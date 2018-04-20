<?php 
namespace Users\Controller;
use \Common\Controllers\BaseController;
use Users\Model\UsersModel;
use Users\Model\UservipModel;
class IndexController extends BaseController{
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
        $Data = M('users');
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
        $orderby['userid']='desc';
        $list = $Data->where($con)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list as $key => $value) {
            $updatestaffid = $value['updatestaffid'];
            $createstaffid = $value['createstaffid'];
            if($updatestaffid != '')
            {
                $staffModel = new \Common\Model\StaffsModel();
                $res = $staffModel ->modelStaffsByid($updatestaffid);
                $list[$key]['updatestaffname'] = $res['loginname'];
            }
            else
            {
                $list[$key]['updatestaffname'] = '';
            }
            if($createstaffid != '')
            {
                $staffModel = new \Common\Model\StaffsModel();
                $res = $staffModel ->modelStaffsByid($createstaffid);
                $list[$key]['createstaffname'] = $res['loginname'];
            }
            else
            {
                $list[$key]['createstaffname'] = '';
            }

        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    /**
     * 添加微商会员
     */
    public function addUserPage()
    {   
        $this->assign("data",$this->_data);
        $this->display();
    }
    /**
     * 添加微商会员操作
     */
    public function doAddUser()
    {     
          $_POST['nickname'] = $_POST['loginName'];
          $UsersModel = new UsersModel();
          $res = $UsersModel->modelAddUser();
          if($res == 1)
          {
            $this->success("添加微商会员操作成功！");
          }
          else
          {
            $this->error($res);
          }
    }
    /**
     * 修改微商会员操作
     */
    public function doEditUser()
    {
        $UsersModel = new UsersModel();
        $res = $UsersModel->modelEditUser();
        if($res == 1)
        {
          $this->success("修改微商会员操作成功！");
        }
        else
        {
          $this->error($res);
        }
    }
    /**
     * 微商会员修改页面
     */
    public function edituserspage()
    {   
        $userid = I('get.userid');
        $UserModel = new UsersModel();
        $info = $UserModel->modelgetinfobyid($userid);
        $this->assign("info",$info);
        $this->assign("data",$this->_data);
        $this->display();
    }
    /**
     * 重置密码页面
     */
    public function resetpwdpage()
    {   
        $this->assign('data',$this->_data);
        $this->display();
    }
    /**
     * 修改用户密码
     */
    public function doResetPwd()
    {
        $data['userid'] = I('get.userid');
        $data['loginPwd'] = I('get.loginPwd');
        $UsersModel = new UsersModel();
        $res = $UsersModel->modelEditUserinfo($data);
        if($res)
        {
            $this->success('重置微商用户密码操作成功！');
        }
        else
        {
            $this->error('重置微商用户密码操作失败！');
        }
    }
    /**
     * 删除微商用户信息
     */
    public function delete()
    {
        $data['userid'] = I('get.userid');
        $data['dataFlag'] = 1;
        $UsersModel = new UsersModel();
        $res = $UsersModel->modelEditUserinfo($data);
        if($res)
        {
            $this->success('删除微商用户信息操作成功！');
        }
        else
        {
            $this->error('删除微商用户信息操作失败！');
        }
    }
    
    /**
     * 设置微商用户VIP操作
     */
    public function setvippage()
    {   
        $userid = I('get.userid');
        $this->assign('userid',$userid);
        $this->display();
    }
    //设置VIP
    public function setvip()
    {   
        $data['vip'] = $_POST['level'];
        $data['userid'] = $_POST['userid'];
        $data['vipenddate'] = $_POST['enddate'];
        
        $Users = new UsersModel();
        $Users->modelEditUserinfo($data);

        $UservipModel = new UservipModel();
        $res = $UservipModel->modelAddVip();
        
        
        if($res == 1)
        {
          $this->success("设置微商会员等级操作成功！");
        }
        else
        {
          $this->error($res);
        }
    }
    /**
     * 冻结微商用户信息
     */
    public function dozen()
    {
        $data['userid'] = I('get.userid');
        $data['userstatus'] = 1;
        $UsersModel = new UsersModel();
        $res = $UsersModel->modelEditUserinfo($data);
        if($res)
        {
            $this->success('冻结微商用户信息操作成功！');
        }
        else
        {
            $this->error('冻结微商用户信息操作失败！');
        }
    }
     /**
     * 启用微商用户信息
     */
    public function undozen()
    {
        $data['userid'] = I('get.userid');
        $data['userstatus'] = 0;
        $UsersModel = new UsersModel();
        $res = $UsersModel->modelEditUserinfo($data);
        if($res)
        {
            $this->success('启用微商用户信息操作成功！');
        }
        else
        {
            $this->error('启用微商用户信息操作失败！');
        }
    } 
}