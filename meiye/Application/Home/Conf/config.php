<?php
return array (
'DEFAULT_THEME'=>'Default',
'DB_PAGENUM'=> 10,//每页显示条数
'DB_PAGENUM_5'=> 5,//每页显示条数
'DB_PAGENUM_20'=> 20,//每页显示条数
'DB_PAGENUM_30'=> 30,//每页显示条数
'DB_PAGENUM_40'=> 40,//每页显示条数

'MENU_ABOUT' => 1,
'MENU_NEWS' => 6,
'MENU_SERVICES' => 9,
'MENU_CONTACT' => 13,
'MENU_TEAM' => 14,
'MENU_TRAIN' => 15,

'CONTENT_INTRODUCE' => 2,
'CONTENT_CULTURE' => 3,
'CONTENT_PRODUCER' => 4,
'CONTENT_FACE' => 10,
'CONTENT_BODY' => 11,
'CONTENT_HEALTHY' => 12,
);

return array_merge(include './Conf/config.php', $config);

