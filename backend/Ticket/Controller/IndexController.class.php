<?php
namespace Ticket\Controller;
use \Common\Controllers\BaseController;
use Ticket\Model\TicketModel;
class IndexController extends BaseController {
    CONST DATAFLAG = 0;
    public function index(){
        if ($_GET) 
        {   
           $ticketName = I('get.ticketName');
           $createTime = I('createTime');
           $con['ticketName'] = isset($ticketName)&&!empty($ticketName) ? ['like',"%".I('get.ticketName')."%"] : '';
           $con['createTime'] = isset($createTime)&&!empty($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('ticket');
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
        $orderby['ticketid']='desc';
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
     * 添加优惠券页面
     */
    public function addTicketPage()
    {   
    	$this->assign('data',$this->_data);
    	$this->display();
    }
    /**
     * 修改优惠券页面
     */
    public function editTicketPage()
    {   
    	$ticketid = I('get.ticketid');
    	$TicketModel = new TicketModel();
    	$info = $TicketModel->modelgetticketinfobyid($ticketid);
    	$this->assign('info',$info);
    	$this->assign('data',$this->_data);
    	$this->display();
    }
    /**
     * 添加优惠券
     */
    public function doAddTicket()
    {
    	$TicketModel = new TicketModel();
    	$res = $TicketModel->modeladdticket();
    	if($res == 1)
    	{
    		$this->success("添加优惠券操作成功！");
    	}
    	else
    	{
    		$this->error($res);
    	}
    }
    /**
     * 修改优惠券信息
     */
    public function doEditTicket()
    {
    	$TicketModel = new TicketModel();
    	$res = $TicketModel->modeleditticket();
    	if($res == 1)
    	{
    		$this->success("修改优惠券操作成功！");
    	}
    	else
    	{
    		$this->error($res);
    	}
    }
    /**
     * 删除优惠券
     */
    public function delete()
    {
    	$data['ticketid'] = I('get.ticketid');
    	$data['dataFlag'] = 1;
    	$TicketModel = new TicketModel();
    	$res = $TicketModel->modeldelete($data);
    	if($res)
    	{
    		$this->success('删除优惠券操作成功！');
    	}
    	else
    	{
    		$this->error('删除优惠券操作失败！');
    	}
    }
}