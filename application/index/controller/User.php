<?php
/**
 * @Author: Marte
 * @Date:   2018-04-17 15:05:19
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-19 14:13:57
 */
namespace app\index\controller;
use app\admin\Controller;
use think\Session;
use app\common\model\User as U;
use app\common\model\UserEducation;
use app\common\model\UserExperience;
use app\common\model\UserProduction;
use app\common\model\UserSkill;

class User  extends Yang
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $arr = input('');
            U::where('id',Session::get('user.id'))->update($arr);

        }else{
            $user = U::where('id',Session::get('user.id'))->find();
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
    public function order()
    {
        return $this->fetch();
    }
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

            }

            return json(count($data['production']));
            //return json($this->ret);

        }else{
            $UserProduction = UserProduction::where(['user_id'=>Session::get('user.id')])->select();
            $this->assign('production',$UserProduction);

            return $this->fetch();
        }
    }
    public function bianji1()
    {
        if ($this->request->isAjax()) {

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
            //$data['experience'] = json_decode($data['experience'],true);
            return json($data['experience']);
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
}
