<?php

class IndexAction extends Action
{
    public function index()
    {
        $message = new MessageViewModel();

        //热门景点
        $scene = $message->where(array('cid' => 1))->order('collect desc, time desc, id desc')->select();
        $scene1 = array();
        foreach ($scene as $key => $value) {
            if ($value['url'] != '' && count($scene1) < 8)
                array_push($scene1, $value);
        }
        $scene1 = plusImgPrefix($scene1);
        $this->assign('scene', $scene1);
        //美食文化
        $food = $message->where(array('cid' => 3))->order('collect desc, time desc, id desc')->limit(5)->select();
        $food = plusDesc($food);
        $food = plusImgPrefix($food);
        $this->assign('food', $food);
        $this->display();
    }

    public function item()
    {
        $message = new MessageViewModel();
        $cid = I('get.cid');
        $info = $message->where(array('cid'=>$cid))->select();
        $info = plusDesc($info);
        $info = plusImgPrefix($info);
        $data = getInfoByPage($info, 10);

        $this->assign('data', $data);
        $this->display();
    }

    public function content()
    {
        $id = I('get.id');
        $message = new MessageViewModel();
        $comment = new CommentModel();
        //点击量+1
        $mes = new MessageModel();
        $info = $mes->where(array('id' => $id))->find();
        $info['hit']++;
        $mes->save($info);
        $mesInfo = $message->where(array('id' => $id))->find();
        $this->assign('mesInfo', $mesInfo);

        $commentInfo = $comment->relation(true)->getCommentByMes($id);
        $this->assign('comment', $commentInfo);
//        var_dump($commentInfo);
        $this->display();
    }

    public function userReg()
    {

        $user = new UserModel();
        if (IS_POST) {
            $callback = $user->addUser();
            if ($callback['isok'] == 1) {
                session('uid', $callback['id']);
                session('username', $callback['username']);
            }
            $this->ajaxReturn($callback);
        }

        $this->display();

    }

    public function userLogin()
    {
        $user = new UserModel();
        $data['username'] = I('post.username');
        $data['password'] = md5(I('post.password'));
        if ($info = $user->where($data)->find()) {
            $callback = 1;
            session('uid', $info['id']);
            session('username', $info['username']);
        } else {
            $callback = '用户或者密码错误';
        }

        $this->ajaxReturn($callback);
    }

    public function judgeUsername()
    {
        $user = new UserModel();
        $data['username'] = I('post.username');
        if ($user->where($data)->find())
            $this->ajaxReturn(false);
        else
            $this->ajaxReturn(true);
    }

    public function imgwall()
    {
        $message = new MessageViewModel();
        $mesInfo = $message->where(array('cid' => 1))->select();
        $mesInfo = plusImgPrefix($mesInfo);
        $this->assign('mesInfo', $mesInfo);
        $this->display();
    }

    public function changeCollect()
    {
        $message = new MessageModel();
        $id = I('post.id');
        $like = I('post.like');
        $mesInfo = $message->where(array('id' => $id))->find();
        if ($like == -1) {
            $mesInfo['collect'] = $mesInfo['collect'] - 1;
            session('like', '-1');
        } else {
            $mesInfo['collect'] = $mesInfo['collect'] + 1;
            session('like', '1');
        }
        $message->save($mesInfo);
    }

    public function changeUp()
    {
        $comment = new CommentModel();
        $id = I('post.id');
        $like = I('post.like');
        $mesInfo = $comment->where(array('id' => $id))->find();
        if ($like == -1) {
            $mesInfo['up'] = $mesInfo['up'] - 1;
            session('like', '-1');
        } else {
            $mesInfo['up'] = $mesInfo['up'] + 1;
            session('like', '1');
        }
        $comment->save($mesInfo);
    }


    public function addComment()
    {
        $comment = new CommentModel();

        $callback['isok'] = $comment->addComment();
        $this->ajaxReturn($callback);
    }


    public function research()
    {
        $message = new MessageViewModel();
        $keywords = I('get.keywords');
        $map['title'] = array("like", "%" . $keywords . "%");

        $list = $message->where($map)->select();
        $list = plusImgPrefix($list);
        $data = getInfoByPage($list, 10);
        $this->assign('data', $data);// 赋值分页输出
        $this->display();
    }

    public function layout()
    {
        session('uid',null);
        session('username',null);
        echo "<script>alert('退出成功');location.href='" . U('index') . "';</script>";
    }
}