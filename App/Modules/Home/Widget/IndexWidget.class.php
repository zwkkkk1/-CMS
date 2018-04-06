<?php
class IndexWidget extends Action {
	public function mesInfo($id) {
	    $category = new CategoryModel();
		$messageView = new MessageViewModel();
		$info['cate'] = $category->getCateInfoByCid($id);
		$cid = $info['cate']['cid'];
		$info['mesInfo'] = $messageView->limit(C('INDEX_MES_COUNT'))->getMesByCid($cid, 'time desc,id desc', true);
		return $info;
	}

	public function getPic($mid) {
		$pic = M('pic');
		$message = M('message');
		$picinfo = $pic->order('messageid')->where('mid = %d',$mid)->limit(4)->select();
		for($i = 0;$i < count($picinfo); $i++) {
			$messageinfo = $message->where(array('id'=>$picinfo[$i]['messageid']))->find();
			$picinfo[$i]['title'] = $messageinfo['title'];
		}
		return $picinfo;
	}

	public function newLst() {
        $info = new InfoModel();

        $messageView = new MessageViewModel();
        $newDate = $info->getValByKey('newDate');
        $list = $messageView->limit(C('INDEX_MES_COUNT'))->newMesLst($newDate);

        return $list;

    }
}