<?php
class UserModel extends BaseModel {
    protected $_validate = array(
        array('username', 'require', '姓名不得为空'),
        array('password', 'require', '密码不得为空')
    );

    public function addUser()
    {
        $data = I('post.');
        $data['password'] = md5($data['password']);
        if($this->where(array('username'=>$data['username']))->find())
        {
            $data['isok'] = '用户名已存在';
            return $data;
        }
        if($this->create($data))
        {
            if ($data['id'] = $this->add())
            {
                $data['isok'] = 1;
                return $data;
            }
            else
            {
                $data['isok'] = '注册失败';
                return $data;
            }
        } else {
            $data['isok'] = $this->getError();
            return $data;
        }
    }
}