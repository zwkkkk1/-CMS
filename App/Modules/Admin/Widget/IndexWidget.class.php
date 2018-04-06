<?php
class IndexWidget extends Action {
    public function topList($cid)
    {
        $category = new CategoryModel();
        $info = $category->getAllPrevCates($cid);
        $nameArr = $category->getVarInArray($info, 'name');
        $this->assign('nameArr', array_reverse($nameArr));
        $this->display('Widget:topList');
    }

    public function selectCategory($cid = '') {
        $category = new CategoryModel();
        if($cid == '')
        {
            $info = $category->where('previd = 0')->select();
            $type = 1;
            $this->assign('type', $type);
            $this->assign('info', $info);
        } else {
            $cates = $category->getAllPrevCates($cid);
//            $info = $category->getAllCates(array_pop($category->getAllPrevCates($cid))['cid']);
            $info = array_pop($category->getAllPrevCates($cid));
            $info = $info['cid'];
            $info = $category->getAllCates($info);
            $this->assign('step', $info['step']);
            $this->assign('cates', array_reverse($cates));
        }
        $this->display('Widget:selectCategory');
    }

    public function getVolistCate($cid)
    {
        $category = new CategoryModel();
        $info = $category->getSiblingsCate($cid, false);
        return $info;
    }

    public function getSonCates($cid)
    {
        $category = new CategoryModel();
        $info = $category->getSonCateByCid($cid);
        return $info;
    }
}