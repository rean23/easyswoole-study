<?php


namespace App\Process;

use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\EasySwoole\Logger;

class TestProcess extends AbstractProcess
{
    public function run($arg)
    {
        while(true) {
            Logger::getInstance()->console($this->getProcessName() . " start");
            sleep(2);
            file_put_contents(EASYSWOOLE_ROOT . '/Log/' . __CLASS__ . '.log', microtime(true) . PHP_EOL, FILE_APPEND);
            Logger::getInstance()->console($this->getProcessName() . " run");
        }
    }
}