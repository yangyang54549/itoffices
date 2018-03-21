<?php
namespace app\index\controller;
use app\admin\Controller;
use app\common\model\Barner as B;

class Index  extends Yang
{
    public function index()
    {
         $barner = B::select();
         $this->assign('barner',$barner);
         return $this->fetch();
    }

    //原首页
    public function index_bak()
    {
         $this->redirect('Cases/index');
         return $this->fetch();
    }
}
