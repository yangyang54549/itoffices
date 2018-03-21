<?php
namespace app\index\controller;
use app\admin\Controller;
use app\common\model\Barner as B;
use app\common\model\Consult as C;

class Index  extends Yang
{
    public function index()
    {
         $barner = B::select();
         $this->assign('barner',$barner);
         return $this->fetch();
    }

    public function consult()
    {
        $data = input();
        C::insert($data);
    }

    //原首页
    public function index_bak()
    {
         //$this->redirect('Cases/index');
         return $this->fetch();
    }
}
