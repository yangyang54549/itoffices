<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use app\common\model\User as U;

class User extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected static $isdelete = false;

    protected function filter(&$map)
    {
        if ($this->request->param("id")) {
            $map['id'] = ["like", "%" . $this->request->param("id") . "%"];
        }
        if ($this->request->param("mobile")) {
            $map['mobile'] = ["like", "%" . $this->request->param("mobile") . "%"];
        }
    }


    public function info()
    {
        $id = input('id');
        $user = U::where('id',$id)->find();
        $this->view->assign('list',$user);
        return $this->view->fetch();
    }

}
