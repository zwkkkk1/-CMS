<?php

class FileModel extends BaseModel
{
    /*
     * 通过新闻ID删除该新闻下所有文件
     */
    public function delFileByMesID($id)
    {
        if($this->getFileByMesID($id) != '')
        {
            if($this->where(array('messageid' => $id))->delete())
            {
                foreach($this->getFileByMesID($id) as $file) {
                    unlink($file['fileurl']);
                }
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    /*
     * 通过文件ID删除文件
     */
    public function delFileByFileID($id)
    {
        $file = $this->where(array('id' => $id))->find();
        if($this->delete($id))
        {
            unlink($file['fileurl']);
            return true;
        } else {
            return false;
        }
    }

    /*
     * 通过新闻ID获得该新闻下所有文件信息
     */
    public function getFileByMesID($id)
    {
        $info = $this->where(array('messageid' => $id))->select();
        return $info;
    }
    /*
     * 通过文件ID获取文件信息
     */
    public function getFileByFileID($id)
    {
        $info = $this->where(array('id' => $id))->select();
        return $info;
    }

    public function uploadFile()
    {
        $data = I('post.');
        $data['type'] = 'file';
        $filetype = I('post.filetype');
        if ($_FILES[$filetype]['tmp_name'] != '') {
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();// 实例化上传类
            $upload->maxSize = 314572800;// 设置附件上传大小
            $upload->allowExts = array('doc', 'docx', 'xls', 'xlsx', 'txt', 'zip', 'rar', 'ppt', 'pptx', 'pdf');// 设置附件上传类型
            $upload->rootPath = './'; // 设置附件上传根目录 与入口文件 index.php平级中Public/Uploads
            $upload->savePath = './Public/Uploads/'; // 设置附件上传（子）目录 // 上传文件
            $info = $upload->uploadOne($_FILES[$filetype]);
            if (!$info)// 上传错误提示错误信息
                return $upload->getErrorMsg();
            else// 上传成功 获取上传文件信息
            {
                $data['fileurl'] = $info[0]['savepath'] . $info[0]['savename'];
            }
        }
        return $data;
    }
}