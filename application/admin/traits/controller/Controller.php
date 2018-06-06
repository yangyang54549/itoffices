<?php
/**
 * tpAdmin [a web admin based ThinkPHP5]
 *
 * @author    yuan1994 <tianpian0805@gmail.com>
 * @link      http://tpadmin.yuan1994.com/
 * @copyright 2016 yuan1994 all rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace app\admin\traits\controller;

use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;

trait Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index()
    {
        $model = $this->getModel();

        // 列表过滤器，生成查询Map对象
        $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete]);

        // 特殊过滤器，后缀是方法名的
        $actionFilter = 'filter' . $this->request->action();
        if (method_exists($this, $actionFilter)) {
            $this->$actionFilter($map);
        }

        // 自定义过滤器
        if (method_exists($this, 'filter')) {
            $this->filter($map);
        }

        $this->datalist($model, $map);

        return $this->view->fetch();
    }

    /**
     * 回收站
     * @return mixed
     */
    public function recycleBin()
    {
        $this::$isdelete = 1;

        return $this->index();
    }

    /**
     * 添加
     * @return mixed
     */
    public function add()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            // 插入
            $data = $this->request->except(['id']);

            // 验证
            if (class_exists($validateClass = Loader::parseClass(Config::get('app.validate_path'), 'validate', $controller))) {
                $validate = new $validateClass();
                if (!$validate->check($data)) {
                    return ajax_return_adv_error($validate->getError());
                }
            }

            // 写入数据
            if (
                class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $this->parseCamelCase($controller)))
                || class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $controller))
            ) {
                //使用模型写入，可以在模型中定义更高级的操作
                $model = new $modelClass();
                $ret = $model->isUpdate(false)->save($data);
            } else {
                // 简单的直接使用db写入
                Db::startTrans();
                try {
                    $model = Db::name($this->parseTable($controller));
                    $ret = $model->insert($data);
                    // 提交事务
                    Db::commit();
                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();

                    return ajax_return_adv_error($e->getMessage());
                }
            }

            return ajax_return_adv('添加成功');
        } else {
            // 添加
            return $this->view->fetch(isset($this->template) ? $this->template : 'edit');
        }
    }

    /**
     * 编辑
     * @return mixed
     */
    public function edit()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            // 更新
            $data = $this->request->post();
            if (!$data['id']) {
                return ajax_return_adv_error("缺少参数ID");
            }

            // 验证
            if (class_exists($validateClass = Loader::parseClass(Config::get('app.validate_path'), 'validate', $controller))) {
                $validate = new $validateClass();
                if (!$validate->check($data)) {
                    return ajax_return_adv_error($validate->getError());
                }
            }

            // 更新数据
            if (
                class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $this->parseCamelCase($controller)))
                || class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $controller))
            ) {
                // 使用模型更新，可以在模型中定义更高级的操作
                $model = new $modelClass();
                $ret = $model->isUpdate(true)->save($data, ['id' => $data['id']]);
            } else {
                // 简单的直接使用db更新
                Db::startTrans();
                try {
                    $model = Db::name($this->parseTable($controller));
                    $ret = $model->where('id', $data['id'])->update($data);
                    // 提交事务
                    Db::commit();
                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();

                    return ajax_return_adv_error($e->getMessage());
                }
            }

            return ajax_return_adv("编辑成功");
        } else {
            // 编辑
            $id = $this->request->param('id');
            if (!$id) {
                throw new HttpException(404, "缺少参数ID");
            }
            $vo = $this->getModel($controller)->find($id);
            if (!$vo) {
                throw new HttpException(404, '该记录不存在');
            }

            $this->view->assign("vo", $vo);

            return $this->view->fetch();
        }
    }

    /**
     * 默认删除操作
     */
    public function delete()
    {
        return $this->updateField($this->fieldIsDelete, 1, "移动到回收站成功");
    }

    /**
     * 从回收站恢复
     */
    public function recycle()
    {
        return $this->updateField($this->fieldIsDelete, 0, "恢复成功");
    }

    /**
     * 默认禁用操作
     */
    public function forbid()
    {
        return $this->updateField($this->fieldStatus, 0, "禁用成功");
    }


    /**
     * 默认恢复操作
     */
    public function resume()
    {
        return $this->updateField($this->fieldStatus, 1, "恢复成功");
    }


    /**
     * 永久删除
     */
    public function deleteForever()
    {
        $model = $this->getModel();
        $pk = $model->getPk();
        $ids = $this->request->param($pk);
        $where[$pk] = ["in", $ids];
        if (false === $model->where($where)->delete()) {
            return ajax_return_adv_error($model->getError());
        }

        return ajax_return_adv("删除成功");
    }

    /**
     * 清空回收站
     */
    public function clear()
    {
        $model = $this->getModel();
        $where[$this->fieldIsDelete] = 1;
        if (false === $model->where($where)->delete()) {
            return ajax_return_adv_error($model->getError());
        }

        return ajax_return_adv("清空回收站成功");
    }

    /**
     * 保存排序
     */
    public function saveOrder()
    {
        $param = $this->request->param();
        if (!isset($param['sort'])) {
            return ajax_return_adv_error('缺少参数');
        }

        $model = $this->getModel();
        foreach ($param['sort'] as $id => $sort) {
            $model->where('id', $id)->update(['sort' => $sort]);
        }

        return ajax_return_adv('保存排序成功', '');
    }

   /*
    * desription 压缩图片
    * @param sting $imgsrc 图片路径
    * @param string $imgdst 压缩后保存路径
    */
    public function image_png_size_add($imgsrc,$imgdst){
      list($width,$height,$type)=getimagesize($imgsrc);
      //等比例缩小

      $new_width = 400;
      $new_height = $height/($width/400);

      // $new_width = 200;
      // $new_height =1500;

      switch($type){
        case 1:

            $image_wp=imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromgif($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst,100);
            imagedestroy($image_wp);
            return true;
            break;
        case 2:

            $image_wp=imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst,100);
            imagedestroy($image_wp);
            return true;
            break;
        case 3:

            $image_wp=imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefrompng($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst,100);
            imagedestroy($image_wp);
            return true;
            break;
        default:

            return false;
      }
      return false;
    }
    /*
     * 发送get请求
     */
    public function concurl($url)
    {
            //初始化curl
            $ch = curl_init($url);
            //设置超时
            curl_setopt($ch, CURLOPT_TIMEOUT,30);
            curl_setopt($ch, CURLOPT_HEADER,FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
            //运行curl，结果以jason形式返回
            $res = curl_exec($ch);
            curl_close($ch);
         //　　//打印获得的数据
             //$data=json_decode($res,true);
             return $res;
    }

    /**
     * 功能：生成二维码
     * @param string $qrData 手机扫描后要跳转的网址
     * @param string $qrLevel 默认纠错比例 分为L、M、Q、H四个等级，H代表最高纠错能力
     * @param string $qrSize 二维码图大小，1－10可选，数字越大图片尺寸越大
     * @param string $savePath 图片存储路径
     * @param string $savePrefix 图片名称前缀
     */
    public function qrcode($url)
    {
        $savePath = ROOT_PATH  . 'public/qrcode/';
        $webPath = '/qrcode/';
        $qrData = $url;
        $qrLevel = 'H';
        $qrSize = '6';
        $savePrefix = 'NickBai';

        if($filename = createQRcode($savePath, $qrData, $qrLevel, $qrSize, $savePrefix)){
            $pic = $webPath . $filename;
        }
        //echo "<img src='".$pic."'>";
        return $pic;
    }

    /*
     * 短信公共方法 根据不同model使用不同的模版
     * mobile 手机号码
     * model 1登录 2注册 3忘记密码修改密码 4修改支付密码 5修改手机号码
     */
    public function message($mobile,$model)
    {
        $cons = '';
        $randStr = str_shuffle('1234567890');
        $rand = substr($randStr,0,6);

        if ($model==1) {
            $cons = "【趣味农场】您正在登录,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }elseif($model==2){
            $cons = "【趣味农场】您正在注册,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }elseif($model==3){
            $cons = "【趣味农场】您正在绑定手机号码,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }elseif($model==4){
            $cons = "【趣味农场】您正在修改支付密码,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }elseif($model==5){
            $cons = "【趣味农场】您正在修改手机号码,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }

        Session::set($mobile,$rand);
        Session::set($rand,time());
        $url='http://117.78.52.216:9003';//系统接口地址
        $conss = iconv('UTF-8', 'gbk', $cons);
        $content=urlencode($conss);
        $username="13613820359";//用户名
        $password="ODIwMzU5";//密码百度BASE64加密后密文
        $url=$url."/servlet/UserServiceAPI?method=sendSMS&extenno=&isLongSms=0&username=".$username."&password=".$password."&smstype=0&mobile=".$mobile."&content=".$content;
        $data = $this->concurl($url);
        return $data;
    }

}
