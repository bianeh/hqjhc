<?php
namespace Message\Controller;
use \Common\Controllers\BaseController;
use Message\Model\WebnotifyModel;
class WebnotifyController extends BaseController{
        CONST DATAFLAG = 0;
	public function index()
	{       
            if ($_GET) 
            {   
               $messageTitle = I('get.title');
               $createTime = I('createTime');
               $con['title'] = isset($title)&&!empty($title) ? ['like',"%".I('get.title')."%"] : '';
               $con['createTime'] = isset($createTime)&&!empty($createTime) ? ['gt',$createTime] : '';
               $con = array_filter($con);
            }
            $con['dataFlag'] = self::DATAFLAG;
            $Data = M('web_notify');
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
            $orderby['id']='desc';
            $list = $Data->where($con)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
            foreach ($list as $key => $value) {
                $createstaffid = $value['createstaffid'];
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
	 * 后台添加站内信页面
	 */
	public function addWebnotifyPage()
	{
		$this->display();
	}
	/**
	 * 后台添加站内信操作
	 */
	public function doAddWebnotify()
	{
		$WebnotifyModel = new WebnotifyModel();
		$R = $WebnotifyModel->modelAddWebnotify();
		if($R == 1)
		{
			$this->success('添加站内信操作成功！');
		}else
		{
			$this->error($R);
		}	
	}
        /**
         * 删除站内信息
         */
        public function delete()
        {
            $id = I('get.id');
            $Webnotify = new WebnotifyModel();
            $data['id'] = $id;
            $data['dataFlag'] = 1;
            $res = $Webnotify->modeldelete($data);
            if($res)
            {
                $this->success('删除站内信息操作成功！');
            }
            else{
                $this->error('删除站内信息操作失败！');
            }
        }
}