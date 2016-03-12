<?php
return array(
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
    'DB_PWD'                 => '', // 密码
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
    'SHOW_PAGE_TRACE' =>true,

    'TRACE_PAGE_TABS'=>array(
        'base'=>'基本',
        'file'=>'文件',
        'think'=>'流程',
        'error'=>'错误',
        'sql'=>'SQL',
        'debug'=>'调试',
        'user'=>'用户',
    )
);