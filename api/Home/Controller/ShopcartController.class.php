<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class ShopcartController extends Controller
{
    CONST STATUS = 0;
    CONST DATAFLAG = 0;
    //购物车列表
    public function index()
    {
        $loginName = I('post.loginName');
        $UserInfo = $this->getUserinfoByuserName($loginName);
        $userid = $UserInfo['userid']; 
        $count = $this->getwebnotify($userid);
        if($count >= 1)
        {
           $response['webstatus'] = 1;
         } else {
           $response['webstatus'] = 0;
        }
        $ShopInfo = $this->getShopInfo($userid);
        $response['code'] = '000008';
        $response['msg'] = '获取购物车信息成功！';
        $response['shopinfo'] = $ShopInfo;
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));
    }
    //加入购物车
    public function doshopcart()
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
         $UserInfo = $this->getUserinfoByuserName($loginName);
         $userid = $UserInfo['userid'];
         $sharecount = $this->checkuserisshared($goodsid,$userid);
         if($sharecount < 1)
         {
             $response['code'] = '000005';
             $response['msg'] = '分享之后才能加入购物车！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
         }
         //判断商品的id是否存在
         if(!$goodsid)
         {
             $response['code'] = '000001';
             $response['msg'] = '请求参数必须包括商品id！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
         }
         //判断品牌的id是否存在
         if(!$brandid)
         {
             $response['code'] = '000002';
             $response['msg'] = '请求参数必须包括品牌id！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
         }
         //判断参spec1是否存在
         if(!$spec1)
         {
             $response['code'] = '000003';
             $response['msg'] = '请求参数必须包括参数规格一！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
         }
         //判断参spec2是否存在
         if(!$spec2)
         {
             $response['code'] = '000004';
             $response['msg'] = '请求参数必须包括参数规格二！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
         }
         //判断商品价格是否存在
         if(!$goodsprice)
         {
             $response['code'] = '000005';
             $response['msg'] = '请求参数必须包括商品价格！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
         }
         //判断参商品数量是否存在
         if(!$goodsnum)
         {
             $response['code'] = '000007';
             $response['msg'] = '请求参数必须包括商品数量！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
         }
         //判断参登录名是否存在
         if(!$loginName)
         {
             $response['code'] = '000009';
             $response['msg'] = '请求参数必须包括参数登录名！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
         }
         //加入购物车之前判断该商品改规格的数量是否足够
         $GoodsspecsInfo = $this->checkgoodsspecnum($goodsid,$spec1,$spec2);
         $specnum = $GoodsspecsInfo['specnum'];
