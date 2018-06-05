<?php
/**
 * @Author: Marte
 * @Date:   2018-06-04 10:59:16
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-06-05 15:43:09
 */
namespace app\bak\controller;
use app\admin\Controller;
use think\Session;

use app\common\model\CasesPay;


class Native extends Yang
{
    //扫码支付
    public function index()
    {

        $data = input('post.');
        $data['order_id'] = 'HG'.time();
        $data['user_id'] = Session::get('user.id');

        $data['create_time'] = time();
        $result = CasesPay::insert($data);

        if ($result) {

            $result = \Wxpay\example\Native::getPayImage($data['money'],$data['name']);
            $this->ret['data'] = "http://paysdk.weixin.qq.com/example/qrcode.php?data=".urlencode($result);
            return json($this->ret);
        }else{
            $this->ret['code'] = -200;
            $this->ret['msg'] = "订单生产失败";
            return json($this->ret);
        }
    }

    //回调通知
    public function notify()
    {

            file_put_contents('wxpaylog.txt','开始记录===='.date("Y-m-d H:i:s",time()).'====='.PHP_EOL,FILE_APPEND);
            $notify = new \Wxpay\example\PayNotifyCallBack;
            $notify->Handle(false);

    }


}