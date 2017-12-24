<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>用户登录</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<meta property="qc:admins" content="032125120605047764526375" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="/Public/assets/css/bootstrap.css" />
		<link rel="stylesheet" href="/Public/assets/css/font-awesome.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="/Public/assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="/Public/assets/css/ace.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="/Public/assets/css/ace-part2.css" />
		<![endif]-->
		<link rel="stylesheet" href="/Public/assets/css/ace-rtl.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="/Public/assets/css/ace-ie.css" />
		<![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="/Public/assets/js/html5shiv.js"></script>
		<script src="/Public/assets/js/respond.js"></script>
		<![endif]-->

<style>
.high{ color:#F00;}
.loginnone{display:none;}
</style>
	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-leaf green"></i>
									<span class="red">后台管理系统</span>
								</h1>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												请填写您的用户信息
											</h4>

											<div class="space-6"></div>
											<form name="runlogin" id="runlogin" method="post" action="<?php echo U('runlogin');?>">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="admin_username" id="admin_username" placeholder="用户名" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="admin_pwd" id="admin_pwd" placeholder="输入密码" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="verfity" id="verfity" placeholder="输入验证码" />
														</span>
														<span class="block">
															<center>
																<a href="javascript:void();" class="reload"><img src="<?php echo U('Login/verfity');;?>"></a>
															</center>
														</span>
													</label>
													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> 记住信息</span>
														</label>

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">登录</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>


										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													找回密码
												</a>
											</div>

										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												找回密码
											</h4>

											<div class="space-6"></div>
											<p>
												输入您注册时候填写的邮箱
											</p>

											<form name="runemail" id="runemail" action="<?php echo U('runemail');?>" method="post" enctype="multipart/form-data">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" name="email" id="email"/>
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">发送密码</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												返回登录
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

							</div><!-- /.position-relative -->

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='/Public/assets/js/jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='/Public/assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");

			$('.reload').click(function(){
				window.location.reload();
			});
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
		</script>
<script src="/Public/assets/js/jquery.min.js"></script>
<script src="/Public/assets/js/jquery.form.js"></script>
<script src="/Public/layer/layer.js"></script>
<script>
//登入
$(function(){
	$('#runlogin').ajaxForm({
		beforeSubmit: logcheckForm, // 此方法主要是提交前执行的方法，根据需要设置
		success: logcomplete, // 这是提交后的方法
		dataType: 'json'
	});
	
	function logcheckForm(){
		if( '' == $.trim($('#admin_username').val())){
			layer.alert('登录用户名不能为空', {icon: 6}, function(index){
 			layer.close(index);
			$('#admin_username').focus(); 
			});
			return false;
		}
 
		if( '' == $.trim($('#admin_pwd').val())){
			layer.alert('登录密码不能为空', {icon: 6}, function(index){
 			layer.close(index);
			$('#admin_pwd').focus(); 
			});
			return false;
		}

		if( '' == $.trim($('#verfity').val())){
			layer.alert('验证码不能为空', {icon: 6}, function(index){
 			layer.close(index);
			$('#verfity').focus(); 
			});
			return false;
		}
 }
	function logcomplete(data){
		if(data.status==1){
			window.location.href="<?php echo U('Index/index');?>";
			return false;
		}else{
			layer.alert(data.info, {
			  skin: 'layui-layer-molv'
			  ,closeBtn: 0
			}, function(){
			  window.location.href=data.url;
			});
			return false;	
		}
	}
 
});

//找回密码，发送邮件
$(function(){
	$('#runemail').ajaxForm({
		beforeSubmit: emailcheckForm, // 此方法主要是提交前执行的方法，根据需要设置
		success: emailcomplete, // 这是提交后的方法
		dataType: 'json'
	});
	
	function emailcheckForm(){
		if( '' == $.trim($('#email').val())){
			layer.alert('邮件不能为空', {icon: 6});
			$('#email').focus(); 
			return false;
		}

 }
	function emailcomplete(data){
		if(data.status==1){
			layer.alert(data.info, {icon: 6});
			return false;
		}else{
			layer.alert(data.info, {icon: 5});
			return false;	
		}
	}
 
});

</script>
	</body>
</html>