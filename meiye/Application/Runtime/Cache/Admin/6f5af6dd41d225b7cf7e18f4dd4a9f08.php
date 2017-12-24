<?php if (!defined('THINK_PATH')) exit();?>	<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>网站后台系统管理</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="/Public/assets/css/bootstrap.css" />
		<link rel="stylesheet" href="/Public/assets/css/font-awesome.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="/Public/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="/Public/assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="/Public/assets/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->
        <link rel="stylesheet" href="/Public/assets/css/slackck.css" />
		<!-- ace settings handler -->
		<script src="/Public/assets/js/ace-extra.js"></script>
		<script src="/Public/assets/js/jquery.min.js"></script>
		<script src="/Public/assets/js/jquery.form.js"></script>
		<script src="/Public/layer/layer.js"></script>
		<!--<script src="/Public/assets/js/jquery.leanModal.min.js"></script>-->

		<!--[if lte IE 8]>
		<script src="/Public/assets/js/html5shiv.js"></script>
		<script src="/Public/assets/js/respond.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default navbar-collapse">
		<script type="text/javascript">

				try{ace.settings.check('navbar' , 'fixed')}catch(e){}

			</script>
			<div class="navbar-container" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">

					<span class="sr-only">Toggle sidebar</span>



					<span class="icon-bar"></span>



					<span class="icon-bar"></span>



					<span class="icon-bar"></span>

				</button>
				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="<?php echo U('Index/index');?>" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							后台管理系统
						</small>
					</a>

				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">
					<li class="transparent"></li>
					<li class="transparent">
						<a style="cursor:pointer;" id="cache" class="dropdown-toggle">清除缓存</a>
					</li>
			
						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="/Public/assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo ($_SESSION['admin_username']); ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										个人设置
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										会员中心
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="javascript:;"  id="logout">
										<i class="ace-icon fa fa-power-off"></i>
										注销
									</a>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>


<script type="text/javascript">
$(document).ready(function(){
	$("#logout").click(function(){
		layer.confirm('你确定要退出吗？', {icon: 3}, function(index){
	    layer.close(index);
	    window.location.href="<?php echo U('Login/logout');?>";
	});
	});
});



$(function(){
$('#cache').click(function(){
if(confirm("确认要清除缓存？")){
var $type=$('#type').val();
var $mess=$('#mess');
$.post('/index.php/Admin/Sys/clear',{type:$type},function(data){
alert("缓存清理成功");
});
}else{
return false;
}
});
});
</script>



		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">

			<!-- #section:basics/sidebar -->
<script>

