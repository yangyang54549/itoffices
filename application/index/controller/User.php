<?php
/**
 * @Author: Marte
 * @Date:   2018-04-17 15:05:19
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-19 14:43:13
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

            $arr = [];
            foreach ($data['skill'] as $key => $value) {
                $arr['skill'] = $value[0];
                $arr['grade'] = $value[1];

                if ($value[2]==0) {
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

            $arr = [];
            foreach ($data['skill'] as $key => $value) {
                $arr['skill'] = $value[0];
                $arr['grade'] = $value[1];

                if ($value[2]==0) {
                    UserSkill::insert($arr);
                }else{
                    UserSkill::where('id',$value[2])->update($arr);
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
}
