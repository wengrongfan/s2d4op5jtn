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
<style type="text/css">
.scd_m h4 {
    color: #333;
    line-height: 40px;
    text-align: center;
    font-size: 22px;
    margin-bottom: 10px;
}
</style>
<!--幻灯片-->
<div class="banner banner_s">
	<img src="/Public/static/banner_a.jpg" alt=""/>
</div>
<!--幻灯片-->
<div class="space_hx">&nbsp;</div>
    <div class="wrap scd clearfix" style="padding: 0 0 0px;">
        <div class="scd_l">
            <div class="s_top"><span>新闻动态</span></div>
            <?php $menu = isset($menu_tree[6]) ? $menu_tree[6] : ''; ?>
            <?php $choose = ''; ?>
            <ul class="s_nav">
                <?php if(is_array($menu['children'])): foreach($menu['children'] as $key=>$m): ?><li <?php echo isset($menu_id) && $menu_id == $m['id'] ? 'class="active"' : ''; ?>><a href="<?php echo U('menu/menu', array('id' => $m['id']));?>"><i>&nbsp;</i><span><?php echo ($m["name"]); ?></span></a></li>
                    <?php if(isset($menu_id) && $menu_id == $m['id']) $choose = $m['name']; endforeach; endif; ?>
            </ul>
            <div class="space_hx">&nbsp;</div>
        </div>
        <div class="scd_r">
            <div class="r_top">
                <i>&nbsp;</i>
                <span><?php echo $_SESSION['m_name']; ?><em>Introduction</em></span>
                <div class="pst">
                    当前位置：
                    <a href="<?php echo U('index/index');?>">首页</a>-
                    <a href="<?php echo U('menu/menu', array('id' => 1));?>"><?php echo $_SESSION['m_name']; ?></a>
                    <?php if($choose != ''): ?>-<?php echo ($choose); endif; ?>
                </div>
            </div>
            <div class="scd_m about">
                <h4><?php echo ($news["news_title"]); ?></h4>
                <div style="text-indent:2em;">
                    <?php echo (htmlspecialchars_decode($news["news_content"])); ?>
                </div>
                <br/>
                <p style="text-align: center;">发布时间：<?php echo date('Y-m-d H:i', $news['news_time']); ?>,发布者：<?php echo ($news["news_auto"]); ?>,浏览量：<?php echo ($news["news_hits"]); ?></p>
                <br/>
                <ul class="prev_next clearfix">
                    <li><b>上一篇：</b>
                        <?php if(!empty($last)): ?><a href="<?php echo U('Info/view', array('id' => $last['n_id']));?>"><?php echo ($last["news_title"]); ?></a><?php endif; ?>
                        <?php if(empty($last)): ?>暂无内容！<?php endif; ?>
                    </li>
                    <li><b>下一篇：</b>
                        <?php if(!empty($next)): ?><a href="<?php echo U('Info/view', array('id' => $next['n_id']));?>"><?php echo ($next["news_title"]); ?></a><?php endif; ?>
                        <?php if(empty($next)): ?>暂无内容！<?php endif; ?>
                    </li>
                </ul>
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