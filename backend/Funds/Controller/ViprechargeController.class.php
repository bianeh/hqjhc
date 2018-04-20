<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Funds\Controller;
use Common\Controllers\BaseController;
class ViprechargeController extends BaseController{
    CONST DATAFLAG = 0;
    //微商购买vip记录列表
    public function index()
    {   
       
         if ($_GET) 
        {   
//           $loginName = I('get.loginName');
//           $UserInfo = $this->getUserInfo($loginName);
//           $userid = $UserInfo['userid'];
//           $createTime = I('createTime');
//           $con['userid'] = isset($userid) ? $userid : '';
//           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
//           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('viprecharge');
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
        $orderby['rechargeid']='desc';
        $list = $Data->where($con)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        
        foreach ($list as $key => $value) {
            $createstaffid = $value['createstaffid'];
            $userid = $value['userid'];
            $UserInfo = $this->getUserInfoById($userid);
            $list[$key]['username'] = $UserInfo['loginname'];  
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
    
     //获取微商用户的id编号
    public function getUserInfo($loginName)
    {
        $Users = M('users');
        return $Users->where(['loginName'=>$loginName])->find();
    }
    //根据用户的id获取用户信息
    public function getUserInfoById($userid)
    {
        $Users = M('users');
        return $Users->where(['userid'=>$userid])->find();
    }
}

