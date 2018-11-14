<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            $admin=new Admin;
            $data=input('post.');
            $num=$admin->login($data);
            if($num==3){
                $this->success('信息正确，正在为您跳转...','index/index','',1);
            }elseif($num==4){
                $this->error('验证码错误','','',1);
            }else{
                $this->error('用户名或密码错误','','',1);
            }
        }
        return $this->fetch('login');
    }
}