//         if($goodsnum > $specnum)
//         {
//             $response['code'] = '0000010';
//             $response['msg'] = '库存不足!';
//             header('Content-type:text/html; Charset=utf8');  
//             header( "Access-Control-Allow-Origin:*");  
//             header('Access-Control-Allow-Methods:POST');    
//             header('Access-Control-Allow-Headers:x-requested-with,content-type');
//             die(json_encode($response));
//         }
         //做加入购物车判断购物栏里该用户有没有相同的商品和规格之前已存在
         $shopcartcount = $this->checksamegoodssamespec($goodsid,$spec1,$spec2,$userid);
         if($shopcartcount == 1)
         {
             $ShopcartInfo = $this->getgoodsshopcartInfo($userid,$goodsid,$spec1,$spec2);
             $cart_id = $ShopcartInfo['id'];
             $num = $ShopcartInfo['num'];
             $shopcartnum = $num + $goodsnum;
             $this->updategoodsshopcartnum($userid,$cart_id,$shopcartnum);  
             $response['orderno'] = $ShopcartInfo['orderno'];
             $response['code'] = '000008';
             $response['msg'] = '加入购物车操作成功！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
         }
         $data['userid'] = $userid;
         $data['goodsid'] = $goodsid;
         $data['spec1'] = $spec1;
         $data['spec2'] = $spec2;
         $data['payMoney'] = $goodsprice;
         $data['num'] = $goodsnum;
         $data['brandid'] = $brandid;
         $data['createTime'] = date("Y-m-d H:i:s",time());
         $data['orderNo'] = $this->create_order_no();
         $ShopCart = D('shop_cart');
         $res = $ShopCart->add($data);
         if($res)
         {  
             $response['orderno'] = $data['orderNo'];
             $response['code'] = '000008';
             $response['msg'] = '加入购物车操作成功！';
         }
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));
    }
    //检查该商品改规格的库存是否足够
    public function checkgoodsspecnum($goodsid,$spec1,$spec2)
    {
        $Goodsspecs = D('goods_specs');
        return $Goodsspecs ->where(['goodsid'=>$goodsid,'speca'=>$spec1,'specb'=>$spec2])->find();
    }
    //如果存在相同商品和规格那么只是修改购物车里面的数量
    public function updategoodsshopcartnum($userid,$cart_id,$num)
    {
        $Shop_cart = D('shop_cart');
        $data['num'] = $num;
        $Shop_cart->where(['userid'=>$userid,'id'=>$cart_id])->save($data);
    }
    //检查相同的商品的相同的规格是否存在
    public function checksamegoodssamespec($goodsid,$spec1,$spec2,$userid)
    {
        $Shop_cart = D('shop_cart');
        return $Shop_cart->where(['goods_id'=>$goodsid,'spec1'=>$spec1,'spec2'=>$spec2,'userid'=>$userid,'status'=>0])->count();
    }
    //检查到购物车里面该用户有相同商品和规格存在查出该购物车信息
    public function getgoodsshopcartInfo($userid,$goodsid,$spec1,$spec2)
    {
        $Shop_cart = D('shop_cart');
        return $Shop_cart->where(['userid'=>$userid,'goodsid'=>$goodsid,'spec1'=>$spec1,'spec2'=>$spec2])->find();
    }
    
    //查看此用户有没有分享过该产品
    public function checkuserisshared($goodsid,$userid)
    {
        $Share = D('share');
        return $Share->where(['productid'=>$goodsid,'userid'=>$userid])->count();
    }
    //获取购物车信息
    public function getShopInfo($userid)
    {   
        $con['userid'] = $userid;
        $con['hqjhc_shop_cart.status'] = self::STATUS;
        $con['hqjhc_shop_cart.dataFlag'] = self::DATAFLAG;
        $field = 'hqjhc_brands.brandName as brandName,
                hqjhc_brands.brandid as brandid,
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.name as goodname,
                hqjhc_goods.number as number,
        	hqjhc_goods.description as description,
        	hqjhc_goods.marketPrice as marketPrice,
        	hqjhc_goods.goods_other_img1 as goods_other_img1,
        	hqjhc_goods.goods_other_img2 as goods_other_img2,
        	hqjhc_goods.goods_other_img3 as goods_other_img3,
            hqjhc_goods.goods_other_img4 as goods_other_img4,
            hqjhc_goods.id as id,
            hqjhc_shop_cart.orderNo as orderNo,
            hqjhc_shop_cart.id as cart_id,
            hqjhc_shop_cart.payMoney as goods_price,
            hqjhc_shop_cart.num as num,
            hqjhc_shop_cart.spec1 as spec1,
            hqjhc_shop_cart.spec2 as spec2';
        $Shopcart = D('shop_cart');
        $info = $Shopcart ->field($field)
                  ->join('LEFT JOIN hqjhc_goods ON hqjhc_shop_cart.goodsid = hqjhc_goods.id')
                  ->join('LEFT JOIN hqjhc_brands ON hqjhc_brands.brandid = hqjhc_shop_cart.brandid')
		  ->where($con)
		  ->select();
        return $info;
    }
    //编辑购物车信息
    public function editshopcartnum()
    {
        $id = I('post.id');
        $num = I('post.num');
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
        $res = $this->editshopcart($id,$num);
        if($res)
        {
             $response['code'] = '000008';
             $response['msg'] = '成功修改购物车单量！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
        }
    }
    //删除购物车里的购物信息
    public function deletecart()
    {
        $id = I('post.id');
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
        $res = $this->deletecartshop($id);
        if($res)
        {
             $response['code'] = '000008';
             $response['msg'] = '成功删除购物车信息！';
             header('Content-type:text/html; Charset=utf8');  
             header( "Access-Control-Allow-Origin:*");  
             header('Access-Control-Allow-Methods:POST');    
             header('Access-Control-Allow-Headers:x-requested-with,content-type');
             die(json_encode($response));
        }
    }
    //删除购物车信息
    public function deletecartshop($id)
    {  
        
        $Shop_cart = D('shop_cart');
        $data['dataFlag'] = 1;
        return $Shop_cart->where(['id'=>$id])->save($data);
    }
    //修改数据库里的购物车信息
    public function editshopcart($id,$num)
    {
        $data['num'] = $num;
        $Shopcart = D('shop_cart');
        return $Shopcart->where(['id'=>$id])->save($data);
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
    //获取个人站内信
   public function getwebnotify($userid)
   {
       $Web_notify = D('web_notify');
       $con['type']  = array('in','0,1');
       $con['userid'] = $userid;
       $con['dataFlag'] = self::DATAFLAG;
       return $Web_notify->where($con)->count();
   }
}