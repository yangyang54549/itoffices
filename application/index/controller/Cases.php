<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:46:09
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-02-23 14:26:34
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
            $specific = input('specific');
            $types_id = input('system_type');
            $where = [];

            if (isset($type)) {
                if ($type!=0) {
                    $where['type']=$type;
                }
            }

            if(isset($specific)){
                if ($specific!=0) {
                    $where['specific']=$specific;
                }
            }

            // if (isset($types_id)) {
            //     if ($types_id!=0) {
            //         $where['system_type']=$types_id;
            //     }
            // }
                // $this->ret['data'] = $types_id;
                // return json($this->ret);
            $str = '';
            $cases = C::where($where)->order('create_time desc')->select();

            if (!empty($cases)) {

                foreach ($cases as $k => $v) {

                    $system_type = explode(',' , $v['system_type']);
                    if ($types_id!=0 && !in_array($types_id,$system_type)) {
                        continue;
                    }

                    $images = explode('@' , $v['images']);
                    $v['images'] = $images[1];

                    $type = T::where(['id'=>$v['type']])->find();
                    $v['type'] = $type['name'];
                    $specific = S::where(['id'=>$v['specific']])->find();
                    $v['specific'] = $specific['name'];

                    for ($i=0; $i < count($system_type); $i++) {
                        $system = SY::where(['id'=>$system_type[$i]])->find();
                        $system_type[$i] = $system['name'];
                    }
                    $srr = implode(",",$system_type);
                    $url = url("cases/inside",["id"=>$v["id"]]);
                    if ($v['is_pp']==1) {
                        $v['is_pp']='sj';
                    }else{
                        $v['is_pp']='diannao';
                    }

                    $str .= '<li class="round">
                        <div class="rounds">
                            <a href="'.$url.'" target="_blank">
                            <img class="proImg" src="'.$v['images'].'" alt="">
                            <div class="picList">
                                <div class="similarity-title">'.$v['case_name'].'</div>
                                <div class="similarity_label">产品类型:<span>'.$v['type'].'</span></div>
                                <div class="similarity_label">主要功能:<span>'.$v['specific'].'</span></div>
                                <div class="similarity_label functionNames">系统类型:
                                    <span>'.$srr.'</span>
                                </div>
                                <div class="similarity-intro">'.$v['brief'].'</div>
                                <div class="similarity-price"> ￥<span class="price">'.$v['money'].'</span></div>
                                <div class="photograph"> <img src="/static/index/img/'.$v['is_pp'].'.png" alt=""> </div>
                            </div>
                        </a>
                        </div>
                    </li>';

                }
                if ($str=='') {
                    $str = '暂无更多数据';
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

                $images = explode('@' , $value['images']);
                $arr[$key]['images'] = $images[1];

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