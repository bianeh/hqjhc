<?php
namespace Message\Controller;
use \Common\Controllers\BaseController;
use Message\Model\MessagesModel;
class IndexController extends BaseController 
{   
    CONST DATAFLAG = 0;
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * 消息列表
     */
    public function index()
    {   
        if ($_GET) 
        {   
           $messageTitle = I('get.messageTitle');
           $createTime = I('createTime');
           $con['messageTitle'] = isset($messageTitle)&&!empty($messageTitle) ? ['like',"%".I('get.messageTitle')."%"] : '';
           $con['createTime'] = isset($createTime)&&!empty($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('messages');
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
        $orderby['messageid']='desc';
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
     * 添加文章页面
     */
    public function addMessagePage()
    {         
        $this->assign('data',$this->_data);
        $this->display();
    }
    /**
     * 添加消息
     */
    public function doAddMessage()
    {   
        $MessagesModel = new MessagesModel();
        $res = $MessagesModel->modelAddMessage();
        if($res == 1)
        {
            $this->success('消息添加操作成功！');
        }else
        {
            $this->error($res);
        }
    }
    /**
     * 修改消息页面
     */
    public function editMessagepage()
    {  
        $messageid = I('get.messageid');
        $MessagesModel = new MessagesModel();
        $info = $MessagesModel->modelgetmessagebyid($messageid);
        $this->assign('info',$info);
        $this->assign('data',$this->_data);
        $this->display();
    }
    /**
     * 修改消息操作
     */
    public function doEditMessage()
    {
        $MessagesModel = new MessagesModel();
        $res = $MessagesModel->modelEditmessage();
        if($res == 1)
        {
            $this->success('消息修改操作成功！');
        }else
        {
            $this->error($res);
        }

    }
    /**
     * 删除消息
     */
    public function delete()
    {
        $data['messageid'] = I('get.messageid');
        $data['updatestaffid'] = $this->_data['stffid'];
        $data['dataFlag'] = 1;
        $MessagesModel = new MessagesModel();
        $res = $MessagesModel->modeldelete($data);
        if($res)
        {
            $this->success("删除消息操作成功！");
        }
        else
        {
            $this->error("删除消息操作失败！");
        }
    }
}