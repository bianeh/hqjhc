<?php
namespace Common\Controllers;
use \Think\Controller;
class BaseController extends Controller {
    public $_data = array();
    public function __construct()
    {
        parent::__construct();
        $this->init_user_info();
        $this->assign('data',$this->_data);
    }
    /**
     * 初始化加载用户信息
     */
    private function init_user_info()
    { 
        $StaffsModel = new \Common\Model\StaffsModel();
        $sess_result =  $StaffsModel->init_sess_info();
        if(isset($sess_result) && $sess_result){
            $data = $StaffsModel->modelStaffsByid($sess_result['stffid']);
            //更新session
            $StaffsModel->save_session($data);
            //更新cookie
            $StaffsModel->write_cookie($data);
            $this->_data = $data;
        }else{
            $this->redirect('User/Login/index');
        }
    }
}
?>
