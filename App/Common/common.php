<?php

    /*
     * 为指定数字加上编码
     */
    function plusNum($list, $pageCount)
    {
        $pageNum = I('get.p',1);
		$number = ($pageNum-1)*$pageCount+1;
		for($i = 0; $i < count($list); $i++) {
			$list[$i]['number'] = $number;
			$number++;
		}
		return $list;
    }

    /**
     * 将数组内信息 以页码的形式返回
     * @param 数组信息
     * @param 单页显示信息条数
     * @return array
     */
    function getInfoByPage($info, $pageCount)
    {
        $count = count($info);
        import("ORG.Util.Page");// 导入分页类
        $Page = new Page($count, $pageCount);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('theme', "%upPage% %prePage% %linkPage% %nextPage% %downPage%");
        $data['show'] = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $data['list'] = array_slice($info, $Page->firstRow, $Page->listRows);
        return $data;
    }

    function getDesc($content) {
        $preg = "/[\x{4e00}-\x{9fa5}]+/u";
        preg_match_all($preg,$content, $return);
        $result = '';
        foreach($return[0] as $key=>$value)
        {
            $result = $result.$value;
        }
        return $result;
    }

    function plusDesc($arr) {
        $returnArr = $arr;
        for($i = 0; $i < count($arr); $i++) {
            $desc = getDesc($arr[$i]['content']);
            $desc = mb_substr($desc,0,100,"utf-8");
            $returnArr[$i]['desc'] = $desc;
        }
        return $returnArr;
    }

    function plusImgPrefix($arr) {
        foreach($arr as $key => &$value)
        {
            if($value['url'] != '') {
                $value['url'] = C('IMG_URL_PREFIX') . $value['url'];
            }
        }
        return $arr;
    }

