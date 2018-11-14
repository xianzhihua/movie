<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Base;
class Message extends Base
{
	public function lst(){
		$data = db('movie_message')->order('id desc')->paginate(30);
		$this->assign('data',$data);
		return $this->fetch();
	}

	public function del(){
		$id = input('id');
	    if(db('movie_message')->delete($id)){
	        $this->success('删除成功','lst');
	    }else{
	        $this->error('删除失败');
	    }
	}

}