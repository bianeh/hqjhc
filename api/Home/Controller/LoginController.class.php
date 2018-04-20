<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller{
    CONST USERSTATUS = 0;
    CONST DATAFLAG = 0;
    public function index()
    {
        $loginName = I('post.loginName');
        $userForm = intval(I('post.userForm'));
        $loginMsgCode = I('post.loginMsgCode');
        $userphoto = I('post.userphoto');
        $nickname = I('post.nickname');
        if(!$nickname)
        {
            $nickname = $loginName;
        }
        if(!$loginName)
        {
                $response['code'] = '000006';
                $response['msg'] = '请输入登录名！';
                header('Content-type:text/html; Charset=utf8');  
                header( "Access-Control-Allow-Origin:*");  
                header('Access-Control-Allow-Methods:POST');    
                header('Access-Control-Allow-Headers:x-requested-with,content-type');
                die(json_encode($response));
        }
        if(!$userForm && $userForm != 0)
        {
                $response['code'] = '000005';
                $response['msg'] = '请输入登录方式！';
                header('Content-type:text/html; Charset=utf8');  
                header( "Access-Control-Allow-Origin:*");  
                header('Access-Control-Allow-Methods:POST');    
                header('Access-Control-Allow-Headers:x-requested-with,content-type');
                die(json_encode($response));
        }
        if($userForm == 0)
        {
               if(!$loginMsgCode)
               {
                   $response['code'] = '000004';
                   $response['msg'] = '请输入短信验证码！';
                   header('Content-type:text/html; Charset=utf8');  
                   header( "Access-Control-Allow-Origin:*");  
                   header('Access-Control-Allow-Methods:POST');    
                   header('Access-Control-Allow-Headers:x-requested-with,content-type');
                   die(json_encode($response));
               }
        }
        //当手机短信登录的时候需要验证短信验证码是否正确
        if($userForm == 0)
        {
            
            $msgcode = $this->getMessageCode($loginName);
            if($loginMsgCode != $msgcode)
            {
                $response['code'] = '000007';
                $response['msg'] = '你输入的短信验证码不正确！';
                $response['msgcode'] = $msgcode;
                header('Content-type:text/html; Charset=utf8');  
                header( "Access-Control-Allow-Origin:*");  
                header('Access-Control-Allow-Methods:POST');    
                header('Access-Control-Allow-Headers:x-requested-with,content-type');
                die(json_encode($response));
            }
        }
        $count = $this->checkRegUser($loginName);
        $UserInfo = $this->getUserinfoByuserName($loginName);
        if($count == 1)
        {   
            $data['lastTime'] = date("Y-m-d H:i:s",time());
            $data['lastIp'] = $_SERVER['REMOTE_ADDR'];
            $data['userPhoto'] = $userphoto;
            $Users = D('users');
            $Users->save($data);
            $logs['userid'] = $UserInfo['userid'];
            $logs['loginTime'] = date("Y-m-d H:i:s",time());
            $logs['loginip'] = $_SERVER['REMOTE_ADDR'];
            $this->login_log($logs);
            $response['code'] = '000008';
            $response['msg'] = '成功操作成功！';
        }
        else {
            $data['loginName'] = $loginName;
            $data['userForm'] = $userForm;
            $data['userPhoto'] = isset($userphoto) ? $userphoto : '';
            $data['createTime'] = date("Y-m-d H:i:s",time());
            $data['lastTime'] = date("Y-m-d H:i:s",time());
            $data['lastIp'] = $_SERVER['REMOTE_ADDR'];
            $data['nickname'] = $nickname;
            $Users = D('users');
            $res = $Users->add($data);
            if($res)
            {   
                $logs['userid'] = $UserInfo['userid'];
                $logs['loginTime'] = date("Y-m-d H:i:s",time());
                $logs['loginip'] = $_SERVER['REMOTE_ADDR'];
                $this->login_log($logs);
                $response['code'] = '000008';
                $response['msg'] = '成功操作成功！';
            }
        }
        $response['userinfo'] = $UserInfo;
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));
    }
    //登录日志
    public function login_log(array $data)
    {
        $Logs = D('logs_user_logins');
        return $Logs->add($data);
    }
    //判断用户有没有注册过
    public function checkRegUser($loginName)
    {
        $Users = D('users');
        return $Users ->where(['loginName'=>$loginName,'userstatus'=>self::USERSTATUS,'dataFlag'=>self::DATAFLAG])->count();
    }
    //根据用户名称获取用户信息
    public function getUserinfoByuserName($loginName)
    {
         $Users = D('users');
         return $Users->where(['loginName'=>$loginName])->find();
    }
    //获取短信
    public function getMessageCode($mobile)
    {
        $MobileMessage = D('mobile_message');
        $R = $MobileMessage->where(['mobile'=>$mobile,'dataFlag'=>0])->order(['id'=>'desc'])->find();
        return $R['code'];
    }
}
