<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller{
    CONST DATAFLAG = 0;
    CONST STATUS = 0;
    CONST orderrecyclestatus = 6;
    
   
    //获取下单待交易的商品
    public function getorderinfo()
    {
         $orderno = I('post.orderno');
         $loginName = I('post.loginName');
         $orderstatus = I('post.orderstatus');
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
         $Orderdetail = $this->getorderdetail($orderno);
         $productid = $Orderdetail['goodsid'];
         $userid = $UserInfo['userid']; 
         if($orderstatus == 6)
         { 
              $OrdersInfo = $this->getorderinforecycledeal($userid,$orderno);
         } else {
              $OrdersInfo = $this->getorderinfowilldeal($userid,$orderno);
         }
         foreach ($OrdersInfo as $k => $v)
         {
             $templateid = $v['templateid'];
             $templateinfo = $this->gettemplate($templateid);
         }
         $shippingInfo = $this->getshippingInfo($templateid);
         $AddressInfo = $this->getAddress($userid);
         if($OrdersInfo)
         {
             $response['code'] = '000008';
             $response['msg'] = '成功获取待交易订单信息！';
             $response['templateinfo'] = $templateinfo;
             $response['OrdersInfo'] = $OrdersInfo;
             $response['AddressInfo'] = $AddressInfo;
             $response['shippingInfo'] = $shippingInfo;
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
         }
         
    }
    public function checkisShare($userid,$productid)
    {
           $Share = D('share');
           return $Share->where(['productid'=>$productid,'userid'=>$userid])->count();
    }
    public function getorderdetail($orderno)
    {
           $Orders = D('orders');
           return $Orders->where(['orderNo'=>$orderno])->find();
    }
    public function getshippingInfo($templateid)
    {
           $Shippingway = D('shipping_way');
           return $Shippingway ->where(['template_id'=>$templateid])->select();
    }
    public function gettemplate($templateid)
    {
        $Goods_template = D('goods_template');
        return $Goods_template->where(['template_id'=>$templateid])->find();
    }
    public function getAddress($userid)
    {
        $Address = D('user_address');
        return  $Address->where(['userid'=>$userid,'dataFlag'=>self::DATAFLAG])->select();     
    }
    //获取回收站的订单信息
    public function getorderinforecycledeal($userid,$orderno)
    {
        $con['userid'] = $userid;
        $con['hqjhc_orders.orderStatus'] = self::orderrecyclestatus;
        $con['hqjhc_orders.orderNo'] = $orderno;
        $field = 'hqjhc_brands.brandName as brandName,
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.name as goodname,
                hqjhc_goods.templateid as templateid,
        	hqjhc_goods.description as description,
        	hqjhc_goods.marketPrice as marketPrice,
        	hqjhc_goods.goods_other_img1 as goods_other_img1,
        	hqjhc_goods.goods_other_img2 as goods_other_img2,
        	hqjhc_goods.goods_other_img3 as goods_other_img3,
            hqjhc_goods.goods_other_img4 as goods_other_img4,
            hqjhc_goods.id as id,
            hqjhc_orders.num as num,
            hqjhc_orders.payMoney as goods_price,
            hqjhc_orders.spec1 as spec1,
            hqjhc_orders.spec2 as spec2';
        $Orders = D('orders');
        $Orderinfo = $Orders ->field($field)
                  ->join('LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id')
                  ->join('LEFT JOIN hqjhc_brands ON hqjhc_brands.brandid = hqjhc_orders.brandsid')
		  ->where($con)
		  ->select();
        return $Orderinfo;
    }
    //获取下单待交易的订单信息
    public function getorderinfowilldeal($userid,$orderno)
    {
        $con['userid'] = $userid;
        $con['hqjhc_orders.orderStatus'] = self::STATUS;
        $con['hqjhc_orders.orderNo'] = $orderno;
        $field = 'hqjhc_brands.brandName as brandName,
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.name as goodname,
                hqjhc_goods.templateid as templateid,
        	hqjhc_goods.description as description,
        	hqjhc_goods.marketPrice as marketPrice,
        	hqjhc_goods.goods_other_img1 as goods_other_img1,
        	hqjhc_goods.goods_other_img2 as goods_other_img2,
        	hqjhc_goods.goods_other_img3 as goods_other_img3,
            hqjhc_goods.goods_other_img4 as goods_other_img4,
            hqjhc_goods.id as id,
            hqjhc_orders.num as num,
            hqjhc_orders.payMoney as goods_price,
            hqjhc_orders.spec1 as spec1,
            hqjhc_orders.spec2 as spec2';
        $Orders = D('orders');
        $Orderinfo = $Orders ->field($field)
                  ->join('LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id')
                  ->join('LEFT JOIN hqjhc_brands ON hqjhc_brands.brandid = hqjhc_orders.brandsid')
		  ->where($con)
		  ->select();
        return $Orderinfo;
    }
    //下单操作
    public function do_order()
    {
         $goodsid = I('post.goodsid');
         $brandid = I('post.brandid');
         $spec1 = I('post.spec1');
         $spec2 = I('post.spec2');
         $goodsprice = I('post.goodsprice');
         $goodsnum = I('post.goodsnum');
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
          /**
          * 获取商品信息
          */
         $GoodsInfo = $this->getgoodsInfo($goodsid);
         
         
         
         $number = $GoodsInfo['number']; 
         $SpecInfo = $this->getsepcab($goodsid,$spec1,$spec2);
         
         
//         print_r($SpecInfo);
//         exit;
         $specnum = $SpecInfo['specnum'];
         $salenum = $SpecInfo['saleNum'];
         
//         /**
//          * 判断总的库存是否满足
//          */
//         if($number < $goodsnum)
//         {
//             $response['code'] = '000005';
//             $response['msg'] = '该商品已售完！';
//             header('Content-type:text/html; Charset=utf8');  
//             header( "Access-Control-Allow-Origin:*");  
//             header('Access-Control-Allow-Methods:POST');    
//             header('Access-Control-Allow-Headers:x-requested-with,content-type');
//             die(json_encode($response));
//         }
          if($specnum < $goodsnum)
         {
             $response['code'] = '000004';
             $response['msg'] = '该商品已售完！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
         }  
         /**
          * 更改总库存
          */
         $this->updatetotalnums($goodsid,$number,$goodsnum);
         /**
          * 更改改规格的库存
          */
         
         $this->updatespecnums($goodsid,$specnum,$salenum,$goodsnum,$spec1,$spec2);  
         $UserInfo = $this->getUserinfoByuserName($loginName);
         $userid = $UserInfo['userid'];
         $data['userid'] = $userid;
         $data['goodsid'] = $goodsid;
         $data['spec1'] = $spec1;
         $data['spec2'] = $spec2;
         $data['payMoney'] = $goodsprice;
         $data['num'] = $goodsnum;
         $data['brandsid'] = $brandid;
         $data['createTime'] = date("Y-m-d H:i:s",time());
         $data['orderNo'] = $this->create_order_no();
         $Order = D('orders');
         $res = $Order->add($data);
         if($res)
         {  
             $response['orderno'] = $data['orderNo'];
             $response['code'] = '000008';
             $response['msg'] = '下单操作成功！';
         }
         header('Content-type:text/html; Charset=utf8');  
         header( "Access-Control-Allow-Origin:*");  
         header('Access-Control-Allow-Methods:POST');    
         header('Access-Control-Allow-Headers:x-requested-with,content-type');
         die(json_encode($response));
    }
    //批量下单
    public function do_more_order()
    {
        $orderInfo = I('post.goodsorderinfo');
        $loginName = I('post.loginName');
        foreach ($orderInfo as $key => $value) 
        {   
            $orderNo = $value['orderno'];
            $goodsid = $value['goodsid'];
            $brandid = $value['brandid'];
            $spec1 = $value['spec1'];
            $spec2 = $value['spec2'];
            $goodsprice = $value['goodsprice'];
            $goodsnum = $value['goodsnum'];
            $this->do_all_order($goodsid,$brandid,$spec1,$spec2,$goodsprice,$goodsnum,$loginName);
            $this->updateshopcartstatus($orderNo);
        }
        $response['sameorderNo'] = strtotime(date("Y-m-d H:i:s"));
        $response['code'] = '000008';
        $response['msg'] = '下单操作成功！';
         header('Content-type:text/html; Charset=utf8');  
         header( "Access-Control-Allow-Origin:*");  
         header('Access-Control-Allow-Methods:POST');    
         header('Access-Control-Allow-Headers:x-requested-with,content-type');
         die(json_encode($response));
        
    }
    
    //批量下单操作
    public function do_all_order($goodsid,$brandid,$spec1,$spec2,$goodsprice,$goodsnum,$loginName)
    {
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
          /**
          * 获取商品信息
          */
         $GoodsInfo = $this->getgoodsInfo($goodsid);
         $number = $GoodsInfo['number']; 
         $SpecInfo = $this->getsepcab($goodsid,$spec1,$spec2);
         $specnum = $SpecInfo['specnum'];
         $salenum = $SpecInfo['saleNum'];
         
         /**
          * 判断总的库存是否满足
          */
//         if($number < $goodsnum)
//         {
//             $response['code'] = '000005';
//             $response['msg'] = '该商品已售完！';
//             header('Content-type:text/html; Charset=utf8');  
//             header( "Access-Control-Allow-Origin:*");  
//             header('Access-Control-Allow-Methods:POST');    
//             header('Access-Control-Allow-Headers:x-requested-with,content-type');
//             die(json_encode($response));
//         }
//          if($specnum < $goodsnum)
//         {
//             $response['code'] = '000004';
//             $response['msg'] = '该商品已售完！';
//             header('Content-type:text/html; Charset=utf8');  
//             header( "Access-Control-Allow-Origin:*");  
//             header('Access-Control-Allow-Methods:POST');    
//             header('Access-Control-Allow-Headers:x-requested-with,content-type');
//             die(json_encode($response));
//         }  
         /**
          * 更改总库存
          */
         $this->updatetotalnums($goodsid,$number,$goodsnum);
         /**
          * 更改改规格的库存
          */
         $this->updatespecnums($goodsid,$specnum,$salenum,$goodsnum,$spec1,$spec2);  
         $UserInfo = $this->getUserinfoByuserName($loginName);
         $userid = $UserInfo['userid'];
         $data['userid'] = $userid;
         $data['goodsid'] = $goodsid;
         $data['spec1'] = $spec1;
         $data['spec2'] = $spec2;
         $data['payMoney'] = $goodsprice;
         $data['num'] = $goodsnum;
         $data['brandsid'] = $brandid;
         $data['createTime'] = date("Y-m-d H:i:s",time());
         $data['orderNo'] = $this->create_order_no();
         $data['sameorderNo'] = strtotime(date("Y-m-d H:i:s"));
         $Order = D('orders');
         $Order->add($data);   
    }
    
    
    //更改购物车的状态
       public function updateshopcartstatus($orderno)
       {   
           $Shop_cart = D('shop_cart');
           $data['status'] = 1;
           $Shop_cart->where(['orderNo'=>$orderno])->save($data);
       }
    //获取商品信息
    public function getgoodsInfo($goodsid)
    {
        $Goods = D('goods');
        return $Goods->where(['id'=>$goodsid])->find();
    }
    //获取该规格的库存信息
    public function getsepcab($goodsid,$spec1,$spec2)
    {
        $Goods_specs = D('goods_specs');
        return $Goods_specs->where(['goodsid'=>$goodsid,'speca'=>$spec1,'specb'=>$spec2])->find();
    }
    //更改制定规格的库存信息
    public function updatespecnums($goodsid,$specnum,$salenum,$goodsnum,$spec1,$spec2)
    {
        $Goodsspecs = D('goods_specs');
        $data['specnum'] = $specnum - $goodsnum;
        $data['salenum'] = $salenum + $goodsnum;
        $Goodsspecs->where(['goodsid'=>$goodsid,'speca'=>$spec1,'specb'=>$spec2])->save($data);
    }
    //更改总库存
    public function updatetotalnums($goodsid,$number,$goodsnum)
    {
        $Goods = D('goods');
        $data['number'] = $number - $goodsnum;
        $Goods->where(['id'=>$goodsid])->save($data);
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
     /**
     * 生成订单号
     * @return string
     */
    public function create_order_no()
    {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}
