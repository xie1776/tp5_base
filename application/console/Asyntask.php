<?php

namespace app\console;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\admin\model\User;

/**
 * 异步任务
 */
class Asyntask extends Command
{
    protected $server;

    protected function configure()
    {
       $this->setName('Asyntask:start')->setDescription('Start Web Socket Server!');
    }

    protected function execute(Input $input, Output $output)
    {
        $serv = new \swoole_server('0.0.0.0',9201);

        $serv->set(array('task_worker_num' => 4));

        $serv->on('connect', function ($serv, $fd){
            echo $fd."客户端已经连接进来了.\n";
        });
        $serv->on('receive', function($serv, $fd, $from_id, $data) {
            $task_id = $serv->task($data);
            echo "开始投递异步任务 id=$task_id\n";
        });

        $serv->on('task', function ($serv, $task_id, $from_id, $data) {
            echo "接收异步任务[id=$task_id]".PHP_EOL;
            $arr = json_decode($data, true);
            switch ($arr['task_name']) {
                case 'useradd': //异步写入用户数据
                    $User = new User();
                    $User->insertUser($arr['data']);
                    break;
                case 'export':
                default:
                    $User = new User();
                    $User->exportlist();
                    break;
            }
            $serv->finish($data);
        });

        $serv->on('finish', function ($serv, $task_id, $data) {
            echo "异步任务[id=$task_id]完成".PHP_EOL;
        });
        $serv->start();
    }
}