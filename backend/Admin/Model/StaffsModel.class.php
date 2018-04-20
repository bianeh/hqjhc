<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Admin\Model;
use Think\Model;
class StaffsModel extends Model{
    public $tableName = "staffs";
    public $tablePrefix = 'hqjhc_';
    public $trueTableName = 'hqjhc_staffs';
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = [
        ['loginPwd','require','密码不能为空，请填写密码！'],
        ['loginName','require','账号不能为空，请填写账号！'],
//        ['loginName','3,50','账号长度不符，请重新设置密码！',3,'length'],
//        ['loginPwd','5,50','密码长度不符，请重新设置账号！',3,'length'],
    ];
    protected $_auto=[
        ['createTime','mydate','1','callback'],
    ];
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加管理员
     */
    public function modelAddstaffs()
    { 
        $Staffs = D('staffs');
        if(!$Staffs->create())
        {
            return $Staffs->getError();
        }
        else 
        {
            $Staffs->add();
            return 1;
        }
    }
     /**
     * 修改管理员
     */
    public function modelEditstaffs()
    {
        $Staffs = D('staffs');
        if(!$Staffs->create())
        {
            return $Staffs->getError();
        }
        else 
        {
            $Staffs->save();
            return 1;
        }
    }
    /**
     * 获取管理员信息
     */
    public function modelStaffs()
    {
        $Staffs = D('staffs');
        $res = $Staffs->select();
        if($res)
        {
            return $res;
        }
        else
        {
            return false;
        }
    }
    /**
     * 根据id获取管理员信息
     */
    public function modelStaffsByid($stffid)
    {
        $Staffs = D('staffs');
        $res = $Staffs->where(['stffid'=>$stffid])->find();
        return $res;
    }
    /**
     * 删除管理员信息
     */
    public function modeldelete($stffid)
    {   
        $Staffs = D('staffs');
        return $Staffs->where(['stffid'=>$stffid])->delete();
    }  
}