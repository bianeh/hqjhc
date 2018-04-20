<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Order\Model;
use Think\Model;
class OrdersModel extends Model
{   CONST DATAFLAG = 0;
    public $tableName = "orders";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
         array("loginPwd","md5",3,"function"),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
   //获取订单信息
   public function modelgetorderinfo()
   {
       $Orders = D('orders');
       $Orders->where(['dataFlag'=>self::DATAFLAG])->select();
   }
   //修改订单信息
   public function modelupdateorderinfo(array $data,$orderno)
   {
       $Orders = D('orders');
       return $Orders->where(['orderNo'=>$orderno])->save($data);
   }
   //修改订单状态
   public function modelupdateorderstatus(array $data,$orderno)
   {
       $Orders = D('orders');
       return $Orders->where(['orderNo'=>$orderno])->save($data);
   }
}