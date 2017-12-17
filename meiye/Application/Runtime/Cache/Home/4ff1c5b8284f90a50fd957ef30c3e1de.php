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

<script type="text/javascript" src="/Public/assets/js/banner.js"></script>
<script language="javascript">
$(function(){
	$('#owl-demo').owlCarousel({
		items: 1,
		navigation: true,
		navigationText: ["上一个","下一个"],
		autoPlay: true,
		stopOnHover: true
	}).hover(function(){
		$('.owl-buttons').show();
	}, function(){
		$('.owl-buttons').hide();
	});
});
</script>

<!--幻灯片-->
<div id="banner" class="banner"> 
    <div id="owl-demo" class="owl-carousel"> 
        <?php if(is_array($banner_list)): foreach($banner_list as $key=>$b): ?><a class="item" target="_blank" href="<?php echo ($b["url_target"]); ?>" style="background-image:url(/Public<?php echo ($b["url_pic"]); ?>)">
            <img src="/Public<?php echo ($b["url_pic"]); ?>" style="max-height: 400px;" alt="">
        </a><?php endforeach; endif; ?>
    </div>
</div>
<!--幻灯片-->
<!--contian-->
<div class="index_wrap index_wrap_a clearfix">
    <div class="index_i_about">
        <h1><a href=""><em>云绣</em> 国际美容有限公司</a></h1>
        <dl class="clearfix">
            <dt><a href=""><img src="/Public/static/pic_1.jpg" alt=""/></a></dt>
            <dd style="text-indent: 2em;">
            <?php echo isset($about['column_content']) ? $about['column_content'] : '暂无内容！'; ?>
            </dd>
        </dl>
    </div>
    <div class="index_i_news">
        <div class="top">
            <em>&nbsp;</em>新闻动态
            <a href="<?php echo U('menu/menu', array('id' => C('MENU_NEWS')));?>">更多新闻</a>
        </div>
        <div class="i_m">
            <div id="scrollbar1">
                <div class="">
                    <div class="content">
                        <ul>
                            <?php if(is_array($news_list)): foreach($news_list as $key=>$v): ?><li>
                                <div class="time"><?php echo date('Y-d-m H:i', $v['news_time']); ?></div>
                                <div class="title">
                                    <a href=""><?php echo ! empty($v['news_titleshort']) ? subtext($v['news_titleshort'], 35) : subtext($v['news_title'], 35); ?></a>
                                </div>
                            </li><?php endforeach; endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--contian-->
<div class="space_hx">&nbsp;</div>
<!-- <div class="i_line"><em>&nbsp;</em></div>
 --><div class="space_hx">&nbsp;</div>
