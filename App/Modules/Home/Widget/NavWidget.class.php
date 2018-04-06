<?php
class NavWidget extends Action {
	/* 首页nav 部分 */
	public function getBigCate($name='') {
		$category = M('category');
		$cateinfo = $category->order('cid')->where("previd = 0 and name != '通知公告'")->select();
		$cateinfo = array_reverse($cateinfo);
		return $cateinfo;
	}
    public function getBigCate2($name='') {
        $category = M('category');
        $cateinfo = $category->order('cid')->where("previd = 0 and name != '通知公告'")->select();
        return $cateinfo;
    }
	public function getSmallCate($info) {
		$category = M('category');
		$cateinfo = $category->order('cid')->where('previd = %d',$info['cid'])->select();
		return $cateinfo;
	}

	/* 左侧nav部分 */
    public function leftNav($cid) {
        $category = new CategoryModel();

        /*左侧nav_top*/
        $info = $category->getCateInfoByCid($cid);
        $this->assign('info', $info);

        $allPrev = $category->getAllPrevCates($cid);
        $allPrev = array_pop($allPrev);
        $this->assign('allPrev', $allPrev);
        $this->display('Widget/left_nav');
    }
}