<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class BrandsgoodsController extends Controller{
    CONST DATAFLAG = 0;
    CONST UPSTATUS = 3;
    //获取专场活动的产品
    public function index()
    {   
        if(!$_POST)
        {
            $response['code'] = '000005';
            $response['msg'] = '请填写参数提交';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            print_r(json_encode($response));
        }
        $loginName = I('post.loginName');
        $Userinfo = $this->getUserinfoByuserName($loginName);
        if($Userinfo)
        {
            $userid = $Userinfo['userid'];
        }
        $con['hqjhc_brands.brandid'] = I('post.brandid');
        $con['hqjhc_goods.status'] = self::UPSTATUS;
        $field = 'hqjhc_brands.brandName as brandName,
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.name as goodname,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.description as description,
        	hqjhc_goods.marketPrice as marketPrice,
                hqjhc_goods.marketPrice as marketPrice,
                hqjhc_goods.number as num,
        	hqjhc_goods.goods_other_img1 as goods_other_img1,
        	hqjhc_goods.goods_other_img2 as goods_other_img2,
        	hqjhc_goods.goods_other_img3 as goods_other_img3,
                hqjhc_goods.goods_other_img4 as goods_other_img4,
                hqjhc_goods.id as id';
        $Brands = M('brands');
        //全部产品信息
        $productinfos = $Brands
        ->field($field)
	->join('hqjhc_goods ON hqjhc_brands.brandid = hqjhc_goods.brandid')
        ->where($con)
        ->select();
        
        $favoriteInfo = $this->getgzinfo($userid);
        foreach ($productinfos as $key => $value) {
            $id = $value['id'];
            if(in_array($id,$favoriteInfo))
            {
                $productinfos[$key]['is_favorite'] = 1;
            }
            else
            {
                $productinfos[$key]['is_favorite'] = 0;
            }
            $productinfos[$key]['description'] = strip_tags(htmlspecialchars_decode($value['description']));
        }
        
        
        $response['code'] = '000008';
        $response['msg'] = '成功获取专场活动信息';
        $response['productinfo'] =  $productinfos;
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        print_r(json_encode($response));
    }
    //根据用户名称获取用户信息
    public function getUserinfoByuserName($loginName)
    {
         $Users = D('users');
         return $Users->where(['loginName'=>$loginName])->find();
    }
     //关注产品信息
    public function getgzinfo($userid)
    {   
        $infoids = [];
        $Favorites = D('favorites');
        $info = $Favorites->where(['userid'=>$userid])->select();
        foreach ($info as $k => $v)
        {
            $infoids[] = $v['targetid'];   
        }
        return $infoids;
    }
}

