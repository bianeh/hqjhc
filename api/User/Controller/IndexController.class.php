<?php
namespace User\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	  $username = $_POST['username'];
    	  $password = $_POST['password'];
    	  $User = M("offers");
    	  $count = $User->where(['loginName'=>$username])->count();
    	  if($count == 1)
    	  {
    	  	 $data['msg'] = '成功登陆';
    	  	 $data['code'] = 1;
    	  }
    	  else
    	  {
    	  	 $data['msg'] = '用户名或密码不正确';
    	  	 $data['code'] = 0;
    	  }
    	  header('Content-type:text/html; Charset=utf8');  
          header( "Access-Control-Allow-Origin:*");  
          header('Access-Control-Allow-Methods:POST');    
          header('Access-Control-Allow-Headers:x-requested-with,content-type');
    	  die(json_encode($data));
        }
}