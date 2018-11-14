<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Index extends Model
{
    public function login($data){
        $captcha=new \think\captcha\Captcha();
        if(!$captcha->check($data['code'])){
            return 4;
        }
        $user=Db::name('user')->where('username','=',$data['username'])->find();
        if($user){
            if($user['password'] == md5($data['password'])){
                session('username',$user['username']);
                session('name',$user['name']);
                session('uid',$user['id']);
                session('uimg',$user['img']);
                return 3;//信息正确
            }else{
                return 2;//密码错误
            }
        }else{
            return 1;//用户不存在
        }
    }
}
