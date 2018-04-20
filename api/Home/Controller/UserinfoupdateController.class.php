<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class UserinfoupdateController extends Controller{
    //绑定手机号码
    public function bindmobile()
    {   
        $loginName = I('post.loginName');
        $mobile = I('post.mobile');
        $code = I('post.code');
        $msgcode = $this->getMessageCode($mobile);
        if($msgcode != $code)
        {
            $response['code'] = '000007';
            $response['msg'] = '你输入的短信验证码不正确！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        $res = $this->bindphone($mobile,$loginName);
//        if($res)
//        {
            $response['code'] = '000008';
            $response['msg'] = '绑定手机号成功！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
//        }
        
    }
    //获取短信
    public function getMessageCode($mobile)
    {
        $MobileMessage = D('mobile_message');
        $R = $MobileMessage->where(['mobile'=>$mobile])->order(['id'=>'desc'])->find();
        return $R['code'];
    }
    public function bindphone($mobile,$loginName)
    {   
        $Users = D('users');
        $data['userphone'] = $mobile;
        return $Users->where(['loginName'=>$loginName])->save($data);
    }
}
