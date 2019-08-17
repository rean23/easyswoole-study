<?php

namespace App\HttpController;

use EasySwoole\Component\Timer;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;
use EasySwoole\EasySwoole\Config;
use EasySwoole\EasySwoole\Swoole\Task\TaskManager;

use App\Tasks\TestTask;
use App\Models\Model;

class Index extends Base
{

    function task()
    {
        // TODO: Implement index() method.

        //获取配置项
        //file_put_contents('./aaa.log',Config::getInstance()->getConf('MYSQL.host'));

        /*$this->response()->write('hello world');
        $conf = new \EasySwoole\Mysqli\Config(\EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL'));
        $db = new \EasySwoole\Mysqli\Mysqli($conf);
        $data = $db->get('users');*/

        //file_put_contents('./aaa.log',json_encode($data));
        // 异步任务
        //TaskManager::async(\App\Tasks\TestTask::class);
        /*$redis = \App\Utility\Pool\RedisPool::defer();
        $redis->set('name','hanyu');
        var_dump($redis->get('name'));*/
        //(new \App\Repositories\UserRepository)->test();
        // 实例化任务模板类 并将数据带进去 可以在任务类$taskData参数拿到数据
        $this->response()->withHeader('Content-type', 'text/html;charset=utf-8');

        /*$taskClass = new TestTask();
        \EasySwoole\EasySwoole\Swoole\Task\TaskManager::async($taskClass);
        $this->response()->write('执行模板异步任务成功');*/
        /*TaskManager::async(function () {
            file_put_contents('./aaa.log',microtime(true));
        });*/

        // 每隔 10 秒执行一次
        /*Timer::getInstance()->loop(10 * 1000, function () {
            file_put_contents('./aaa.log', microtime(true) . PHP_EOL, FILE_APPEND);
        });*/
    }

    function test()
    {
        $redis = $this->getRedisPool();

        $redis->set('name', 'Rean');
        $this->response()->withHeader('Content-type', 'text/html;charset=utf-8');
        $this->response()->write($redis->get('name'));

        //$this->response()->write('this is test123');
        //return '/test2';//当执行完test方法之后,返回/test2,让框架继续调度/test2方法
    }

    function test2()
    {
        $this->response()->write('this is test2');
        return true;
    }
}