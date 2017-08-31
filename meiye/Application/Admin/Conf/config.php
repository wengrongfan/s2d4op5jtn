<?php
return array (
	'LOAD_EXT_CONFIG' => 'sdk_config',//扩展第三方登录配置文件
	'DB_PAGENUM'=> 10,//后台每页显示条数
	'DB_PAGENUM_20'=> 20,//后台每页显示条数
	'DB_PAGENUM_30'=> 30,//后台每页显示条数
	'DB_PAGENUM_40'=> 40,//后台每页显示条数
	
	/*
	 * 返回参数类型，用于判断返回值
	 */
	'CUE_0'=>0,
	'CUE_1'=>1,
	'CUE_2'=>2,
	'CUE_3'=>3,

	'DB_PATH_NAME'=> 'Data',        //备份目录名称,主要是为了创建备份目录
	'DB_PATH'     => './Public/Data/',     //数据库备份路径必须以 / 结尾；
	'DB_PART'     => '20971520',  //该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M
	'DB_COMPRESS' => '1',         //压缩备份文件需要PHP环境支持gzopen,gzwrite函数        0:不压缩 1:启用压缩
	'DB_LEVEL'    => '9',         //压缩级别   1:普通   4:一般   9:最高
	
	'MAIL_CHARSET' =>'utf-8',//设置邮件编码
	'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件
		
	'AUTH_CONFIG' => array(
	'AUTH_ON' => true, //是否开启权限
	'AUTH_TYPE' => 1, // 
	'AUTH_GROUP' => 'mr_auth_group', //用户组
	'AUTH_GROUP_ACCESS' => 'mr_auth_group_access', //用户组规则
	'AUTH_RULE' => 'mr_auth_rule', //规则中间表
	'AUTH_USER' => 'mr_admin'// 管理员表
		
		
		),
		
		'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
		'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
		'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
		'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true
);

return array_merge(include './Conf/config.php', $config);
?>
