<?php


namespace App\Processes;

use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\EasySwoole\Logger;
use swoole_process;

class TestProcess extends AbstractProcess
{
    const MAX_PROCESS_NUM = 3;
    private $workers = [];

    public function run($arg)
    {
        /*while(true) {
            Logger::getInstance()->console($this->getProcessName() . " start");
            sleep(2);
            file_put_contents(EASYSWOOLE_ROOT . '/Log/' . __CLASS__ . '.log', microtime(true) . PHP_EOL, FILE_APPEND);
            Logger::getInstance()->console($this->getProcessName() . " run");
        }*/

        //创建子进程
        for ($i = 0; $i <= self::MAX_PROCESS_NUM; $i++) {
            $this->createProcess($i);
        }

        // 发送给子进程消息
        foreach ($this->workers as $pid => $worker) {
            $worker->write('Hi son--'.$pid);
        }

        // 回收子进程
        $this->waitProcess();
    }

    //创建进程
    private function createProcess($index)
    {
        $process = new swoole_process(function (\Swoole\Process $worker) use ($index) {
            $msg = $worker->read();

            file_put_contents(EASYSWOOLE_ROOT.'/Log/'.$index.'.log',$msg);

            $worker->write('Hi Father,I am son '.$msg.',Log is created'.PHP_EOL);
        });

        $pid                 = $process->start();
        $this->workers[$pid] = $process;
    }

    // 回收进程
    private function waitProcess()
    {
        while ($process = swoole_process::wait()) {
            $pid = $process['pid'];

            echo $this->workers[$pid]->read();
        }
    }
}