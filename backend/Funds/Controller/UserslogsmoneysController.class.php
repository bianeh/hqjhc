<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Funds\Controller;
use Common\Controllers\BaseController;
class UserslogsmoneysController extends BaseController{
    CONST DATAFLAG=0;
    //获取微商收入资金记录
    public function getentrance()
    {   
         if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['userid'] = isset($userid) ? $userid : '';
           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $con['accessType'] = 1;
        $Data = M('logs_moneys');
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
        $orderby['moneyid']='desc';
        $list = $Data->where($con)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUserInfoById($userid);
            $list[$key]['username'] = $UserInfo['loginname'];  
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
     //获取微商支出资金记录
    public function getpay()
    {   
         if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['userid'] = isset($userid) ? $userid : '';
           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $con['accessType'] = 2;
        $Data = M('logs_moneys');
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
        $orderby['moneyid']='desc';
        $list = $Data->where($con)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUserInfoById($userid);
            $list[$key]['username'] = $UserInfo['loginname'];  
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