<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>云秀国际</title>
<link rel="stylesheet" type="text/css" href="/Public/assets/css/reset.css"/>
<script type="text/javascript" src="/Public/assets/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/Public/assets/js/js_z.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/assets/css/thems.css">
<link rel="stylesheet" type="text/css" href="/Public/assets/css/responsive.css">
<link rel="stylesheet" type="text/css" href="/Public/assets/css/responsive-other.css">
</head>

<body>

<!--头部-->
<div class="header">
    <div class="head clearfix">
        <div class="logo"><a href=""><img src="/Public/images/logo2.jpg" alt="云秀国际"/></a></div>
        <div class="nav_m">
            <div class="n_icon">导航栏</div>
            <ul class="nav clearfix">
                <li><a href="/">首页</a></li>
                <li><a href="<?php echo U('index/about');?>">关于云秀</a></li>
                <li><a href="<?php echo U('index/team');?>">云秀团队</a></li>
                <li class="now"><a href="<?php echo U('index/news');?>">新闻动态</a></li>
                <li><a href="<?php echo U('index/service');?>">云秀服务</a></li>
                <li><a href="<?php echo U('index/contact');?>">联系我们</a></li>
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
        <a class="item" target="_blank" href="" style="background-image:url(/Public/static/banner10.png)">
            <img src="/Public/static/banner10.png" alt="">
        </a>
        <a class="item" target="_blank" href="" style="background-image:url(/Public/static/banner.jpg)">
            <img src="/Public/static/banner.jpg" alt="">
        </a>
        <a class="item" target="_blank" href="" style="background-image:url(/Public/static/banner.jpg)">
            <img src="/Public/static/banner.jpg" alt="">
        </a>
    </div>
</div>
<!--幻灯片-->
<!--contian-->
<div class="index_wrap index_wrap_a clearfix">
    <div class="index_i_about">
        <h1><a href=""><em>云秀</em> 国际美容有限公司</a></h1>
        <dl class="clearfix">
            <dt><a href=""><img src="/Public/static/pic_1.jpg" alt=""/></a></dt>
            <dd>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;美容品牌作为质集团核心品牌和高科技美容的引领者，定位于亚健康调理专家，是国际芳疗SPA与中医养生领导品牌。在岁月的沉淀和洗礼中，从诞生之日起就以“让名媛淑女体验真正芳疗的力量”为品牌使命，致力于为爱美女士打造一个身心灵合一的美肤芳疗SPA平台，这一高端、高贵、高水准的“三高”差异化定位，领航美容院走出红海、开辟美容蓝海，领航美容院走出红海、开辟美容蓝海。</p>
                <p>美容品牌作为质集团核心品牌和高科技美容的引领者，定位于亚健康调理专家，是国际芳疗SPA与中医养生领导品牌。在岁月的沉淀和洗礼中，从诞生之日起就以“让名媛淑女体验真正芳疗的力量”为品牌使命</p>
                <p>美容品牌作为质集团核心品牌和高科技美容的引领者，定位于亚健康调理专家，是国际芳疗SPA与中医养生领导品牌。在岁月的沉淀和洗礼中，从诞生之日起就以“让名媛淑女体验真正芳疗的力量”为品牌使命。</p>
            </dd>
        </dl>
    </div>
    <div class="index_i_news">
        <div class="top">
            <em>&nbsp;</em>新闻动态
            <a href="">更多新闻</a>
        </div>
        <div class="i_m">
            <div id="scrollbar1">
                <div class="">
                    <div class="content">
                        <ul>
                            <li>
                                <div class="time">2016-05-13</div>
                                <div class="title">
                                    <a href="">云秀获得广州天河区百强企业荣誉称号</a>
                                </div>
                            </li>
                            <li>
                                <div class="time">2016-05-13</div>
                                <div class="title">
                                    <a href="">云秀将为美容美业贡献力量，致力于为爱美女士..</a>
                                </div>
                            </li>
                            <li>
                                <div class="time">2016-05-13</div>
                                <div class="title">
                                    <a href="">云秀将亮相在"广州会展中心"举办的"国际美容展"。</a>
                                </div>
                            </li>
                            <li>
                                <div class="time">2016-05-13</div>
                                <div class="title">
                                    <a href="">云秀将为美容美业贡献力量。</a>
                                </div>
                            </li>
                            <li>
                                <div class="time">2016-05-13</div>
                                <div class="title">
                                    <a href="">云秀将为美容美业贡献力量。</a>
                                </div>
                            </li>
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
                <span>云秀国际</span>
                <i>YUNXIU PERFORMANCE</i> 
                <em></em>
            </div>
        </div>
    <ul class="i_ma clearfix" style="background">
        <li>
            <a href="">
                <img src="/Public/static/pic1.jpg" alt=""/>
            </a>
            <div class="title">
                <a href=""><em>01.</em>xxxx</a>
            </div>
            <div class="des">以传播美丽之道为目标，是一家以美容护肤保养品与美容院为主，集研发、生产一体的企业。</div>
            <!-- 旗下已形成三大疗程多个系列的成熟护肤体系，秉持以“医学为本、美容为用”的多元化专业护肤理念，产品以其亲肤、护肤、活肤的显著功效成为护肤品中的佼佼者。...... -->
            <div class="more"><a href="">MORE</a></div>
        </li>
        <li>
            <a href="">
                <img src="/Public/static/pic2.jpg" alt=""/>
            </a>
            <div class="title">
                <a href=""><em>02.</em>企业文化</a>
            </div>
            <div class="des">以传播美丽之道为目标，是一家以美容护肤保养品与美容院为主，集研发、生产一体的企业。......</div>
            <div class="more"><a href="">MORE</a></div>
        </li>
        <li>
            <a href="">
                <img src="/Public/static/pic3.jpg" alt=""/>
            </a>
            <div class="title">
                <a href=""><em>03.</em>工作方案</a>
            </div>
            <div class="des">以传播美丽之道为目标，是一家以美容护肤保养品与美容院为主，集研发、生产一体的企业。......</div>
            <div class="more"><a href="">MORE</a></div>
        </li>
        <li>
            <a href="">
                <img src="/Public/static/pic4.jpg" alt=""/>
            </a>
            <div class="title">
                <a href=""><em>04.</em>产品中心</a>
            </div>
            <div class="des">以传播美丽之道为目标，是一家以美容护肤保养品与美容院为主，集研发、生产一体的企业。......</div>
            <div class="more"><a href="">MORE</a></div>
        </li>
    </ul>
