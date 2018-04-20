<?php
namespace Upload\Controller;
use Think\Controller;
class IndexController extends Controller {
 /*
  * 图像上传
  */
    public function upload()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './data/';// 设置附件上传根目录
        $upload->savePath  =     '';// 设置附件上传（子）目录
        
        // 上传文件 
        $info   =   $upload->upload();
        if(!$info)
        {   
            // 上传错误提示错误信息
            $data['msg'] = '上传失败';
            $data['code'] = '000001';
            print_r(json_encode($data));
        }
        else
        {   // 上传成功
            $data['msg'] = '上传成功';
            $data['code'] = '000002';
            $data['showimgurl'] = DATA_URL."/".$info['uploadfile']['savepath'].$info['uploadfile']['savename'];
            $data['imgurl'] = $info['uploadfile']['savepath'].$info['uploadfile']['savename'];
            print_r(json_encode($data));
        }
    }
    /**
     * 发布产品图片上传
     */
    public function upload_product()
    {
        $id = I('get.id');
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './data/';// 设置附件上传根目录
        $upload->savePath  =     '';// 设置附件上传（子）目录
        $imageinfo = getimagesize($_FILES[$id]['tmp_name']);
        $width = $imageinfo[0];
        $height = $imageinfo[1];
//        if($weidth != 640 || $height != 640)
//        {   
//            $data['msg'] = '图片尺寸必须是640 X 640';
//            $data['code'] = '000000';
//            die(json_encode($data));
//        }
  
        // 上传文件 
        $info   =   $upload->upload();
        if(!$info)
        {   
            // 上传错误提示错误信息
            $data['msg'] = '上传失败';
            $data['code'] = '000001';
            print_r(json_encode($data));
        }
        else
        {   // 上传成功
            $data['msg'] = '上传成功';
            $data['code'] = '000002';
            $data['showimgurl'] = DATA_URL."/".$info[$id]['savepath'].$info[$id]['savename'];
            $data['imgurl'] = $info[$id]['savepath'].$info[$id]['savename'];
            print_r(json_encode($data));
        }
    }
}