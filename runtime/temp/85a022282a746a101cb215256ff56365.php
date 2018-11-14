<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"C:\wamp\www\tp5movie\public/../application/index\view\video\index.html";i:1530796860;s:59:"C:\wamp\www\tp5movie\application\index\view\common\top.html";i:1529057787;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php echo $data['title']; ?></title>
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="/tp5movie/public/static/index/css/style.css" rel="stylesheet">
	<script src="/tp5movie/public/static/index/js/index.js"></script>
	<script>
		window.onload=function(){
			$(document).bind("contextmenu",function(e){   
			    return false;   
			});
			$(document).keydown(function (e) {
			    e = window.event || e || e.which;
			    if (e.keyCode == 123 || e.ctrlKey && e.which == 85 || e.ctrlKey && e.which == 83) {
			        e.keyCode = 0;
			        return false;
			    }
			});
		}
	</script>
	<style>
	.gongao{
	  background: url(/tp5movie/public/static/index/img/gongao.jpg) no-repeat;
	}
	.dianzanok{
		background-position: 0 -14px;
	}
	.xianlu-div{
		display: flex;
	}
	.xianlu-div>div{
		flex: 1;
		border: none;
		border-radius: 0;
		text-align: center;
		cursor: pointer;
	}
	</style>
</head>
<body style="background: url('__PUBLIC__/img/pc_bg.png')">
<nav class="navbar navbar-default" style="background-color: white;padding: 20px 0px;box-shadow: 0 1px 3px rgba(26,26,26,.1);border: none;">
  <div class="container">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="" href="<?php echo url('/'); ?>" style="line-height: 42px;">
        <img alt="Brand" src="/tp5movie/public/static/index/img/logo.png" height="50">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo url('/'); ?>">首页</a></li>
        <li><a href="<?php echo url('more/index',array('classid'=>'1')); ?>">电影</a></li>
        <li><a href="<?php echo url('more/index',array('classid'=>'2')); ?>">电视剧</a></li>
        <li><a href="<?php echo url('more/index',array('classid'=>'3')); ?>">动漫</a></li>
      </ul>
      <form class="navbar-form navbar-left" method="get" action="<?php echo url('search/index'); ?>">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="请输入关键字" name="keywords">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php if(\think\Request::instance()->session('username')): ?>
          <li class="dropdown">
            <a style="background: url(<?php echo \think\Request::instance()->session('uimg'); ?>) no-repeat;background-size: cover;margin-top: 5px;width: 40px;height: 40px;border-radius: 50%;" href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="javascript:;">欢迎你,<?php echo \think\Request::instance()->session('username'); ?></a></li>
                <li><a href="javascript:;" class="editme" data-id="<?php echo \think\Request::instance()->session('uid'); ?>" data-toggle="modal" data-target="#myModal">修改信息</a></li>
                <li><a href="<?php echo url('logout/index'); ?>">退出登录</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li><a target="_blank" href="<?php echo url('login/index'); ?>">登录</a></li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">修改信息</h4>
      </div>
      <form action="<?php echo url('index/edit/edit'); ?>" method="post">
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          <button type="submit" class="btn btn-primary editme-btn">修改</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="gotop"><i class="glyphicon glyphicon-arrow-up"></i></div>






<script>
$('.gotop').click(function(){
    $("html, body").animate({
      scrollTop: 0
    },200);
})

$(window).scroll(function(){  
    if($(window).scrollTop()>300){  
      $('.gotop').fadeIn(300);  
    }else{
      $('.gotop').fadeOut(200);
    }  
});

$('.editme-btn').attr('disabled',"true");
$('.editme').click(function(){
  $('.modal-body').html('');
  $.ajax({
    url : "<?php echo url('index/edit/index'); ?>",
    type : "POST",
    data : {
      id : $(this).attr('data-id'),
    },
    beforeSend : function (jqXHR, settings) {
    },
    success : function(response){
      $('.editme-btn').removeAttr("disabled");
      var div ='';
      
      div+='  <div class="form-group">';
      div+='    <label for="password">密码</label>';
      div+='    <input type="password" name="password" class="form-control" id="password" placeholder="填写则修改，不填则不修改">';
      div+='  </div>';
      div+='  <div class="form-group">';
      div+='    <label for="name">昵称</label>';
      div+='    <input type="name" name="name" class="form-control" id="name" value="'+response.name+'">';
      div+='    <input type="hidden" name="id" class="form-control" id="id" value="'+response.id+'">';
      div+='    <input type="hidden" name="username" class="form-control" id="username" value="'+response.username+'">';
      div+='  </div>';
      div+='  <div class="form-group">';
      div+='    <label for="email">邮箱</label>';
      div+='    <input type="email" name="email" class="form-control" id="email" value="'+response.email+'">';
      div+='  </div>';
      div+='  <div class="form-group">';
      div+='    <label for="img">头像 (头像出现破碎就换个网站的头像)</label>';
      div+='    <input type="type" name="img" class="form-control" id="img" value="'+response.img+'" autocomplete="off">';
      div+='  </div>';
      div+='  <div class="form-group">';
      div+='    <img src="'+response.img+'" width="100%">';
      div+='  </div>';
      
      $('.modal-body').append(div);
    }
  })
})
</script>

