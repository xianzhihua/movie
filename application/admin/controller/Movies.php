<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Base;
class Movies extends Base
{
	public function lst(){
		$data = db('movies')->alias('a')->join('class c','c.id=a.classid')->field('a.*,c.name')->paginate(10);
		$this->assign('data',$data);
		return $this->fetch();
	}

	public function edit(){
		$id = input('id');
		$data = db('movies')->find($id);
		if(request()->isPost()){
			$data=[
    			'id'=>input('post.id'),
                'title'=>input('post.title'),
                'classid'=>input('post.classid'),
                'a'=>input('post.a'),
                'img'=>input('post.img'),
                'num'=>input('post.num'),
                'score'=>input('post.score'),
                'year'=>input('post.year'),
                'des'=>input('post.des'),
    		];
    		if(db('movies')->update($data)){
    			$this->success('修改成功','lst','',1);
    		}else{
    			$this->error('修改失败');
    		}
    		return;
		}
		$this->assign('data',$data);
		$classs=db('class')->select();
		$this->assign('classs',$classs);
		return $this->fetch();
	}

	public function add(){
		if(request()->isPost()){
			$data=[
				'title'=>input('title'),
				'classid'=>input('classid'),
				'a'=>input('a'),
				'img'=>input('img'),
				'num'=>input('num'),
				'score'=>input('score'),
				'year'=>input('year'),
				'des'=>input('des'),
			];
			if(db('movies')->insert($data)){
				return $this->success('新增成功','lst');
			}else{
				return $this->error('新增失败');
			}
			return;
		}
		$classs=db('class')->select();
		$this->assign('classs',$classs);
		return $this->fetch();
	}

	public function del(){
		$id = input('id');
	    if(db('movies')->delete($id)){
	        $this->success('删除成功','lst');
	    }else{
	        $this->error('删除失败');
	    }
	}

	public function ck(){
		$id = input('id');
		$data = db('movies_num')->where('moviesid','=',$id)->select();
		return json_encode($data);
	}

}