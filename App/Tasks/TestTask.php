<?php
/**
 * 测试任务类
 */

namespace App\Tasks;

use EasySwoole\EasySwoole\Swoole\Task\AbstractAsyncTask;

class TestTask extends AbstractAsyncTask
{
    /**
     * 执行任务的内容
     * @param mixed $taskData 任务数据
     * @param int $taskId 执行任务的task编号
     * @param int $fromWorkerId 派发任务的worker进程号
     * @author : evalor <master@evalor.cn>
     */
    function run($taskData, $taskId, $fromWorkerId, $flags = null)
    {
        // 测试任务生成文件
        //file_Put_contents(EASYSWOOLE_ROOT . '/' . $taskId . '.log', microtime(true));
        echo 'this is '.__CLASS__;
        return true;//必须要return true,代表完成
    }

    /**
     * 任务执行完的回调
     * @param mixed $result 任务执行完成返回的结果
     * @param int $task_id 执行任务的task编号
     * @author : evalor <master@evalor.cn>
     */
    function finish($result, $task_id)
    {
        // 任务执行完的处理
    }
}