<div class="gongao">请不要相信站内的广告，如有被骗，站主概不负责</div>

<?php if($datanum): ?>
	<div class="container dianshi-container">
		<iframe src="https://api.pangujiexi.com/player.php?url=<?php echo $data['a']; ?>" data-a="<?php echo $data['a']; ?>" frameborder="0" width="75%" height="500"></iframe>
		<div class="zk_div">
			<span class="zk_bg" data-lock="on">
				<svg fill="rgb(47,47,47)" viewBox="0 0 9 59" width="9" height="59">
				<path d="M3.8,5.1C1.7,4.3,0.2,2.4,0,0h0v5v4v41v5v3.9c0.6-1.9,2.1-3.4,4-4v0c2.9-0.7,5-3.2,5-6.3v-37  C9,8.4,6.8,5.7,3.8,5.1z"></path>
				</svg>
				<svg fill="rgb(110,110,110)" viewBox="0 0 10 6" class="zk_btn" width="10" height="16" aria-hidden="true"><title></title><g><path d="M8.716.217L5.002 4 1.285.218C.99-.072.514-.072.22.218c-.294.29-.294.76 0 1.052l4.25 4.512c.292.29.77.29 1.063 0L9.78 1.27c.293-.29.293-.76 0-1.052-.295-.29-.77-.29-1.063 0z"></path></g></svg>
			</span>
		</div>
		<div class="right">
			<div class="js_div">
			<?php if(is_array($datanum) || $datanum instanceof \think\Collection || $datanum instanceof \think\Paginator): $i = 0; $__LIST__ = $datanum;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$datanum): $mod = ($i % 2 );++$i;?>
				<div class="js" data-a="<?php echo $datanum['a']; ?>"><i class="dijiji"><?php echo $datanum['num']; ?></i> <i class="des"><?php echo $datanum['des']; ?></i></div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>
	<div class="container con2">
		<p class="title"><i><?php echo $data['title']; ?></i> <i class="num"><?php echo $data['num']; ?></i></p>
		<h6></h6>
	</div>
<?php else: ?>
	<div class="container">
		<iframe src="https://api.pangujiexi.com/player.php?url=<?php echo $data['a']; ?>" data-a="<?php echo $data['a']; ?>" frameborder="0" width="100%" height="500"></iframe>
	</div>
