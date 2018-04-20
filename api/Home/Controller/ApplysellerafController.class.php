<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class ApplysellerafController extends Controller{
    //申请售后
    public function index()
    {
        $orderno = I('post.orderNo');
        $loginName = I('post.loginName');
        $type = I('post.type');
        $info = I('post.info');
        //验证用户的合法性
        $count = $this->checkUser($loginName);
        if($count != 1)
        {
            $response['code'] = '000001';
            $response['msg'] = '没有此用户！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        //获取用户信息
        $UserInfo = $this->getUserInfo($loginName);
        $userid = $UserInfo['userid'];
        if(!$orderno)
        {
            $response['code'] = '000002';
            $response['msg'] = '订单号必须存在！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }       
        if(!$type)
        {
            $response['code'] = '000003';
            $response['msg'] = '售后类型必须存在！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        if(!$info)
        {
            $response['code'] = '000004';
            $response['msg'] = '售后原因必须填写！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        //添加售后申请内容
        $orders_info['orderNo'] = $orderno;
        $orders_info['type'] = $type;
        $orders_info['userid'] = $userid;
        $orders_info['info'] = $info;
        $res = $this->addorderaf($orders_info);
        if($res)
        {
            $response['code'] = '000008';
            $response['msg'] = '售后申请成功！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
    }
    //添加售后信息
    public function addorderaf(array $data)
    {
        $Orders_af = D('orders_af');
        return $Orders_af->add($data);
    }
    //验证用户的合法性
    public function checkUser($loginName)
    {
       $Users = D('users');
       return $Users->where(['loginName'=>$loginName])->count();
    }
    //获取用户的信息
    public function getUserInfo($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->find();
    }
}

