<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class OrderremindController extends Controller{
   //提醒订单操作
    public function index()
    {
        $orderno = I('post.orderno');
        $loginName = I('post.loginName');
        //验证用户的合法性
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
        //获取用户信息
        $UserInfo = $this->getUserInfo($loginName);
        $userid = $UserInfo['userid'];
        //添加提醒操作数据
        $orderremindinfo['userid'] = $userid;
        $orderremindinfo['createTime'] = date("Y-m-d H:i:s",time());
        $orderremindinfo['orderNo'] = $orderno; 
        $res = $this->order_remind($orderremindinfo);
        if($res)
        {
            //返回成功状态
            $response['code'] = '000008';
            $response['msg'] = '成功提醒！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        
    }
    //订单提醒操作
    public function order_remind(array $data)
    {
        $Order_remind = D('order_remind');
        return $Order_remind->add($data);
    }
    //验证用户合法性
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