<?php endif; ?>
	<div class="container xianlu-div">
		<div class="alert alert-success" data-api="http://yun.6woaw.cn/yun.php?url=">线路1</div>
		<div class="alert alert-info" data-api="http://api.xfsub.com/index.php?url=">线路2</div>
		<div class="alert alert-warning" data-api="http://api.baiyug.vip/index.php?url=">线路3</div>
		<div class="alert alert-danger" data-api="https://api.pangujiexi.com/player.php?url=">线路4</div>
	</div>


	<div class="container message-region">
		<h4>评论<i class=" message_count"> ( <?php echo $allcount; ?> ) <i class="pull-right">文明上网理性发言</i></i></h4>
		<?php if(\think\Request::instance()->session('uid')): ?>
			<div class='media'>
				<div class='media-left'>
					<div class='media-object'>
						<img src='<?php echo \think\Request::instance()->session('uimg'); ?>' width='50' height='50'/>
					</div>
				</div>
				<div class='media-body'>
					<div class="box-content box-login"> 
						<div class="box-input-block">
							<div class="box-textarea-block"> 
								<textarea class="box-textarea J_Textarea" id="J_Textarea" placeholder="说两句吧..." required="required"></textarea>
							</div>
							<div class="box-info">
								<div class="box-operate">
									<b class="box-username"><?php echo \think\Request::instance()->session('name'); ?></b>
								</div>
								<div class="box-commentBtn box-commentBtn--able J_PostBtn" id="J_PostBtn">发布评论</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class='media'>
				<div class='media-left'>
					<div class='media-object'>
						<img src='/tp5movie/public/static/index/img/avatar.png' width='50' height='50'/>
					</div>
				</div>
				<div class='media-body'>
					<div class="box-content box-logout"> 
						<div class="box-textarea-block"> 
							<textarea class="box-textarea" placeholder="说两句吧..."></textarea> 
						</div> 
						<a href="<?php echo url('login/index'); ?>" target="_blank">
						<span class="box-loginBtn J_PostBtn">登录</span>
						</a>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<h4>全部评论</h4>
		<div class="all_message">
			<?php if(is_array($message) || $message instanceof \think\Collection || $message instanceof \think\Paginator): $i = 0; $__LIST__ = $message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<div class='media'>
				<div class='media-left'>
					<div class='media-object'>
						<img src='<?php echo $vo['img']; ?>' width='50' height='50'/>
					</div>
				</div>
				<div class='media-body'>
					<div class='media-heading'>
						<?php if($vo['messageuid'] == '0'): ?>
						<p><b class='editor'><?php echo $vo['name']; if($vo['uid'] == '9'): ?> <kbd>管理员</kbd><?php endif; ?></b><i class='time pull-right'><?php echo $vo['time']; ?></i></p>
						<?php else: ?>
						<p><b class='editor'><?php echo $vo['name']; if($vo['uid'] == '9'): ?> <kbd>管理员</kbd><?php endif; ?></b><i class="jiange">回复</i><img src="<?php echo $vo['messageuidimg']; ?>" class="huifu_img"><b class='editor'><?php echo $vo['messageuidname']; ?></b><i class='time pull-right'><?php echo $vo['time']; ?></i></p>
						<?php endif; ?>
						<p class='content'><?php echo $vo['content']; ?></p>
						<p class='time zan'>
							<?php if(\think\Request::instance()->session('uid')): ?>
							<span class='J_Vote comment-operate-item comment-operate-up' data-id='<?php echo $vo['id']; ?>'><?php echo $vo['love']; ?></span>
							<?php else: ?>
							<span class='comment-operate-item comment-operate-up' data-id='<?php echo $vo['id']; ?>' onClick="alert('请登录')"><?php echo $vo['love']; ?></span>
							<?php endif; ?>
							<span class='J_Reply comment-operate-item comment-operate-reply' data-key='on'> <i class='xs'>回复</i><i class='sq'>收起</i> </span>
						</p>
					</div>
					<div class='box-content box-logout' style='margin-top: 10px;'>
						<div class='box-textarea-block'>
							<textarea class='box-textarea' placeholder='说两句吧...' required='required'></textarea>
						</div>
						<?php if(\think\Request::instance()->session('uid')): ?>
							<span class='box-loginBtn J_PostBtn huifu_btn' data-id='<?php echo $vo['id']; ?>' data-uid='<?php echo $vo['uid']; ?>'> 回复 </span>
						<?php else: ?>
							<a href="<?php echo url('login/index'); ?>" target="_blank">
								<span class='box-loginBtn J_PostBtn huifu_btn' data-id='<?php echo $vo['id']; ?>' data-uid='<?php echo $vo['uid']; ?>'> 登录 </span>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
			<div class="text-center load_more">加载更多</div>
	</div>
	
