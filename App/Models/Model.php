<?php
/**
 * 模型基类
 */

namespace App\Models;


abstract class Model
{
    protected $tableName;//表名
    protected $connection;//连接名

    public static function getPool() {
        $db = \EasySwoole\MysqliPool\Mysql::getInstance()->pool('mysql')::defer();
        var_dump($db->rawQuery('select version()'));
        $db = \EasySwoole\MysqliPool\Mysql::defer('mysql');
        var_dump($db->rawQuery('select version()'));
    }
}