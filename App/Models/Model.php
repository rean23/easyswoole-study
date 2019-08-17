<?php
/**
 * 模型基类
 */

namespace App\Models;
use EasySwoole\MysqliPool\Mysql;

abstract class Model
{
    protected $tableName;//表名
    protected $connection;//连接名

    public static function getPool() {
        $db = Mysql::getInstance()->pool('mysql')::defer();
        /*var_dump($db->rawQuery('select version()'));
        $db = Mysql::defer('mysql');
        var_dump($db->rawQuery('select version()'));*/

        $data = $db->getOne('users','name');

        var_dump($data);
    }
}