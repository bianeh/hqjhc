<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class ShareController extends Controller{
    public function index()
    {
        $targetid = I('post.productid');
        $loginName = I('post.loginName');
        $way = I('post.way');
        if(!$targetid)
        {
            $response['code'] = '000004';
            $response['msg'] = '产品id不能为空！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        if(!$loginName)
        {
            $response['code'] = '000003';
            $response['msg'] = '用户名不能为空！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        if(!$_POST)
        {
            $response['code'] = '000005';
            $response['msg'] = '没有请求参数！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        $count = $this->checkUser($loginName);
        if($count != 1)
        {
            $response['code'] = '000006';
            $response['msg'] = '不存在改用户！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        $UserInfo = $UserInfo = $this->getUserInfo($loginName);
        $userid = $UserInfo['userid'];
        $Share_data['userid'] = $userid;
        $Share_data['src'] = $way;
        $Share_data['productid'] = $targetid;
        $Share_data['createTime'] = date("Y-m-d H:i:s",time());
        $res = $this->addsharedata($Share_data);
        if($res)
        {
            $response['code'] = '000008';
            $response['msg'] = '分享成功！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
    }
    //插入微商已分享的数据
    public function addsharedata(array $arr)
    {
        $Share = D('share');
        return $Share->add($arr);
    }
    //验证用户
   public function checkUser($loginName)
   {
       $Users = D('users');
       return $Users->where(['loginName'=>$loginName])->count();
   }
    
    //获取用户信息
   public function getUserInfo($loginName)
   {
       $Users = D('users');
       return $Users->where(['loginName'=>$loginName])->find();
   }
}

