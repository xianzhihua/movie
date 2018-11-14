<?php
namespace app\index\controller;
use think\Controller;
class Search extends Controller
{
    public function index(){
        $keywords = input('keywords');
        if($keywords){
            $map['title']=['like','%'.$keywords.'%'];
            $movies = db('movies')->where($map)->select();
            $this->assign([
                'movies' => $movies,
                'keywords'=>$keywords,
            ]);
            return $this->fetch();
        }
    }
}
