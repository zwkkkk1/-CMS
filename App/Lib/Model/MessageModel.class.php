<?php

class MessageModel extends BaseModel
{
    protected $_validate = array(
//        array('verify', 'require', '验证码不得为空'),
        array('title', 'require', '标题不得为空'),
        array('content', 'require', '内容不得为空'),
//        array('verify', 'checkVerify', '验证码输入错误', 1, 'callback'),
    );

    protected $_link = array(
        'Category' => array(
            'mapping_type' => BELONGS_TO,
            'class_name' => 'Category',
            'foreign_key' => 'cid',
            'as_fields' => 'name'
        )
    );

    public function getMesByID($id)
    {
        $mesInfo = $this->where(array('id' => $id))->find();
        return $mesInfo;
    }

    public function addMessage()
    {
        $image = new ImageModel();
        $data = I('post.');
        $data['content'] = $_POST['content'];
        if ($data['time'] == '')
            $data['time'] = date('Y-m-d');
        $data['hit'] = 0;
        $data['top_img_id'] = $image->addImg($data['pic_url']);
        if ($this->create($data)) {
            if ($this->add())
                return 1;
            else
                return '添加失败';
        } else {
            return $this->getError();
        }
    }

    public function editMessage()
    {
        $data = I('post.');
        $data['content'] = $_POST['content'];
        if ($data['time'] == '')
            $data['time'] = date('Y-m-d');
        if ($this->create($data)) {
            if ($this->save())
                return 1;
            else
                return '修改失败';
        } else {
            return $this->getError();
        }
    }

    public function delMessage($id)
    {
        $file = new FileModel();
        if ($this->where(array('id' => $id))->delete())
            return true;
        else
            return false;
    }

}