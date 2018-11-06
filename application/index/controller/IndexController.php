<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class IndexController extends Controller
{
    public function index()
    {
    	return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
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
            	'username' => 'wosshui2004',
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
