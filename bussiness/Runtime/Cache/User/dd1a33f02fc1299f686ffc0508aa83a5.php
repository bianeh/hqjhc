<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta  "charset=utf-8" />
<title>环球集货仓供货商后台 | 登录页面</title>
<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
<style type="text/css">
html{height:100%;}
body{margin: 0;padding: 0;height:100%;overflow:hidden}
#tab {width: 100%;margin: auto;height:100%;position: relative; }
#tab>img{width: 100%;height: 100%;}
#tab>img:not(:first-child){display:none; }
#span{z-index: 3;position: absolute;bottom: 20px;left:45%;}
#span span:first-child{background: purple;}
#span>span:not(:first-child){background: red;}
#span span{cursor: pointer;margin-left:10px;float: left;width:15px;height:15px;border-radius: 50%;display: inline-block;text-align: center;cursor: pointer;display: none;}
.loginform{position:absolute;height:423px;top: 20%;;width:419px;border:2px solid #00BCD4;z-index: 99999;right:500px;margin:0 auto;border-radius:5px;padding-top:30px;}
.loginform div{margin-top:10px;}
.loginform div span{display:inline-block;width:120px;color:#FFFFFF;text-align:right;padding-right:5px}
input{font-size: 16px;font-family: "Microsoft YaHei";height: 28px;width:200px;background: #fff;border: 0;border-radius: 5px;padding: 6px 10px 6px 10px;opacity: 0.8; filter: alpha(opacity=80);border-bottom: 1px solid #fff;color: #666;}
h1{color:#ffffff;}
.login{display:inline-block;height:50px;width:240px;border-radius:7px;background:#00BCD4;color:#FFFFFF;border:0px;}
.loginbutton{margin-top:30px;text-align:center;}
.ve{vertical-align:middle;}
</style>
</head>
<body>
<div id="tab">
	<img src="<?php echo (ROOT_URL); ?>/Public/backend/img/banner_1.jpg" />
	<img src="<?php echo (ROOT_URL); ?>/Public/backend/img/banner_2.jpg" />
	<img src="<?php echo (ROOT_URL); ?>/Public/backend/img/banner_3.jpg" />
	<span id="span"></span>
	<div class="loginform">
	     <form action="<?php echo U('User/Login/dologin');?>" method="post">
		      <h1 style="text-align:center;">供货商管理后台</h1>
		      <div><span class="ve"><i class="fa fa-user-o fa-2x" aria-hidden="true"></i></span><input type="text" class="ve" name="loginName"  placeholder="用户名"></div>
		      <div><span class="ve"><i class="fa fa-lock fa-2x" aria-hidden="true"></i></span><input type="password" class="ve" name="loginPwd"  placeholder="密码"></div>
		      <div class="loginbutton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="login">登陆</button></div>
	      </form>
	</div>
</div>
</body>
</html>
<script>
	window.onload = function(){
        var obox=document.getElementById('tab');
        var aimg=obox.getElementsByTagName('img');
        var ospan=document.getElementById('span');
        var span=document.getElementById('span').children;
        for (var i=0;i<aimg.length;i++){
            ospan.innerHTML+="<span></span>";
        }
		var images = document.getElementsByTagName('img');
		var pos = 0;
		var len = images.length;
		setInterval(function(){
			images[pos].style.display = 'none';
			span[pos].style.background = 'red';
			pos = ++pos == len ? 0 : pos;
			images[pos].style.display = 'inline';
			span[pos].style.background = 'purple';	
		},2000);
	};
</script>
<!--<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>环球集货仓供货商管理后台 | 登录页面</title>
   Tell the browser to be responsive to screen width 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   Bootstrap 3.3.7 
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/bootstrap/dist/css/bootstrap.min.css">
   Font Awesome 
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/font-awesome/css/font-awesome.min.css">
   Ionicons 
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/Ionicons/css/ionicons.min.css">
   Theme style 
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend//dist/css/AdminLTE.min.css">
   iCheck 
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/plugins/iCheck/square/blue.css">

   HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries 
   WARNING: Respond.js doesn't work if you view the page via file:// 
  [if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]

   Google Font 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-image: url('<?php echo (ROOT_URL); ?>/Public/backend/img/login.jpg');background-repeat:no-repeat;background-size:100%;">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>环球集货仓供货商管理后台</b></a>
  </div>
   /.login-logo 
  <div class="login-box-body">
    <p class="login-box-msg">登录页面</p>

    <form action="<?php echo U('User/Login/dologin');?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="loginName" class="form-control" placeholder="用户名">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="loginPwd" class="form-control" placeholder="密码">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> 记住我
            </label>
          </div>
        </div>
         /.col 
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
        </div>
         /.col 
      </div>
    </form>
  </div>
   /.login-box-body 
</div>
 /.login-box 

 jQuery 3 
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jquery/dist/jquery.min.js"></script>
 Bootstrap 3.3.7 
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 iCheck 
<script src="<?php echo (ROOT_URL); ?>/Public/backend/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>-->