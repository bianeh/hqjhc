<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Orderaf\Model;
use Think\Model;
class OrdersafModel extends Model
{   
    CONST DATAFLAG = 0;
    public $tableName = "orders_af";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    //更新退货状态
    public function model_update_return_status($id,array $data)
    {
         $Ordersaf = D('orders_af');
         return $Ordersaf->where(['id'=>$id])->save($data);
    }
    //更新漏货状态
    public function model_update_leak_status($id,array $data)
    {
        $Ordersaf = D('orders_af');
        return $Ordersaf->where(['id'=>$id])->save($data);
    }
}