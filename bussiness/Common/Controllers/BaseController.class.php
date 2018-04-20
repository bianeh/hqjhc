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
         
        $OffersModel = new \Common\Model\OffersModel();
        $sess_result =  $OffersModel->init_sess_info();
        if(isset($sess_result) && $sess_result){
            $data = $OffersModel->modelOffersByid($sess_result['offerid']);
            //更新session
            $OffersModel->save_session($data);
            //更新cookie
            $OffersModel->write_cookie($data);
            $this->_data = $data;
        }else{
            $this->redirect('User/Login/index');
        	// $this->error('请先进行登录！',U('Offers/Login/index'));
        }
    
    }

}
?>
