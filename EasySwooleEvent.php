<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/28
 * Time: 下午6:33
 */

namespace EasySwoole\EasySwoole;


use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\EasySwoole\Config as GConfig;
use App\Process\HotReload;
use App\Process\TestProcess;

use EasySwoole\RedisPool\Config as RedisConfig;
use EasySwoole\RedisPool\Redis;

class EasySwooleEvent implements Event
{

    const INIT_FUNCTION_LIST = [
        'registerProcess' => [],//注册自定义进程
        'loadConf'        => [],// 加载配置
        'initDb'          => [],//初始化数据库配置
    ];

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
    }

    public static function mainServerCreate(EventRegister $register)
    {
        // TODO: Implement mainServerCreate() method.

        // 启动热加载
        $swooleServer = ServerManager::getInstance()->getSwooleServer();
        $swooleServer->addProcess((new HotReload('HotReload', ['disableInotify' => false]))->getProcess());

        //加载初始化函数
        foreach (self::INIT_FUNCTION_LIST as $function => $args) {
            call_user_func_array(['self', $function], $args);
        }
    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }

    /**
     * 注册自定义进程
     */
    private static function registerProcess()
    {
        /**
         * 除了进程名，其余参数非必须
         */
        $processConfig = new \EasySwoole\Component\Process\Config;

        //注册testProcess进程
        /*$processConfig->setProcessName('testProcess');
        ServerManager::getInstance()->getSwooleServer()->addProcess((new TestProcess($processConfig))->getProcess());
        */
    }

    /**
     * 加载配置文件
     * @throws \Exception
     */
    private static function loadConf()
    {
        // 获取Config类实例
        $config = GConfig::getInstance();

        // 遍历目录
        $dir = EASYSWOOLE_ROOT . '/App/Config/';

        //循环加载文件
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $config->loadEnv($dir . $file);
        }
    }

    /**
     * 初始化数据库连接
     * @throws \EasySwoole\Component\Pool\Exception\PoolObjectNumError
     * @throws \EasySwoole\RedisPool\RedisPoolException
     */
    private static function initDb()
    {
        // 加载redis配置
        $configData = GConfig::getInstance()->getConf('REDIS');
        $config     = new RedisConfig($configData);
        $poolConf   = Redis::getInstance()->register('redis', $config);

        $poolConf->setMaxObjectNum($configData['maxObjectNum']);
        $poolConf->setMinObjectNum($configData['minObjectNum']);
    }
}