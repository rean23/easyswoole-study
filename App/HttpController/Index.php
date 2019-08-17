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

        //file_put_contents('./aaa.log',json_encode($data));
        // 实例化任务模板类 并将数据带进去 可以在任务类$taskData参数拿到数据
        //$this->response()->withHeader('Content-type', 'text/html;charset=utf-8');

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
}