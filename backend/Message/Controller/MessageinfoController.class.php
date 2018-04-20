<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Message\Controller;
use Common\Controllers\BaseController;
use Message\Model\MobilemessageModel;
class MessageinfoController extends BaseController
{
        CONST DATAFLAG = 0;
	public function index()
	{       
            if ($_GET) 
            {   
               $mobile = I('get.mobile');
               $createTime = I('createTime');
               $con['mobile'] = isset($mobile)&&!empty($mobile) ? $mobile : '';
               $con['createTime'] = isset($createTime)&&!empty($createTime) ? ['gt',$createTime] : '';
               $con = array_filter($con);
            }
            $con['dataFlag'] = self::DATAFLAG;
            $Data = M('mobile_message');
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
}
