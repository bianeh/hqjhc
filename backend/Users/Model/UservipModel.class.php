<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Users\Model;
use Think\Model;
class UservipModel extends Model
{   CONST DATAFLAG = 0;
    public $tableName = "user_vip";
    public function __construct() 
    {
        parent::__construct();
    }
    protected $_validate = array(
         array('level','require','vip等级不能为空，请选择用户的vip等级！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 设置VIP等级
     */
   public function modelAddVip()
    {   
        $UsersVip = D('user_vip');
        if(!$UsersVip->create())
        {
            return $UsersVip->getError();
        }
        else 
        {
            $UsersVip->add();
            return 1;
        }
    }
    /**
     * 修改微商用户
     */
   public function modelEditUser()
    {   
        $Users = D('users');
        if(!$Users->create())
        {
            return $Users->getError();
        }
        else 
        {
            $Users->save();
            return 1;
        }
    }
    /**
     * 根据微商用户的ID获取用户信息
     */
    public function modelgetinfobyid($userid)
    {
        $User = D('users');
        return $User->where(['userid'=>$userid,'dataFlag'=>self::DATAFLAG])->find();
    }
    /**
     * 修改微商用户信息操作
     */
    public function modelEditUserinfo(array $data)
    {
        $User = D('users');
        return $User->save($data);
    }
}