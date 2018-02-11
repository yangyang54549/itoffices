<?php
namespace app\index\controller;
use app\admin\Controller;

class Index  extends Yang
{
    public function index()
    {
        return $this->fetch();
    }
}
