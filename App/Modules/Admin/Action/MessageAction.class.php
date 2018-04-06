<?php

// 本类由系统自动生成，仅供测试用途
class MessageAction extends CommonAction
{

    public function lst()
    {

        $messageView = new MessageViewModel();
        $category = new CategoryModel();
        $cid = I('get.cid', '');
        $info = $category->getCateInfoByCid($cid);
        $this->assign('info', $info);
        $list = $messageView->getMesByCid($cid, 'time desc,id desc');
        $data = getInfoByPage($list, C('ADMIN_PAGE_COUNT'));
        $data['list'] = plusNum($data['list'], C('ADMIN_PAGE_COUNT'));
        $this->assign('list', $data['list']);// 赋值数据集
        $this->assign('page', $data['show']);// 赋值分页输出


        $this->display(); // 输出模板
    }

    /*
        添加新闻
     */
    public function add()
    {
        $message = new MessageModel();
        if (IS_POST) {
            $callback['isok'] = $message->addMessage();
            $callback['url'] = 'lst?cid=' . I('post.cid');
            $this->ajaxReturn($callback);
        }

        $this->display();
    }

    /*
        编辑新闻
     */
    public function edit()
    {
        $message = new MessageModel();
        $messageView = new MessageViewModel();
        $id = I('get.id');

        if (IS_POST) {
            $callback['isok'] = $message->editMessage();
            $callback['url'] = 'lst?cid=' . I('post.cid');
            $this->ajaxReturn($callback);
        }
        $mesInfo = $message->getMesByID($id);
        $this->assign('mesInfo', $mesInfo);
        $this->display();
    }

    /*
        删除新闻 及 属于该新闻的文件
     */
    public function del()
    {
        header("Content-type: text/html; charset=utf-8");
        $message = new MessageModel();
        $cid = $_GET['cid'];
        if ($message->delMessage(I('get.id')))
            echo "<script>alert('删除成功!');location.href='lst?cid=" . $cid . "';</script>";
        else
            echo "<script>alert('删除失败!');location.href='lst?cid=" . $cid . "';</script>";

    }

    /*
     * 信息要闻部分
     */
    public function newLst()
    {
        $info = new InfoModel();

        if (IS_POST) {
            $callback['isok'] = $info->setValByKey('newDate');
            $this->ajaxReturn($callback);
        }

        $messageView = new MessageViewModel();
        $newDate = $info->getValByKey('newDate');
        $list = $messageView->newMesLst($newDate, true);

        $data = getInfoByPage($list, C('ADMIN_PAGE_COUNT'));
        $data['list'] = plusNum($list, C('ADMIN_PAGE_COUNT'));

        $this->assign('newDate', $newDate);
        $this->assign('list', $data['list']);
        $this->assign('page', $data['show']);
        $this->display();
    }

    /*
        关键字模糊查询
     */
    public function research()
    {
        $messageView = new MessageViewModel();
        $category = new CategoryModel();

        $list = $messageView->researchMes(I('get.keywords'), I('get.cid'), 'time desc,id desc');
        $data = getInfoByPage($list, C('ADMIN_PAGE_COUNT'));

        $this->assign('list', $data['list']);// 赋值数据集
        $this->assign('page', $data['show']);// 赋值分页输出

        $this->display(); // 输出模板
    }


    /*
        上传文件
     */
    public function uploadfile()
    {
        header("Content-type: text/html; charset=utf-8");
        $file = new FileModel();
        $cid = I('get.cid');
        $data = $file->uploadFile();
        if (!is_array($data)) {
            echo "<script>alert('".$data."');location.href='lst?cid=" . $cid . "';</script>";
        } else {
            if ($file->add($data))
                echo "<script>alert('上传成功');location.href='lst?cid=" . $cid . "';</script>";
            else
                echo "<script>alert('上传失败');location.href='lst?cid=" . $cid . "';</script>";
        }
    }

    /*
        展示属于该新闻的文件
     */
    public function showfile()
    {
        $file = new FileModel();
        $fileInfo = $file->getFileByMesID(I('post.messageid'));

        $this->ajaxReturn($fileInfo);
    }

    /*
        删除文件
     */
    public function delfile()
    {
        header("Content-type: text/html; charset=utf-8");
        $file = new FileModel();
        $cid = I('get.cid');
        if ($file->delFileByFileID(I('get.id'))) {
            echo "<script>alert('删除成功');location.href='lst?cid=" . $cid . "';</script>";
        } else {
            echo "<script>alert('删除失败');location.href='lst?cid=" . $cid . "';</script>";
        }
    }

    /*
        关键字选取父板块 选取子版块
     */
    public function sortCate()
    {
        $category = new CategoryModel();
        $previd = I('post.cid');
        $data = $category->getSonCateByCid($previd);
        $this->ajaxReturn($data);
    }

    public function change()
    {
        $message = new MessageModel();
        $mesInfo = $message->where('cid = 37')->select();
        for($i = 0;$i<count($mesInfo);$i++)
        {
            $mesInfo[$i]['cid'] = 60;
            $message->save($mesInfo[$i]);
        }
        $mesInfo = $message->where('cid = 39')->select();
        for($i = 0;$i<count($mesInfo);$i++)
        {
            $mesInfo[$i]['cid'] = 67;
            $message->save($mesInfo[$i]);
        }
    }

    public function changeShowStatus()
    {
        header("Content-type: text/html; charset=utf-8");
        $message = new MessageModel();
        $mesInfo = $message->getMesByID(I('post.id'));
        $mesInfo['showstatus'] = 1 - $mesInfo['showstatus'];
        $message->save($mesInfo);

        $this->ajaxReturn($mesInfo);
    }
}