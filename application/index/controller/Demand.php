<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:46:09
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-02-11 10:26:24
 */
namespace app\index\controller;
use app\admin\Controller;
use think\Session;

use app\common\model\Cases as C;
use app\common\model\Demand as D;
use app\common\model\Type as T;
use app\common\model\Specific as S;
use app\common\model\System as SY;
use app\common\model\CasesOrder as CO;
use app\common\model\DemandType as DT;
use app\common\model\DemandTrade as DTR;

/**
* 案例
*/
class Demand extends Yang
{
    /*
     * 发布需求
     */
    public function publish()
    {
        if ($this->request->isAjax()) {
            $data = input();
            $data['create_time'] = time();
            $result = D::insert($data);
            if (isset($result)) {
                $this->ret['msg'] = '需求提交成功';
                return json($this->ret);
            }
            $this->ret['msg'] = '需求提交成功';
            $this->ret['code'] = -200;
            return json($this->ret);
        }else{
            $demandtrade = DTR::select();
            $demandtype = DT::select();
            $this->assign('demandtrade',$demandtrade);
            $this->assign('demandtype',$demandtype);
            return $this->fetch();
        }
    }
    /*
     * 需求首页
     */
    public function index()
    {
        if ($this->request->isAjax()) {

            $type = input('type');
            $schedule = input('schedule');
            $where = [];

            if (isset($type)) {
                if ($type!=0) {
                    $where['type']=$type;
                }
            }
            if(isset($schedule)){
                if ($schedule!=0) {
                    $where['specific']=$schedule;
                }
            }

            $demand = D::where($where)->select();
            if (isset($demand)) {
                $str = '反反复复';
                foreach ($demand as $k => $v) {

                    $dt = DT::where(['id'=>$v['type']])->find();
                    $demand[$k]['type'] = $dt['name'];
                    $dtr = DTR::where(['id'=>$v['industry']])->find();
                    $demand[$k]['industry'] = $dtr['name'];
                    if ($v['schedule']==1) {
                        $v['schedule'] = "招募中";
                    }elseif($v['schedule']==2){
                        $v['schedule'] = "对接中";
                    }elseif($v['schedule']==3){
                        $v['schedule'] = "执行中";
                    }else{
                        $v['schedule'] = "已完成";
                    }

                    $str += '<div class="demandBox" tid="799" onclick="window.open('.url("Demand/inside",["id"=>$v["id"]]).')">
                        <div class="marking" style="background-image:url(https://www.315pr.com/resources/bootstrap/reset/img/demand_status_yellow.png)">'.$v['schedule'].'
                        </div>
                        <div class="demandTitle">'.$v['name'].'</div>
                        <div class="accomplishDate"><span>发布时间</span><span>'.date($v['create_time']).'</span></div>
                        <div class="abbreviationBox"><span>'.$v['industry'].'</span><span>'.$v['type'].'</span><em class="clear"></em></div>
                        <div class="unitPriceBox">'.$v['money'].'</div>
                        <div class="bottomColor">
                            <div class="applyFor">已申请'.$v['apply'].'人</div>
                            <div class="lookOver">已浏览'.$v['browse'].'人</div>
                        </div>
                    </div>';
                }

                $this->ret['msg'] = $str;
                return json($this->ret);
            }
            $this->ret['msg'] = '暂无更多数据';
            return json($this->ret);
        }else{
            $demandtype = DT::select();
            $demand = D::select();
            foreach ($demand as $k => $v) {
                $dt = DT::where(['id'=>$v['type']])->find();
                $demand[$k]['type'] = $dt['name'];
                $dtr = DTR::where(['id'=>$v['industry']])->find();
                $demand[$k]['industry'] = $dtr['name'];
            }
            $this->assign('url',LUR);
            $this->assign('demandtype',$demandtype);
            $this->assign('demand',$demand);
            return $this->fetch();
        }
    }
    /*
     * 内页
     */
    public function inside()
    {
        $id = input('id');
        $demand = D::where('id',$id)->find();
        $dt = DT::where(['id'=>$demand['type']])->find();
        $demand['type'] = $dt['name'];
        $dtr = DTR::where(['id'=>$demand['industry']])->find();
        $demand['industry'] = $dtr['name'];
        // $demandtype = DT::select();
        // $demand = D::select();
        // foreach ($demand as $k => $v) {
        //     $dt = DT::where(['id'=>$v['type']])->find();
        //     $demand[$k]['type'] = $dt['name'];
        //     $dtr = DTR::where(['id'=>$v['industry']])->find();
        //     $demand[$k]['industry'] = $dtr['name'];
        // }
        // $this->assign('demandtype',$demandtype);
        $this->assign('demand',$demand);
        return $this->fetch();
    }
}