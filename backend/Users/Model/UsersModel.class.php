<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Users\Model;
use Think\Model;
class UsersModel extends Model
{   CONST DATAFLAG = 0;
    public $tableName = "users";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
         array('loginName','require','微商昵称不能为空，请填写微商昵称！'),
         array('offerName','require','微商姓名不能为空，请填写微商姓名！'),
         array('userphone','require','微商手机号码不能为空，请填写手机号码！'),
         array('loginName','','微商昵称已经存在！',0,'unique',1),
         array('useremail','email','Email格式错误！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
         array("loginPwd","md5",1,"function"),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加微商用户
     */
   public function modelAddUser()
    {   
        $Users = D('users');
        if(!$Users->create())
        {
            return $Users->getError();
        }
        else 
        {
            $Users->add();
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