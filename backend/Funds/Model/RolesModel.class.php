<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Admin\Model;
use Think\Model;
class RolesModel extends Model{
    public $tableName = "roles";
    public $tablePrefix = 'hqjhc_';
    public $trueTableName = 'hqjhc_roles';
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = [
        ['roleName','require','部门名称不能为空，请填写部门名称！'],
    ];
    protected $_auto=[
        ['createTime','mydate','1','callback'],
    ];
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加部门
     */
    public function modelAddroles()
    {
        $Staffs = D('roles');
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
     * 修改部门信息
     */
    public function modelEditroles()
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