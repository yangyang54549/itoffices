<?php
namespace app\bak\controller;
use app\admin\Controller;
use app\common\model\Barner as B;
use app\common\model\Consult as C;

class Index  extends Yang
{

    public function consult()
    {
        $data = input();
        $data['create_time'] = time();
        C::insert($data);
    }
    public function lxwm()
    {
         //$this->redirect('Cases/index');
         return $this->fetch();
    }
    //原首页
    public function index()
    {
         $this->redirect('index/one');
    }
    //新首页
    public function one()
    {
         //$this->redirect('Cases/index');
         return $this->fetch();
    }

}
