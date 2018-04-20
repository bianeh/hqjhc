<?php 
namespace Offers\Controller;
use \Common\Controllers\BaseController;
use Offers\Model\OffersModel;
class IndexController extends BaseController{
	CONST DATAFLAG = 0;
	public function __construct()
	{
		parent::__construct();
	}
    /**
     * 供货商信息列表
     */
    public function index()
    {
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $createTime = I('createTime');
           $con['loginName'] = isset($loginName) ? ['like',"%".I('get.loginName')."%"] : '';
           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('offers');
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
        $orderby['offerid']='desc';
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
     * 添加供货商页面
     */
    public function addOffersPage()
    {
    	$this->display();
    }
    /**
     * 添加供货商操作
     */
    public function doAddOffers()
    {   

        $OffersModel = new OffersModel();
        $res = $OffersModel->modelAddOffer();
        if($res == 1)
        {
        	$this->success('成功添加供货商!');
        }
        else
        {
        	$this->error($res);
        }
    }
    /**
     * 编辑供货商信息页面
     */
    public function editOfferspage()
    {
    	$offerid = I('get.offerid');
    	$OffersModel = new OffersModel();
    	$info = $OffersModel->modelgetinfobyid($offerid);
    	$this->assign('info',$info);
    	$this->assign('data',$this->_data);
    	$this->display();
    }
    /**
     * 编辑供货商信息操作
     */
    public function doEditOffers()
    {
    	$OffersModel = new OffersModel();
        $res = $OffersModel->modelEditOffer();
        if($res == 1)
        {
        	$this->success('成功修改供货商!');
        }
        else
        {
        	$this->error($res);
        }
    }
    /**
     * 重置供货商密码
     */
    public function resetpwdpage()
    {   
    	$offerid = I('get.offerid');
    	$OffersModel = new OffersModel();
    	$info = $OffersModel->modelgetinfobyid($offerid);
    	$this->assign('info',$info);
    	$this->assign('data',$this->_data);
    	$this->display();

    }
    /**
     * 重置密码操作
     */
    public function doResetPwd()
    {
    	$OffersModel = new OffersModel();
        $res = $OffersModel->modelEditOffer();
        if($res == 1)
        {
        	$this->success('成功修改密码!');
        }
        else
        {
        	$this->error($res);
        }
    }
    /**
     * 删除供货商信息
     */
    public function delete()
    {
        $data['offerid'] = I('get.offerid');
        $data['dataFlag'] = 1;
        $OffersModel = new OffersModel();
        $res = $OffersModel->modeldelete($data);
        if($res)
        {
            $this->success("删除供货商信息操作成功！");
        }
        else
        {
            $this->error("删除供货商信息操作失败！");
        }

    }
}