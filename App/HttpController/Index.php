<?php

namespace App\HttpController;

use EasySwoole\EasySwoole\Swoole\Task\TaskManager;
use EasySwoole\Component\Timer;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;
use EasySwoole\EasySwoole\Config;

class Index extends Base
{

    function index()
    {
        // TODO: Implement index() method.

        //获取配置项
        //file_put_contents('./aaa.log',Config::getInstance()->getConf('MYSQL.host'));

        $this->response()->write('hello world');
        $conf = new \EasySwoole\Mysqli\Config(\EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL'));
        $db = new \EasySwoole\Mysqli\Mysqli($conf);
        $data = $db->get('users');

        //file_put_contents('./aaa.log',json_encode($data));
        // 异步任务
        /*TaskManager::async(function () {
            file_put_contents('./aaa.log','adsasdad');
            return true;
        });*/
        // 每隔 10 秒执行一次
        /*Timer::getInstance()->loop(10 * 1000, function () {
            file_put_contents('./aaa.log', microtime(true) . PHP_EOL, FILE_APPEND);
        });*/
    }

    function test()
    {
        $this->response()->write('this is test123');
        //return '/test2';//当执行完test方法之后,返回/test2,让框架继续调度/test2方法
    }

    function test2()
    {
        $this->response()->write('this is test2');
        return true;
    }
}