<script>
$(function(){
		// 播放界面
		$('.js').each(function(){
			$(this).on('click',function(){
				var a = $(this).attr('data-a');
				$('iframe').attr('data-a',a);
				$('iframe').attr('src','https://api.pangujiexi.com/player.php?url='+a);
				$('.js').css({'color':'#bbb'});
				$(this).css({'color':'rgb(252,63,76)'});
			})
		})

		$('.xianlu-div>div').click(function(){
			var url = $('iframe').attr('data-a');
			var api = $(this).attr('data-api');
			$('iframe').attr('src',api+url);
		})

		var movie_id = "<?php echo $data['id']; ?>";
		var uid = "<?php echo \think\Request::instance()->session('uid'); ?>";

		//发表评论
		$('#J_PostBtn').click(function(){
			if($('#J_Textarea').val()==''){
				alert('说点什么吧');
			}else{
				$.ajax({
					url : "<?php echo url('index/video/movie_addmessage'); ?>",
					type : 'POST',
					data : {
						content : $('#J_Textarea').val(),
						uid : uid,
						movieid : movie_id,
					},
					beforeSend : function (jqXHR, settings) {
						$('.all_message').append("<div class='media' style='height:0;width:0;margin:0;padding:0;'></div>");
						if(uid){
							$('#J_PostBtn').addClass('jinyong');
						}
					},
					success : function (response, status) {
						if(uid){
							setTimeout(function(){
								$('#J_PostBtn').removeClass('jinyong');
							},5000)
						}
						var json = $.parseJSON(response);
						var div = '';
						div+= "<div class='media show'>";
						div+= "	<div class='media-left'>";
						div+= "		<div class='media-object'>";
						div+= "			<img src='"+json.img+"' width='50' height='50'/>";
						div+= "		</div>";
						div+= "	</div>";
						div+= "	<div class='media-body'>";
						div+= "		<div class='media-heading'>";
						div+= "			<p><b class='editor'>"+json.name+"</b><i class='time pull-right'>"+json.time+"</i></p>";
						div+= "			<p class='content'>"+json.content+"</p>";
						div+= "			<p class='time zan'>";
						div+= "				<span class='J_Vote comment-operate-item comment-operate-up' data-id='"+json.id+"'>"+json.love+"</span>";
						div+= "				<span class='J_Reply comment-operate-item comment-operate-reply' data-key='on'> <i class='xs'>回复</i><i class='sq'>收起</i> </span>";
						div+= "			</p>";
						div+= "		</div>";
						div+= "		<div class='box-content box-logout' style='margin-top: 10px;'>";
						div+= "			<div class='box-textarea-block'>";
						div+= "				<textarea class='box-textarea' placeholder='说两句吧...' required></textarea>";
						div+= "			</div>";
						div+= "			<span class='box-loginBtn huifu_btn J_PostBtn' data-id='"+json.id+"' data-uid='"+json.uid+"'> 回复 </span>";
						div+= "		</div>";
						div+= "	</div>";
						div+= "</div>";
						$('.all_message .media').eq(0).before(div);
						$('.J_Textarea').val("");
						$('.all_message .media').eq(0).hide().fadeIn(250);
					}
				})
			}
		})

		$('.all_message').delegate('.huifu_btn','click',function(){
			var _this = $(this);
			if(_this.parent().find('textarea').val()==''){
				alert('说点什么吧');
			}else{

				$.ajax({
					url : "<?php echo url('index/video/movie_addmessage2'); ?>",
					type : 'POST',
					data : {
						movieid : movie_id,
						content : _this.parent().find('textarea').val(),
						uid : uid,
						messageid : _this.attr('data-id'),
						messageuid : _this.attr('data-uid'),
					},
					beforeSend : function (jqXHR, settings) {
						$('.box-textarea').val("");
						if(uid){
							_this.addClass('jinyong');
						}
					},
					success : function (response, status) {
						if(uid){
							setTimeout(function(){
								_this.removeClass('jinyong');
							},5000)
						}
						var json2 = $.parseJSON(response);
						var div2 = "";
						div2+="<div class='media show'>";
						div2+="	<div class='media-left'>";
						div2+="		<div class='media-object'>";
						div2+="			<img src='<?php echo \think\Request::instance()->session('uimg'); ?>' width='50' height='50'/>";
						div2+="		</div>";
						div2+="	</div>";
						div2+="	<div class='media-body'>";
						div2+="		<div class='media-heading'>";
						div2+="			<p><b class='editor'><?php echo \think\Request::instance()->session('name'); ?></b><i class='jiange'>回复</i><img src='"+json2.messageuidimg+"' class='huifu_img'><b class='editor'>"+json2.messageuidname+"</b><i class='time pull-right'>"+json2.time+"</i></p>";
						div2+="			<p class='content'>"+json2.content+"</p>";
						div2+="			<p class='time zan'>";
						div2+="				<span class='J_Vote comment-operate-item comment-operate-up' data-id='"+json2.id+"'>"+json2.love+"</span>";
						div2+="				<span class='J_Reply comment-operate-item comment-operate-reply' data-key='on'> <i class='xs'>回复</i><i class='sq'>收起</i> </span>";
						div2+="			</p>";
						div2+="		</div>";
						div2+="		<div class='box-content box-logout' style='margin-top: 10px;'>";
						div2+="			<div class='box-textarea-block'>";
						div2+="				<textarea class='box-textarea' placeholder='说两句吧...' required></textarea>";
						div2+="			</div>";
						div2+="			<span class='box-loginBtn J_PostBtn huifu_btn' data-id='"+json2.id+"' data-uid='"+json2.uid+"'> 回复 </span>";
						div2+="		</div>";
						div2+="	</div>";
						div2+="</div>";
						_this.parents('.media').after(div2);
						_this.parents('.media').next().hide().fadeIn(250);
					}
				})
			}
		})

		//点赞
		$('.all_message').delegate('.J_Vote','click',function(){
			var love_this = $(this);
			if($(this).attr("date-key")=="on"){
				$(this).attr("date-key","");
				$.ajax({
					url : "<?php echo url('index/video/movie__message_removelove'); ?>",
					type : "POST",
					data : {
						id : love_this.attr('data-id'),
					},
					success : function(){
						var lovenum=Number($(love_this).html())-1;
						$(love_this).html(lovenum);
						$(love_this).removeClass('dianzanok');
					}
				})
			}else{
				$(this).attr("date-key","on");
				$.ajax({
					url : "<?php echo url('index/video/movie_message_love'); ?>",
					type : "POST",
					data : {
						id : love_this.attr('data-id'),
					},
					success : function(){
						var lovenum=Number($(love_this).html())+1;
						$(love_this).html(lovenum);
						$(love_this).addClass('dianzanok');
					}
				})
			}
		})

		//回复表单
		$('.all_message').delegate('.J_Reply','click',function(){if($(this).attr("data-key")=="on"){$('.xs').show();$('.sq').hide();$(this).find('.xs').hide();$(this).find('.sq').show();$('.J_Reply').attr("data-key","on");$(this).attr("data-key","");$('.all_message').find('.box-content').hide();$(this).parents('.media-body').find('.box-content').fadeIn(250);}else{$('.xs').show();$('.sq').hide();$(this).attr("data-key","on");$(this).parents('.media-body').find('.box-content').hide();}})



		var count = <?php echo $count; ?>;
		var page = 2;
		if (page > count) {
			$('.load_more').off('click');
			$('.load_more').hide();
		}
		$('.load_more').on('click', function () {
			$('.load_more').attr('disabled',"true");//防止连续点击出现的BuG
			$.ajax({
				url : "<?php echo url('index/video/index'); ?>",
				type : "POST",
				data : {
					page : page,
					id : <?php echo $data['id']; ?>,
				},
				success : function(response){
					var json3 = $.parseJSON(response);
					$.each(json3,function(index,value){
						var div3 = '';
						div3 +="<div class='media'>";
						div3 +="	<div class='media-left'>";
						div3 +="		<div class='media-object'>";
						div3 +="			<img src='"+value.img+"' width='50' height='50'/>";
						div3 +="		</div>";
						div3 +="	</div>";
						div3 +="	<div class='media-body'>";
						 div3 +="		<div class='media-heading'>";
						 				if(value.messageuid==0){
						 div3 +="			<p><b class='editor'>"+value.name+"</b><i class='time pull-right'>"+value.time+"</i></p>";
						 				}else{
						 div3 +="			<p><b class='editor'>"+value.name+"</b><i class='jiange'>回复</i><img src='"+value.messageuidimg+"'' class='huifu_img'><b class='editor'>"+value.messageuidname+"</b><i class='time pull-right'>"+value.time+"</i></p>";
						 				}
						 div3 +="			<p class='content'>"+value.content+"</p>";
						 div3 +="			<p class='time zan'>";
						 div3 +="				<span class='J_Vote comment-operate-item comment-operate-up' data-id='"+value.id+"'>"+value.love+"</span>";
						 div3 +="				<span class='J_Reply comment-operate-item comment-operate-reply' data-key='on'> <i class='xs'>回复</i><i class='sq'>收起</i> </span>";
						 div3 +="			</p>";
						 div3 +="		</div>";
						 div3 +="		<div class='box-content box-logout' style='margin-top: 10px;'>";
						 div3 +="			<div class='box-textarea-block'>";
						 div3 +="				<textarea class='box-textarea' placeholder='说两句吧...'></textarea>";
						 div3 +="			</div>";
						 					if($('.load_more').attr('data-uid')){
						 div3 +="			<span class='box-loginBtn J_PostBtn huifu_btn' data-id='"+value.id+"' data-uid='"+value.uid+"'> 回复 </span>";
						 					}else{												
						 div3 +="				<a href='<?php echo url('login/index'); ?>''>";
						 div3 +="					<span class='box-loginBtn J_PostBtn huifu_btn' data-id='"+value.id+"' data-uid='"+value.uid+"'> 登录 </span>";
						 div3 +="				</a>";
						 					}
						 div3 +="		</div>";
						 div3 +="	</div>";
						 div3 +="</div>";
						$('.all_message').append(div3);
					})
					$('.load_more').removeAttr("disabled");
					$('.load_more').html('加载更多');
					page++;
					if (page > count) {
						$('.load_more').off('click');
						$('.load_more').hide();
					}
				}
			})
		});

})
</script>
</body>
</html>