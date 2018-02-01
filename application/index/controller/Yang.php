<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:47:48
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-01-31 18:06:15
 */

namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Cookie;

class yang extends Controller
{
    public function __construct()
    {
        $this->ret = ['code'=>1,'data'=>'','msg'=>'提交成功'];//1是成功 -200是失败
        parent::__construct();
    }
}