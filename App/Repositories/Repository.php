<?php


namespace App\Repositories;

use App\Utility\Pool\MysqlPool;
use EasySwoole\Component\Pool\PoolManager;

class Repository
{
    protected $db;

    public function __construct()
    {
        $this->db = MysqlPool::defer();
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        PoolManager::getInstance()->getPool(MysqlPool::class)->recycleObj($this->db);
    }
}