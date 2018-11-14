<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"C:\wamp\www\tp5movie\public/../application/index\view\search\index.html";i:1530796592;s:59:"C:\wamp\www\tp5movie\application\index\view\common\top.html";i:1529057787;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>随看影视</title>
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="/tp5movie/public/static/index/css/style.css" rel="stylesheet">
	<style>
	.icon{
	    background: url(/tp5movie/public/static/index/img/play-icon.png) no-repeat;
	}
	.gongao{
	  background: url(/tp5movie/public/static/index/img/gongao.jpg) no-repeat;
	}
	</style>
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
</script>
</head>
<body>
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

	<div class="gongao">
		本站一切以学习为目的，不用做任何商业用途，如有侵权，请联系QQ1103223758。
	</div>

	<main>
		<div class="container">
			<div class="alert alert-danger" role="alert">
			  <span class="sr-only">Error:</span>搜索<i style="color: #ff6428;font-size: 18px;padding: 0 20px;font-weight: 600;"><?php echo $keywords; ?></i>的结果如下：
			</div>
			<div class="row">
				<?php if(is_array($movies) || $movies instanceof \think\Collection || $movies instanceof \think\Paginator): $i = 0; $__LIST__ = $movies;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<div class="col-xs-6 col-sm-4  col-md-3 col-lg-2">
						<a href="<?php echo url('video/index',array('id'=>$vo['id'])); ?>" target="_blank">
						<div class="col-img">
							<div>
								<div class="icon"></div>
								<img src="<?php echo $vo['img']; ?>">
								<?php if($vo['num']): ?>
									<p><?php echo $vo['num']; ?></p>
								<?php endif; ?>
							</div>
							<p><?php echo $vo['title']; ?></p>
					        <?php if($vo['des']): ?>
					        	<p><?php echo $vo['des']; ?></p>
					        <?php else: ?>
								<p>无描述</p>
					        <?php endif; ?>
							<p class="score"><?php echo $vo['score']; ?></p>
						</div>
						</a>
					</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</main>
</body>
</html>