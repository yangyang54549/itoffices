<?php
/**
 * @Author: Marte
 * @Date:   2018-06-04 10:59:16
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-06-05 18:57:17
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

            $result = \Wxpay\example\Native::getPayImage($data['money'],$data['name'],$data['order_id']);
            $this->ret['data'] = "http://paysdk.weixin.qq.com/example/qrcode.php?data=".urlencode($result);
            $this->ret['order_id'] = $data['order_id'];
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

            $xml = file_get_contents('php://input');

            $arr = json_decode(json_encode((array) simplexml_load_string($xml,'SimpleXMLElement', LIBXML_NOCDATA)), true);
            file_put_contents('wxpaylog.txt','开始记录===='.date("Y-m-d H:i:s",time()).'====='.$xml.'====='.PHP_EOL,FILE_APPEND);

            CasesPay::where(['order_id'=>$arr['out_trade_no']])->update(['status'=>1]);

            //$notify = new \Wxpay\example\Notify;
            //return $notify->isorder();
    }

    //支付查询
    public function inquire()
    {

        $order_id = input('post.order_id');

        $result = CasesPay::where(['order_id'=>$order_id])->find();

        if (!empty($result) && $result['status']==1) {
            return json($this->ret);
        }else{
            $this->ret['code'] = -200;
            $this->ret['msg'] = "订单未支付";
            return json($this->ret);
        }
    }

}