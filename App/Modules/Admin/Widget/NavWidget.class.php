<?php
class NavWidget extends Action {
	public function bigCate($name='') {
		$category = M('category');
		$info = $category->order('cid')->where('previd = 0')->select();
		return $info;
	}

	public function sonCate($cateArray) {
		$category = M('category');
		$info = $category->order('cid')->where(array('previd'=>$cateArray['cid']))->select();
		return $info;
	}

}