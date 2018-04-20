<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class AddressController extends Controller{
    CONST DATAFLAG = 0;
    //收货地址列表页面
    public function index()
    {
        $loginName = I('post.loginName');
        if(!$_POST)
        {
            $response['code'] = '000001';
            $response['msg'] = '请填写请求参数！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            print_r(json_encode($response));
        }
        $UserInfo = $this->getUserInfo($loginName);
        $userid = $UserInfo['userid'];
        $addressInfo = $this->getAddressInfo($userid);
        foreach($addressInfo as $k=>$v)
        {
            $areaidPath = $v['areaidpath']; 
            $areaidPathInfo = explode('-',$areaidPath);
            $Proviceid = $areaidPathInfo[0];
            $Cityid = $areaidPathInfo[1];
            $Countyid = $areaidPathInfo[2]; 
            $addressInfo[$k]['prvoince'] = $this->getareaInfo($Proviceid);
            $addressInfo[$k]['city'] = $this->getareaInfo($Cityid);
            $addressInfo[$k]['county'] = $this->getareaInfo($Countyid);
        }
        $response['code'] = '000008';
        $response['msg'] = '获取数据操作成功！';
        $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response)); 
    }
    public function getareaInfo($id)
    {
        $Area = M('area');
        $area =  $Area->where(['region_id'=>$id])->find();
        return $area['region_name'];
    }
    //删除收货地址接口
    public function deleteaddress()
    {
        $addressid =  I('post.addressid');
        $userAdress = M('user_address');
        $data['dataFlag'] = 1;
        $res = $userAdress->where(['addressid'=>$addressid])->save($data);
        if($res)
        {
            $response['code'] = '000008';
            $response['msg'] = '删除收货地址操作成功！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
    }
    //添加收货地址接口
    public function addAddressInfo()
    {
        
        if(!$_POST)
        {
            $response['code'] = '000005';
            $response['msg'] = '请传送请求数据！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        
        $loginName = I('post.loginName');
        $userName = I('post.userName');
        $userPhone = I('post.userPhone');
        $provinceid = I('post.provinceid');
        $cityid = I('post.cityid');
        $countyid = I('post.countyid');
        $userAdress = I('post.userAdress');
        $isDefault = I('post.isDefault');
        if(!$loginName)
        {
            $response['code'] = '000001';
            $response['msg'] = '请传输登录名！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$userName)
        {
            $response['code'] = '000001';
            $response['msg'] = '请填写您的姓名！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$userPhone)
        {
            $response['code'] = '000001';
            $response['msg'] = '请填写你的手机号！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$provinceid)
        {
            $response['code'] = '000001';
            $response['msg'] = '请选择省份！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$cityid)
        {
            $response['code'] = '000001';
            $response['msg'] = '请填写你的城市！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$countyid)
        {
            $response['code'] = '000001';
            $response['msg'] = '请填写你的县级！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$userAdress)
        {
            $response['code'] = '000001';
            $response['msg'] = '请填写你的详细地址！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        $UserInfo = $this->getUserInfo($loginName);
        $data['userid'] = $UserInfo['userid'];
        $data['userName'] = $userName;
        $data['userPhone'] = $userPhone;
        $data['areaidPath'] = $provinceid."-".$cityid."-".$countyid;
        $data['areaid'] = $provinceid;
        $data['userAdress'] = $userAdress;
        $data['isDefault'] = $isDefault;
        $data['createTime'] = date("Y-m-d H:i:s",time());
        $userAdress = M('user_address');
        $userAdressInfo = $userAdress->add($data);
        if($userAdressInfo)
        {
            $response['code'] = '000008';
            $response['msg'] = '添加地址成功！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            $response['addressid'] = $userAdressInfo;
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
    }
    //获取修改地址信息
    public function geteditaddressInfo()
    {
        $addressid = I('post.addressid');
        $addressInfo = $this->getinfoaddressByid($addressid); 
        $response['code'] = '000008';
        $response['msg'] = '获取修改地址信息成功！';
        $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response)); 
    }
    public function getinfoaddressByid($addressid)
    {
        $UserAddress = D('user_address');
        return $UserAddress->where(['addressid'=>$addressid])->find();
    }
    //编辑收货地址信息
    public function editAddressInfo()
    {
        
        if(!$_POST)
        {
            $response['code'] = '000005';
            $response['msg'] = '请传送请求数据！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        
        $loginName = I('post.loginName');
        $userName = I('post.userName');
        $userPhone = I('post.userPhone');
        $provinceid = I('post.provinceid');
        $cityid = I('post.cityid');
        $countyid = I('post.countyid');
        $userAdress = I('post.userAdress');
        $isDefault = I('post.isDefault');
        $addressid =  I('post.addressid');
        if(!$loginName)
        {
            $response['code'] = '000001';
            $response['msg'] = '请传输登录名！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$userName)
        {
            $response['code'] = '000001';
            $response['msg'] = '请填写您的姓名！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$userPhone)
        {
            $response['code'] = '000001';
            $response['msg'] = '请填写你的手机号！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$provinceid)
        {
            $response['code'] = '000001';
            $response['msg'] = '请选择省份！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$cityid)
        {
            $response['code'] = '000001';
            $response['msg'] = '请填写你的城市！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$countyid)
        {
            $response['code'] = '000001';
            $response['msg'] = '请填写你的县级！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        if(!$userAdress)
        {
            $response['code'] = '000001';
            $response['msg'] = '请填写你的详细地址！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
        $UserInfo = $this->getUserInfo($loginName);
        $data['userid'] = $UserInfo['userid'];
        $data['userName'] = $userName;
        $data['userPhone'] = $userPhone;
        $data['areaidPath'] = $provinceid."-".$cityid."-".$countyid;
        $data['areaid'] = $countyid;
        $data['userAdress'] = $userAdress;
        $data['isDefault'] = $isDefault;
        $data['createTime'] = date("Y-m-d H:i:s",time());
        $userAdress = M('user_address');
        $userAdressInfo = $userAdress->where(['addressid'=>$addressid])->save($data);
        if($userAdressInfo)
        {
            $response['code'] = '000008';
            $response['msg'] = '修改地址信息成功！';
            $response['addressInfo'] = isset($addressInfo) ? $addressInfo : '';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response)); 
        }
    }
    //设置收货定制为默认地址接口
    public function setdefaultAddress()
    {
        $userid = I('post.userid');
        $addressid = I('post.addressid');
        $res = $this->setbeforedefaultaddress($userid,$addressid);
        if($res)
        {
            $this->setdefaultaddr($userid,$addressid);
            $response['code'] = '000008';
            $response['msg'] = '设置默认地址成功！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        
        
    }
    //设置之前的默认地址为0
    public function setbeforedefaultaddress($userid,$addressid)
    {
        $data['isDefault'] = 0;
        $UserAddress = M('user_address');
        return $UserAddress->where(['userid'=>$userid,'isDefault'=>1])->save($data);
    }
     //设置之前的默认地址为1
    public function setdefaultaddr($userid,$addressid)
    {
        $data['isDefault'] = 1;
        $UserAddress = M('user_address');
        return $UserAddress->where(['addressid'=>$addressid])->save($data);
    }
    //获取地址信息
    public function getAddressInfo($userid)
    {
        $Useraddress = D('user_address');
        return $Useraddress->where(['userid'=>$userid,'dataFlag'=>self::DATAFLAG])->select();
    }
    //获取省份
    public function getProvince()
    {
       $parent_id = I('post.parent_id');
       $Area = M('area');
       $provinceInfo = $Area->where(['parent_id'=>$parent_id])->select();
       $response['code'] = '000008';
       $response['msg'] = '获取省份信息成功！';
       $response['provinceInfo'] = $provinceInfo;
       header('Content-type:text/html; Charset=utf8');  
       header( "Access-Control-Allow-Origin:*");  
       header('Access-Control-Allow-Methods:POST');    
       header('Access-Control-Allow-Headers:x-requested-with,content-type');
       die(json_encode($response));
    }
    //获取市区
    public function getCity()
    {  
       $parent_id = I('post.parent_id');
       $Area = M('area');
       $CityInfo = $Area->where(['parent_id'=>$parent_id])->select();
       $response['code'] = '000008';
       $response['msg'] = '获取市级信息成功！';
       $response['cityInfo'] = $CityInfo;
       header('Content-type:text/html; Charset=utf8');  
       header( "Access-Control-Allow-Origin:*");  
       header('Access-Control-Allow-Methods:POST');    
       header('Access-Control-Allow-Headers:x-requested-with,content-type');
       die(json_encode($response));
        
    }
    //获取县级
    public function getCounty()
    {   
        $parent_id = I('post.parent_id');
        $Area = M('area');
        $CountyInfo = $Area->where(['parent_id'=>$parent_id])->select();
        $response['code'] = '000008';
        $response['msg'] = '获取县级信息成功！';
        $response['countyInfo'] = $CountyInfo;
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));   
    }
    //获取用户的id编号
    public function getUserInfo($loginName)
    {
         $Users = D('users');
         return $Users->where(['loginName'=>$loginName])->find();
    }
    
}
