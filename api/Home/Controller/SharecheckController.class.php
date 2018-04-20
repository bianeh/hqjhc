<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class SharecheckController extends Controller{
    //判断该用户是否分享过该产品
    public function index()
    {
        $loginName = I('post.loginName');
        $count = $this->checkUser($loginName);
        if($count < 1)
        {
             $response['code'] = '000006';
             $response['msg'] = '不存在改用户！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
        }
        $UserInfo = $this->getUserInfo($loginName);
        $userid = $UserInfo['userid'];
        $goodsid = I('post.goodsid');
        $sharecount = $this->checkShare($goodsid,$userid);
        if($sharecount < 1)
        {
             $response['code'] = '000005';
             $response['msg'] = '还没有分享过该产品！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
        }
        $response['code'] = '000008';
        $response['msg'] = '以分享过该产品！';
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));
    }
    //判断该用户是否合法
    public function checkUser($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->count();
    }
    //获取该用户信息
    public function getUserInfo($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->find();
    }
    //判断是否分享过该产品
    public function checkShare($goodsid,$userid)
    {
        $Share = D('share');
        return $Share->where(['productid'=>$goodsid,'userid'=>$userid])->count();
    }
}
