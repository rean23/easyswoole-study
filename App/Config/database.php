<?php
return [
    'MYSQL' => [
//数据库配置
        'host'                 => '192.168.10.199',//数据库连接ip
        'user'                 => '',//数据库用户名
        'password'             => '',//数据库密码
        'database'             => '',//数据库
        'port'                 => '',//端口
        'timeout'              => '30',//超时时间
        'connect_timeout'      => '5',//连接超时时间
        'charset'              => 'utf8',//字符编码
        'strict_type'          => false, //开启严格模式，返回的字段将自动转为数字类型
        'fetch_mode'           => false,//开启fetch模式, 可与pdo一样使用fetch/fetchAll逐行或获取全部结果集(4.0版本以上)
        'alias'                => '',//子查询别名
        'isSubQuery'           => false,//是否为子查询
        'max_reconnect_times ' => '3',//最大重连次数
    ],
];