<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class OrderdealController extends Controller{
    CONST cancelOrderstatus = 4;
    //取消订单
    public function index()
    {
        
        $orderno = I('post.orderno');
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
        //获取订单信息
        $OrderInfo = $this->getOrderInfo($orderno);
        $num = $OrderInfo['num'];
        $spec1 = $OrderInfo['spec1'];
        $spec2 = $OrderInfo['spec2'];
        $actualpaymoney = $OrderInfo['actualpaymoney'];
        $userid = $OrderInfo['userid'];
        $goodsid = $OrderInfo['goodsid'];
        
        //修改商品规格库存
        $GoodsspecInfo = $this->getGoodsspecsInfo($goodsid,$spec1,$spec2);
        $specnum = $GoodsspecInfo['specnum'];
        $bnum = $specnum + $num;
        $this->updategoodsspecnum($spec1,$spec2,$goodsid,$bnum);
        
        //修改商品总库存
        $GoodsInfo = $this->getGoodsInfo($goodsid);
        $number = $GoodsInfo['number'];
        $goodsbnum = $number + $num;
        $this->updategoodsnumber($goodsid,$goodsbnum);
        
        
        //更改订单状态
        $this->updateOderstatus($orderno);
        
        //获取用户信息
        $UserInfo = $this->getUserInfo($loginName);
        $usermoney = $UserInfo['usermoney'];
        $busermoney = $usermoney + $actualpaymoney;
        
//        //更新账户的金额
//        $this->updateusersMoney($loginName,$busermoney);
//        
//        //更新金额到日志信息中
//        $logs_moneys_info['amount'] = $actualpaymoney;
//        $logs_moneys_info['moneyType'] = 1;
//        $logs_moneys_info['accessType'] = 1;
//        $logs_moneys_info['orderNo'] = $this->create_order_no();
//        $logs_moneys_info['createTime'] = date('Y-m-d H:i:s',time());
//        $logs_moneys_info['datasource'] = 7;
//        $logs_moneys_info['userid'] = $userid;
//        $logs_moneys_info['otherOrderno'] = $orderno;
//        $logs_moneys_info['examount'] = $usermoney;
//        $this->updateusermoneylogs($logs_moneys_info);
        
        //返回成功状态
        $response['code'] = '000008';
        $response['msg'] = '取消订单成功！';
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));
        
        
        
    }
    //订单取消之后更新金额日志
    public function updateusermoneylogs(array $data)
    {
        $Logs_moneys = D('logs_moneys');
        $Logs_moneys->add($data);
    }
    //订单取消之后更新账户的的可用余额
    public function updateusersMoney($loginName,$busermoney)
    {
        $data['userMoney'] = $busermoney;
        $Users = D('users');
        $Users->where(['loginName'=>$loginName])->save($data);
    }
    //订单取消之后要把商品的库存还原回去
    public function updategoodsnumber($goodsid,$goodsbnum)
    {
        $Goods = D('goods');
        $data['number'] = $goodsbnum;
        return $Goods->where(['id'=>$goodsid])->save($data);
    }
    //订单取消之后要把原商品的库存还原回去
    public function updategoodsspecnum($spec1,$spec2,$goodsid,$bnum)
    {
        $Goodsspecs = D('goods_specs');
        $data['specnum'] = $bnum;
        $Goodsspecs->where(['speca'=>$spec1,'specb'=>$spec2,'goodsid'=>$goodsid])->save($data);
             
    }
    //订单取消之后更改订单的状态
    public function updateOderstatus($orderno)
    {
        $Orders = D('orders');
        $data['orderStatus'] = self::cancelOrderstatus;
        $Orders->where(['orderNo'=>$orderno])->save($data);
    }
    //获取订单信息
    public function getOrderInfo($orderno)
    {
        $Orders = D('orders');
        return $Orders->where(['orderNo'=>$orderno])->find();
    }
    //获取商品规格信息
    public function getGoodsspecsInfo($goodsid,$spec1,$spec2)
    {
        $Goodsspecs = D('goods_specs');
        return $Goodsspecs->where(['goodsid'=>$goodsid,'speca'=>$spec1,'specb'=>$spec2])->find();
    }
    //获取商品信息
    public function getGoodsInfo($goodsid)
    {
       $Goods = D('goods');
       return $Goods->where(['id'=>$goodsid])->find();
    }
    //验证用户合法性
    public function checkUser($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->count();
    }
    //获取用户信息
    public function getUserInfo($loginName)
    {
       $Users = D('users');
       return $Users->where(['loginName'=>$loginName])->find();
    }
     /**
     * 生成订单号
     * @return string
     */
    public function create_order_no()
    {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}

