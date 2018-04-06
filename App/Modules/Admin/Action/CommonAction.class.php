<?php
class CommonAction extends Action {
	public function __construct() {
		parent::__construct();
		if(!session('outer_id')) {
			$this->error('请先登录系统',U('Admin/index'),1);
		}
	}
}
