<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class OrderdeleteController extends Controller{
    //删除已取消订单
    public function index()
    {
        $loginName = I('post.loginName');
        $orderno = I('post.orderno');
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
        $res = $this->delete($orderno);   
        if($res)
        {
             $response['code'] = '000008';
             $response['msg'] = '成功删除订单！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
        }
    }
    
     //验证用户合法性
    public function checkUser($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->count();
    }
    //删除订单
    public function delete($orderno)
    {
        $Orders = D('orders');
        $data['dataFlag'] = 1;
        return $Orders->where(['orderNo'=>$orderno])->save($data);
    }
}
