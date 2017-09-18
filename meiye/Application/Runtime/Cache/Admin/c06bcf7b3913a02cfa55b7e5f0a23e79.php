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
						<div class="row maintop">
							<form class="form-horizontal" name="admin_rule_add" id="admin_rule_add" method="post" action="<?php echo U('admin_rule_add');?>">
								<div class="col-xs-12 col-sm-12">
								<small>菜单状态：</small>
								<small>
									<select name="status">
										<option value="1">显示</option>
										<option value="0">不显示</option>
									</select>
								</small>
								<small class="sl-left10">父级：</small>
								<small>
									<select name="pid">
										<option value="0">--默认顶级--</option>
											<?php if(is_array($admin_rule)): foreach($admin_rule as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" style="margin-left:55px;"><?php echo ($v["lefthtml"]); echo ($v["title"]); ?></option><?php endforeach; endif; ?>
									</select>
								</small>
								<small class="sl-left10">名称：</small>
								<small><input name="title" id="title" class="rule"  placeholder=" 输入名称" /></small>
								<small class="sl-left10">控/方：</small>
								<small><input name="name" id="name" class="rule"  placeholder=" 输入控制器/方法" /></small>
								<small class="sl-left10">css：</small>
								<small><input name="css" id="css" class="wh50"  placeholder=" css样式" /></small>
								<small class="sl-left10">排序：</small>
								<small><input name="sort" id="sort" class="wh30" value="50"/></small>
								<small>
								<button class="btn btn-xs btn-danger ruleadd">
										添加权限
								</button>
								</small>
								</div>
							</form>
						<div class="col-xs-12 col-sm-12 rule-top alert alert-info top10">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						1、《控/方》：意思是 控制器/方法; 例如 Sys/sys_list<br />
						2、css为控制左侧导航顶级栏目前图标样式，具体可查看FontAwesome图标CSS样式
						</div>
							<div class="row">
							    <div class="col-xs-12">
										<div>
											<form id="ruleorder" name="ruleorder" method="post" action="<?php echo U('ruleorder');?>" >
											<table width="100%" class="table table-striped table-bordered table-hover" id="dynamic-table">
												<thead>
													<tr>
													  <th width="8%">ID</th>
													  <th width="21%">权限名称</th>
													  <th width="13%">控制器/方法</th>
													  <th width="13%">是否验证权限</th>
													  <th width="13%">栏目菜单状态</th>
													  <th width="8%" style="border-right:#CCC solid 1px;">排序</th>
													  <th width="11%" style="border-right:#CCC solid 1px;">操作</th>
												  </tr>
												</thead>

												<tbody>

                                                <?php if(is_array($admin_rule)): foreach($admin_rule as $key=>$v): ?><tr>
														<td height="28"><?php echo ($v["id"]); ?></td>
														<td style='padding-left:<?php if($v["leftpin"] != 0): echo ($v["leftpin"]); ?>px<?php endif; ?>' ><?php echo ($v["lefthtml"]); echo ($v["title"]); ?></td>
														<td><?php echo ($v["name"]); ?></td>
														<td>
														<?php if($v[authopen] == 1): ?><a class="red" href="javascript:;" onclick="return tzyes(<?php echo ($v["id"]); ?>);" title="已开启">
														<div id="yz<?php echo ($v["id"]); ?>"><button class="btn btn-minier btn-danger">无需验证</button></div>
														</a>
														<?php else: ?>
														<a class="red" href="javascript:;" onclick="return tzyes(<?php echo ($v["id"]); ?>);" title="已禁用">
														<div id="yz<?php echo ($v["id"]); ?>"><button class="btn btn-minier btn-yellow">需要验证</button></div>
														</a><?php endif; ?>														</td>
														<td>
														<?php if($v[menustatus] == 1): ?><a class="red" href="javascript:;" onclick="return stateyes(<?php echo ($v["id"]); ?>);" title="已开启">
														<div id="zt<?php echo ($v["id"]); ?>"><button class="btn btn-minier btn-yellow">显示状态</button></div>
														</a>
														<?php else: ?>
														<a class="red" href="javascript:;" onclick="return stateyes(<?php echo ($v["id"]); ?>);" title="已禁用">
														<div id="zt<?php echo ($v["id"]); ?>"><button class="btn btn-minier btn-danger">隐藏状态</button></div>
														</a><?php endif; ?>														</td>
														<td><input name="<?php echo ($v["id"]); ?>" class="list_order" value=" <?php echo ($v["sort"]); ?>" size="10"/></td>
														<td>
						<div class="hidden-sm hidden-xs action-buttons">
							<a class="green" href="<?php echo U('admin_rule_edit',array('id'=>$v['id']));?>" title="修改">
								<i class="ace-icon fa fa-pencil bigger-130"></i>							</a>
							<a class="red" href="javascript:;" onclick="return del(<?php echo ($v["id"]); ?>);" title="删除">
								<i class="ace-icon fa fa-trash-o bigger-130"></i>							</a>						</div>														</td>
													</tr><?php endforeach; endif; ?>   
                                                  <tr>
													  <td colspan="8" align="left"><button type="submit"  id="btnorder" class="btn btn-white btn-yellow btn-sm">排序</button></td>
												  </tr>
												</tbody>
										  </table>
										  </form>
							    		</div>


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
>

<script>
function del(id){
		layer.confirm('你确定要删除吗？', {icon: 3}, function(index){
	    layer.close(index);
	    window.location.href="/index.php/Admin/Sys/admin_rule_del/id/"+id+"";
	});
}

function stateyes(val){
		  $.post('<?php echo U("admin_rule_state");?>',
		  {x:val},
	function(data){
		if(data.status){
			if(data.info=='状态禁止'){
				var a='<button class="btn btn-minier btn-danger">隐藏状态</button>'
				$('#zt'+val).html(a);
				return false;
			}else{
				var b='<button class="btn btn-minier btn-yellow">显示状态</button>'
				$('#zt'+val).html(b);
				return false;
			}
		}
	});
	return false;
}


function tzyes(val){
		  $.post('<?php echo U("admin_rule_tz");?>',
		  {x:val},
	function(data){
		if(data.status){
			if(data.info=='无需验证'){
				var a='<button class="btn btn-minier btn-danger">无需验证</button>'
				$('#yz'+val).html(a);
				return false;
			}else{
				var b='<button class="btn btn-minier btn-yellow">需要验证</button>'
				$('#yz'+val).html(b);
				return false;
			}
		}
	});
	return false;
}

$(function(){
	$('#admin_rule_add').ajaxForm({
		beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
		success: complete, // 这是提交后的方法
		dataType: 'json'
	});
	
	function checkForm(){
		if( '' == $.trim($('#title').val())){
			layer.alert('名称不能为空', {icon: 6}, function(index){
 			layer.close(index);
			$('#title').focus(); 
			});
			return false;
		}
		
		if( '' == $.trim($('#name').val())){
			layer.alert('控制器/方法不能为空', {icon: 6}, function(index){
 			layer.close(index);
			$('#name').focus(); 
			});
			return false;
		}
 }
	function complete(data){
		if(data.status==1){
			layer.alert(data.info, {icon: 6}, function(index){
 			layer.close(index);
			window.location.href=data.url;
			});
		}else{
			alert(data.info);
			return false;	
		}
	}
 
});



$(function(){
	$('#ruleorder').ajaxForm({
		success: complete, // 这是提交后的方法
		dataType: 'json'
	});


	function complete(data){
		if(data.status==1){
			layer.alert(data.info, {icon: 6}, function(index){
 			layer.close(index);
			window.location.href=data.url;
			});
		}else{
			layer.alert(data.info, {icon: 6}, function(index){
 			layer.close(index);
			window.location.href=data.url;
			});
		}
	}
});

</script>
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

    
		</div><!-- /.main-container -->
	</body>
</html>