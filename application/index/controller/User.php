<?php
/**
 * @Author: Marte
 * @Date:   2018-04-17 15:05:19
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-24 18:01:02
 */
namespace app\index\controller;
use app\admin\Controller;
use think\Session;
use app\common\model\User as U;
use app\common\model\UserEducation;
use app\common\model\UserExperience;
use app\common\model\UserProduction;
use app\common\model\DemandTrade;
use app\common\model\DemandType;
use app\common\model\Demand;
use app\common\model\UserSkill;
use app\common\model\Apply;

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
        $this->assign('education',$UserEducation);
        $this->assign('experience',$UserExperience);
        $this->assign('production',$UserProduction);
        $this->assign('skill',$UserSkill);
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
        $this->assign('education',$UserEducation);
        $this->assign('experience',$UserExperience);
        $this->assign('production',$UserProduction);
        $this->assign('skill',$UserSkill);
        $this->assign('user',$user);
        return $this->fetch();
    }

    public function order()
    {
        $demand = Demand::where(['user_id'=>Session::get('user.id')])->select();//我发布的需求
        foreach ($demand as $key => $value) {
            $apply = Apply::where(['demand_id'=>$value['id']])->select();
            $demand[$key]['apply'] = $apply;
            $app = Apply::where(['demand_id'=>$value['id'],'status'=>1])->find();
            if (isset($app)) {
                $user = U::where('id',$app['user_id'])->find();
                $demand[$key]['app'] = $user['user_name'];
            }
        }

        $apply = Apply::where(['user_id'=>Session::get('user.id')])->select();
        $sdemand = [];
        foreach ($apply as $k => $v) {
            $de = Demand::where(['id'=>$v['demand_id']])->find();//我发布的需求
            $sdemand[$k] = $de;
        }

        $sdemand = Demand::where(['user_id'=>Session::get('user.id')])->select();//我申请的需求
        $demandtrade = DemandTrade::select();
        $demandtype = DemandType::select();
        $this->assign('demand',$demand);
        $this->assign('sdemand',$sdemand);
        $this->assign('demandtrade',$demandtrade);
        $this->assign('demandtype',$demandtype);
        return $this->fetch();
    }

    //需求方选择开发者
    public function order_kai()
    {
        $user_id = input('user_id');
        $demand_id = input('demand_id');
        Demand::where(['id'=>$demand_id])->update(['schedule'=>2]);
        Apply::where(['user_id' => $user_id,'demand_id'=>$demand_id])->update(['xstatus' => 1,'sstatus'=>1,'status'=>1]);
        return json($this->ret);
    }
    //需求方确认完成
    public function order_que()
    {
        $user_id = input('user_id');
        $demand_id = input('demand_id');
        Demand::where(['id'=>$demand_id])->update(['schedule'=>3]);
        Apply::where(['user_id' => $user_id,'demand_id'=>$demand_id])->update(['xstatus' => 2,'sstatus'=>2]);
        return json($this->ret);
    }

    //申请方确认干活
    public function order_gan()
    {
        $user_id = input('user_id');
        $demand_id = input('demand_id');
        Apply::where(['user_id' => $user_id,'demand_id'=>$demand_id])->update(['xstatus' => 2,'sstatus'=>2]);
        return json($this->ret);
    }

    //申请方完工提交
    public function order_wan()
    {
        $user_id = input('user_id');
        $demand_id = input('demand_id');
        Demand::where(['id'=>$demand_id])->update(['schedule'=>3]);
        Apply::where(['user_id' => $user_id,'demand_id'=>$demand_id])->update(['xstatus' => 2,'sstatus'=>2]);
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

            //个人介绍
            U::where('id',Session::get('user.id'))->update(['introduce'=>$data['introduce']]);

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
}