<div style="background:#f1f1f1">
        <div class="case_com">

            <div class="index_top">
                <span>云绣国际</span>
                <i>YUNXIU PERFORMANCE</i> 
                <em></em>
            </div>
        </div>
    <ul class="i_ma clearfix" style="background">
        <li>
            <a href="<?php echo U('Info/index', array('id' => C('CONTENT_PRODUCER')));?>">
                <img src="/Public/static/pic1.jpg" alt=""/>
            </a>
            <div class="title">
                <a href="<?php echo U('Info/index', array('id' => C('CONTENT_PRODUCER')));?>"><em>01.</em><?php echo $producer['column_name']; ?></a>
            </div>
            <div class="des"><?php echo isset($producer['column_content']) ? mb_substr($producer['column_content'],0,40,'utf-8'): '暂无内容！'; ?>....</div>
            <!--以传播美丽之道为目标，是一家以美容护肤保养品与美容院为主，集研发、生产一体的企业。 旗下已形成三大疗程多个系列的成熟护肤体系，秉持以“医学为本、美容为用”的多元化专业护肤理念，产品以其亲肤、护肤、活肤的显著功效成为护肤品中的佼佼者。...... -->
            <div class="more"><a href="<?php echo U('Info/index', array('id' => C('CONTENT_PRODUCER')));?>">MORE</a></div>
        </li>
        <li>
            <a href="<?php echo U('Info/index', array('id' => C('CONTENT_CULTURE')));?>">
                <img src="/Public/static/pic2.jpg" alt=""/>
            </a>
            <div class="title">
                <a href="<?php echo U('Info/index', array('id' => C('CONTENT_CULTURE')));?>"><em>02.</em><?php echo $culture['column_name']; ?></a>
            </div>
            <div class="des"><?php echo isset($culture['column_content']) ? mb_substr($culture['column_content'],0,40,'utf-8'): '暂无内容！'; ?>....</div>
            <div class="more"><a href="<?php echo U('Info/index', array('id' => C('CONTENT_CULTURE')));?>">MORE</a></div>
        </li>
        <li>
            <a href="<?php echo U('Info/index', array('id' => C('CONTENT_INTRODUCE')));?>">
                <img src="/Public/static/pic3.jpg" alt=""/>
            </a>
            <div class="title">
                <a href="<?php echo U('Info/index', array('id' => C('CONTENT_INTRODUCE')));?>"><em>03.</em><?php echo $about['column_name']; ?></a>
            </div>
            <div class="des"><?php echo isset($about['column_content']) ? mb_substr($about['column_content'],0,40,'utf-8'): '暂无内容！'; ?>.....</div>
            <div class="more"><a href="<?php echo U('Info/index', array('id' => C('CONTENT_INTRODUCE')));?>">MORE</a></div>
        </li>
        <li>
            <a href="<?php echo U('Info/index', array('id' => C('CONTENT_HEALTHY')));?>">
                <img src="/Public/static/pic4.jpg" alt=""/>
            </a>
            <div class="title">
                <a href="<?php echo U('Info/index', array('id' => C('CONTENT_HEALTHY')));?>"><em>04.</em><?php echo $healthy['column_name']; ?></a>
            </div>
            <div class="des"><?php echo isset($healthy['column_content']) ? mb_substr($healthy['column_content'],0,40,'utf-8'): '暂无内容！'; ?>.....</div>
            <div class="more"><a href="<?php echo U('Info/index', array('id' => C('CONTENT_HEALTHY')));?>">MORE</a></div>
        </li>
    </ul>
</div>
<!--产品介绍-->
<div class="new_home clearfix">
        <span class="title_line clearfix"> 产品中心</span>
        <div class="left_new clearfix">
            <div class="pic">
                <a href="<?php echo U('Info/index', array('id' => C('CONTENT_HEALTHY')));?>">
                    <img src="/Public/static/about1.jpg" alt="" class="vcenter"/>
                <i></i></a>
            </div>
            <div class="text">
                <h4><?php echo $healthy['column_name']; ?></h4>
                <p><?php echo isset($healthy['column_content']) ? mb_substr($healthy['column_content'],0,80,'utf-8'): '暂无内容！'; ?></p>
                <a href="<?php echo U('Info/index', array('id' => C('CONTENT_HEALTHY')));?>">查看详细 >></a>
            </div>
        </div>
        <ul  class="right_new">
            <li>
                <a href="<?php echo U('Info/index', array('id' => C('CONTENT_FACE')));?>">
                    <div class="pic"><img src="/Public/static/news1.jpg" alt="" class="vcenter"/><i></i></div>
                    <div class="text">
                        <h4><?php echo $face['column_name']; ?></h4>
                        <time>[201610-08]</time>
                        <p>
                            <?php echo isset($face['column_content']) ? mb_substr($face['column_content'],0,150,'utf-8'): '暂无内容！'; ?>
                        </p>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Info/index', array('id' => C('CONTENT_BODY')));?>">
                    <div class="pic"><img src="/Public/static/news2.jpg" alt="" class="vcenter"/><i></i></div>
                    <div class="text">
                        <h4><?php echo $body['column_name']; ?></h4>
                        <time>[201610-08]</time>
                        <p>
                            <?php echo isset($body['column_content']) ? mb_substr($body['column_content'],0,150,'utf-8'): '暂无内容！'; ?>
                        </p>
                    </div>
                </a>
            </li>
        </ul>
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