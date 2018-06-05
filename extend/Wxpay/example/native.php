<?php
namespace Wxpay\example;

use think\Loader;

Loader::import('Wxpay.lib.WxPayApi');
Loader::import('Wxpay.lib.WxPayNativePay');
//require_once "../lib/WxPayApi.php";
// require_once "WxPay.NativePay.php";
require_once 'log.php';
//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
class Native
{

    public static function getPayImage($money,$name)
    {
        $notify = new \NativePay();

        $input = new \WxPayUnifiedOrder();
        $input->SetBody($name);
        $input->SetAttach("test");
        $input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee($money);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://keji.yingjisong.com/example/notify.php");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id("123456789");
        $result = $notify->GetPayUrl($input);
        $url2 = $result["code_url"];
        return $url2;
    }
}

?>