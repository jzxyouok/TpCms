<?php
return array(
    //超级管理员配置
    'ADMINISTRATOR_NAME'      => 'admin',
    'ADMINISTRATOR_EMAIL'     => 'admin@qq.com',
    'ADMINISTRATOR_MOBILE'    => '18188888888',
    'ADMINISTRATOR_PASSWORD'  => 'admin123',

    /* URL设置 */
    'URL_CASE_INSENSITIVE'   => true, // 默true 表示URL不区分大小写 false则表示区分大小写
    'URL_MODEL'              => 2, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_HTML_SUFFIX'        => '', // URL伪静态后缀设置

    // 布局设置
    'LAYOUT_ON'              => true, // 是否启用布局
    'LAYOUT_NAME'            => 'layout', // 当前布局名称 默认为layout

    /* 数据库设置 */
    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => 'localhost', // 服务器地址
    'DB_NAME'                => 'tpcms', // 数据库名
    'DB_USER'                => 'root', // 用户名
    'DB_PWD'                 => 'root', // 密码
    'DB_PORT'                => '3306', // 端口
    'DB_PREFIX'              => 'cms_', // 数据库表前缀
    'DB_PARAMS'              => array(), // 数据库连接参数
    'DB_DEBUG'               => true, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'        => false, // 启用字段缓存
    'DB_CHARSET'             => 'utf8', // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'         => 0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'         => false, // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'          => 1, // 读写分离后 主服务器数量
    'DB_SLAVE_NO'            => '', // 指定从服务器序号
    'DB_BIND_PARAM'          => true, //参数自动绑定

    /* 日志设置 */
    'LOG_RECORD'             => true, // 默认不记录日志
    'LOG_TYPE'               => 'File', // 日志记录类型 默认为文件方式
    'LOG_LEVEL'              => 'EMERG,ALERT,CRIT,ERR', // 允许记录的日志级别

    // 显示页面Trace信息
    'SHOW_PAGE_TRACE' => true,

    'TRACE_PAGE_TABS'=>array(
        'base'=>'基本',
        'file'=>'文件',
        'think'=>'流程',
        'error'=>'错误',
        'sql'=>'SQL',
        'debug'=>'调试',
        'user'=>'用户',
    ),

    /* 数据缓存设置 */
    'DATA_CACHE_TIME'        => 0, // 数据缓存有效期 0表示永久缓存
    'DATA_CACHE_PREFIX'      => 'cms_admin', // 缓存前缀
    'DATA_CACHE_TYPE'        => 'File', // 数据缓存类型,支持:File|Db|Apc|Memcache|Shmop|Sqlite|Xcache|Apachenote|Eaccelerator
    'DATA_CACHE_KEY'         => 'cache', // 缓存文件KEY (仅对File方式缓存有效)

    /* 数据备份设置 */
    'DATA_BACKUP_PATH'            => 'Data',       //数据库备份根路径
    'DATA_BACKUP_PART_SIZE'       => 20971520,     //数据库备份卷大小,单位B
    'DATA_BACKUP_COMPRESS'        => 1,            //数据库备份文件是否启用压缩
    'DATA_BACKUP_COMPRESS_LEVEL'  => 9,            //数据库备份文件压缩级别

    // 布局设置
    'TMPL_CACHE_ON'          => false, // 是否开启模板编译缓存,设为false则每次都会重新编译
    'TMPL_CACHE_PREFIX'      => '', // 模板缓存前缀标识，可以动态改变
);