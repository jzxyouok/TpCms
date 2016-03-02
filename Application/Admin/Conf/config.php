<?php
return array(
    /* URL设置 */
    'URL_CASE_INSENSITIVE'   => true, // 默true 表示URL不区分大小写 false则表示区分大小写
    'URL_MODEL'              => 1, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_PATHINFO_DEPR'      => '/', // PATHINFO模式下，各参数之间的分割符号
    'URL_PATHINFO_FETCH'     => 'ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL', // 用于兼容判断PATH_INFO 参数的SERVER替代变量列表
    'URL_REQUEST_URI'        => 'REQUEST_URI', // 获取当前页面地址的系统变量 默认为REQUEST_URI
    'URL_HTML_SUFFIX'        => '', // URL伪静态后缀设置
    'URL_DENY_SUFFIX'        => 'ico|png|gif|jpg', // URL禁止访问的后缀设置
    'URL_PARAMS_BIND'        => true, // URL变量绑定到Action方法参数
    'URL_PARAMS_BIND_TYPE'   => 0, // URL变量绑定的类型 0 按变量名绑定 1 按变量顺序绑定
    'URL_PARAMS_FILTER'      => false, // URL变量绑定过滤
    'URL_PARAMS_FILTER_TYPE' => '', // URL变量绑定过滤方法 如果为空 调用DEFAULT_FILTER
    'URL_ROUTER_ON'          => false, // 是否开启URL路由
    'URL_ROUTE_RULES'        => [], // 默认路由规则 针对模块
    'URL_MAP_RULES'          => array(), // URL映射定义规则

    // 布局设置
    'TMPL_ENGINE_TYPE'       => 'Think', // 默认模板引擎 以下设置仅对使用Think模板引擎有效
    'TMPL_CACHFILE_SUFFIX'   => '.php', // 默认模板缓存后缀
    'TMPL_DENY_FUNC_LIST'    => 'echo,exit', // 模板引擎禁用函数
    'TMPL_DENY_PHP'          => false, // 默认模板引擎是否禁用PHP原生代码
    'TMPL_L_DELIM'           => '{', // 模板引擎普通标签开始标记
    'TMPL_R_DELIM'           => '}', // 模板引擎普通标签结束标记
    'TMPL_VAR_IDENTIFY'      => 'array', // 模板变量识别。留空自动判断,参数为'obj'则表示对象
    'TMPL_STRIP_SPACE'       => true, // 是否去除模板文件里面的html空格与换行
    'TMPL_CACHE_ON'          => true, // 是否开启模板编译缓存,设为false则每次都会重新编译
    'TMPL_CACHE_PREFIX'      => '', // 模板缓存前缀标识，可以动态改变
    'TMPL_CACHE_TIME'        => 0, // 模板缓存有效期 0 为永久，(以数字为值，单位:秒)
    'TMPL_LAYOUT_ITEM'       => '{__CONTENT__}', // 布局模板的内容替换标识
    'LAYOUT_ON'              => true, // 是否启用布局
    'LAYOUT_NAME'            => 'layout', // 当前布局名称 默认为layout
);