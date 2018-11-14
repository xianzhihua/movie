<?php
namespace app\index\controller;
use think\Controller;
class Register extends Controller
{
    public function index(){
        if(request()->isPost()){
            $data=[
                'username'=>input('username'),
                'password'=>md5(input('password')),
                'name'=>input('name'),
                'email'=>input('email'),
                'time'=>time(),
                'img'=>'/static/index/img/touxiang/'.rand(10,40).'.png',
            ];
            //验证
            $validate = \think\Loader::validate('Index');
            //scene场景验证
            if(!$validate->scene('register')->check($data)){
                $this->error($validate->getError());
                die;
            }

            if(db('user')->insert($data)){
                return $this->success('注册成功','login/index');
            }else{
                return $this->error('注册失败');
            }
            return;
        }
        return $this->fetch();
    }
}
