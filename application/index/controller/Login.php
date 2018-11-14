<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Index as mIndex;
class Login extends Controller
{
    public function index(){
        if(request()->isPost()){
            $admin=new mIndex;
            $data=input('post.');
            $num=$admin->login($data);
            if($num==3){
                $this->success('信息正确，正在为您跳转...','index/index');
            }elseif($num==4){
                $this->error('验证码错误');
            }else{
                $this->error('用户名或密码错误');
            }
        }
        return $this->fetch();

    }

}
