<?php
/**
 * @Author: Marte
 * @Date:   2018-04-17 15:05:19
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-18 10:52:18
 */
namespace app\index\controller;
use app\admin\Controller;
use app\common\model\User as U;
use app\common\model\UserEducation;
use app\common\model\UserExperience;
use app\common\model\UserProduction;
use app\common\model\UserSkill;

class User  extends Yang
{
    public function index()
    {
        $user = U::where('id',1)->find();
        $this->assign('user',$user);
        return $this->fetch();
    }
    public function resume()
    {
        $user = U::where('id',1)->find();
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
        return $this->fetch();
    }
    public function bianji0()
    {
        return $this->fetch();
    }
    public function bianji1()
    {
        return $this->fetch();
    }
    public function bianji2()
    {
        return $this->fetch();
    }
}
