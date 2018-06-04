<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:47:48
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-06-04 11:14:29
 */

namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Cookie;
use app\common\model\User;

class yang extends Controller
{
    protected $arr = ['Cases/index','Cases/inside','Cases/computers','Cases/phones','Cases/order','Demand/index','Demand/inside','Index/index','Index/index_bak','Login/codemsg','Login/login','Login/checkindex','Login/admin','Index/one','Index/lxwm','Wxpay/index','Native/index'];
    protected $ret = ['code'=>1,'data'=>'','msg'=>'提交成功'];//1是成功 -200是失败

    public function __construct()
    {
        parent::__construct();
        $request=  \think\Request::instance();
        $con = $request->controller();
        $act = $request->action();
        $url = $con.'/'.$act;
        if (!in_array($url,$this->arr)) {

            $user = Session::get('user');
            if (!isset($user)) {
                //未登录
                $this->redirect('login/login');
            }

        }
    }
}