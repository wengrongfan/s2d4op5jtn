<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title><?php echo ($web_info["sys_title"]); ?></title>
<meta name="keywords" content="<?php echo isset($column['column_key']) && ! empty($column['column_key']) ? $column['column_key'] : $web_info['sys_key']; ?>">
<meta name="description" content="<?php echo isset($column['column_des']) && ! empty($column['column_des']) ? $column['column_des'] : $web_info['sys_des']; ?>">
<link rel="stylesheet" type="text/css" href="/Public/assets/css/reset.css"/>
<script type="text/javascript" src="/Public/assets/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/Public/assets/js/js_z.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/assets/css/thems.css">
<link rel="stylesheet" type="text/css" href="/Public/assets/css/responsive.css">
<link rel="stylesheet" type="text/css" href="/Public/assets/css/responsive-other.css">
</head>
<style type="text/css">
	.pages .pagination li { display: inline-block; float:left; margin:0px 0px 0px 5px; }
</style>
<body>

<!--头部-->
<div class="header">
    <div class="head clearfix">
        <div class="logo"><a href=""><img src="/Public/images/logo2.jpg" alt="云绣国际"/></a></div>
        <div class="nav_m">
            <div class="n_icon">导航栏</div>
            <ul class="nav clearfix">
                <li><a href="/">首页</a></li>
                <?php if(count($menu_tree) != 0): if(is_array($menu_tree)): foreach($menu_tree as $key=>$m): ?><li <?php echo isset($_SESSION['m_id']) && $_SESSION['m_id'] == $m['id'] ? 'class="now"' : ''; ?> ><a href="<?php echo U('menu/menu', array('id' => $m['id']));?>"><?php echo ($m["name"]); ?></a></li><?php endforeach; endif; endif; ?>
            </ul>
        </div>
    </div>
</div>
<!--头部-->
<!--幻灯片-->
<div class="banner banner_s">
	<img src="/Public/static/banner_d.jpg" alt=""/>
</div>
<!--幻灯片-->
<div class="space_hx">&nbsp;</div>
<div class="scd_bg">
    <div class="wrap scd clearfix">
        <div class="scd_l">
            <div class="s_top"><span>新闻中心</span></div>
            <?php $menu = isset($menu_tree[C('MENU_NEWS')]) ? $menu_tree[C('MENU_NEWS')] : ''; ?>
            <?php $choose = ''; ?>
            <ul class="s_nav">
                <?php if(is_array($menu['children'])): foreach($menu['children'] as $key=>$m): ?><li <?php echo isset($menu_id) && $menu_id == $m['id'] ? 'class="active"' : ''; ?>><a href="<?php echo U('menu/menu', array('id' => $m['id']));?>"><i>&nbsp;</i><span><?php echo ($m["name"]); ?></span></a></li>
                    <?php if(isset($menu_id) && $menu_id == $m['id']) $choose = $m['name']; endforeach; endif; ?>
            </ul>
            <div class="space_hx">&nbsp;</div>
            <form id="search-form" method="post" action="<?php echo U('Info/list_view');?>">
            <div class="s_search">
                <input name="keyword" type="text" value="请您输入搜索内容" onfocus="if (this.value == '请您输入搜索内容') {this.value = '';this.style.color='#333'}" onblur="if (this.value == '') {this.value = '请您输入搜索内容';this.style.color='#999'}">
                <input type="submit" class="btn" value="">
            </div>
            </form>
        </div>

        <div class="scd_r">
            <div class="r_top">
                <i>&nbsp;</i>
                <span>新闻中心<em>News</em></span>
                <div class="pst">
                    当前位置：
                    <a href="<?php echo U('index/index');?>">首页</a>-
                    <a href="<?php echo U('menu/menu', array('id' => 6));?>"><?php echo $_SESSION['m_name']; ?></a>
                    <?php if($choose != ''): ?>-<?php echo ($choose); endif; ?>
                </div>
            </div>
            <div class="scd_m news">
                <?php if(is_array($news_list)): foreach($news_list as $key=>$v): ?><dl class="clearfix">
                    <dt>
                        <a href="<?php echo U('Info/view', array('id' => $v['n_id']));?>">
                            <img src="/Public/<?php echo empty($v['news_img']) ? 'images/nopic.png' : $v['news_img']; ?>" width="260" height="130" alt=""/>
                        </a>
                    </dt>
                    <dd>
                        <div class="title"><a href="<?php echo U('Info/view', array('id' => $v['n_id']));?>"><b><?php echo ($v["news_title"]); ?></b></a></div>
                        <div class="ctn">
                            <?php if(empty($v['news_scontent'])){ ?>
                                <?php echo (subtext(strip_tags(html_entity_decode($v["news_content"])),180)); ?>
                            <?php }else{ ?>
                                <?php echo (subtext(strip_tags(html_entity_decode($v["news_scontent"])),180)); ?>
                            <?php } ?>
                        </div>
                        <div class="time">
                            [<?php echo isset($id2name[$v['news_columnid']]) ? $id2name[$v['news_columnid']] : '未知'; ?>]
                            <span><?php echo date('Y-m-d H:i', $v['news_time']); ?></span>
                        </div>
                    </dd>
                </dl><?php endforeach; endif; ?>
                <?php if(empty($news_list)): ?>暂无内容！<?php endif; ?>
                <!-- <div class="space_hx">&nbsp;</div> -->
                <div class="pages">
                    <?php echo ($page); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="space_hx">&nbsp;</div>
