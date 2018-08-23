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

    	$this->assign('list', $list['data']);
    	return $this->fetch('joke');
    }
}
