<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class ShopdetailController extends Controller
{
    //购物详情页面
    public function index()
    {
        $goodsid = I('post.goodsid');
        $loginName = I('post.loginName');
        $count = $this->checkUser($loginName);
        if($count !=1 )
        {
            $response['code'] = '000001';
            $response['msg'] = '无此用户！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        $userinfo = $this->getUserinfoByuserName($loginName);
        $userid = $userinfo['userid'];
        $count = $this->checkisShare($userid,$goodsid);
//        if($count < 1)
//        {
//            $response['code'] = '000004';
//            $response['msg'] = '先分享该产品才能购买！';
//            header('Content-type:text/html; Charset=utf8');  
//            header( "Access-Control-Allow-Origin:*");  
//            header('Access-Control-Allow-Methods:POST');    
//            header('Access-Control-Allow-Headers:x-requested-with,content-type');
//            die(json_encode($response));
//        }
        $GoodsInfo = $this->getGoodsInfoByid($goodsid);
        $brandid = $GoodsInfo['brandid'];
        $Brands = D('brands');
        $Brandinfo = $Brands->where(['brandid'=>$brandid])->find();
        $GoodsInfo['brandName'] = $Brandinfo['brandname'];
        $GoodsInfo['brandLogo'] = $Brandinfo['brandlogo'];
        $GoodsSpecInfo = $this->getSpecsInfoByGoodsid($goodsid);
        $speca = [];
        $specb = [];
        foreach ($GoodsSpecInfo as $k => $v)
        {
            $speca[] = $v['speca'];
        }
        $specaval = $speca[0];
        $specs = $this->getspecbinfo($specaval,$goodsid);
        foreach ($specs as $k=>$v)
        {
            $specb[]= $v['specb'];
        }    
        $response['speca'] = array_values(array_unique($speca));
        $response['specb'] = array_filter($specb);
        $response['code'] = '000008';
        $response['msg'] = '获取信息操作成功！';
        $response['goodsinfo'] = $GoodsInfo;
        $response['goodsspecinfo'] = $GoodsSpecInfo;
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));
    }
    //购物车详情页面传送规格a的值来获取对应的信息
    public function getSpecbdetailInfo()
    {
         $loginName = I('post.loginName');
         $speca = I('post.speca');
         $goodsid = I('post.goodsid');
         $specbInfo = $this->getspecbInfobya($speca,$goodsid);
         $response['sepcbinfo'] = $specbInfo;
         $response['code'] = '000008';
         $response['msg'] = '成功获取规格信息！';
         header('Content-type:text/html; Charset=utf8');  
         header( "Access-Control-Allow-Origin:*");  
         header('Access-Control-Allow-Methods:POST');    
         header('Access-Control-Allow-Headers:x-requested-with,content-type');
         die(json_encode($response));
    }
    //购物车详情页面传送规格a的值和b的值来获取相对应的信息
     public function getSpecdetailInfo()
     {
         $loginName = I('post.loginName');
         $speca = I('post.speca');
         $specb = I('post.specb');
         $goodsid = I('post.goodsid');
         $specInfo = $this->getspecInfobyab($speca, $specb, $goodsid);
         $response['sepcinfo'] = $specInfo;
         $response['code'] = '000008';
         $response['msg'] = '成功获取规格信息！';
         header('Content-type:text/html; Charset=utf8');  
         header( "Access-Control-Allow-Origin:*");  
         header('Access-Control-Allow-Methods:POST');    
         header('Access-Control-Allow-Headers:x-requested-with,content-type');
         die(json_encode($response));
     }
     //获取规格b的详情信息
     public function getspecbInfobya($speca,$goodsid)
     {
          $Goodsspecs = D('goods_specs');
          return $Goodsspecs->where(['speca'=>$speca,'goodsid'=>$goodsid])->select();
     }
     //获取规格详细信息
     public function getspecInfobyab($speca,$specb,$goodsid)
     {
           $Goodsspecs = D('goods_specs');
           return  $Goodsspecs->where(['speca'=>$speca,'specb'=>$specb,'goodsid'=>$goodsid])->find();
     }
     public function checkisShare($userid,$productid)
    {
           $Share = D('share');
           return $Share->where(['productid'=>$productid,'userid'=>$userid])->count();
    }
    //根据商品id获取商品信息
    public function getGoodsInfoByid($goodsid)
    {
        $Goods = D('goods');
        return $Goods->where(['id'=>$goodsid])->find();
    }
    //获取第一个分类下的规格二级信息
    public function getspecbinfo($specaval,$goodsid)
    {
        $Goodsspecs = D('goods_specs');
        return $Goodsspecs->where([['speca'=>$specaval,'goodsid'=>$goodsid]])->select();
    }
    //根据商品的id来获取商品规格的信息
    public function getSpecsInfoByGoodsid($goodsid)
    {
        $Goodsspecs = D('goods_specs');
        return $Goodsspecs->where(['goodsid'=>$goodsid])->select();
    }
    /**
    * 验证用户的合法性
    */
    public function checkUser($loginName)
    {
        $Users = M('users');
        return $Users->where(['loginName'=>$loginName])->count();
    }
      //根据用户名称获取用户信息
    public function getUserinfoByuserName($loginName)
    {
         $Users = D('users');
         return $Users->where(['loginName'=>$loginName])->find();
    }
}
