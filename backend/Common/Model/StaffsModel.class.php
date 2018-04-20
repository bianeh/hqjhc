<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Common\Model;
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
    ];
    protected $_auto=[
        ['createTime','mydate','1','callback'],
        ['loginPwd','md5','3','function'],
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
     * 根据管理员昵称获取管理员信息
     */
    public function modelStaffsByname($loginName)
    {
        $Staffs = D('staffs');
        $res = $Staffs->where(['loginName'=>$loginName])->find();
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
    /**
     * 验证管理员信息是否正确
     */
    public function modelcheckuser($loginName,$loginPwd)
    {
        $Staffs = D('staffs');
        return $Staffs->where(['loginName'=>$loginName,'loginPwd'=>$loginPwd])->find();

    }
    /**
     * 保存cookie信息
     * @param $data
     */
    public function write_cookie(array $data)
    {  
        $cookie_data = array(
            'stffid' => $data['stffid'],
            'loginName' => $data['loginname'],
        );
        $cookie_value = json_encode($cookie_data);
        setcookie(
            'JIHUOCANGADMIN',
            $cookie_value,
            time() + 14000000,
            '/'
        );
    }

    /**
     * 保存session信息
     * @param $data
     */
    public function save_session(array $data)
    {

        $sess_key = md5('SESSIONTOKEN-' . $data['stffid']);
        $_SESSION[$sess_key] = $data;
    }
    public function init_sess_info(){
        if (isset($_COOKIE['JIHUOCANGADMIN']) && $_COOKIE['JIHUOCANGADMIN']) {
            $cookie_data = json_decode($_COOKIE['JIHUOCANGADMIN'],true);
            if (isset($cookie_data['stffid']) && $cookie_data['stffid']) {
                //获取登录session信息
                $sess_key = md5('SESSIONTOKEN-' . $cookie_data['stffid']);
                $sess_info = session($sess_key);
                if (isset($sess_info) && $sess_info){
                    return $sess_info;
                }
            }
        }
        return false;
    }
}