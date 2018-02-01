<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:46:09
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-01-31 18:09:16
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
        $type_id = input('ty');
        $specific_id = input('xiao');
        $system_id = input('sys');
        $types_id = Session::get('where.system_type');

        $where=Session::get('where');
        if (isset($type_id)) {
            if ($type_id!=0) {
                $where['type']=$type_id;
                unset($where['specific']);
                Session::set('father_id',$type_id);
            }else{
                Session::delete('where');
                Session::delete('father_id');
                $where=null;
            }

        }elseif(isset($specific_id)){
            if ($specific_id!=0) {
                $specifics = S::where(['id'=>$specific_id])->find();
                Session::set('father_id',$specifics['father_id']);
                $where['specific']=$specific_id;
                $where['type'] = $specifics['father_id'];
            }else{
                unset($where['specific']);
            }

        }elseif(isset($system_id)){
            if ($system_id!=0) {
                $types_id = $system_id;
                $where['system_type']=$system_id;
            }else{
                $types_id = 0;
                unset($where['system_type']);
            }

        }

        Session::set('where',$where);
        unset($where['system_type']);
        $types = T::select();
        $specifics = S::select();
        $systems = SY::select();
        $cases = C::where($where)->order('create_time desc')->page(1,10)->select();
        $arr = $cases;
        foreach ($cases as $key => $value) {
            $system_type = explode(',' , $value['system_type']);
            if (!empty($types_id) && !in_array($types_id,$system_type)) {
                unset($arr[$key]);
                continue;
            }

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
        $this->view->assign("where", $where);
        //var_dump($arr);die;
        $this->view->assign("cases", $arr);
        return $this->fetch();
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