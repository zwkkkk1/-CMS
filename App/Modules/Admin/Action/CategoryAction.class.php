<?php
class CategoryAction extends Action
{
    public function lst()
    {
        $category = new CategoryModel();
        $cateinfo = $category->select();
        $this->display();
    }

    public function add()
    {
        $category = new CategoryModel();
        if(IS_POST)
        {
            $callback['isok'] = $category->addCate();
            $callback['url'] = 'lst';
            $this->ajaxReturn($callback);
        }
        $this->display();
    }

    public function edit()
    {
        $category = new CategoryModel();
        if(IS_POST)
        {
            $callback['isok'] = $category->editCate();
            $callback['url'] = 'lst';
            $this->ajaxReturn($callback);
        }
        $cateInfo = $category->where(array('cid' => I('get.cid')))->find();
        $this->assign('cateInfo', $cateInfo);
        $this->display();
    }

    public function del()
    {
        header("Content-type: text/html; charset=utf-8");
        $category = new CategoryModel();
        $cid = I('get.cid');
        if ($category->delCate($cid))
            echo "<script>alert('删除成功!');location.href='lst';</script>";
        else
            echo "<script>alert('删除失败!');location.href='lst';</script>";

    }
}