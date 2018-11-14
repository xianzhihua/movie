<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Index as mIndex;
class Index extends Controller
{
    public function index(){
        $movie = db('movies')->where('classid','1')->paginate(12);
        $dianshi = db('movies')->where('classid','2')->paginate(12);
        $donman = db('movies')->where('classid','3')->paginate(12);
        $this->assign([
            'movie' => $movie,
            'dianshi' => $dianshi,
            'donman' => $donman,
        ]);
        return $this->fetch();
    }
}
