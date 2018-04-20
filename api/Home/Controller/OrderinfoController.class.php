<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class OrderinfoController extends Controller
{  
   CONST DATAFLAG = 0;
   public function getorderinfo()
   {
       $loginName = I('post.loginName');
       $count = $this->checkUser($loginName);
       if($count != 1)
        {
            $response['code'] = '000006';
            $response['msg'] = '不存在改用户！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
       $UserInfo = $this->getUserinfoByuserName($loginName);
       $userid = $UserInfo['userid'];
       $OrderInfo = $this->orderinfo($userid);
       if($OrderInfo){
            $response['code'] = '000008';
            $response['msg'] = '成功获取数据！';
            $response['orderinfo'] = $OrderInfo;
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
       }else{
            $response['code'] = '000009';
            $response['msg'] = '获取数据失败！';
            $response['orderinfo'] = $OrderInfo;
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
       }  
   }
    //获取订单信息
    public function orderinfo($userid)
    {   
        $con['hqjhc_orders.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders.userid'] = $userid;
        $Data = M('orders');
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
                hqjhc_brands.brandName as brandName,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.expressName as expressname,
                hqjhc_orders.expressNo as expressno,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.payMoney as goods_price,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress,
                hqjhc_orders.orderStatus as orderstatus';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_orders.addressid")
                ->where($con)
                ->order($orderby)
                ->select();
        foreach ($list as $key => $value) 
        {
            $orderno = $value['orderno'];
            $ordernocount = $this->checkordersaf($orderno);
            if($ordernocount == 1)
            {
                 $list[$key]['applystatus'] = 1;
            }else{
                 $list[$key]['applystatus'] = 0;
            }
            $count = $this->getOrderremind($orderno);
            if($count >= 1)
            {
                $list[$key]['remindstatus'] = 1;
            }
            else {
                $list[$key]['remindstatus'] = 0;
            }
                
        }
        return $list;
       
     }
    //验证订单售后是否处理
    public function checkordersaf($orderno)
    {
        $Ordersaf = D('orders_af');
        return $Ordersaf->where(['orderNo'=>$orderno])->count();
    }
    //获取改订单今日有没有提醒
    public function getOrderremind($orderno)
    {
        $Order_remind = D('order_remind');
        $Nowdate = date('Y-m-d',time());
        $con['orderNo'] = $orderno;
        $con['createTime'] = ['gt',$Nowdate];
        return  $Order_remind->where($con)->count();
    }
    //根据用户名称获取用户信息
    public function getUserinfoByuserName($loginName)
    {
         $Users = D('users');
         return $Users->where(['loginName'=>$loginName])->find();
    }
    /**
    * 验证用户的合法性
    */
    public function checkUser($loginName)
    {
            $Users = M('users');
            return $Users->where(['loginName'=>$loginName])->count();
    }
}