$(function(){
	$('textarea.limited').maxlength({
		'feedback' : '.charsLeft', 
	});
	  
	$('textarea.limitedone').maxlength({
		'feedback' : '.charsLeftone', 
	});
});
</script>
	<div id="sidebar" class="sidebar responsive sidebar-fixed">

	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<!--左侧顶端按钮-->
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<a class="btn btn-success" href="<?php echo U('News/news_list');?>" role="button" title="文章列表"><i class="ace-icon fa fa-signal"></i></a>
			<a class="btn btn-info" href="<?php echo U('News/news_add');?>" role="button" title="添加文章"><i class="ace-icon fa fa-pencil"></i></a>
			<a class="btn btn-warning" href="<?php echo U('Member/member_list');?>" role="button" title="会员列表"><i class="ace-icon fa fa-users"></i></a>
			<a class="btn btn-danger" href="<?php echo U('Sys/sys');?>" role="button" title="站点设置"><i class="ace-icon fa fa-cogs"></i></a>
		</div>
        <!--左侧顶端按钮（手机）-->
		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<a class="btn btn-success" href="<?php echo U('News/news_list');?>" role="button" title="文章列表"></a>
			<a class="btn btn-info" href="<?php echo U('News/news_add');?>" role="button" title="添加文章"></a>
			<a class="btn btn-warning" href="<?php echo U('Member/member_list');?>" role="button" title="会员列表"></a>
			<a class="btn btn-danger" href="<?php echo U('Sys/sys');?>" role="button" title="站点设置"></a>
		</div>
	</div>
    <!--菜单栏开始-->
	<ul class="nav nav-list">
		<?php use Common\Controller\AuthController; use Think\Auth; $m = M('auth_rule'); $field = 'id,name,title,css'; $data = $m->field($field)->where('pid=0 AND status=1')->order('sort')->select(); $auth = new Auth(); foreach ($data as $k=>$v){ if(!$auth->check($v['name'], $_SESSION['aid']) && $_SESSION['aid'] != 1){ unset($data[$k]); } } ?>
        <!--一级菜单遍历-->
		<?php if(is_array($data)): foreach($data as $key=>$v): ?><li class="<?php if(CONTROLLER_NAME == $v['name']): ?>open<?php endif; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa <?php echo ($v["css"]); ?>"></i>
							<span class="menu-text">
								<?php echo ($v["title"]); ?>
							</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<?php $m = M('auth_rule'); $dataa = $m->where(array('pid'=>$v['id'],'menustatus'=>1))->order('sort')->select(); foreach ($dataa as $kk=>$vv){ if(!$auth->check($vv['name'], $_SESSION['aid']) && $_SESSION['aid'] != 1){ unset($dataa[$kk]); } } $id_4=$m->where(array('name'=>CONTROLLER_NAME.'/'.ACTION_NAME,'level'=>4))->field('pid')->find(); if($id_4){ $id_3=$m->where(array('id'=>$id_4['pid'],'level'=>3))->field('pid')->find(); }else{ $id_3=$m->where(array('name'=>CONTROLLER_NAME.'/'.ACTION_NAME,'level'=>3))->field('pid')->find(); if(!$id_3){ $id_2=$m->where(array('name'=>CONTROLLER_NAME.'/'.ACTION_NAME,'level'=>2))->field('id')->find(); $id_3['pid']=$id_2['id']; } } ?>
                <!--二级菜单遍历-->
				<?php if(is_array($dataa)): foreach($dataa as $key=>$j): $m = M('auth_rule'); $dataaa = $m->where(array('pid'=>$j['id'],'status'=>1))->order('sort')->select(); foreach ($dataaa as $kkk=>$vvv){ if(!$auth->check($vvv['name'], $_SESSION['aid']) && $_SESSION['aid'] != 1){ unset($dataaa[$kkk]); } } ?>
					<?php if(empty($dataaa)): ?><!-- 无三级菜单 -->
					<li class="<?php if(($id_3['pid'] == $j['id'])): ?>active open<?php endif; ?>">
						<a href="<?php echo U($j['name']);?>">
							<i class="menu-icon fa fa-caret-right"></i>
							<?php echo ($j["title"]); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<?php else: ?>
					<li class="<?php if(($id_3['pid'] == $j['id'])): ?>active open<?php endif; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>
							<?php echo ($j["title"]); ?>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<!--三级菜单遍历-->
							 <?php if(is_array($dataaa)): foreach($dataaa as $key=>$m): ?><li class="<?php if(((CONTROLLER_NAME.'/'.ACTION_NAME) == $m['name'])): ?>active<?php endif; ?>">
								<a href="<?php echo U($m['name']);?>">
									<i class="menu-icon fa fa-leaf green"></i>
									<?php echo ($m["title"]); ?>
								</a>
								<b class="arrow"></b>
								</li><?php endforeach; endif; ?>
							<!--三级菜单遍历结束-->
						</ul>
					</li><?php endif; endforeach; endif; ?>
                <!--二级菜单遍历结束-->
			</ul>
			</li><?php endforeach; endif; ?>
        <!--一级菜单遍历结束-->
	</ul><!-- 菜单栏结束 -->

	<!-- 左侧菜单伸缩 -->
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	</script>
</div>


			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">

                        
                        
                        <!--主题-->
						<div class="page-header">
							<h1>
								您当前操作
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									基础信息
								</small>
							</h1>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<form class="form-horizontal" name="sys" id="sys" method="post" action="<?php echo U('base_info');?>">
                                <input type="hidden" name="sys_id" value="<?php echo ($sys_id); ?>" />
                                	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 移动电话: </label>
										<div class="col-sm-9">
											<input type="text" name="mobile" id="mobile" value="<?php echo ($base["mobile"]); ?>" class="col-xs-10 col-sm-5" />
                                            <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle" id="resone"></span>
											</span>
										</div>
									</div>
                                    <div class="space-4"></div>
                                    
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 坐机: </label>
										<div class="col-sm-9">
											<input type="text" name="phone" id="phone" value="<?php echo ($base["phone"]); ?>"  class="col-xs-10 col-sm-5" />
                                            <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle" id="restwo"></span>
											</span>
										</div>
									</div>
                                    <div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 邮箱: </label>
										<div class="col-sm-9">
											<input type="text" name="mail" id="mail" value="<?php echo ($base["mail"]); ?>"  class="col-xs-10 col-sm-5" />
                                            <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle" id="resthr"></span>
											</span>
										</div>
									</div>
                                    <div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 地址: </label>
										<div class="col-sm-9">
                                            <textarea  name="address" cols="20" class="col-xs-10 col-sm-7 limited"  id="form-field-9"  maxlength="100"><?php echo ($base["address"]); ?></textarea>
                                            <input type="hidden" name="maxlength" value="100" />
                                            <span class="help-inline col-xs-5 col-sm-5">
												还可以输入 <span class="middle charsLeft"></span> 个字符,以英文 , 号隔开
											</span>
									  </div>
									</div>
                                    <div class="space-4"></div>
                                    <input type="hidden" name="action" value="dosubmit">
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												保存
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												重置
											</button>
										</div>
									</div>
								</form>
                        	</div>
                        </div>
									<div class="hr hr-24"></div>

