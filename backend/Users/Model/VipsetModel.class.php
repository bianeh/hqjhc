<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Users\Model;
use Think\Model;
class VipsetModel extends Model
{   CONST DATAFLAG = 0;
    public $tableName = "vipset";
    public function __construct() 
    {
        parent::__construct();
    }
    protected $_validate = array(
         array('level','require','vip等级不能为空，请选择vip等级！'),
         array('name','require','名称标题不能为空，请填写名称标题！'),
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
   public function modelAddvipset()
    {   
        $Vipset = D('vipset');
        if(!$Vipset->create())
        {
            return $Vipset->getError();
        }
        else 
        {
            $Vipset->add();
            return 1;
        }
    }
     /**
     * 设置VIP等级
     */
   public function modelEditvipset()
    {   
        $Vipset = D('vipset');
        if(!$Vipset->create())
        {
            return $Vipset->getError();
        }
        else 
        {
            $Vipset->save();
            return 1;
        }
    }
    /**
     * 根据vip设置id来获取vip设置信息
     */
    public function getvipsetInfobyId($id)
    {
        $Vipset = D('vipset');
        return $Vipset->where(['id'=>$id])->find();
    }
}