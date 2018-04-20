<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class MessagesController extends Controller{
   CONST DATAFLAG = 0;
   //获取公告预告信息
   public function index()
   {
        $MessageInfo = $this->getMessageInfo();
        $response['messaginfo'] = $MessageInfo;
        $response['code'] = '000008';
        $response['msg'] = '成功获取公告预告信息！';
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));
   }
    public function getMessageInfo()
    {
        $Messages = D('messages');
        return $Messages->where(['dataFlag'=>self::DATAFLAG])->select();   
    }
}