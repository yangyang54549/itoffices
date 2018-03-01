<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:46:09
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-03-01 17:42:55
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
        $types = T::order('id desc')->select();
        $specifics = S::order('father_id desc,id desc')->select();
        $systems = SY::order('id desc')->select();

        if ($this->request->isAjax()) {

            $type = input('type');
            $specific = input('specific');
            $types_id = input('system_type');
            $pages = input('page');
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
            if(isset($types_id)){
                if ($types_id!=0) {
                    $where['system_type']=$types_id;
                }
            }
            $str = '';
            $cases = C::where($where)->order('create_time desc')->page("$pages,8")->select();
            if (!empty($cases)) {

                foreach ($cases as $k => $v) {

                    foreach ($types as $e => $f) {
                        if($f['id'] == $v['type']){
                             $v['type'] = $f['name'];
                             break;
                        }
                    }
                    foreach ($specifics as $a => $b) {
                        if($b['id'] == $v['specific']){
                             $v['specific'] = $b['name'];
                             break;
                        }
                    }
                    foreach ($systems as $c => $d) {
                        if($d['id'] == $v['system_type']){
                             $v['system_type'] = $d['name'];
                             break;
                        }
                    }

                    $url = url("cases/inside",["id"=>$v["id"]]);
                    if ($v['is_pp']==1) {
                        $v['is_pp']='sj';
                    }else{
                        $v['is_pp']='diannao';
                    }

                    $str .= '<li class="round">
                        <div class="rounds">
                            <a href="'.$url.'" target="_blank">
                            <img class="proImg" src="'.$v['img'].'" alt="">
                            <div class="picList">
                                <div class="similarity-title">'.$v['case_name'].'</div>
                                <div class="similarity_label">产品类型:<span>'.$v['type'].'</span></div>
                                <div class="similarity_label">主要功能:<span>'.$v['specific'].'</span></div>
                                <div class="similarity_label functionNames">系统类型:
                                    <span>'.$v['system_type'].'</span>
                                </div>
                                <div class="similarity-intro">'.$v['brief'].'</div>
                                <div class="similarity-price"> ￥<span class="price">'.$v['money'].'</span></div>
                                <div class="photograph"> <img src="/static/index/img/'.$v['is_pp'].'.png" alt=""> </div>
                            </div>
                        </a>
                        </div>
                    </li>';
                }

                $page['count'] = C::where($where)->count();//总条数
                $page['page'] = ceil($page['count']/8);//总共几页
                $page['num'] = $pages;//当前处于第几页
                $this->ret['data'] = $str;
                $this->ret['page'] = $page;
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

            $cases = C::order('create_time desc')->page('1,8')->select();
            $arr = $cases;
            $page = [];
            $page['count'] = C::count();//总条数
            $page['page'] = ceil($page['count']/8);//总共几页
            $page['num'] = 1;//当前处于第几页
            foreach ($cases as $key => $value) {

                foreach ($types as $k => $v) {
                    if($v['id'] == $value['type']){
                         $arr[$key]['type'] = $v['name'];
                         break;
                    }
                }
                foreach ($specifics as $a => $b) {
                    if($b['id'] == $value['specific']){
                         $arr[$key]['specific'] = $b['name'];
                         break;
                    }
                }
                foreach ($systems as $c => $d) {
                    if($d['id'] == $value['system_type']){
                         $arr[$key]['system_type'] = $d['name'];
                         break;
                    }
                }

            }

            $this->view->assign("type", $types);
            $this->view->assign("specific", $specifics);
            $this->view->assign("system", $systems);
            $this->view->assign("cases", $arr);
            $this->view->assign("page", $page);
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