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
       $loginPwd  = md5(I('post.loginPwd'));
       $StaffsModel = new \Common\Model\StaffsModel();
       $stffs = $StaffsModel ->modelStaffsByname($loginName);
       $res = $StaffsModel->modelcheckuser($loginName,$loginPwd);
       if ($res) {
           $data['staffid'] = $stffs['stffid'];
           $data['loginTime'] = date("Y-m-d H:i:s");
           $data['loginIp'] = $_SERVER['REMOTE_ADDR'];
           $staffslogins = D('logs_staffs_logins');
           $staffslogins->add($data);
           $StaffsModel->write_cookie($res);
           $StaffsModel->save_session($res);
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
            'JIHUOCANGADMIN',
            '',
            time(),
            '/'
        );
       $this->redirect('User/Login/index');
  }
}