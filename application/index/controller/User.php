<?php
/**
 * @Author: Marte
 * @Date:   2018-04-17 15:05:19
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-17 18:42:14
 */
namespace app\index\controller;
use app\admin\Controller;
use app\common\model\User as U;

class User  extends Yang
{
    public function index()
    {
        $user = U::where('id',1)->find();
        $this->assign('user',$user);
        return $this->fetch();
    }
    public function resume()
    {
        return $this->fetch();
    }
    public function order()
    {
        return $this->fetch();
    }
    public function bianji0()
    {
        return $this->fetch();
    }
    public function bianji1()
    {
        return $this->fetch();
    }
    public function bianji2()
    {
        return $this->fetch();
    }
}