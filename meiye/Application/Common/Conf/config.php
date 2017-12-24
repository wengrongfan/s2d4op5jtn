<?php
return array(
'DB_TYPE'   => 'mysql', // 数据库类型
'DB_HOST'   => '111.230.147.181', // 数据库连接地址
'DB_NAME'   => 'yunxu', // 数据库名
'DB_USER'   => 'yunxiu', // 数据库用户名
'DB_PWD'    => 'yunxiu9527', // 数据库密码
'DB_PORT'   => 3306, // 数据库端口
'DB_PREFIX' => 'mr_', // 数据库前缀 
'DB_CHARSET'=> 'utf8', // 数据库编码
'DB_DEBUG'  =>  TRUE, // 是否开启调试模式
'URL_CASE_INSENSITIVE'  =>  true,
'DB_LIKE_FIELDS'=>'news_title|news_content|news_open',//自动模糊查询字段

		'URL_ROUTER_ON'   => true,
		'URL_ROUTE_RULES'=>array(
				'con/:n_id'=> 'Home/Index/news_content',//路由文章页
				'list/:c_id'=> 'Home/Index/news_list',//路由列表页
		),

//媒体资源类型
'MEDIA_BANNER_TYPE' => 1,
'MEDIA_WEIXIN_TYPE' => 2,

//图片上传
'IMG_UPLOAD_CONFIG' => array('jpeg' , 'jpg' , 'png' , 'gif' , 'bmp'),
'IMG_UPLOAD_PATH' => './Public/uploads/image/',

/*
 * 关闭缓存
 */
'DB_FIELD_CACHE'=>false,
'HTML_CACHE_ON'=>false,
		'SESSION_OPTIONS'         =>  array(
        'name'                =>  '_slcj_video_',                    //设置session名
        'expire'              =>  3600*24*7,                      //SESSION保存7天
        'use_trans_sid'       =>  1,                               //跨页传递
        'use_only_cookies'    =>  0,                               //是否只开启基于cookies的session的会话方式
    ),
);
