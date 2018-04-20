<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Admin\Model;
use Think\Model;
class PrivilegesModel extends Model{
    public $tableName = "privileges";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = [
        ['privilegeName','require','资源名称不能为空，请填写资源名称！'],
    ];
    protected $_auto=[
        ['createTime','mydate','1','callback'],
    ];
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加资源
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

}