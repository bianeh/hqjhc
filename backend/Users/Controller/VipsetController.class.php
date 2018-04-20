<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Users\Controller;
use Common\Controllers\BaseController;
use Users\Model\VipsetModel;
class VipsetController extends BaseController
{  
    CONST DATAFLAG = 0;
    //会员设置信息
    public function index()
    {
        if ($_GET) 
        {   
//           $loginName = I('get.loginName');
//           $createTime = I('createTime');
//           $nickname = I('get.nickname');
//           $con['loginName'] = isset($loginName) ? ['like',"%".I('get.loginName')."%"] : '';
//           $con['nickname'] = isset($nickname) ? ['like',"%".I('get.nickname')."%"] : '';
//           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
//           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('vipset');
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
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //会员设置信息页面
    public function vipsetpage()
    {
        $this->display();
    }
    //会员设置编辑页面
    public function editvipsetpage()
    {   
        $id = I('get.id');
        $VipsetModel = new VipsetModel;
        $vipsetInfo = $VipsetModel->getvipsetInfobyId($id);
        $this->assign('vipsetinfo',$vipsetInfo);
        $this->display();
    }
    //会员设置编辑操作
    public function doeditvipset()
    {
        $VipsetModel = new VipsetModel;
        $res = $VipsetModel->modelEditvipset();
        if($res == 1)
         {
            $this->success("修改微商会员设置操作成功！");
         }
          else
          {
            $this->error($res);
          }
    }
    //会员设置信息操作
    public function dovipset()
    {
        $VipsetModel = new VipsetModel;
        $res = $VipsetModel->modelAddvipset();
        if($res == 1)
         {
            $this->success("添加微商会员设置操作成功！");
         }
          else
          {
            $this->error($res);
          }
    }
}