<div class="bg_a">
	<ul class="f_nav clearfix">
        <li>
        	<div class="name"><b>关于云绣国际</b></div>
            <?php $menu = isset($menu_tree[1]) ? $menu_tree[1] : ''; ?>
            <?php if(is_array($menu['children'])): foreach($menu['children'] as $key=>$m): ?><p><a target="_blank" href="<?php echo U('menu/menu', array('id' => $m['id']));?>"><?php echo ($m["name"]); ?></a></p><?php endforeach; endif; ?>
        </li>
        <li class="f_ct">
        	<div class="name"><b>联系方式</b></div>
            <p>
            	<a href="mailto:<?php echo ($web_info["mail"]); ?>">
                	<img src="/Public/images/icon6.png" alt=""/>
                    <span>邮箱:<?php echo ($web_info["mail"]); ?></span>
                </a>
            </p>
            <p>
                <a href="tel:<?php echo ($web_info["phone"]); ?>">
                    <img src="/Public/images/icon5.png" alt=""/>
                    <span>坐机:<?php echo ($web_info["phone"]); ?></span>
                </a>
            </p>
            <p>
            	<a href="tel:<?php echo ($web_info["mobile"]); ?>">
                	<img src="/Public/images/icon5.png" alt=""/>
                    <span>电话:<?php echo ($web_info["mobile"]); ?></span>
                </a>
            </p>
        </li>
        <li class="dz">
        	<div class="name"><b>我们的位置</b></div>
            <p><?php echo ($web_info["sys_name"]); ?><br/>
            Guangzhou Cloud show international beauty Co. Ltd.</p>
			<p><?php echo ($web_info["address"]); ?></p>
        </li>
        <?php if(isset($winxin_code) && $winxin_code != ''){ ?>
        <li class="f_ct" style="padding-right: 0px;margin-right: 0px;padding-left: 20px;">
            <div class="name" align="right"><b>“云绣国际”</b></div>
            <div align="right">
                <img src="/Public<?php echo ($winxin_code); ?>" width="100px" height="100px" alt=""/>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>
<div class="f_bg">
	<div class="bq clearfix">
    	<div class="bq_l">
        	<?php echo ($web_info["sys_title"]); ?>
        </div>
        <div class="bq_r">2012-<?php echo date('Y'); ?>©版权所有“云绣国际”</div>
    </div>
</div>
</body>
</html>