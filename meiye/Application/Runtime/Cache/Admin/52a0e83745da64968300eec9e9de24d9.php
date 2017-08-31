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
$.post('/index.php/Admin/Member/clear',{type:$type},function(data){
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
							<div class="col-xs-12 col-sm-1">
								<a href="<?php echo U('member_list_add');?>">
								<button class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-bolt bigger-110"></i>
										添加会员
								</button>
								</a>
							</div>

								<div class="col-xs-12 col-sm-3">
								<form name="admin_list_sea" class="form-search" method="post" action="/index.php/Admin/Member/member_list">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="ace-icon fa fa-check"></i>
										</span>
										<input type="text" name="key" id="key" class="form-control search-query admin_sea" value="<?php echo ($val); ?>" placeholder="输入用户名或者邮箱" />
										<span class="input-group-btn">
											<button type="submit" class="btn btn-xs  btn-purple">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
												搜索
											</button>
										</span>
									</div>
								</form>
								</div>
								  <div class="input-group-btn">
									<a href="/index.php/Admin/Member/member_list">
									<button type="button" class="btn btn-xs  btn-purple">
										<span class="ace-icon fa fa-globe icon-on-right bigger-110"></span>
										显示全部
									</button>
									</a>
								  </div>
							</div>

							<div class="row">
							    <div class="col-xs-12">
										<div>
											<table width="100%" class="table table-striped table-bordered table-hover" id="dynamic-table">
												<thead>
													<tr>
													  <th width="6%">ID</th>
													  <th width="11%">用户名</th>
													  <th width="32%">昵称/邮箱</th>
													  <th width="5%">性别</th>
													  <th width="15%">添加时间</th>
													  <th width="8%">状态</th>
													  <th width="12%" style="border-right:#CCC solid 1px;">操作</th>
												  </tr>
												</thead>

												<tbody>
                                                
                                                <?php if(is_array($member_list)): foreach($member_list as $key=>$v): ?><tr>
														<td height="28" ><?php echo ($v["member_list_id"]); ?></td>
														<td><?php echo ($v["member_list_username"]); ?></td>
														<td><?php echo ($v["member_list_petname"]); ?>【<?php echo ($v["member_list_email"]); ?>】</td>
														<td><?php if($v["member_list_petname"] == 1): ?>女<?php else: ?>男<?php endif; ?></td>
														<td><?php echo (date('Y-m-d h:i:s',$v["member_list_addtime"])); ?></td>
														<td>
														<?php if($v[member_list_open] == 1): ?><a class="red" href="javascript:;" onclick="return stateyes(<?php echo ($v["member_list_id"]); ?>);" title="已开启">
														<div id="zt<?php echo ($v["member_list_id"]); ?>"><button class="btn btn-minier btn-yellow">状态开启</button></div>
														</a>
														<?php else: ?>
														<a class="red" href="javascript:;" onclick="return stateyes(<?php echo ($v["member_list_id"]); ?>);" title="已禁用">
														<div id="zt<?php echo ($v["member_list_id"]); ?>"><button class="btn btn-minier btn-danger">状态禁用</button></div>
														</a><?php endif; ?>														</td>
														<td>
								<div class="hidden-sm hidden-xs action-buttons">
									<!--<a class="green" data-toggle="modal" data-target="#myModal" href="javascript:;" onclick="return model_pic(<?php echo ($v["member_list_id"]); ?>);"   title="修改头像">
									<i class="ace-icon fa fa-file-picture-o bigger-130"></i>
									</a>-->
									<a class="green"  href="<?php echo U('member_list_edit',array('member_list_id'=>$v['member_list_id']));?>" title="修改">
										<i class="ace-icon fa fa-pencil bigger-130"></i>
									</a>
									<a class="red" href="javascript:;" onclick="return del(<?php echo ($v["member_list_id"]); ?>,<?php echo I('p',1);?>);" title="删除">
										<i class="ace-icon fa fa-trash-o bigger-130"></i>
									</a>
								</div>
														</td>
													</tr><?php endforeach; endif; ?>  
                                                  <tr>
													  <td height="50" colspan="9" align="left"><?php echo ($page); ?></td>
												  </tr>
												</tbody>
										  </table>
										  
							    		</div>
									</div>
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

					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

<script>
function del(id,p){
	layer.confirm('你确定要删除吗？', {icon: 3}, function(index){
	layer.close(index);
	window.location.href="/index.php/Admin/Member/member_list_del/member_list_id/"+id+"/p/"+p+"";
	});
}

function stateyes(val){
		  $.post('<?php echo U("member_list_state");?>',
		  {x:val},
	function(data){
		if(data.status){
			if(data.info=='状态禁止'){
				var a='<button class="btn btn-minier btn-danger">状态禁用</button>'
				$('#zt'+val).html(a);
				layer.alert(data.info, {icon: 5});
				return false;
			}else{
				var b='<button class="btn btn-minier btn-yellow">状态开启</button>'
				$('#zt'+val).html(b);
				layer.alert(data.info, {icon: 6});
				return false;
			}
		}
	});
	return false;
}


</script>
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



<link href="/Public/shearphoto_common/css/ShearPhoto.css" rel="stylesheet" type="text/css" media="all">
<script  type="text/javascript" src="/Public/shearphoto_common/js/ShearPhoto.js" ></script>
<script  type="text/javascript"  src="/Public/shearphoto_common/js/webcam_ShearPhoto.js" ></script>
<script  type="text/javascript"  src="/Public/shearphoto_common/js/alloyimage.js" ></script>
<script  type="text/javascript"  src="/Public/shearphoto_common/js/handle.js" ></script>
<!-- 显示模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog" style="width:70%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
            <h4 class="modal-title" id="myModalLabel">
               添加会员头像
            </h4>
         </div>
         <div class="modal-body">
            
			
						<div class="row">
							<div class="col-xs-12">
								


<div id="shearphoto_loading">程序加载中......</div><!--这是2.2版本加入的缓冲效果，JS方法加载前显示的等待效果-->
 <div id="shearphoto_main">
<!--效果开始.............如果你不要特效，可以直接删了........-->
<div class="Effects" id="shearphoto_Effects" autocomplete="off">
  <strong class="EffectsStrong">截图效果</strong>
  <a href="javascript:;" StrEvent="原图" class="Aclick"><img src="/Public/shearphoto_common/images/Effects/e0.jpg"/>原图</a>
  <a href="javascript:;" StrEvent="美肤"><img src="/Public/shearphoto_common/images/Effects/e1.jpg"/>美肤效果</a>
  <a href="javascript:;" StrEvent="素描"><img src="/Public/shearphoto_common/images/Effects/e2.jpg"/>素描效果</a>
  <a href="javascript:;" StrEvent="自然增强"><img src="/Public/shearphoto_common/images/Effects/e3.jpg" />自然增强</a>
  <a href="javascript:;" StrEvent="紫调"><img src="/Public/shearphoto_common/images/Effects/e4.jpg" />紫调效果</a>
  <a href="javascript:;" StrEvent="柔焦"><img src="/Public/shearphoto_common/images/Effects/e5.jpg"/>柔焦效果</a>
  <a href="javascript:;" StrEvent="复古"><img src="/Public/shearphoto_common/images/Effects/e6.jpg"/>复古效果</a>
  <a href="javascript:;" StrEvent="黑白"><img src="/Public/shearphoto_common/images/Effects/e7.jpg"/>黑白效果</a>
  <a href="javascript:;" StrEvent="仿lomo"><img src="/Public/shearphoto_common/images/Effects/e8.jpg"/>仿lomo</a>
  <a href="javascript:;" StrEvent="亮白增强"><img src="/Public/shearphoto_common/images/Effects/e9.jpg"/>亮白增强</a>
  <a href="javascript:;" StrEvent="灰白"><img src="/Public/shearphoto_common/images/Effects/e10.jpg"/>灰白效果</a>
  <a href="javascript:;" StrEvent="灰色"><img src="/Public/shearphoto_common/images/Effects/e11.jpg"/>灰色效果</a>
  <a href="javascript:;" StrEvent="暖秋"><img src="/Public/shearphoto_common/images/Effects/e12.jpg"/>暖秋效果</a>
  <a href="javascript:;" StrEvent="木雕"><img src="/Public/shearphoto_common/images/Effects/e13.jpg"/>木雕效果</a>
  <a href="javascript:;" StrEvent="粗糙"><img src="/Public/shearphoto_common/images/Effects/e14.jpg"/>粗糙效果</a>
</div>
<!--效果结束...........................如果你不要特效，可以直接删了.....................................................-->
<!--primary范围开始-->
   <div class="primary"> 
     <!--main范围开始-->
        <div id="main">
           <div class="point">
                </div>
                <!--选择加载图片方式开始-->

                <div id="SelectBox">
                <form id="ShearPhotoForm" enctype="multipart/form-data" method="post"  target="POSTiframe"> 
                <input name="shearphoto" type="hidden" value="123" autocomplete="off">
				 <!--示例传参数到服务端，后端文件UPLOAD.php用$_POST['shearphoto']接收,注意：HTML5切图时，这个参数是不会传的-->
                        <a href="javascript:;" id="selectImage"><input type="file"  name="UpFile" autocomplete="off"/></a>
                 </form>           
                        <a href="javascript:;" id="PhotoLoading"></a>
                        <a href="javascript:;" id="camerasImage"></a>
                </div>
                <!--选择加载图片方式结束--->
                <div id="relat">
                        <div id="black">
                        </div>
                        <div id="movebox">
                                <div id="smallbox">
                                        <img src="shearphoto_common/images/default.gif" class="MoveImg" /><!--截框上的小图-->
                                </div>
                                <!--动态边框开始-->
                                 <i id="borderTop">
                                </i>
                                
                                <i id="borderLeft">
                                </i>
                                
                                <i id="borderRight">
                                </i>
                                
                                <i id="borderBottom">
                                </i>
                                <!--动态边框结束-->
                                <i id="BottomRight">
                                </i>
                                <i id="TopRight">
                                </i>
                                <i id="Bottomleft">
                                </i>
                                <i id="Topleft">
                                </i>
                                <i id="Topmiddle">
                                </i>
                                <i id="leftmiddle">
                                </i>
                                <i id="Rightmiddle">
                                </i>
                                <i id="Bottommiddle">
                                </i>
                        </div>
                        <img src="shearphoto_common/images/default.gif" class="BigImg" /><!--MAIN上的大图-->
                </div>
        </div>
         <!--main范围结束-->  
          <div style="clear: both"></div>
        <!--工具条开始-->
        <div id="Shearbar">
                <a id="LeftRotate" href="javascript:;">
                        <em>
                        </em>
                        向左旋转
                </a>
                <em class="hint L">
                </em>
                <div class="ZoomDist" id="ZoomDist">
                        <div id="Zoomcentre">
                        </div>
                        <div id="ZoomBar"> 
                        </div>
                        <span class="progress">
                        </span>
                </div>
                <em class="hint R">
                </em>
                <a id="RightRotate" href="javascript:;">
                        向右旋转
                        <em>
                        </em>
                </a>
                <p class="Psava">
                        <a id="againIMG"  href="javascript:;">重新选择</a>
                        <a id="saveShear" href="javascript:;">保存截图</a>
                </p>
        </div>
        <!--工具条结束-->
    </div>   
     <!--primary范围结束-->
        <div style="clear: both"></div>
        </div>
<!--shearphoto_main范围结束-->

<!--主功能部份 主功能部份的标签请勿随意删除，除非你对shearphoto的原理了如指掌，否则JS找不到DOM对象，会给你抱出错误-->        
 <!--相册-->
<div id="photoalbum"><!--假如你不要这个相册功能。把相册标签删除了，JS会抱出一个console.log()给你，注意查收，console.log的内容是告诉，某个DOM对象找不到-->
<h1>假如：这是一个相册--------试试点击图片</h1>
<i id="close"></i>
<ul>
<li><img src="shearphoto_common/file/photo/1.jpg" serveUrl="file/photo/1.jpg" /></li>  <!--serveUrl 是对于服务器路径而言，一般不需要改动，如果index.html位置改变时，你只需要改动 src就可以-->
<li><img src="shearphoto_common/file/photo/2.jpg" serveUrl="file/photo/2.jpg" /></li>   <!--serveUrl 是对于服务器路径而言，一般不需要改动，如果index.html位置改变时，你只需要改动 src就可以-->
<li><img src="shearphoto_common/file/photo/3.jpg" serveUrl="file/photo/3.jpg" /></li>  <!--serveUrl 是对于服务器路径而言，一般不需要改动，如果index.html位置改变时，你只需要改动 src就可以-->
<li><img src="shearphoto_common/file/photo/4.jpg" serveUrl="file/photo/4.jpg" /></li> <!--serveUrl 是对于服务器路径而言，一般不需要改动，如果index.html位置改变时，你只需要改动 src就可以-->
<li><img src="shearphoto_common/file/photo/5.jpg" serveUrl="file/photo/5.jpg" /></li> <!--serveUrl 是对于服务器路径而言，一般不需要改动，如果index.html位置改变时，你只需要改动 src就可以-->
<li><img src="shearphoto_common/file/photo/6.jpg" serveUrl="file/photo/6.jpg" /></li> <!--serveUrl 是对于服务器路径而言，一般不需要改动，如果index.html位置改变时，你只需要改动 src就可以-->
<li><img src="shearphoto_common/file/photo/7.jpg" serveUrl="file/photo/7.jpg" /></li> <!--serveUrl 是对于服务器路径而言，一般不需要改动，如果index.html位置改变时，你只需要改动 src就可以-->
<li><img src="shearphoto_common/file/photo/8.jpg" serveUrl="file/photo/8.jpg" /></li><!--serveUrl 是对于服务器路径而言，一般不需要改动，如果index.html位置改变时，你只需要改动 src就可以-->
</ul>
</div>
<!--相册-->
<!--拍照-->
<div id="CamBox">
<p class="lens"></p>
<div id="CamFlash"></div>
<p class="cambar">
<a href="javascript:;" id="CamOk"  >拍照</a>
<a href="javascript:;" id="setCam">设置</a>
<a href="javascript:;" id="camClose">关闭</a>
<span style="clear:both;"></span>
</p>
<div id="timing"></div>
</div>
<!--拍照-->










									
							</div>
						</div>
         </div>

      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
function model_pic(id){
	 $('#userid').val(id);
}

</script>



		</div><!-- /.main-container -->
	</body>
</html>