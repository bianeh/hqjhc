<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Funds\Controller;
use Common\Controllers\BaseController;
class RechargeController extends BaseController{
    CONST ADMINDATASRC = 3;
    CONST SUCCESSSTATUS = 1;
    CONST DATAFLAG = 0;
    CONST ADMINmoneyType = 1;
    CONST accessType = 1;
    //微商充值记录列表
    public function index()
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
        $Data = M('recharge');
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
    //微商用户充值页面
    public function rechargeUserPage()
    {
        $this->display();
    }
    public function doRechargeUser()
    {
        $loginName = I('post.loginName');
        $amount = floatval(I('post.amount'));
        $remarks = I('post.remarks');
        if(!$loginName)
        {
            $this->error("请输入微商用户昵称！");
        }
        if(!$amount)
        {
            $this->error('请输入充值金额！');
        }
        $Infocount = $this->checkUserInfo($loginName);
        if($Infocount < 1 )
        {
            $this->error("没有此用户！");
        }
        $UserInfo = $this->getUserInfo($loginName);
        $userid = $UserInfo['userid'];
        $data['examount'] = $UserInfo['usermoney'];
        $data['userid'] = $userid;
        $data['amount'] = $amount;
        $data['remarks'] = $remarks;
        $data['datasrc'] = self::ADMINDATASRC;
        $data['createTime'] = date("Y-m-d H:i:s",time());
        $data['status'] = self::SUCCESSSTATUS;
        $data['orderNo'] = $this->create_order_no();
        $logs_moneys['amount'] = $amount;
        $logs_moneys['moneyType'] = 1;
        $logs_moneys['accessType'] = 1;
        $logs_moneys['orderNo'] = $data['orderNo'];
        $logs_moneys['datasource'] = 3;
        $logs_moneys['createTime'] = date("Y-m-d H:i:s",time());;
        $logs_moneys['userid'] = $userid;
        $logs_moneys['otherOrderno'] = $data['orderNo'];
        $Fundsinfo['userMoney'] = $data['examount'] + $amount;
        $this->updateUserfundsInfo($userid,$Fundsinfo);
        $Recharge = M('recharge');
        $Logs_Recharge = M('logs_recharge');
        $Logs_Moneys = M('logs_moneys');
        $Recharge->add($data);
        $res = $Logs_Recharge->add($data);
        $Logs_Moneys->add($logs_moneys);
        if($res)
        {
            $this->success('手动充值成功！');
        }
        
        
    }
    //更新用户的可用余额
    public function updateUserfundsInfo($userid,$Fundsinfo)
    {
         $Users = M('users');
         return $Users->where(['userid'=>$userid])->save($Fundsinfo);
    }
    //核对微商用户
    public function checkUserInfo($loginName)
    {
        $Users = M('users');
        return $Users->where(['loginName'=>$loginName])->count();
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
     /**
     * 生成订单号
     * @return string
     */
    public function create_order_no()
    {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}

