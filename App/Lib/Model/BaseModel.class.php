<?php
/**
 * Created by PhpStorm.
 * User: zwkkkk1
 * Date: 2017/8/1
 * Time: 20:45
 */

class BaseModel extends RelationModel
{
    /**
     * 取一个数组中某一字段 作一个子数组返回
     * @param array $items 数组
     * @param string $var 字段名
     * @return array
     */
    public function getVarInArray($items, $var)
    {
        $newArray = array();
        for($i = 0; $i < count($items); $i++)
        {
            array_push($newArray, $items[$i][$var]);
        }
        return $newArray;
    }

    public function checkVerify($data)
    {
        if ($_SESSION['authcode'] != $data) {
            return false;
        }
        return true;
    }
}