<?php

namespace app\index\controller;
use app\index\model\JokeModel;

class Index extends Base
{	
	/**
	 * 首页
	 * @Author zhibin
	 * @Date   2018-08-23
	 * @return [type]     [description]
	 */
    public function index()
    {	
    	$JokeModel = new JokeModel();
    	$list = $JokeModel->getList();

        // pre($list);die;
    	$this->assign('list', $list['data']);
        $this->assign('page', $list['page']);
    	return $this->fetch('joke');
    }

    /**
     * 测试异步任务
     * @Author zhibin
     * @Date   2018-11-05
     * @return [type]     [description]
     */
    public function add()
    {
        $client = new \swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC);
        $ret = $client->connect("192.168.33.10", 9201);
        if(empty($ret)){
            echo 'error!connect to swoole_server failed';
        } else {
            // $data = ['task_name'=>'export', 'file'=>'1.log', 'data'=>"导出数据\n"];
            $user = [
                'username' => 'wosshui20045',
                'passwd' => 'admin',
                'email' => 'zhibin3@qq.com',
            ];
            $data = ['task_name'=>'useradd', 'data'=>$user];
            $data = json_encode($data);
            $client->send($data);
        }
    }

    /**
     * 导出
     * @Author zhibin
     * @Date   2018-11-05
     * @return [type]     [description]
     */
    public function export()
    {
        $client = new \swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC);
        $ret = $client->connect("192.168.33.10", 9201);
        if(empty($ret)){
            echo 'error!connect to swoole_server failed';
        } else {
            $data = [];
            $str = ['task_name'=>'export', 'data'=>$data];
            $client->send(json_encode($str));
        }
    }
}
