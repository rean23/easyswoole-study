<?php


namespace App\Task;

use EasySwoole\Task\AbstractInterface\TaskInterface;

class TestTask implements TaskInterface
{
    function run(int $taskId, int $workerIndex)
    {
        TaskManager::async(function () {
            file_Put_contents(EASYSWOOLE_ROOT . '/aaa.log', microtime(true));
        });

    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        echo $throwable->getMessage();
    }
}