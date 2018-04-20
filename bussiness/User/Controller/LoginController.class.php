<?php
namespace User\Controller;
use Think\Controller;
class LoginController extends Controller 
{
  /**
   * 登录页面
   */
  public function index()
  {
       $this->display();
  }
  /**
   * 登录操作
   */
  public function dologin()
  {
       $loginName = I('post.loginName');
       $loginPwd  = I('post.loginPwd');
       $loginPwd = md5($loginPwd);
       $OffersModel = new \Common\Model\OffersModel();
       $res = $OffersModel->modelcheckuser($loginName,$loginPwd);
       if ($res) {
           $OffersModel->write_cookie($res);
           $OffersModel->save_session($res);
           $this->redirect('Home/Index/index');
       }else{
           $this->error('登录失败！');
       }
  }
  /**
   * 登出操作
   */
  public function dologinout()
  {
       setcookie(
            'JIHUOCANGGHS',
            '',
            time(),
            '/'
        );
       $this->redirect('User/Login/index');
  }
}