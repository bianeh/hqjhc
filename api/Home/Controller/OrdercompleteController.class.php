<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Home\Controller;
use Think\Controller;
class OrdercompeleteController extends Controller{
    CONST completeorderstatus = 5;
    //确认订单完成
    public function index()
    {
        $loginName = I('post.loginName');
        $orderNo = I('post.ordeNo');
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
        //更改订单的状态信息
        $res = $this->updateorderStatus($orderNo);
        if($res)
        {
            //返回成功状态
            $response['code'] = '000008';
            $response['msg'] = '确认订单完成操作成功！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        
    
    }
    //更改订单的状态信息
    public function updateorderStatus($orderno)
    {
        $Orders = D('orders');
        $data['orderStatus'] = self::completeorderstatus;
        return $Orders->where(['orderNo'=>$orderno])->save($data);
    }
     //验证用户合法性
    public function checkUser($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->count();
    }
}