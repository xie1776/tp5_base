<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class UserModel extends Model
{
	/**
	 * 添加新的用户
	 * @Author zhibin
	 * @Date   2018-11-05
	 * @param  string     $username [description]
	 * @param  string     $passwd   [description]
	 * @return [type]               [description]
	 */
	public function insertUser(array $data=[])
	{
		if (empty($data)) {
			return false;
		}

		$suffix = config('passwd_suffix');
		$data['passwd'] = md5($data['passwd'].$suffix);
		$data['add_time'] = time();

		return Db::name('user')->insert($data);
	}

	/**
	 * 数据导出
	 * @Author zhibin
	 * @Date   2018-11-05
	 * @param  array      $map [description]
	 * @return [type]          [description]
	 */
	public function exportlist(array $map=[])
	{
		$list = Db::name('user')->field('id,username,email,add_time')->where($map)->select();
		if (empty($list)) {
			return false;
		}
		foreach ($list as $key => &$val) {
			$val['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
		}

		export('userlist', ['ID', '用户', '邮箱', '时间'], $list);
	}
}