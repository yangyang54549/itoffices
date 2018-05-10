<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:46:09
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-05-10 09:39:58
 */
namespace app\bak\controller;
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
use app\common\model\Apply;
use app\common\model\User;

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
            $data['user_id'] = Session::get('user.id');
            $data['username'] = Session::get('user.user_name');
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
            $industry = input('industry');
            $pages = input('page');
            $where['status'] = 1;

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
            $demand = D::where($where)->order('create_time desc')->page("$pages,9")->select();

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
                $page['count'] = D::where($where)->count();//总条数
                $page['page'] = ceil($page['count']/9);//总共几页
                $page['num'] = $pages;//当前处于第几页
                $this->ret['page'] = $page;
                $this->ret['data'] = $str;
                return json($this->ret);
            }
            $page['count'] = 0;//总条数
            $page['page'] = 0;//总共几页
            $page['num'] = 1;//当前处于第几页
            $this->ret['page'] = $page;
            $this->ret['data'] = '暂无更多数据';
            $this->ret['msg'] = '暂无更多数据';
            return json($this->ret);
        }else{
            $page['count'] = D::where(['status'=>1])->count();//总条数
            $page['page'] = ceil($page['count']/9);//总共几页
            $page['num'] = 1;//当前处于第几页
            $demandtype = DT::order('sort')->select();
            $demand = D::where(['status'=>1])->order('create_time desc')->page('1,9')->select();
            $demandtrade = DTR::order('sort')->select();
            foreach ($demand as $k => $v) {
                $dt = DT::where(['id'=>$v['type']])->find();
                $demand[$k]['type'] = $dt['name'];
                $dtr = DTR::where(['id'=>$v['industry']])->find();
                $demand[$k]['industry'] = $dtr['name'];
            }
            $this->assign('url',LUR);
            $this->assign('demandtype',$demandtype);
            $this->assign('demand',$demand);
            $this->assign('demandtrade',$demandtrade);
            $this->view->assign("page", $page);
            return $this->fetch();
        }
    }
    /*
     * 内页
     */
    public function inside()
    {

        if ($this->request->isAjax()) {
            $id = input('id');

            $demand = D::where('id',$id)->find();
            if (Session::get('user.id')==$demand['user_id']) {
                $this->ret['msg'] = '不能申请自己的发布的需求';
                $this->ret['code'] = -200;
                return json($this->ret);
            }

            $apply = Apply::where(['user_id'=>Session::get('user.id'),'demand_id'=>$id])->find();
            if (isset($apply)) {
                $this->ret['msg'] = '您已提交过申请';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            $user = User::where('id',Session::get('user.id'))->find();
            $data['user_id'] = Session::get('user.id');
            $data['user_name'] = $user['user_name'];
            $data['demand_id'] = $id;
            $data['create_time'] = time();
            Apply::insert($data);
            D::where(['id'=>$id])->setInc('apply');
            return json($this->ret);

        }else{

            $id = input('id');

            /*浏览量*/
            D::where('id',$id)->setInc('browse');

            $exist = 0;
            $demand = D::where('id',$id)->find();
            $dt = DT::where(['id'=>$demand['type']])->find();
            $demand['type'] = $dt['name'];
            $dtr = DTR::where(['id'=>$demand['industry']])->find();
            $demand['industry'] = $dtr['name'];

            //判断是否已经申请过
            $user_id = Session::get('user.id');
            if (isset($user_id)) {
                $apply = Apply::where(['user_id'=>Session::get('user.id'),'demand_id'=>$id])->find();
                if (isset($apply)) {
                    $exist = 1;
                }
            }

            // $demandtype = DT::select();
            // $demand = D::select();
            // foreach ($demand as $k => $v) {
            //     $dt = DT::where(['id'=>$v['type']])->find();
            //     $demand[$k]['type'] = $dt['name'];
            //     $dtr = DTR::where(['id'=>$v['industry']])->find();
            //     $demand[$k]['industry'] = $dtr['name'];
            // }
            // $this->assign('demandtype',$demandtype);

            $this->assign('exist',$exist);
            $this->assign('demand',$demand);

            return $this->fetch();
        }
    }
}