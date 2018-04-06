<?php

class MessageViewModel extends ViewModel
{
    public $viewFields = array(
        'Message' => array('id', 'title', 'content', 'time', 'author', 'hit', 'top_img_id', 'collect'),
        'Image' => array('url', '_on' => 'Message.top_img_id=Image.id'),
        'Category' => array('name', 'cid', '_on' => 'Message.cid=Category.cid'),
    );

    /**
     * 取cid下所有message信息
     * @param $cid
     * @param string $order 排列顺序 默认为0
     * @param bool $showStatus 可视状态是否生效 默认不生效(false)
     * @return
     */
    public function getMesByCid($cid, $order = '', $showStatus = false)
    {
        $category = new CategoryModel();
        $allCates = $category->getAllCates($cid);
        $allCates['sonArr'] = $category->getVarInArray($allCates['sonArr'], 'cid');

        $map['cid'] = array('in', $allCates['sonArr']);
        if(!$showStatus)
        {
            $messageInfo = $this->where($map)->order($order)->select();
        }
        else
        {
            $map['showstatus'] = 1;
            $messageInfo = $this->where($map)->order($order)->select();
        }
        return $messageInfo;
    }

    public function getMesByID($id)
    {
        $mesInfo = $this->where(array('id' => $id))->find();
        return $mesInfo;
    }

    /**
     * 关键字搜索信息
     * @param $keyword int 关键字
     * @param $cid int 默认为空
     * @return array
     */
    public function researchMes($keyword, $cid = '', $order = '')
    {
        $category = new CategoryModel();
        if($cid != '')
        {
            $allCates = $category->getAllCates($cid);
            $map['cid'] = $allCates['sonArr'];
        }
        $map['title|author'] = array("like", "%". $keyword ."%");
        $mesInfo = $this->where($map)->order($order)->select();
        return $mesInfo;
    }

    public function newMesLst($date, $showStatus = false)
    {
        $timeLine = date('Y-m-d', strtotime('-' . $date . ' day'));
        if($showStatus)
            $list = $this->where('time > "'.$timeLine.'"')->order('time desc,id desc')->select();
        else
            $list = $this->where('showstatus = 1 and time > "'.$timeLine.'"')->order('time desc,id desc')->select();
        return $list;
    }
}