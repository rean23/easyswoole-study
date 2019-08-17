<?php

namespace App\Commands;

use EasySwoole\EasySwoole\Command\CommandInterface;

class Test implements CommandInterface
{

    public function commandName(): string
    {
        return 'test';
    }

    public function help(array $args): ?string
    {
        return 'help';
    }

    public function exec(array $args): ?string
    {
        //打印参数,打印测试值
        var_dump($args);
        echo 'test' . PHP_EOL;
        return null;
    }
}