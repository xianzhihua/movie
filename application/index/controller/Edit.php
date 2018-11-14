<?php
namespace app\index\controller;
use think\Controller;
class Edit extends Controller
{
    public function index(){
        $id=input('id');
        $data = db('user')->where('id',$id)->find();
        return $data;
    }

    public function edit(){
        $id = input('id');
        $name = input('name');
        $img = input('img');

        if(request()->isPost()){
            $data=[
                'id'=>$id,
                'name'=>$name,
                'username'=>input('post.username'),
                'password'=>md5(input('post.password')),
                'email'=>input('post.email'),
                'img'=>$img,
            ];
            if(db('user')->update($data)){

                session('name',$name);
                session('uimg',$img);

                $this->success('修改成功','index/index/index','',1);
            }else{
                $this->error('修改失败');
            }
            return;
        }
    }

}