</div>
<!--产品介绍-->
<div class="new_home clearfix">
        <span class="title_line clearfix"> 产品中心</span>
        <div class="left_new clearfix">
            <div class="pic">
                <a href="about.html">
                    <img src="/Public/static/about1.jpg" alt="" class="vcenter"/>
                <i></i></a>
            </div>
            <div class="text">
                <h4>上海唯星信息科技有限公司</h4>
                <p>唯星成立于2005年，秉承"整合数字资源,技术驱动营销"的理念为传统企业互联网商业转型各个阶段提供全方位应用支撑。经过10余年的快速发展，唯星深刻理解...……</p>
                <a href="about.html">查看详细 >></a>
            </div>
        </div>
        <ul  class="right_new">
            <li>
                <a href="news.html">
                    <div class="pic"><img src="/Public/static/news1.jpg" alt="" class="vcenter"/><i></i></div>
                    <div class="text">
                        <h4>SaaS级智能营销云平台</h4>
                        <time>[201610-08]</time>
                        <p>
                            SaaS级智能营销云平台的核心模块是唯星大数据精准营销平台.....
                        </p>
                    </div>
                </a>
            </li>
            <li>
                <a href="news.html">
                    <div class="pic"><img src="/Public/static/news2.jpg" alt="" class="vcenter"/><i></i></div>
                    <div class="text">
                        <h4>SaaS级智能营销云平台</h4>
                        <time>[201610-08]</time>
                        <p>
                            SaaS级智能营销云平台的核心模块是唯星大数据精准营销平台.....
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
        	<div class="name"><b>关于云秀国际</b></div>
            <p><a href="">了解我们</a></p>
            <p><a href="">加入我们</a></p>
            <p><a href="">联系我们</a></p>
        </li>
        <li class="f_ct">
        	<div class="name"><b>联系方式</b></div>
            <p>
            	<a href="mailto:1023102176@qq.com">
                	<img src="/Public/images/icon6.png" alt=""/>
                    <span>邮箱:1023102176@qq.com</span>
                </a>
            </p>
            <p>
                <a href="tel:020-8888888">
                    <img src="/Public/images/icon5.png" alt=""/>
                    <span>坐机:020-8888888</span>
                </a>
            </p>
            <p>
            	<a href="tel:1881946576">
                	<img src="/Public/images/icon5.png" alt=""/>
                    <span>电话:1881946576</span>
                </a>
            </p>
        </li>
        <li class="dz">
        	<div class="name"><b>我们的位置</b></div>
            <p>广州市云秀国际有限公司<br/>
xxxxxx xxxx Co. Ltd.</p>
			<p>xxxxxxxxxxxxxxxxxxx</p>
        </li>
        <li class="f_ct" style="padding-right: 0px;margin-right: 0px;padding-left: 20px;">
            <div class="name" align="right"><b>“云秀国际”</b></div>
            <div align="right">
                <img src="/Public/images/erwei.png" width="100px" height="100px" alt=""/>
            </div>
        </li>
    </ul>
</div>
<div class="f_bg">
	<div class="bq clearfix">
    	<div class="bq_l">
        	广州市云秀国际有限公司
        </div>
        <div class="bq_r">2012-2017©版权所有“云秀国际”</div>
    </div>
</div>
</body>
</html>