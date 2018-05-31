<?php
/**
 * @Author: Marte
 * @Date:   2017-12-08 10:07:44
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-05-31 14:43:36
 */
namespace app\bak\controller;
use app\bak\controller\Yang;
use think\Request;
use think\Db;
use think\Session;
use think\Cookie;
use app\common\model\User;

/**
* 会员管理
*/
class Login extends Yang
{
    use \app\admin\traits\controller\Controller;
    public function login()
    {
        if ($this->request->isAjax()){
            $data = input();

        }else{
            return  $this->fetch();
        }
    }

    public function wxlogin()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            //在微信内打开
            $getuser = new Getuser;
            if (input('referrer')) {
                Session::set('referrer',input('referrer'));
            }
            if (input('gouwu')) {
                Session::set('gouwu',input('gouwu'));
            }
            if (input('gongxiang')) {
                Session::set('gongxiang',input('gongxiang'));
            }
            $url = $getuser->geturl();
            $this->redirect($url);
        }else{
            //不在微信内
            echo '请在微信内使用微信登录';
        }
    }

    public function getaccess_token()
    {
        $code = input('code');
        if (isset($code)) {
            $getuser = new Getuser;
            $result = $getuser->getaccess_token($code);
            //echo $result;die;
            //是否成功 成功跳转
            if (Session::get('isopenid')==1) {
                $this->redirect(url('member/pay'));
            }
            if (Session::get('isopenid')==2) {
                $this->redirect(url('Supermarket/gouwuche'));
            }
            if (Session::get('isopenid')==3) {
                $this->redirect(url('wap/Gongxiang/banner'));
            }
            if ($result) {
                if (Session::get('user.mobile') == '') {
                    return $this->fetch('phone');
                }
                if (Session::get('user.authentication') == 0) {
                    return $this->fetch('identity');
                }
                $this->redirect(url('index/index'));
            }else{
                echo "微信获取失败,请从新登录!";
            }
        }else{
            echo "微信获取失败,请从新登录!";
        }
    }

    //登录验证
    public function checkindex()
    {
        if ($this->request->isAjax() && $this->request->isPost())
        {

        $mobile=input('post.mobile');
        $code=input('post.code');

        if (!$mobile) {
            $this->ret['msg'] = '手机号不能为空';
            $this->ret['code'] = -200;
            return json($this->ret);
        }

        if ($code == '') {
            return json(['code'=>1, 'msg'=>'短信验证码不能为空']);
        }
        // if ($code != Session::get($mobile)) {
        //     $this->ret['msg'] = '短信验证码错误';
        //     $this->ret['code'] = -200;
        //     return json($this->ret);
        // }
        // $times=Session::get($code);
        // if (time() > ($times+5*60)) {
        //     Session::delete($times);
        //     $this->ret['msg'] = '短信验证码已失效';
        //     $this->ret['code'] = -200;
        //     return json($this->ret);
        // }

        $res = User::where(['mobile'=>$mobile])->find();
        if (isset($res)) {
                //存cookie

                // Session::delete($mobile);
                // Session::delete($times);

                Session::set('user',$res);
                $this->ret['msg'] = '登录成功';
                return json($this->ret);

        } else {

            $row['mobile']=$mobile;
            $row['user_name'] = '程序员';
            $row['create_time']=time();
            $row['gender']='男';
            $res = User::insert($row);

            if ($res!==false) {

                // Session::delete($mobile);
                // Session::delete($times);

                $res = User::where(['mobile'=>$mobile])->find();
                Session::set('user',$res);
                $this->ret['msg'] = '登录成功';
                return json($this->ret);
            }
            $this->ret['msg'] = '登录失败';
            $this->ret['code'] = -200;
            return json($this->ret);

        }
            $this->ret['msg'] = '登录失败';
            $this->ret['code'] = -200;
            return json($this->ret);
        }else{
            $this->ret['msg'] = '非法请求';
            $this->ret['code'] = -200;
            return json($this->ret);
        }
    }
    /**
     * 用户注册操作 tml 20170920
     */
    public function checkreg()
    {
        if ($this->request->isAjax() && $this->request->isPost())
        {
            $mobile    = input('post.mobile');
            //$password  = input('post.password');
            $name    = input('post.name');
            $code      = input('post.code');//验证码
            $referer  =input('post.referer');

            $row['mobile']=input('post.mobile');
            //$row['password']=input('post.password');
            $row['name']=input('post.name');
            $row['referrer']=input('post.referrer');



            if (!$mobile) {
                return json(['code'=>1, 'msg'=>'手机号不能为空']);
            }
            if (!checkMobile($mobile)) {
                return json(['code'=>1, 'msg'=>'手机号格式不正确']);
            }
            $user = User::where(['mobile'=>$mobile])->find();
            if ($user) {
                return json(['code'=>1, 'msg'=>'手机号已存在']);
            }
            if ($code != Session::get($mobile)) {
                return json(['code'=>1, 'msg'=>'短信验证码错误']);
            }
            $times=Session::get($code);
            if (time() > ($times+5*60)) {
                Session::delete($times);
                return json(['code'=>1, 'msg'=>'短信验证码已失效']);
            }
            // if (!$password) {
            //     return json(['code'=>1, 'msg'=>'密码不能为空']);
            // }
            // if (strlen($password) > 20 || strlen($password) < 6) {
            //     return json(['code'=>1, 'msg'=>'密码长度需在6~20位之间']);
            // }

            $row['create_time']=time();
            $row['status']=1;
            $row['login_time']=time();
            $row['integral']=1000;
            $res = User::insert($row);
            if ($res!==false) {
                Session::delete($mobile);
                Session::delete($times);
                $res = User::where(['mobile'=>$mobile])->find();
                $user_login = rand('10000000','99999999');
                User::where(['mobile'=>$mobile])->update(['user_login'=>$user_login]);
                $res['user_login'] = $user_login;
                Session::set('user',$res);
                Cookie::set('user_id',$res['id'],2592000);
                return json(['code'=>200, 'msg'=>'注册成功']);
            }
            return json(['code'=>1, 'msg'=>'注册失败']);

        }else{
            return json(['code'=>1, 'msg'=>'非法请求']);
        }
    }
    /*
     * 发送验证码
     */
    public function codemsg()
    {
        if ($this->request->isAjax() && $this->request->isPost()){
            $mobile = input('mobile');
            $model = input('model');
            if ($mobile==''||$model=='') {
                return json(['code'=>1, 'msg'=>'数据丢失']);
            }
            if (!checkMobile($mobile)) {
                return json(['code'=>1, 'msg'=>'手机号格式不正确']);
            }
            $result = $this->message($mobile,$model);
            if ($result) {
                return json(['code'=>200, 'msg'=>'发送成功']);
            }
            return json(['code'=>1, 'msg'=>'发送失败']);
        }
        return json(['code'=>1, 'msg'=>'非法请求']);
    }

    /*
     * 修改密码
     */
    public function nopassword()
    {
          if ($this->request->isAjax() && $this->request->isPost())
                {
                $mobile=Session::get('user.mobile');
                if (!isset($mobile)) {
                    $mobile = input('post.mobile');
                }
                $password=input('post.password');
                $arr['mobile']= $mobile;
                $arr['password'] = md5($password);
                $code      = input('post.code');

                if (!$password) {
                    return json(['code'=>1, 'msg'=>'密码不能为空']);
                }
                if (!$mobile) {
                    return json(['code'=>1, 'msg'=>'密码不能为空']);
                }
                //$scode = empty($_SESSION['code'][$mobile]['code']) ? '' : $_SESSION['code'][$mobile]['code'];
                //$stime = empty($_SESSION['code'][$mobile]['time']) ? 0 : $_SESSION['code'][$mobile]['time'];
                //if (!$scode || $scode != $messcode) {
                //   echo json_encode(array('code'=>-200,'msg'=>'短信验证码错误'));exit;
                //}
                // if ($scode && $scode == $messcode) {
                //     if (time() > ($stime + 5*60)) {
                //         echo json_encode(array('code'=>-200,'msg'=>'短信验证码已失效'));exit;
                //     }
                // }

                $res = User::where(['mobile'=>$mobile])->find();

                if (isset($res)) {

                    $ress = User::where(['mobile'=>$mobile])->update($arr);
                    return json(['code'=>200, 'msg'=>'重置密码成功']);
                }else{
                    return json(['code'=>1, 'msg'=>'用户不存在']);
                }

                return json(['code'=>1, 'msg'=>'重置密码失败']);

                }else{
                    return $this->fetch();
                }
    }


    /*
     * 绑定手机号码
     */
    public function mobile()
    {
        if ($this->request->isAjax() && $this->request->isPost()){
                $mobile=input('post.mobile');
                $code      = input('post.code');
                $arr['mobile']= $mobile;

                if (!$mobile) {
                    return json(['code'=>1, 'msg'=>'支付密码不能为空']);
                }
                if ($code != Session::get($mobile)) {
                    return json(['code'=>1, 'msg'=>'短信验证码错误']);
                }
                $times=Session::get($code);
                if (time() > ($times+5*60)) {
                    Session::delete($times);
                    return json(['code'=>1, 'msg'=>'短信验证码已失效']);
                }
                Session::delete($mobile);
                Session::delete($times);
                $user = User::where(['mobile'=>$mobile])->find();
                if (isset($user)) {
                    if (!empty($user['openid'])) {
                        return json(['code'=>1, 'msg'=>'手机号码已被绑定']);
                    }else{
                        $err = ['code'=>200, 'msg'=>'绑定手机号码成功'];
                        Db::startTrans();
                        try{
                            $err = ['code'=>1, 'msg'=>'绑定手机号码失败111'];
                            $wxuser = User::where(['id'=>$this->id])->find();
                            $upda['openid'] = $wxuser['openid'];
                            $upda['image'] = $wxuser['image'];
                            $upda['name'] = $wxuser['name'];
                            $upda['user_login'] = $wxuser['user_login'];
                            $result = User::where(['mobile'=>$mobile])->update($upda);
                            if ($result!==false) {
                                db('user')->delete($this->id);
                                $user = User::where(['mobile'=>$mobile])->find();
                                Session::set('user',$user);
                                Cookie::set('user_id',$user['id']);
                                $err = ['code'=>200, 'msg'=>'绑定手机号码成功'];
                            }
                            Db::commit();
                        } catch (\Exception $e) {
                            // 回滚事务
                            Db::rollback();
                        }
                        return json($err);
                    }
                }else{
                    $ress = User::where(['id'=>$this->id])->update($arr);
                    if ($ress!==false) {
                        Session::set('user.mobile',$mobile);
                        return json(['code'=>200, 'msg'=>'绑定手机号码成功']);
                    }
                    return json(['code'=>1, 'msg'=>'绑定手机号码失败']);
                }

        }else{
            return $this->fetch();
        }
    }
    /*
     * 绑定手机号码
     */
    public function phone()
    {
        $user = User::where(['id'=>$this->id])->find();
        if (!empty($user['mobile'])) {
           $this->redirect('index/index');
        }
        return $this->fetch();
    }
    /*
     * 测试用登录
     */
    public function admin()
    {
       $user = User::where(['id'=>1])->find();
       Session::set('user',$user);
       echo 'ok';
    }
    /*
     * 退出
     */
    public function exits()
    {
        Session::delete('user');
        $this->redirect('demand/index');
        echo 'ok';
    }
}
