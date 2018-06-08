<?php
/**
 * @Author: Marte
 * @Date:   2018-06-04 10:59:16
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-06-08 16:03:37
 */
namespace app\index\controller;
use app\admin\Controller;
use think\Session;

use app\common\model\CasesPay;
use app\common\model\Cases;
use app\common\model\User;


class Native extends Yang
{
    //扫码支付
    public function index()
    {

        $data = input('post.');

        $Cases = Cases::where('id',$data['cases_id'])->find();

        $data['cases_user_id'] = $Cases['user_id'];
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
            //file_put_contents('wxpaylog.txt','开始记录===='.date("Y-m-d H:i:s",time()).'====='.$xml.'====='.PHP_EOL,FILE_APPEND);

            $casespay = CasesPay::where(['order_id'=>$arr['out_trade_no'],'status'=>1])->find();
            if(!isset($casespay)){
                CasesPay::where(['order_id'=>$arr['out_trade_no']])->update(['status'=>1]);
                $casespay = CasesPay::where(['order_id'=>$arr['out_trade_no']])->find();
                $user = User::where('id',$casespay['cases_user_id'])->find();
                $money = $user['money']+$casespay['money'];
                file_put_contents('wxpaylog.txt','开始增加金额===='.$money.'用户id'.$casespay['cases_user_id'].date("Y-m-d H:i:s",time()).'====='.$xml.'====='.PHP_EOL,FILE_APPEND);
                User::where(['id'=>$casespay['cases_user_id']])->update(['money'=>intval($money)]);

            }


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