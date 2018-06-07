<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:46:09
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-06-07 15:17:46
 */
namespace app\bak\controller;
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
        $types = T::order('sort')->select();
        $specifics = S::order('sort,father_id desc')->select();
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
                    $where['specific'] = ['like','%'.$specific.'%'];
                }
            }
            if(isset($types_id)){
                if ($types_id!=0) {
                    $where['system_type'] = ['like','%'.$types_id.'%'];
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
                    // foreach ($specifics as $a => $b) {
                    //     if($b['id'] == $v['specific']){
                    //          $v['specific'] = $b['name'];
                    //          break;
                    //     }
                    // }

                    $v['specific'] = explode(",",$v['specific']);
                    $specific = [];

                    foreach ($specifics as $a => $b) {

                        if (in_array($b['id'],$v['specific']))
                        {
                            $specific[] = $b['name'];
                        }
                    }

                    $specific = implode(',',$specific);


                    $v['system_type'] = explode(",",$v['system_type']);
                    $system_type = [];

                    foreach ($systems as $c => $d) {

                        if (in_array($d['id'],$v['system_type']))
                        {
                            $system_type[] = $d['name'];
                        }
                    }

                    $system_type = implode(',',$system_type);

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
                                <div class="similarity_label">适用行业:<span>'.$specific.'</span></div>
                                <div class="similarity_label functionNames">系统类型:
                                    <span>'.$system_type.'</span>
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
                $page['sys'][] = -200;
                //判断系统类型是否存在,不存在传去前台
                foreach ($systems as $va => $lu) {
                     $where['system_type'] = ['like','%'.$lu["id"].'%'];
                     $count = C::where($where)->count();
                     if ($count==0) {
                         $page['sys'][] = $lu['id'];
                     }
                }


                $str .= '<li class="page-div" onclick="xia();"><h3>下一页</h3></li>';
                $this->ret['data'] = $str;
                $this->ret['page'] = $page;
                return json($this->ret);
            }
            $page['count'] = 0;//总条数
            $page['page'] = 0;//总共几页
            $page['num'] = 1;//当前处于第几页
            $page['sys'][] = -200;
            foreach ($systems as $va => $lu) {
                $page['sys'][] = $lu['id'];
            }

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

            if ($page['page']>4) {
                $page['xpage'] = 4;
            }else{
                $page['xpage'] = $page['page'];
            }
            $page['num'] = 1;//当前处于第几页
            foreach ($cases as $key => $value) {

                foreach ($types as $k => $v) {
                    if($v['id'] == $value['type']){
                         $arr[$key]['type'] = $v['name'];
                         break;
                    }
                }

                // foreach ($specifics as $a => $b) {
                //     if($b['id'] == $value['specific']){
                //          $arr[$key]['specific'] = $b['name'];
                //          break;
                //     }
                // }

                $value['specific'] = explode(",",$value['specific']);
                $specific = [];

                foreach ($specifics as $a => $b) {

                    if (in_array($b['id'],$value['specific']))
                    {
                        $specific[] = $b['name'];
                    }
                }

                $arr[$key]['specific'] = implode(',',$specific);


                $value['system_type'] = explode(",",$value['system_type']);
                $system_type = [];

                foreach ($systems as $c => $d) {

                    if (in_array($d['id'],$value['system_type']))
                    {
                        $system_type[] = $d['name'];
                    }
                }

                $arr[$key]['system_type'] = implode(',',$system_type);

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

        $specifics = explode(',' , $cases['specific']);
        for ($i=0; $i < count($specifics); $i++) {
            $specific = S::where(['id'=>$specifics[$i]])->find();
            $specifics[$i] =  $specific['name'];
        }

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
        $this->view->assign("specific", $specifics);
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
    /*
     * 案例添加
     */
    public function add()
    {
        if ($this->request->isAjax())
        {
            $data = input();


            $result = C::insert($data);
            if ($result) {
                return json($this->ret);
            }else{
                $this->ret['code']=-200;
                $this->ret['msg']='提交失败,请重试';
                return json($this->ret);
            }

        }else{
            return $this->fetch();
        }
    }
}