<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;

use app\admin\Controller;
use app\common\model\Type as T;
use app\common\model\Specific as S;
use app\common\model\System as SY;
use app\common\model\CasesOrder as CO;

class Cases extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

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

            $info = $_POST['info'];
            $data['info'] = $info;
            $data['create_time'] = time();
            $data['system_type'] = implode(',',$data['system_type']);
            $data['specific'] = implode(',',$data['specific']);
            //首页图缩略
            //$url = ROOT_PATH.'public'.$data['img'];
            $url = '.'.$data['img'];
            $suo = $this->image_png_size_add($url,$url);

            //二维码生成
            $data['code'] = $this->qrcode($data['preview']);

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
            $type = T::select();
            $specific = S::select();
            $system = SY::select();
            $this->view->assign("type", $type);
            $this->view->assign("specific", $specific);
            $this->view->assign("system", $system);
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
            $info = $_POST['info'];
            $data['info'] = $info;
            $data['create_time'] = time();
            $data['system_type'] = implode(',',$data['system_type']);
            $data['specific'] = implode(',',$data['specific']);

            //首页图缩略
            $url = '.'.$data['img'];
            $suo = $this->image_png_size_add($url,$url);

            //二维码生成
            $data['code'] = $this->qrcode($data['preview']);

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

            $type = T::select();
            $specific = S::select();
            $system = SY::select();
            $this->view->assign("type", $type);
            $this->view->assign("specific", $specific);
            $this->view->assign("system", $system);
            $image = $vo['images'];
            $vo['images'] = substr($vo['images'],1);
            $vo['images'] = explode('@', $vo['images']);
            $this->view->assign("vo", $vo);
            $this->view->assign("image", $image);
            return $this->view->fetch();
        }
    }

   public function upload(){
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");header("Content-Type:text/html; charset=utf-8");
            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
                exit; // finish preflight CORS requests here
            }


            if ( !empty($_REQUEST[ 'debug' ]) ) {
                $random = rand(0, intval($_REQUEST[ 'debug' ]) );
                if ( $random === 0 ) {
                    header("HTTP/1.0 500 Internal Server Error");
                    exit;
                }
            }
            @set_time_limit(5 * 60);

            // Uncomment this one to fake upload time
            // usleep(5000);

            // Settings
            // $targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
            $targetDir = 'upload_tmp';
            $uploadDir = 'upload';

            $cleanupTargetDir = true; // Remove old files
            $maxFileAge = 5 * 3600; // Temp file age in seconds


            // Create target dir
            if (!file_exists($targetDir)) {
                @mkdir($targetDir);
            }

            // Create target dir
            if (!file_exists($uploadDir)) {
                @mkdir($uploadDir);
            }

                    function getFileType($filename) {
                        return substr($filename, strrpos($filename, '.') + 1);
                    }
            if (isset($_REQUEST["name"])) {
             $fileName= uniqid().".". getFileType($_REQUEST["name"]);
            } elseif (!empty($_FILES)) {
                $fileName = $_FILES["file"]["name"];
            } else {
                $fileName = uniqid()."jpg";
            }

            $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
            $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;

            // Chunking might be enabled
            $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
            $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;


            // Remove old temp files
            if ($cleanupTargetDir) {
                if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
                }

                while (($file = readdir($dir)) !== false) {
                    $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                    // If temp file is current file proceed to the next
                    if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                        continue;
                    }

                    // Remove temp file if it is older than the max age and is not the current file
                    if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                        @unlink($tmpfilePath);
                    }
                }
                closedir($dir);
            }


            // Open temp file
            if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }

            if (!empty($_FILES)) {
                if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
                }

                // Read binary input stream and append it to temp file
                if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                }
            } else {
                if (!$in = @fopen("php://input", "rb")) {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                }
            }

            while ($buff = fread($in, 4096)) {
                fwrite($out, $buff);
            }

            @fclose($out);
            @fclose($in);

            rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

            $index = 0;
            $done = true;
            for( $index = 0; $index < $chunks; $index++ ) {
                if ( !file_exists("{$filePath}_{$index}.part") ) {
                    $done = false;
                    break;
                }
            }
            if ( $done ) {
                if (!$out = @fopen($uploadPath, "wb")) {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
                }

                if ( flock($out, LOCK_EX) ) {
                    for( $index = 0; $index < $chunks; $index++ ) {
                        if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                            break;
                        }

                        while ($buff = fread($in, 4096)) {
                            fwrite($out, $buff);
                        }

                        @fclose($in);
                        @unlink("{$filePath}_{$index}.part");
                    }

                    flock($out, LOCK_UN);
                }
                @fclose($out);
            }
        return json($fileName);
    }

    public function oneupload(){
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      exit; // finish preflight CORS requests here
    }
    if ( !empty($_REQUEST[ 'debug' ]) ) {
      $random = rand(0, intval($_REQUEST[ 'debug' ]) );
      if ( $random === 0 ) {
        header("HTTP/1.0 500 Internal Server Error");
        exit;
      }
    }

    // header("HTTP/1.0 500 Internal Server Error");
    // exit;
    // 5 minutes execution time
    @set_time_limit(5 * 60);
    // Uncomment this one to fake upload time
    // usleep(5000);
    // Settings
    // $targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
    $targetDir = 'uploads'.DIRECTORY_SEPARATOR.'file_material_tmp';
    $uploadDir = 'uploads'.DIRECTORY_SEPARATOR.'file_material'.DIRECTORY_SEPARATOR.date('Ymd');
    $cleanupTargetDir = true; // Remove old files
    $maxFileAge = 5 * 3600; // Temp file age in seconds
    // Create target dir
    if (!file_exists($targetDir)) {
      @mkdir($targetDir);
    }
    // Create target dir
    if (!file_exists($uploadDir)) {
      @mkdir($uploadDir);
    }
    // Get a file name
    if (isset($_REQUEST["name"])) {
      $fileName = $_REQUEST["name"];
    } elseif (!empty($_FILES)) {
      $fileName = $_FILES["file"]["name"];
    } else {
      $fileName = uniqid("file_");
    }
    $oldName = $fileName;
    $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
    // $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
    // Chunking might be enabled
    $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
    $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;
    // Remove old temp files
    if ($cleanupTargetDir) {
      if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
      }
      while (($file = readdir($dir)) !== false) {
        $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
        // If temp file is current file proceed to the next
        if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
          continue;
        }
        // Remove temp file if it is older than the max age and is not the current file
        if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
          @unlink($tmpfilePath);
        }
      }
      closedir($dir);
    }

    // Open temp file
    if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
      die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
    }
    if (!empty($_FILES)) {
      if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
      }
      // Read binary input stream and append it to temp file
      if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
      }
    } else {
      if (!$in = @fopen("php://input", "rb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
      }
    }
    while ($buff = fread($in, 4096)) {
      fwrite($out, $buff);
    }
    @fclose($out);
    @fclose($in);
    rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");
    $index = 0;
    $done = true;
    for( $index = 0; $index < $chunks; $index++ ) {
      if ( !file_exists("{$filePath}_{$index}.part") ) {
        $done = false;
        break;
      }
    }



    if ( $done ) {
      $pathInfo = pathinfo($fileName);
      $hashStr = substr(md5($pathInfo['basename']),8,16);
      $hashName = time() . $hashStr . '.' .$pathInfo['extension'];
      $uploadPath = $uploadDir . DIRECTORY_SEPARATOR .$hashName;

      if (!$out = @fopen($uploadPath, "wb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
      }
      if ( flock($out, LOCK_EX) ) {
        for( $index = 0; $index < $chunks; $index++ ) {
          if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
            break;
          }
          while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
          }
          @fclose($in);
          @unlink("{$filePath}_{$index}.part");
        }
        flock($out, LOCK_UN);
      }
      @fclose($out);
      $response = [
        'success'=>true,
        'oldName'=>$oldName,
        'filePaht'=>$uploadPath,
        //'fileSize'=>$data['size'],
        'fileSuffixes'=>$pathInfo['extension']
        //'file_id'=>$data['id'],
        ];

      die(json_encode($response));
    }

   // Return Success JSON-RPC response
    die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
    }
    /**
     * 订单首页
     * @return mixed
     */
    public function order()
    {

        $casesorder = CO::select();
        $this->view->assign('list',$casesorder);
        return $this->view->fetch();
    }

    /**
     * 功能：生成二维码
     * @param string $qrData 手机扫描后要跳转的网址
     * @param string $qrLevel 默认纠错比例 分为L、M、Q、H四个等级，H代表最高纠错能力
     * @param string $qrSize 二维码图大小，1－10可选，数字越大图片尺寸越大
     * @param string $savePath 图片存储路径
     * @param string $savePrefix 图片名称前缀
     */
    // public function qrcode($url)
    // {
    //     $savePath = ROOT_PATH  . 'public/qrcode/';
    //     $webPath = '/qrcode/';
    //     $qrData = $url;
    //     $qrLevel = 'H';
    //     $qrSize = '6';
    //     $savePrefix = 'NickBai';

    //     if($filename = createQRcode($savePath, $qrData, $qrLevel, $qrSize, $savePrefix)){
    //         $pic = $webPath . $filename;
    //     }
    //     //echo "<img src='".$pic."'>";
    //     return $pic;
    // }


}
