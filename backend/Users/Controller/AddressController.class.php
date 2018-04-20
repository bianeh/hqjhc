<?php 
namespace Users\Controller;
use \Common\Controllers\BaseController;
use Users\Model\UsersModel;
class AddressController extends BaseController{
	CONST DATAFLAG = 0;
	public function __construct()
	{
		parent::__construct();
	}
    /**
     * 微商信息列表
     */
    public function index()
    {
        if ($_GET) 
        {   
           // $loginName = I('get.loginName');
           // $createTime = I('createTime');
           // $con['loginName'] = isset($loginName) ? ['like',"%".I('get.loginName')."%"] : '';
           // $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           // $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('user_address');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['addressid']='desc';
        $list = $Data->where($con)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUserInfoById($userid);
            $list[$key]['nickname'] = $UserInfo['loginname'];  
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //根据用户的id获取用户信息
    public function getUserInfoById($userid)
    {
        $Users = M('users');
        return $Users->where(['userid'=>$userid])->find();
    }
    
     //获取微商用户的id编号
    public function getUserInfo($loginName)
    {
        $Users = M('users');
        return $Users->where(['loginName'=>$loginName])->find();
    }

}