<?php

class LinkAction extends Action
{
    public function lst()
    {
        $link = new LinkModel();
        $linkInfo = $link->showAllLink();
        $linkInfo = plusNum($linkInfo, C('ADMIN_PAGE_COUNT'));
        $this->assign('linkInfo', $linkInfo);
        $this->display();
    }

    public function add()
    {
        $link = new LinkModel();
        if (IS_POST) {
            $callback['isok'] = $link->addLink();
            $callback['url'] = 'lst';
            $this->ajaxReturn($callback);
        }
        $this->display();
    }

    public function edit()
    {
        $link = new LinkModel();
        if (IS_POST) {
            $callback['isok'] = $link->editLink();
            $callback['url'] = 'lst';
            $this->ajaxReturn($callback);
        }
        $linkInfo = $link->showLinkByID(I('get.id'));
        $this->assign('linkInfo', $linkInfo);
        $this->display();
    }

    public function del()
    {
        header("Content-type: text/html; charset=utf-8");
        $link = new LinkModel();
        $id = I('get.id');
        if ($link->where(array('id' => $id))->delete())
            echo "<script>alert('删除成功!');location.href='lst';</script>";
        else
            echo "<script>alert('删除失败!');location.href='lst';</script>";
    }
}