<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class GetordersafinfoController extends Controller{
    CONST DATAFLAG = 0;
    //获取售后信息
    public function index()
    {
        $loginName = I('post.loginName');
        $count = $this->checkUser($loginName);
        if($count != 1)
        {
            $response['code'] = '000001';
            $response['msg'] = '没有此用户！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        //获取用户信息
        $UserInfo = $this->getUserInfo($loginName);
        $userid = $UserInfo['userid'];
        $ordersafInfo = $this->getinfo($userid);
        
        $response['code'] = '000008';
        $response['msg'] = '成功获得售后信息！';
        $response['ordersafInfo'] = $ordersafInfo;
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));
    }
    //获取售后信息
    public function getinfo($userid)
    {
        $con['hqjhc_orders.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders_af.userid'] = $userid;
        $con['hqjhc_orders.userid'] = $userid;
        $Data = M('orders_af');
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
                hqjhc_orders_af.type as type,
                hqjhc_orders_af.lack_status as lack_status,
                hqjhc_orders_af.leakage_status as leakage_status,
                hqjhc_orders_af.returngoods_status as returngoods_status,
        	hqjhc_brands.brandLogo as brandLogo,
                hqjhc_brands.brandName as brandName,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.expressName as expressname,
                hqjhc_orders.expressNo as expressno,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress,
                hqjhc_orders.orderStatus as orderstatus';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_orders ON hqjhc_orders_af.orderNo = hqjhc_orders.orderNo")
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_orders.addressid")
                ->where($con)
                ->order($orderby)
                ->select();
        return $list;
    }
    //检查会员是否合法
    public function checkUser($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->count();
    }
    //获取用户的信息
    public function getUserInfo($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->find();
    }
}
