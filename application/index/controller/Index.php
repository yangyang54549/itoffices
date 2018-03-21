<?php
namespace app\index\controller;
use app\admin\Controller;

class Index  extends Yang
{
    public function index()
    {

         return $this->fetch();
    }

    //原首页
    public function index_bak()
    {
         $this->redirect('Cases/index');
         return $this->fetch();
    }
}
