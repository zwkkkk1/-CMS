<?php
class CommentModel extends BaseModel {
    protected $_link = array(
        'User' => array(
            'mapping_type' => BELONGS_TO,
            'class_name' => 'User',
            'foreign_key' => 'id',
            'as_fields' => 'name'
        )
    );
    public function getCommentByMes($mesid) {
        $info = $this->where(array('mesid' => $mesid))->order('up desc, time desc, id desc')->select();
        return $info;
    }

    public function addComment() {
        $data = I('post.');
        $data['time'] = date('Y-m-d');
        if($data['uid'] == '')
        {
            return '需要登录才能评论！';
        }
        if($this->add($data))
            return 1;
        else
            return '发表失败';
    }
}