<?php

namespace app\index\model;
use think\Model;
use think\Db;

class JokeModel extends Model
{
	protected $name = 'joke';
	/**
	 * 查询文字列表
	 * @Author zhibin
	 * @Date   2018-08-23
	 * @param  array      $map   [description]
	 * @param  integer    $limit [description]
	 * @return [type]            [description]
	 */
	public function getList(array $map=[], $limit=10)
	{
		// $map['type'] = 1;
		$field = 'id,title,img,content,add_time';
		$model = Db::name('joke');
		$list = $model->field($field)->where($map)->order('id desc')->paginate($limit);
		$page = $list->render();
		if ($list) {
			$list = json_decode(json_encode($list), true);
			foreach ($list['data'] as &$val) {
				$val['add_time'] = date('Y年m月d日', $val['add_time']);
			}
		}

		$list['page'] = $page;
		// pre($list);die;
		return $list;
	}
}