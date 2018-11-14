<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Base;
class User extends Base
{
	public function lst(){
		$data = db('user')->paginate(10);
		$this->assign('data',$data);
		return $this->fetch();
	}

	public function del(){
		$id = input('id');
	    if(db('user')->delete($id)){
	        $this->success('删除成功','lst');
	    }else{
	        $this->error('删除失败');
	    }
	}

}