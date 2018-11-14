<?php
namespace app\index\controller;
use think\Controller;
class More extends Controller
{
    
    public function index(){
    	$classid=input('classid');
        $_result = db('movies')->where('classid',$classid)->count();
        $_pagesize = 18;
        $_count = ceil($_result / $_pagesize);
        if (!input('page')) {
            $_page = 1;
            $_limit = ($_page - 1) * $_pagesize;
            $data = db('movies')->limit($_limit,$_pagesize)->where('classid',$classid)->select();
            $this->assign([
                'data' => $data,
                'count' =>$_count,
                'classid' =>$classid,
            ]);
            return $this->fetch();
        } else {
            $_page = input('page');
            if ($_page > $_count) {
                $_page = $_count;
            }
            $_limit = ($_page - 1) * $_pagesize;
            $data = db('movies')->limit($_limit,$_pagesize)->where('classid',$classid)->select();
            return json_encode($data);
        }
       

        
    }

}
