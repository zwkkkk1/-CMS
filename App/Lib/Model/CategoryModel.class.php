<?php
/**
 * Created by PhpStorm.
 * User: zwkkkk1
 * Date: 2017/8/1
 * Time: 20:45
 */

class CategoryModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '模块名不得为空')
//        array('verify', 'require', '验证码不得为空'),
//        array('verify','checkVerify', '验证码输入错误', 1, 'callback')
    );

    public function addCate()
    {
        $data = I('post.');
        if($this->create($data))
        {
            if($this->add())
                return 1;
            else
                return '添加失败';
        } else {
            return $this->getError();
        }
    }

    public function editCate()
    {
        $data = I('post.');
        if($this->create($data))
        {
            if($this->save())
                return 1;
            else
                return '添加失败';
        } else {
            return $this->getError();
        }
    }

    public function delCate($id)
    {
        if($this->where(array('cid'=>$id))->delete())
            return true;
        else
            return false;
    }

    /**
     * 找到该cid下所有子孙板块(包括自身)
     * @param int || array
     * @return array 子孙板块详情
     */
    public function getAllCates($cid, $sonArr = array(), $step = 1)
    {

        $newCIDs = array();
        if (!is_array($cid)) {
            array_push($sonArr, $this->getCateInfoByCid($cid));
        }

        //将找到的板块信息放入$sonArr
        $info = $this->getSonCateByCid($cid);
        for ($i = 0; $i < count($info); $i++) {
            array_push($newCIDs, $info[$i]['cid']);
        }

        $callback['step'] = $step;
        $callback['sonArr'] = $sonArr;
        if (!empty($info)) {
            $callback['sonArr'] = array_merge($sonArr, $info);
            $callback = $this->getAllCates($newCIDs, $callback['sonArr'], ++$step);
        }

        return $callback;
    }

    /**
     * 通过cid 获取该板块信息
     * @param int $cid
     * @return array 板块信息
     */
    public function getCateInfoByCid($cid)
    {
        $info = $this->where(array('cid' => $cid))->find();
        $prevInfo = $this->where(array('cid'=>$info['previd']))->find();
        $info['prevname'] = $prevInfo['name'];
        return $info;
    }

    /**
     * 通过cid获取该板块下的子板块
     * @param int || array
     * @return array
     */
    public function getSonCateByCid($cid)
    {
        if (is_array($cid))
            $map['previd'] = array('in', $cid);
        else
            $map['previd'] = $cid;

        $info = $this->where($map)->select();
        return $info;
    }

    /**
     * 找到板块的父板块
     * @param $cid int
     * @return array
     */
    public function getPrevCateByCid($cid)
    {
        $info = $this->getCateInfoByCid($cid);
        $prevInfo = $this->where(array('cid' => $info['previd']))->find();
        return $prevInfo;
    }

    /*
     * 找出该板块的所有祖先板块
     */
    public function getAllPrevCates($cid, $prevArr = array())
    {
        array_push($prevArr, $this->getCateInfoByCid($cid));
        $prevInfo = $this->getPrevCateByCid($cid);
        if (!empty($prevInfo)) {
            $prevArr = $this->getAllPrevCates($prevInfo['cid'], $prevArr);
        }
        return $prevArr;
    }

    /**
     * 通过cid取兄弟板块
     * @param int $cid
     * @param boolean $hasOwn true 包括自己 false 不包括自己
     * @return array
     */
    public function getSiblingsCate($cid, $hasOwn = true)
    {
        $prevInfo = $this->getPrevCateByCid($cid);
        if (!empty($prevInfo)) {
            if ($hasOwn)
                $info = $this->where('previd = ' . $prevInfo['cid'])->select();
            else
                $info = $this->where('previd = ' . $prevInfo['cid'] . ' and cid != ' . $cid)->select();
        } else {
            if ($hasOwn)
            {
                $info = $this->where('previd = 0')->select();
            } else {
                $info = $this->where('previd = 0 and cid != ' . $cid)->select();
            }
        }
        return $info;
    }

    /**
     * 通过板块名获取板块
     */
    public function getCateByName($name)
    {
        $cateInfo = $this->where('name = "'.$name.'"')->find();
        return $cateInfo;
    }
}