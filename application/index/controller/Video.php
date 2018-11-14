<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Video extends Controller
{
    public function index(){
        $id = input('id');

        //电视的信息
        $data = db('movies')->where('id',$id)->find();
        //电视集数
        $datanum = db('movies_num')->where('moviesid',$id)->select();
        $_result = db('movie_message')->where('movieid',$id)->count();
        $_pagesize = 3;
        $_count = ceil($_result / $_pagesize);
        //ajax分评论
        if (!input('page')) {
            $_page = 1;
            $_limit = ($_page - 1) * $_pagesize;
            $message = Db::query("SELECT (select name from user where id = a.uid) As name,(select time from user where id = a.uid) As zctime,(select img from user where id = a.uid) As img,(select name from user where id = a.messageuid) As messageuidname,(select img from user where id = a.messageuid) As messageuidimg,a.id,a.movieid,a.uid,a.content,a.time,a.love,a.messageuid FROM movie_message a where movieid = $id order by a.time desc LIMIT {$_limit},{$_pagesize}");
            for($i=0;$i<count($message);$i++){
                $message[$i]['time'] = $this->wordTime($message[$i]['time']);
            }
            $this->assign([
                'data'=>$data,
                'datanum'=>$datanum,
                'message'=>$message,
                'allcount'=>$_result,
                'count'=>$_count,
            ]);
            return $this->fetch();
        }else{
            $_page = input('page');
            if ($_page > $_count) {
                $_page = $_count;
            }
            $_limit = ($_page - 1) * $_pagesize;
            $message = Db::query("SELECT (select name from user where id = a.uid) As name,(select img from user where id = a.uid) As img,(select name from user where id = a.messageuid) As messageuidname,(select img from user where id = a.messageuid) As messageuidimg,a.id,a.movieid,a.uid,a.content,a.time,a.love,a.messageuid FROM movie_message a where movieid = $id order by a.time desc LIMIT {$_limit},{$_pagesize}");
            for($i=0;$i<count($message);$i++){
                $message[$i]['time'] = $this->wordTime($message[$i]['time']);
            }
            return json_encode($message);
        }
    }

    //一级评论
    public function movie_addmessage(){
        $time = time();
        $uid = input('uid');
        $data = [
            'movieid' => input('movieid'),
            'uid' => $uid,
            'content' => input('content'),
            'time' => $time,
        ];
        if(db('movie_message')->insert($data)){
            $user = db('user')->where('id',$uid)->find();
            $data1 = db('movie_message')->where('time',$time)->where('uid',$uid)->find();
            $data1['time']=$this->wordTime($data1['time']);
            $arr = array_merge($user,$data1);
            return json_encode($arr);
        };
    }

    //二级回复
    public function movie_addmessage2(){
        $time = time();
        $messageid = input('messageid');
        $messageuid = input('messageuid');
        $uid = input('uid');
        $data = [
            'movieid' => input('movieid'),
            'uid' => $uid,
            'content' => input('content'),
            'time' => $time,
            'messageid' => $messageid,
            'messageuid' => $messageuid,
        ];
         if(db('movie_message')->insert($data)){
             $data1 = db('movie_message')->where('time',$time)->where('uid',$uid)->find();
             $data1['time']=$this->wordTime($data1['time']);
             
             $user1 = db('user')->where('id',$messageuid)->find();
             $user1['messageuidname']=$user1['name'];
             $user1['messageuidimg']=$user1['img'];
             //小心下面的数组合并,相同后面的替换前面
             $arr = array_merge($user1,$data1);
             return json_encode($arr);
        };
    }

    public function movie_message_love(){
        $id = input('id');
        db('movie_message')->where('id',$id)->setInc('love');
    }

    public function movie__message_removelove(){
        $id = input('id');
        db('movie_message')->where('id',$id)->setDec('love');
    }

    public function wordTime($time) {
        $time = (int) substr($time, 0, 10);
        $int = time() - $time;
        $str = '';
        if ($int <= 2){
            $str = sprintf('刚刚', $int);
        }elseif ($int < 60){
            $str = sprintf('%d秒前', $int);
        }elseif ($int < 3600){
            $str = sprintf('%d分钟前', floor($int / 60));
        }elseif ($int < 86400){
            $str = sprintf('%d小时前', floor($int / 3600));
        }elseif ($int < 2592000){
            $str = sprintf('%d天前', floor($int / 86400));
        }else{
            $str = date('Y-m-d H:i:s', $time);
        }
        return $str;
    }

}
