<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:46:09
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-02-11 14:50:38
 */
namespace app\index\controller;
use app\admin\Controller;
use think\Session;

use app\common\model\Cases as C;
use app\common\model\Type as T;
use app\common\model\Specific as S;
use app\common\model\System as SY;
use app\common\model\CasesOrder as CO;

/**
* 案例
*/
class Cases extends Yang
{
    public function index()
    {
        if ($this->request->isAjax()) {

            $type = input('type');
            $schedule = input('schedule');
            $industry = input('industry');
            $where = [];

            if (isset($type)) {
                if ($type!=0) {
                    $where['type']=$type;
                }
            }

            if(isset($schedule)){
                if ($schedule!=0) {
                    $where['schedule']=$schedule;
                }
            }

            if (isset($industry)) {
                if ($industry!=0) {
                    $where['industry']=$industry;
                }
            }

            $str = '';
            $demand = D::where($where)->order('create_time desc')->select();

            if (!empty($demand)) {

                foreach ($demand as $k => $v) {

                    $dt = DT::where(['id'=>$v['type']])->find();
                    $demand[$k]['type'] = $dt['name'];
                    $dtr = DTR::where(['id'=>$v['industry']])->find();
                    $demand[$k]['industry'] = $dtr['name'];
                    $schedule = '';
                    if ($v['schedule']==1) {
                        $schedule = "招募中";
                    }elseif($v['schedule']==2){
                        $schedule = "对接中";
                    }elseif($v['schedule']==3){
                        $schedule = "执行中";
                    }else{
                        $schedule = "已完成";
                    }
                    $url = url("Demand/inside",["id"=>$v["id"]]);
                    $str .= '<div class="demandBox" tid="799" onclick="window.open('."'".$url."'".')">
                        <div class="marking content-bg-fff'.$v["schedule"].'">'.$schedule.'
                        </div>
                        <div class="demandTitle">'.$v['name'].'</div>
                        <div class="accomplishDate"><span>发布时间</span><span>'.date('y-m-d h:i:s',$v['create_time']).'</span></div>
                        <div class="abbreviationBox"><span>'.$v['industry'].'</span><span>'.$v['type'].'</span><em class="clear"></em></div>
                        <div class="unitPriceBox">'.$v['money'].'</div>
                        <div class="bottomColor">
                            <div class="applyFor">已申请'.$v['apply'].'人</div>
                            <div class="lookOver">已浏览'.$v['browse'].'人</div>
                        </div>
                    </div>';

                }

                $this->ret['data'] = $str;
                return json($this->ret);
            }
            $this->ret['data'] = '暂无更多数据';
            $this->ret['msg'] = '暂无更多数据';
            return json($this->ret);

        }else{
            $types = T::select();
            $specifics = S::select();
            $systems = SY::select();
            $cases = C::order('create_time desc')->page(1,10)->select();
            $arr = $cases;
            foreach ($cases as $key => $value) {
                $system_type = explode(',' , $value['system_type']);
                // if (!empty($types_id) && !in_array($types_id,$system_type)) {
                //     unset($arr[$key]);
                //     continue;
                // }

                $type = T::where(['id'=>$value['type']])->find();
                $arr[$key]['type'] = $type['name'];
                $specific = S::where(['id'=>$value['specific']])->find();
                $arr[$key]['specific'] = $specific['name'];

                for ($i=0; $i < count($system_type); $i++) {
                    $system = SY::where(['id'=>$system_type[$i]])->find();
                    $system_type[$i] = $system['name'];
                }
                $arr[$key]['system_type'] = $system_type;
            }

            $this->view->assign("type", $types);
            $this->view->assign("specific", $specifics);
            $this->view->assign("system", $systems);
            //var_dump($arr);die;
            $this->view->assign("cases", $arr);
            return $this->fetch();
        }
    }

    public function inside()
    {
        $id = input('id');
        $cases = C::where(['id'=>$id])->find();
        $type = T::where(['id'=>$cases['type']])->find();
        $cases['type']=$type['name'];

        $specific = S::where(['id'=>$cases['specific']])->find();
        $cases['specific']=$specific['name'];
        $fetch = 0;
        $system_type = explode(',' , $cases['system_type']);
        for ($i=0; $i < count($system_type); $i++) {
            $specific = SY::where(['id'=>$system_type[$i]])->find();
            $system_type[$i] =  $specific['name'];
        }

        $cases['images'] = substr($cases['images'],1);
        $cases['images'] = explode('@', $cases['images']);
        $this->view->assign("cases", $cases);
        $this->view->assign("system_type", $system_type);
        $fet = '';
        if ($cases['is_pp']==0) {
            $fet = 'computer';
        }else{
            $fet = 'phone';
        }
        return $this->fetch($fet);
    }

    public function computers()
    {
        $id = input('id');
        $cases = C::where(['id'=>$id])->find();
        $images = substr($cases['images'],1);
        $images = explode('@', $images);
        $this->view->assign("images", $images);
        return $this->fetch();
    }
    public function phones()
    {
        $id = input('id');
        $cases = C::where(['id'=>$id])->find();
        $images = substr($cases['images'],1);
        $images = explode('@', $images);
        $this->view->assign("images", $images);
        return $this->fetch();
    }
    /*
     * 案例申请
     */
    public function order()
    {

        //return json('fjjj');
        $data = input();
        $result = CO::insert($data);
        if ($result) {
            return json($this->ret);
        }else{
            $this->ret['code']=-200;
            $this->ret['msg']='提交失败,请重试';
            return json($this->ret);
        }

    }

}