<?php

namespace app\admin\model;
use think\Model;

class BaseModel extends Model
{
	/**
	 * 增
	 * @Author   zhibin
	 * @DateTime 2018-11-24
	 * @param    array      $data [description]
	 */
	public function add(array $data)
	{
		if (empty($data) || !is_array($data))  return false;
		$res = $this->insert($data);

		return $res;
	}

	/**
	 * 改
	 * @Author   zhibin
	 * @DateTime 2018-11-24
	 * @param    array      $where [description]
	 * @param    array      $data  [description]
	 * @return   [type]            [description]
	 */
	public function edit(array $where, array $data)
	{
		if (empty($where) || empty($data)) {
			return false;
		}

		$res = $this->where($where)->update($data);

		return $res;
	}

	/**
	 * 查单条
	 * @Author   zhibin
	 * @DateTime 2018-11-24
	 * @param    array      $where [description]
	 * @return   [type]            [description]
	 */
	public function info(array $where)
	{
		$info = $this->where($where)->find();
		if (!empty($info)) {
			// $info = $info->toArray();
		}

		return $info;
	}
}