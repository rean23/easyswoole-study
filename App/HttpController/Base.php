<?php


namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\EasySwoole\Config;
use EasySwoole\RedisPool\Redis;

class Base extends Controller
{
    protected $config;
    protected $redis = null;

    public function index()
    {

    }

    /**
     * 获取redis连接池
     * @return mixed|null
     * @throws \Throwable
     */
    protected function getRedisPool()
    {
        if (is_null($this->redis)) {
            $this->redis = Redis::getInstance()->pool('redis')->getObj();
        }

        return $this->redis;
    }

    /**
     * 获取配置信息
     * @param string $key
     * @return array|mixed|null
     */
    protected function getConfig($key = '')
    {
        $instance = Config::getInstance();

        // 获取全部配置
        return $instance->getConf($key);
    }
}