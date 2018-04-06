<?php
return array(
	//'配置项'=>'配置值'

    'TAG_NESTED_LEVEL' =>5,
    'HOME_PAGE_COUNT' => 10,
    'ADMIN_PAGE_COUNT' => 8,
    'INDEX_MES_COUNT' => 7,

    'APP_GROUP_LIST' => 'Home,Admin',
    'DEFAULT_GROUP' => 'Home',
    'APP_GROUP_MODE' => 1,
    'APP_GROUP_PATH' => 'Modules',

    'IMG_URL_PREFIX' => __ROOT__,


    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'goodtown', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'tp_', // 数据库表前缀

    'DEFAULT_FILTER'        => 'strip_tags,htmlspecialchars'
//    'DB_TYPE'   => 'mysql', // 数据库类型
//    'DB_HOST'   => 'localhost', // 服务器地址
//    'DB_NAME'   => 'xxgcxy', // 数据库名
//    'DB_USER'   => 'xxgcxy', // 用户名
//    'DB_PWD'    => 'x6x8g9c1', // 密码
//    'DB_PORT'   => 3306, // 端口
//    'DB_PREFIX' => 'tp_', // 数据库表前缀
);
?>