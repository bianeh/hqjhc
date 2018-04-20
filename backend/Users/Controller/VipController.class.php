<?php 
namespace Users\Controller;
use \Common\Controllers\BaseController;
use Users\Model\UsersModel;
use Users\Model\UservipModel;
class VipController extends BaseController{
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
           $loginName = I('get.loginName');
           $createTime = I('createTime');
           $nickname = I('get.nickname');
           $con['loginName'] = isset($loginName) ? ['like',"%".I('get.loginName')."%"] : '';
           $con['nickname'] = isset($nickname) ? ['like',"%".I('get.nickname')."%"] : '';
           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('user_vip');
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
        $list = $Data->where($con)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UsersModel = new UsersModel();
            $info = $UsersModel->modelgetinfobyid($userid);
            $list[$key]['loginname'] = $info['loginname'];

        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
}