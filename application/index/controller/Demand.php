<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:46:09
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-02-09 18:55:08
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

        }else{
            $demandtype = DT::select();
            $demand = D::select();
            foreach ($demand as $k => $v) {
                $dt = DT::where(['id'=>$v['type']])->find();
                $demand[$k]['type'] = $dt['name'];
                $dtr = DTR::where(['id'=>$v['industry']])->find();
                $demand[$k]['industry'] = $dtr['name'];
            }
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