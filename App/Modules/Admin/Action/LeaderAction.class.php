<?php

class LeaderAction extends Action
{
    public function lst()
    {
        $leader = new LeaderModel();
        $leaders = $leader->order('id asc')->relation(true)->select();
        $this->assign('leaders', $leaders);
        $this->display();
    }

    public function add()
    {
        $leader = new LeaderModel();
        if (IS_POST) {
            $isok = $leader->addLeader();
            if ($isok == 1)
                echo "<script>alert('添加成功!');location.href='lst';</script>";
            else
                echo "<script>alert('" . $isok . "');location.href='add';</script>";
        }
        $this->display();
    }

    public function edit()
    {
        $leader = new LeaderModel();
        if (IS_POST) {
            $isok = $leader->editLeader();
            if ($isok == 1)
                echo "<script>alert('修改成功!');location.href='lst';</script>";
            else
                echo "<script>alert('" . $isok . "');location.href='edit?id=".I('post.id')."';</script>";
        }
        $info = $leader->relation(true)->select(I('get.id'));
        $this->assign('info', $info[0]);
        $this->display();
    }

    public function del()
    {
        $leader = new LeaderModel();
        header("Content-type: text/html; charset=utf-8");
        if ($leader->delete(I('get.id')))
            echo "<script>alert('删除成功!');location.href='lst';</script>";
        else
            echo "<script>alert('删除失败!');location.href='lst';</script>";
    }
}