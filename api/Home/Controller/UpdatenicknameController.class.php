<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class UpdatenicknameController extends Controller
{
    //修改昵称
    public function index()
    {
        //修改昵称
        $loginName = I('post.loginName');
        $nickName = I('post.nickName');
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
        if($nickName)
        {
            $data['nickname'] = $nickName;
            $res = $this->updateoperate($data,$loginName);
            if($res)
            {
                $response['code'] = '000008';
                $response['msg'] = '成功修改昵称！';
                header('Content-type:text/html; Charset=utf8');  
                header( "Access-Control-Allow-Origin:*");  
                header('Access-Control-Allow-Methods:POST');    
                header('Access-Control-Allow-Headers:x-requested-with,content-type');
                die(json_encode($response));
            }
        }
        else
        {
                $response['code'] = '000005';
                $response['msg'] = '修改昵称失败！';
                header('Content-type:text/html; Charset=utf8');  
                header( "Access-Control-Allow-Origin:*");  
                header('Access-Control-Allow-Methods:POST');    
                header('Access-Control-Allow-Headers:x-requested-with,content-type');
                die(json_encode($response));
        }
        
    }
    //修改操作
    public function updateoperate(array $data,$loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->save($data);
    }
    //检验用户的合法性
    public function checkUser($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->count();
    }
}
