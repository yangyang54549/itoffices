<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:46:09
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-06-04 10:49:28
 */
namespace app\index\controller;
use app\admin\Controller;
use think\Session;

use app\common\model\Cases as C;
use app\common\model\Type as T;
use app\common\model\Specific as S;
use app\common\model\System as SY;
use app\common\model\CasesOrder as CO;

class Wxpay extends Yang
{
    /*
     *  统一下单
     */
    public function index()
    {

        $url = "http://keji.yingjisong.com/wxpay/example/native.php?money=5000";

        $img = $this->curlget($url);

        //dump($img);die;

        $ht = '<html>
            <head>
                <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1" />
                <title>微信支付样例</title>
            </head>
            <body>
                <div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式二</div><br/>
                <img alt="模式二扫码支付"  src="http://paysdk.weixin.qq.com/example/qrcode.php?data='.urlencode($img).'" style="width:150px;height:150px;"/>

            </body>
            </html>';

        echo $ht;
    }

    /*
     *  回调
     */
    public function notify()
    {

    }

    public function curlget($url)
    {
            file_put_contents("test.txt", $url);
            //初始化curl
            $ch = curl_init($url);
            //设置超时
            curl_setopt($ch, CURLOPT_TIMEOUT,30);
            curl_setopt($ch, CURLOPT_HEADER,FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
            //运行curl，结果以jason形式返回
            $res = curl_exec($ch);
            curl_close($ch);
            //file_put_contents("test.txt", $res);
         //　　//打印获得的数据
             //$data=json_decode($res,true);
             return $res;
    }

}