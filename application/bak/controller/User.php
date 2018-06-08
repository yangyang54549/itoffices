<?php
/**
 * @Author: Marte
 * @Date:   2018-04-17 15:05:19
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-06-08 09:54:00
 */
namespace app\bak\controller;
use app\admin\Controller;
use think\Session;
use app\common\model\User as U;
use app\common\model\UserEducation;
use app\common\model\UserExperience;
use app\common\model\UserProduction;
use app\common\model\DemandTrade;
use app\common\model\DemandType;
use app\common\model\Demand;
use app\common\model\Cases;
use app\common\model\UserSkill;
use app\common\model\Apply;
use app\common\model\Evaluate;
use think\exception\HttpException;
use app\common\model\CasesPay;
use app\common\model\Withdraw;

class User  extends Yang
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $arr = input('');
            U::where('id',Session::get('user.id'))->update($arr);
            return json($this->ret);

        }else{
            $user = U::where('id',Session::get('user.id'))->find();
            $user['occupations'] = explode("/",$user['occupation']);
            $user['attentions'] = explode(",",$user['attention']);
            //dump($user);die;
            $this->assign('user',$user);
            return $this->fetch();
        }
    }
    public function resume()
    {
        $user = U::where('id',Session::get('user.id'))->find();
        $UserEducation = UserEducation::where(['user_id'=>$user['id']])->select();
        $UserExperience = UserExperience::where(['user_id'=>$user['id']])->select();
        $UserProduction = UserProduction::where(['user_id'=>$user['id']])->select();
        $UserSkill = UserSkill::where(['user_id'=>$user['id']])->select();
        $Evaluate = Evaluate::where(['user_id'=>$user['id']])->select();
        $this->assign('education',$UserEducation);
        $this->assign('experience',$UserExperience);
        $this->assign('production',$UserProduction);
        $this->assign('skill',$UserSkill);
        $this->assign('evaluate',$Evaluate);
        $this->assign('user',$user);
        return $this->fetch();
    }

    public function resumes()
    {
        $id = input('id');
        $user = U::where('id',$id)->find();
        $UserEducation = UserEducation::where(['user_id'=>$user['id']])->select();
        $UserExperience = UserExperience::where(['user_id'=>$user['id']])->select();
        $UserProduction = UserProduction::where(['user_id'=>$user['id']])->select();
        $UserSkill = UserSkill::where(['user_id'=>$user['id']])->select();
        $Evaluate = Evaluate::where(['user_id'=>$user['id']])->select();
        //dump($Evaluate);die;
        $this->assign('education',$UserEducation);
        $this->assign('experience',$UserExperience);
        $this->assign('production',$UserProduction);
        $this->assign('skill',$UserSkill);
        $this->assign('evaluate',$Evaluate);
        $this->assign('user',$user);
        return $this->fetch();
    }

    public function order()
    {
        $demand = Demand::where(['user_id'=>Session::get('user.id')])->order('create_time desc')->select();//我发布的需求
        foreach ($demand as $key => $value) {
            $demand[$key]['applys'] = $demand[$key]['apply'];
            $apply = Apply::where(['demand_id'=>$value['id']])->select();
            $demand[$key]['apply'] = $apply;
            if (!empty($value['apply_id'])) {
                $app = Apply::where(['id'=>$value['apply_id']])->find();
                $demand[$key]['apply_id'] = $app;
                $demand[$key]['app'] = $app['user_name'];
            }
        }

        $apply = Apply::where(['user_id'=>Session::get('user.id')])->order('create_time desc')->select();
        $sdemand = [];
        foreach ($apply as $k => $v) {
            $de = Demand::where(['id'=>$v['demand_id']])->find();//我发布的需求

            if (!empty($de['apply_id'])) {
                if ($de['apply_id']==$v['id']) {
                    $de['is_apply_id'] = 1;//申请的需求人选中了我
                }elseif($de['apply_id']!=$v['id']){
                    continue;
                    //$de['is_apply_id'] = 2;//申请的需求人没有选中我
                }

                $app = Apply::where(['id'=>$de['apply_id']])->find();
                $de['apply_id'] = $app;

            }else{
                    $de['is_apply_id'] = 0;//申请的需求人还没有选择开发者
            }

            $sdemand[$k] = $de;
        }
        //dump($sdemand);die;
        $demandtrade = DemandTrade::select();
        $demandtype = DemandType::select();
        $this->assign('demand',$demand);
        $this->assign('sdemand',$sdemand);
        $this->assign('demandtrade',$demandtrade);
        $this->assign('demandtype',$demandtype);
        return $this->fetch();
    }

    public function orders()
    {
        return $this->fetch();
    }

    //需求方选择开发者
    public function order_kai()
    {

         if ($this->request->isAjax()) {
        //     Db::startTrans();
        //     try {
                //$this->ret['code'] = -200;
                $user_id = input('user_id');
                $demand_id = input('demand_id');
                $apply = Apply::where(['user_id' => $user_id,'demand_id'=>$demand_id])->find();
                Demand::where(['id'=>$demand_id])->update(['schedule'=>2,'apply_id'=>$apply['id']]);
                Apply::where(['user_id' => $user_id,'demand_id'=>$demand_id])->update(['xstatus' => 1,'status'=>1]);
                //$this->ret['code'] = 1;
                // 提交事务
                //Db::commit();
            //} catch (\Exception $e) {
                // 回滚事务
                //Db::rollback();

                //return json($this->ret);
            //}
            return json($this->ret);
        }
    }
    //需求方确认完成
    public function order_que()
    {
        $demand_id = input('demand_id');
        Apply::where(['status' => 1,'demand_id'=>$demand_id])->update(['xstatus' => 2,'sstatus'=>3]);
        Demand::where(['id'=>$demand_id])->update(['schedule'=>4]);
        return json($this->ret);
    }
    //需求方评论
    public function order_pinglu()
    {
        if ($this->request->isAjax()) {
            // Db::startTrans();
            // try {

            //     $this->ret['code'] = -200;
                $demand_id = input('demand_id');
                $star = input('star');
                $content = input('content');

                $user = U::where('id',Session::get('user.id'))->find();
                $apply = Apply::where(['status' => 1,'demand_id'=>$demand_id])->find();
                $data['user_id'] = $apply['user_id'];
                $data['demand_id'] = $apply['demand_id'];
                $data['evaluate_name'] = $user['user_name'];
                $data['evaluate_id'] = Session::get('user.id');
                $data['star'] = $star;
                $data['content'] = $content;
                $data['create_time'] = time();

                Evaluate::insert($data);
                Apply::where(['status' => 1,'demand_id'=>$demand_id])->update(['xstatus' => 3]);
            //     $this->ret['code'] = 1;

            //     Db::commit();
            // } catch (\Exception $e) {
            //     // 回滚事务
            //     Db::rollback();
            //     return json($this->ret);
            // }
            return json($this->ret);
        }
    }
    //需求方修改时间
    public function order_xiugai()
    {
        $demand_id = input('demand_id');
        $start_time = input('start_time');
        $delivery_time = input('delivery_time');
        $money = input('money');
        Demand::where(['id'=>$demand_id])->update(['start_time' => $start_time,'delivery_time'=>$delivery_time,'money'=>$money]);
        $demand = Demand::where(['id'=>$demand_id])->find();
        Apply::where(['id'=>$demand['apply_id']])->update(['xstatus' => 4]);
        return json($this->ret);
    }
    //申请方确认干活
    public function order_gan()
    {
        if ($this->request->isAjax()) {
            // Db::startTrans();
            // try {
            //     $this->ret['code'] = -200;
                $user_id = Session::get('user.id');
                $demand_id = input('demand_id');
                Demand::where(['id'=>$demand_id])->update(['schedule'=>3]);
                Apply::where(['status' => 1,'user_id' => $user_id,'demand_id'=>$demand_id])->update(['sstatus'=>1]);
                $this->ret['code'] = 1;
            //     Db::commit();
            // } catch (\Exception $e) {
            //     // 回滚事务
            //     Db::rollback();
            //     return json($this->ret);
            // }
            return json($this->ret);
        }
    }

    //申请方完工提交
    public function order_wan()
    {
        $user_id = Session::get('user.id');
        $demand_id = input('demand_id');
        Apply::where(['status' => 1,'user_id' => $user_id,'demand_id'=>$demand_id])->update(['sstatus'=>2]);
        return json($this->ret);
    }

    //我的作品 id为0就是新添加数据,否则为修改
    public function bianji0()
    {
        if ($this->request->isAjax()) {
            $data = input();

            $arr = [];
            foreach ($data['production'] as $key => $value) {
                $arr['name'] = $value[0];
                $arr['position'] = $value[1];
                $arr['url'] = $value[2];
                $arr['content'] = $value[3];

                if ($value[4]==0) {
                    $arr['user_id'] = Session::get('user.id');
                    UserProduction::insert($arr);
                }else{
                    UserProduction::where('id',$value[4])->update($arr);
                }
            }

            return json($this->ret);

        }else{
            $UserProduction = UserProduction::where(['user_id'=>Session::get('user.id')])->select();
            $this->assign('production',$UserProduction);

            return $this->fetch();
        }
    }
    public function bianji1()
    {
        if ($this->request->isAjax()) {
            $data = input();
            //return json($data);

            $arr = [];
            foreach ($data['skill'] as $key => $value) {
                $arr['skill'] = $value[0];
                $arr['grade'] = $value[1];

                if ($value[2]==0) {
                    $arr['user_id'] = Session::get('user.id');
                    UserSkill::insert($arr);
                }else{
                    UserSkill::where('id',$value[2])->update($arr);
                }
            }

            return json($this->ret);
        }else{
            $UserSkill = UserSkill::where(['user_id'=>Session::get('user.id')])->select();
            $this->assign('skill',$UserSkill);
            return $this->fetch();
        }
    }
    public function bianji2()
    {
        if ($this->request->isAjax()) {
            $data = input();
            $introduce = $_POST['introduce'];
            //个人介绍
            U::where('id',Session::get('user.id'))->update(['introduce'=>$introduce]);

            $experience = [];//工作经历
            foreach ($data['experience'] as $key => $value) {
                $experience['start_time'] = $value[0];
                $experience['end_time'] = $value[1];
                $experience['company_name'] = $value[2];
                $experience['position'] = $value[3];
                $experience['content'] = $value[4];

                if ($value[5]==0) {
                    $experience['user_id'] = Session::get('user.id');
                    UserExperience::insert($experience);
                }else{
                    UserExperience::where('id',$value[5])->update($experience);
                }
            }


            $education = [];//教育经历
            foreach ($data['education'] as $key => $value) {
                $education['start_time'] = $value[0];
                $education['end_time'] = $value[1];
                $education['school_name'] = $value[2];
                $education['major'] = $value[3];
                $education['xueli'] = $value[4];
                $education['content'] = $value[5];

                if ($value[6]==0) {
                    $education['user_id'] = Session::get('user.id');
                    UserEducation::insert($education);
                }else{
                    UserEducation::where('id',$value[6])->update($education);
                }
            }

            return json($this->ret);

        }else{
            $user = U::where('id',Session::get('user.id'))->find();
            $UserEducation = UserEducation::where(['user_id'=>$user['id']])->select();
            $UserExperience = UserExperience::where(['user_id'=>$user['id']])->select();
            $this->assign('education',$UserEducation);
            $this->assign('experience',$UserExperience);
            $this->assign('user',$user);

            return $this->fetch();
        }
    }

    //教育经历删除
    public function deeducation()
    {
        $id = input('id');
        UserEducation::where('id',$id)->delete();
        return json($this->ret);

    }
    //作品删除
    public function production()
    {
        $id = input('id');
        UserProduction::where('id',$id)->delete();
        return json($this->ret);

    }
    //工作经历删除
    public function deexperience()
    {
        $id = input('id');
        UserExperience::where('id',$id)->delete();
        return json($this->ret);

    }
    //技能删除
    public function deskill()
    {
        $id = input('id');
        UserSkill::where('id',$id)->delete();
        return json($this->ret);

    }

    public function news()
    {
            return $this->fetch();
    }

    public function account()
    {

        if ($this->request->isAjax())
        {

                $data = input();
                $user = U::where('id',Session::get('user.id'))->find();
                if ($data['money']>$user['money']) {
                    $this->ret['code']=-200;
                    $this->ret['msg']='余额不足';
                    return json($this->ret);
                }


                $data['user_id'] = Session::get('user.id');
                $data['username'] = Session::get('user.user_name');
                $data['create_time'] = time();
                $result = Withdraw::insert($data);
                if ($result) {

                U::where(['id'=>Session::get('user.id')])->setDec('money',$data['money']);
                $dj_money = $user['dj_money']+$data['money'];
                $aaa = U::where(['id'=>Session::get('user.id')])->update(['dj_money'=>$dj_money]);

                return json($this->ret);

            }else{
                $this->ret['code']=-200;
                $this->ret['msg']='提交失败,请重试';
                return json($this->ret);
            }
        }else{
            $user_id = Session::get('user.id');
            $user = U::where('id',$user_id)->find();
            $CasesPay = CasesPay::where(['user_id'=>$user_id,'status'=>1])->order('id desc')->select();
            $CasesPayCases = CasesPay::where(['cases_user_id'=>$user_id,'status'=>1])->order('id desc')->select();
            $Cases = Cases::where(['user_id'=>$user_id])->order('id desc')->select();

            $this->assign('user',$user);
            $this->assign('casespay',$CasesPay);
            $this->assign('casespaycases',$CasesPayCases);
            $this->assign('cases',$Cases);

            return $this->fetch();
        }

    }
}
