<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class VipsetinfoController extends Controller{
    //获取VIP购买设置信息
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
       
       
        $Vipset = D('vipset');
        $vipinfo = $Vipset->select();
        $response['code'] = '000008';
        $response['msg'] = 'vip购买设置信息！';
        $response['vipsetinfo'] = $vipinfo;
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));
    }
    
    //验证用户信息
   public function checkUserInfo($loginName)
   {
       $Users = D('users');
       return $Users->where(['loginName'=>$loginName])->count();
   }
}
