<?php

class AdminAction extends Action
{
    public function layout()
    {
        session('outer_id',null);
        session('outer_username',null);
        header("Content-type: text/html; charset=utf-8");
        echo "<script>location.href='" . U('index') . "';</script>";
    }

    public function edit()
    {
        $map['id'] = I('get.id');
        $admin = D('admin');
        if (IS_POST) {
            $data['id'] = I('post.id');
            $mes = $admin->where($data)->find();
            $data['password'] = md5(I('post.new_pwd'));
            if ($admin->create($data)) {
                if (md5(I('post.password')) == $mes['password']) {
                    if ($admin->save()) {
                        $isok = '密码修改成功';
                    } else {
                        $isok = '密码修改失败';
                    }
                } else {
                    $isok = '原密码输入错误';
                }
            } else {
                $isok = $admin->getError();
            }
            $this->ajaxReturn($isok);
            return;
        }
        $info = $admin->where($map)->find();
        $this->assign('info', $info);
        $this->display();
    }


    public function index()
    {
        $admin = D('admin');
        if (session('outer_id')) {
            $this->redirect('Message/lst?cid=1');
        } else {
            $this->display();
        }
    }


    public function login()
    {
        $admin = D('admin');
        $data['username'] = I('post.username');
        $data['password'] = md5(I('post.password'));
        $data['verify'] = I('post.verify');
        if ($_SESSION['authcode'] == $_POST['verify']) {
            if ($info = $admin->where($data)->find()) {
                $callback = 1;
                session('outer_id', $info['id']);
                session('outer_username', $info['username']);
            } else {
                $callback = '用户或者密码错误';
            }
        } else {
            $callback = "验证码输入错误";
        }
        $this->ajaxReturn($callback);
    }

    public function admin()
    {
        $admin = D('admin');
        // if($admin->where(array('cid'=>1))->delete())
        // 	echo "ok";
        // else
        // 	echo "no";

        // $data['id'] = 1;
        // $data['username'] = 'admin';
        // $data['password'] = md5('2017!#@$xxgcxy');
        // if($admin->add($data))
        // 	echo "ok";
        // else
        // 	echo "no";
    }

    public function lst()
    {
        $admin = M('admin'); // 实例化User对象
        import('ORG.Util.Page');// 导入分页类
        $count = $admin->count();// 查询满足要求的总记录数
        $Page = new Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme', "%upPage% %prePage% %linkPage% %nextPage% %downPage%");
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $admin->order('id')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $pageNum = I('get.p', 1);
        $number = ($pageNum - 1) * 8 + 1;
        for ($i = 0; $i < count($list); $i++) {
            $list[$i]['number'] = $number;
            $number++;
        }
        $this->assign('list', $list);// 赋值数据集
        $this->assign('page', $show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    public function add()
    {
        $admin = D('admin');
        if (IS_POST) {
            $data['username'] = I('post.username');
            $data['password'] = md5(I('post.password'));

            if ($admin->add($data)) {
                $data1['isok'] = 1;
            } else {
                $data1['isok'] = '添加失败';
            }
            $data1['url'] = 'lst?cid=50';
            $this->ajaxReturn($data1);
        }

        $this->display();
    }

    public function adminedit()
    {
        $admin = D('admin');
        if (IS_POST) {
            $data = I('post.');
            $data['password'] = md5(I('post.password'));

            $flag = $admin->where(array('id' => $data['id']))->find();
            if ($flag['password'] != $data['password']) {
                $data1['isok'] = '原密码输入错误';
                $this->ajaxReturn($data1);
            } else {
                $data['password'] = md5(I('post.newpassword'));
                if ($admin->save($data)) {
                    $data1['isok'] = 1;
                } else {
                    $data1['isok'] = '修改失败';
                }
            }
            $data1['url'] = 'lst?cid=50';
            $this->ajaxReturn($data1);

        }
        $map['id'] = I('get.id');
        $info = $admin->where($map)->find();
        $this->assign('info', $info);
        $this->display();
    }

    public function del()
    {
        header("Content-type: text/html; charset=utf-8");
        $admin = D('admin');
        $map['id'] = I('get.id');
        if ($map['id'] == 1) {
            echo "<script>alert('超级管理员不可删除');location.href='lst?cid=50';</script>";
        } else {
            if ($admin->where($map)->delete()) {
                echo "<script>alert('删除成功');location.href='lst?cid=50';</script>";
            } else {
                echo "<script>alert('删除失败');location.href='lst?cid=50';</script>";
            }
        }
    }
}

