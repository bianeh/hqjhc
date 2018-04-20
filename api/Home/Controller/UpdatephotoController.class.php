<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class UpdatephotoController extends Controller{
   //修改头像接口
   public function index()
   {    
        $loginName = I('post.loginName');
        //检验登录名的合法性
        $count = $this->checkUser($loginName);
        if($count != 1)
        {
            $response['code'] = '000001';
            $response['msg'] = '不存在此用户！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        $photo = I('post.photobase64code');
        if(!$photo)
        {
            $response['code'] = '000002';
            $response['msg'] = '没有上传头像！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        $photo = substr($photo,23);
        $img = base64_decode($photo);
        $time = time();
        $a = file_put_contents("./data/userphoto/".$time.".png", $img);//返回的是字节数
        $data['userPhoto'] = "/userphoto/".$time.".png";
        $data['userPhotoway'] = 1;
        //修改用户的头像
        $res = $this->updateuserphoto($loginName,$data);
        if($res)
        {
            $response['code'] = '000008';
            $response['msg'] = '成功修改头像！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }  
   }
   //修改用户的头像
   public function updateuserphoto($loginName,array $data)
   {
       $Users = D('users');
       return $Users->where(['loginName'=>$loginName])->save($data);
   }
   //判断登录名的合法性
   public function checkUser($loginName)
   {
       $Users = D('users');
       return $Users->where(['loginName'=>$loginName])->count();
   }
}

