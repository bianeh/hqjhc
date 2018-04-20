<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class UserinfoController extends Controller{
    CONST DATAFLAG = 0;
    //用户中心信息
   public function index()
   {
       $loginName = I('post.loginName');
       $count  = $this->checkUserInfo($loginName);
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
       $UserInfo = $this->getUserInfo($loginName);
       $userid = $UserInfo['userid'];
       $count = $this->getwebnotify($userid);
       if($count >= 1)
       {
           $response['webstatus'] = 1;
        } else {
           $response['webstatus'] = 0;
        }
       if($UserInfo)
       { 
           $paycount = $this->getordercount(0,$userid);
           $haspaycount = $this->getordercount(1,$userid);
           $checkcount = $this->getordercount(2,$userid);
           $hasexpresscount = $this->getordercount(3,$userid);
           $cancelcount = $this->getordercount(4,$userid);
           $completecount = $this->getordercount(5,$userid);
           $recyclecount = $this->getordercount(6,$userid);
           
           $leakcount = $this->getorderafcount(1,$userid);
           $lackcount = $this->getorderafcount(2,$userid);
           $returncount = $this->getorderafcount(3,$userid);
           $response['paycount'] = $paycount;
           $response['haspaycount'] = $haspaycount;
           $response['checkcount'] = $checkcount;
           $response['hasexpresscount'] = $hasexpresscount;
           $response['cancelcount'] = $cancelcount;
           $response['completecount'] = $completecount;
           $response['recyclecount'] = $recyclecount;
           
           
           $response['leakcount'] = $leakcount;
           $response['lackcount'] = $lackcount;
           $response['returncount'] = $returncount;
           
           
           
           $response['userinfo'] = $UserInfo;
           $response['usercode'] = 100000 + $UserInfo['userid'];
           $response['code'] = '000008';
           $response['msg'] = '获取用户中心数据成功！';
           header('Content-type:text/html; Charset=utf8');  
           header( "Access-Control-Allow-Origin:*");  
           header('Access-Control-Allow-Methods:POST');    
           header('Access-Control-Allow-Headers:x-requested-with,content-type');
           die(json_encode($response));
       }
       
   }
   //验证用户信息
   public function checkUserInfo($loginName)
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
   //获取个人站内信
   public function getwebnotify($userid)
   {
       $Web_notify = D('web_notify');
       $con['type']  = array('in','0,1');
       $con['userid'] = $userid;
       $con['dataFlag'] = self::DATAFLAG;
       return $Web_notify->where($con)->count();
   }
   /**
    * 获取订单数量
    */
   public function getordercount($orderstatus,$userid)
   {
       $Orders = D('orders');
       return $Orders->where(['orderStatus'=>$orderstatus,'userid'=>$userid])->count();
   }
    /**
    * 获取售后数量
    */
   public function getorderafcount($type,$userid)
   {
       $Orders = D('orders_af');
       return $Orders->where(['type'=>$type,'userid'=>$userid])->count();
   }
   
}