<div class="breadcrumbs breadcrumbs-fixed " id="breadcrumbs">
	<div class="row">
		<div class="col-xs-12">
			<div class="">
				<div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse collapse_btn">
					<ul class="nav nav-list header-nav" id="header-nav">
						<?php $m = M('auth_rule'); $dataaa = $m->where(array('pid'=>$id_3['pid'],'status'=>1))->order('sort')->select(); foreach ($dataaa as $kkk=>$vvv){ if(!$auth->check($vvv['name'], $_SESSION['aid']) && $_SESSION['aid']!= 1){ unset($dataaa[$kkk]); } } if(empty($dataaa)){ $dataaa = $m->where(array('id'=>$id_3['pid']))->order('sort')->find(); $dataaa = $m->where(array('pid'=>$dataaa['pid'],'status'=>1))->order('sort')->select(); if(!$auth->check($vvv['name'], $_SESSION['aid']) && $_SESSION['aid']!= 1){ unset($dataaa[$kkk]); } } ?>
    					<?php if(is_array($dataaa)): foreach($dataaa as $key=>$k): ?><li>
										<a href="<?php echo U(''.$k['name'].'');?>">
											<o class="font12 <?php if((CONTROLLER_NAME.'/'.ACTION_NAME == $k['name'])): ?>rigbg<?php endif; ?>"><?php echo ($k["title"]); ?></o>
										</a>

								<b class="arrow"></b>
							</li><?php endforeach; endif; ?>
					</ul><!-- /.nav-list -->
				</div><!-- .sidebar -->
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
	
</div>

					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">网站</span>
							后台管理系统 &copy; 2015-2016
						</span>
					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>
            

		<!-- basic scripts -->


<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script src="/Public/assets/js/bootstrap.js"></script>
		<script src="/Public/assets/js/maxlength.js"></script>
		<script src="/Public/assets/js/ace/ace.js"></script>
		<script src="/Public/assets/js/ace/ace.sidebar.js"></script>


		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			   $('#sidebar2').insertBefore('.page-content');
			   
			   $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');
			   
			   
			   $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
				 if(event_name == 'sidebar_fixed') {
					 if( $('#sidebar').hasClass('sidebar-fixed') ) {
						$('#sidebar2').addClass('sidebar-fixed');
						$('#navbar').addClass('h-navbar');
					 }
					 else {
						$('#sidebar2').removeClass('sidebar-fixed')
						$('#navbar').removeClass('h-navbar');
					 }
				 }
			   }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);
			})
		</script>


	</body>
</html>