<?php
/**
 * @Author: Marte
 * @Date:   2018-06-04 10:59:16
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-06-04 17:54:44
 */
namespace app\index\controller;
use app\admin\Controller;
use think\Session;

use app\common\model\CasesPay;


class Native extends Yang
{

    public function index()
    {

        $data = input('post.');
        $data['order_id'] = 'HG'.time();
        $data['user_id'] = Session::get('user.id');

        $data['create_time'] = time();
        $result = CasesPay::insert();

        if ($result) {

            $result = \Wxpay\example\Native::getPayImage($data['money']*100);
            $this->ret['data'] = $result;
            return json($this->ret);
        }else{
            $this->ret['code'] = -200;
            $this->ret['msg'] = "订单生产失败";
            return json($this->ret);
        }
    }

}