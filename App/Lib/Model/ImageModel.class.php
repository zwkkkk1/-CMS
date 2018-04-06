<?php
class ImageModel extends BaseModel {
    public function uploadImg($fileName)
    {
        if ($_FILES[$fileName]['tmp_name'] != '') {
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();// 实例化上传类
            $upload->maxSize = 314572800;// 设置附件上传大小
            $upload->allowExts = array('png','jpeg','jpg','gif','bmp','pdf','svg');// 设置附件上传类型
            $upload->rootPath = './'; // 设置附件上传根目录 与入口文件 index.php平级中Public/Uploads
            $upload->savePath = './Public/Uploads/'; // 设置附件上传（子）目录 // 上传文件
            $info = $upload->uploadOne($_FILES[$fileName]);
            if (!$info)// 上传错误提示错误信息
                return $upload->getErrorMsg();
            else// 上传成功 获取上传文件信息
            {
                $data['url'] = $info[0]['savepath'] . $info[0]['savename'];
                $imgID = $this->add($data);
                return $imgID;
            }
        }
        return false;
    }

    public function addImg($url)
    {
        $data['url'] = $url;
        if($imgID = $this->add($data))
            return $imgID;
    }
}