<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Base;
class Classs extends Base
{
	public function lst(){
		$data = db('class')->paginate(10);
		$this->assign('data',$data);
		return $this->fetch();
	}

	public function edit(){
		$id = input('id');
		$data = db('class')->find($id);
		if(request()->isPost()){
			$data=[
    			'id'=>input('post.id'),
                'name'=>input('post.name'),
    		];
    		if(db('class')->update($data)){
    			$this->success('修改成功','lst','',1);
    		}else{
    			$this->error('修改失败');
    		}
    		return;
		}
		$this->assign('data',$data);
		return $this->fetch();
	}

	public function add(){
		if(request()->isPost()){
			$data=[
				'name'=>input('name'),
			];
			if(db('class')->insert($data)){
				return $this->success('新增成功','lst');
			}else{
				return $this->error('新增失败');
			}
			return;
		}
		return $this->fetch();
	}

	public function del(){
		$id = input('id');
	    if(db('class')->delete($id)){
	        $this->success('删除成功','lst');
	    }else{
	        $this->error('删除失败');
	    }
	}

}