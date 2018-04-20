<?php
namespace Orderaf\Controller;
use Common\Controllers\BaseController;
use Orderaf\Model\OrdersafModel;
class IndexController extends BaseController {
    CONST DATAFLAG = 0;
    CONST LEAKTYPE = 1;
    CONST LACKTYPE = 2;
    CONST RETURNTYPE = 3;
    //获取全部的退货漏货缺货信息
    public function index(){
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['hqjhc_orders.userid'] = isset($userid) ? $userid : '';
           $con['hqjhc_orders.createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['hqjhc_orders_af.dataFlag'] = self::DATAFLAG;
        $Data = M('orders_af');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
                hqjhc_orders_af.returngoods_status as returngoods_status,
                hqjhc_orders_af.lack_status as lack_status,
                hqjhc_orders_af.leakage_status as leakage_status,
                hqjhc_orders_af.type as type,
                hqjhc_orders_af.id as id,
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.userid as userid,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.orderStatus as orderstatus,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_orders ON hqjhc_orders.orderNo = hqjhc_orders_af.orderNo")
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_order_address.addressid")
                ->where($con)
                ->order($orderby)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUsersInfo($userid);
            $list[$key]['nickname'] = $UserInfo['nickname'];
;            
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //获取漏货信息
     public function leakgoods(){
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['hqjhc_orders.userid'] = isset($userid) ? $userid : '';
           $con['hqjhc_orders.createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['hqjhc_orders_af.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders_af.type'] = self::LEAKTYPE;
        $Data = M('orders_af');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
                hqjhc_orders_af.returngoods_status as returngoods_status,
                hqjhc_orders_af.lack_status as lack_status,
                hqjhc_orders_af.leakage_status as leakage_status,
                hqjhc_orders_af.type as type,
                hqjhc_orders_af.id as id,
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.userid as userid,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.orderStatus as orderstatus,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_orders ON hqjhc_orders.orderNo = hqjhc_orders_af.orderNo")
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_order_address.addressid")
                ->where($con)
                ->order($orderby)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUsersInfo($userid);
            $list[$key]['nickname'] = $UserInfo['nickname'];
;            
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //获取漏货信息
     public function lackgoods(){
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['hqjhc_orders.userid'] = isset($userid) ? $userid : '';
           $con['hqjhc_orders.createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['hqjhc_orders_af.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders_af.type'] = self::LACKTYPE;
        $Data = M('orders_af');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
                hqjhc_orders_af.returngoods_status as returngoods_status,
                hqjhc_orders_af.lack_status as lack_status,
                hqjhc_orders_af.leakage_status as leakage_status,
                hqjhc_orders_af.type as type,
                hqjhc_orders_af.id as id,
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.userid as userid,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.orderStatus as orderstatus,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_orders ON hqjhc_orders.orderNo = hqjhc_orders_af.orderNo")
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_order_address.addressid")
                ->where($con)
                ->order($orderby)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUsersInfo($userid);
            $list[$key]['nickname'] = $UserInfo['nickname'];
;            
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
     //获取退货信息
     public function returngoods(){
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['hqjhc_orders.userid'] = isset($userid) ? $userid : '';
           $con['hqjhc_orders.createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['hqjhc_orders_af.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders_af.type'] = self::RETURNTYPE;
        $Data = M('orders_af');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
                hqjhc_orders_af.returngoods_status as returngoods_status,
                hqjhc_orders_af.lack_status as lack_status,
                hqjhc_orders_af.leakage_status as leakage_status,
                hqjhc_orders_af.type as type,
                hqjhc_orders_af.id as id,
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.userid as userid,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.orderStatus as orderstatus,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_orders ON hqjhc_orders.orderNo = hqjhc_orders_af.orderNo")
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_order_address.addressid")
                ->where($con)
                ->order($orderby)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUsersInfo($userid);
            $list[$key]['nickname'] = $UserInfo['nickname'];
;            
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //获取用户信息
    public function getUsersInfo($userid)
    {
        $Users = D('users');
        return $Users->where(['userid'=>$userid])->find();
    }
    //获取待付款的订单信息
    public function paymenting(){
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['hqjhc_orders.userid'] = isset($userid) ? $userid : '';
           $con['hqjhc_orders.createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['hqjhc_orders.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders.orderStatus'] = self::paymentOrderStatus;
        $Data = M('orders');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.userid as userid,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_order_address.addressid")
                ->where($con)
                ->order($orderby)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUsersInfo($userid);
            $list[$key]['nickname'] = $UserInfo['nickname'];
;            
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //待发货的订单信息
    public function waitexpress(){
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['hqjhc_orders.userid'] = isset($userid) ? $userid : '';
           $con['hqjhc_orders.createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['hqjhc_orders.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders.orderStatus'] = self::WAITEXPESS;
        $Data = M('orders');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.userid as userid,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_order_address.addressid")
                ->where($con)
                ->order($orderby)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUsersInfo($userid);
            $list[$key]['nickname'] = $UserInfo['nickname'];
;            
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
     //拣货中的订单信息
    public function checkedorder(){
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['hqjhc_orders.userid'] = isset($userid) ? $userid : '';
           $con['hqjhc_orders.createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['hqjhc_orders.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders.orderStatus'] = self::CHECKEDORDER;
        $Data = M('orders');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
                hqjhc_orders.userid as userid,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_order_address.addressid")
                ->where($con)
                ->order($orderby)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUsersInfo($userid);
            $list[$key]['nickname'] = $UserInfo['nickname'];
;            
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
     //已发货的订单信息
    public function expressedorder(){
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['hqjhc_orders.userid'] = isset($userid) ? $userid : '';
           $con['hqjhc_orders.createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['hqjhc_orders.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders.orderStatus'] = self::expressedorder;
        $Data = M('orders');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
                hqjhc_orders.userid as userid,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_order_address.addressid")
                ->where($con)
                ->order($orderby)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUsersInfo($userid);
            $list[$key]['nickname'] = $UserInfo['nickname'];
;            
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //已完成的订单信息
    public function compeleteorder()
    {
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['hqjhc_orders.userid'] = isset($userid) ? $userid : '';
           $con['hqjhc_orders.createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['hqjhc_orders.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders.orderStatus'] = self::compeleteorder;
        $Data = M('orders');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
                hqjhc_orders.userid as userid,
                hqjhc_orders.orderStatus as orderstatus,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_order_address.addressid")
                ->where($con)
                ->order($orderby)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUsersInfo($userid);
            $list[$key]['nickname'] = $UserInfo['nickname'];
;            
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //已取消的订单信息
    public function canceledorder(){
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['hqjhc_orders.userid'] = isset($userid) ? $userid : '';
           $con['hqjhc_orders.createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['hqjhc_orders.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders.orderStatus'] = self::canceledorder;
        $Data = M('orders');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
                hqjhc_orders.userid as userid,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_order_address.addressid")
                ->where($con)
                ->order($orderby)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUsersInfo($userid);
            $list[$key]['nickname'] = $UserInfo['nickname'];
;            
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
     //已回收的订单信息
    public function recycleorder()
    {
        if ($_GET) 
        {   
           $loginName = I('get.loginName');
           $UserInfo = $this->getUserInfo($loginName);
           $userid = $UserInfo['userid'];
           $createTime = I('createTime');
           $con['hqjhc_orders.userid'] = isset($userid) ? $userid : '';
           $con['hqjhc_orders.createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['hqjhc_orders.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_orders.orderStatus'] = self::recycleorder;
        $Data = M('orders');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
                hqjhc_orders.userid as userid,
                hqjhc_orders.orderStatus as orderstatus,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.remarks as remarks,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_order_address.addressid")
                ->where($con)
                ->order($orderby)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        foreach ($list as $key => $value) {
            $userid = $value['userid'];
            $UserInfo = $this->getUsersInfo($userid);
            $list[$key]['nickname'] = $UserInfo['nickname'];
;            
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //获取微商用户的id编号
    public function getUserInfo($loginName)
    {
        $Users = M('users');
        return $Users->where(['loginName'=>$loginName])->find();
    }
    //确认订单
    public function checkorder()
    {   
        $data['orderStatus'] = 2;
        $orderno = I('get.orderno');
        $Orders = D('orders');
        $res = $Orders->where(['orderNo'=>$orderno])->save($data);
        if($res)
        {
            $this->success('订单确认成功！');
        }
    }
    
    //添加快递信息页面
    public function adddeliveryinfo()
    {   
        $orderno = I('get.orderno');
        if(!$orderno)
        {
            $this->error('出现错误！');
        }
        $this->assign('orderno',$orderno);
        $this->display();
    }
    //添加物流信息操作
    public function doAdddeleveryinfo()
    {
        if($_POST)
        {
            $data['expressNo'] = I('post.expressNo');
            $data['expressName'] = I('post.expressName');
            $orderno = I('post.orderNo');
            $OrdersModel = new OrdersModel;
            $orderInfo['orderStatus'] = 3;
            $OrdersModel->modelupdateorderstatus($orderInfo,$orderno);
            $res = $OrdersModel->modelupdateorderinfo($data,$orderno);
            if($res)
            {
                $this->success('确认发货成功！');
            }
            else
            {
                $this->error('确认发货失败！');
            }
        }
    }
    //审核退货申请成功
    public function checkreturnsuccess()
    {
        $id = I('get.id');
        $data['returngoods_status'] = 1;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_return_status($id,$data);
        if($res)
        {
            $this->success("申请退货申请通过！");
        }
        else
        {
            $this->error("申请退货申请通过失败！");
        }
    }
    //审核退货申请不通过
    public function checkreturnfail()
    {
        $id = I('get.id');
        $data['returngoods_status'] = 4;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_return_status($id,$data);
        if($res)
        {
            $this->success("申请退货申请不通过操作成功！");
        }
        else
        {
            $this->error("申请退货申请不通过操作失败！");
        }
    }
    //已经退货操作
    public function returned()
    {
        $id = I('get.id');
        $data['returngoods_status'] = 2;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_return_status($id,$data);
        if($res)
        {
            $this->success("已经退货操作成功！");
        }
        else
        {
            $this->error("已经退货操作失败！");
        }
    }
    //关闭申请操作
    public function returnapplyclose()
    {
        $id = I('get.id');
        $data['returngoods_status'] = 3;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_return_status($id,$data);
        if($res)
        {
            $this->success("关闭申请操作成功！");
        }
        else
        {
            $this->error("关闭售后申请操作失败！");
        }
    }
    //漏货申请通过
    public function checkleakgoodssuccess()
    {
        $id = I('get.id');
        $data['leakage_status'] = 1;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_leak_status($id,$data);
        if($res)
        {
            $this->success("漏货申请通过操作成功！");
        }
        else
        {
            $this->error("漏货申请通过操作失败！");
        }
    }
    //漏货申请操作失败
    public function checkleakgoodsfail()
    {
        $id = I('get.id');
        $data['leakage_status'] = 2;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_leak_status($id,$data);
        if($res)
        {
            $this->success("漏货申请未通过操作成功！");
        }
        else
        {
            $this->error("漏货申请未通过操作失败！");
        }
    }
    //漏货申请已处理
    public function leakgoodsdeal()
    {
        $id = I('get.id');
        $data['leakage_status'] = 3;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_leak_status($id,$data);
        if($res)
        {
            $this->success("漏货申请已处理操作成功！");
        }
        else
        {
            $this->error("漏货申请已处理操作失败！");
        }
    }
    //漏货申请已关闭
    public function leakapplyclose()
    {
        $id = I('get.id');
        $data['leakage_status'] = 4;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_leak_status($id,$data);
        if($res)
        {
            $this->success("漏货申请已关闭操作成功！");
        }
        else
        {
            $this->error("漏货申请已关闭操作失败！");
        }
    }
    
    
    
    
    //缺货申请通过
    public function checklackgoodssuccess()
    {
        $id = I('get.id');
        $data['lack_status'] = 1;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_leak_status($id,$data);
        if($res)
        {
            $this->success("缺货申请通过操作成功！");
        }
        else
        {
            $this->error("缺货申请通过操作失败！");
        }
    }
    //缺货申请操作失败
    public function checklackgoodsfail()
    {
        $id = I('get.id');
        $data['lack_status'] = 2;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_leak_status($id,$data);
        if($res)
        {
            $this->success("缺货申请未通过操作成功！");
        }
        else
        {
            $this->error("缺货申请未通过操作失败！");
        }
    }
    //缺货申请已处理
    public function lackgoodsdeal()
    {
        $id = I('get.id');
        $data['lack_status'] = 3;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_leak_status($id,$data);
        if($res)
        {
            $this->success("缺货申请已处理操作成功！");
        }
        else
        {
            $this->error("缺货申请已处理操作失败！");
        }
    }
    //缺货申请已关闭
    public function lackapplyclose()
    {
        $id = I('get.id');
        $data['lack_status'] = 4;
        $OrdersafModel = new OrdersafModel;
        $res = $OrdersafModel->model_update_leak_status($id,$data);
        if($res)
        {
            $this->success("缺货申请已关闭操作成功！");
        }
        else
        {
            $this->error("缺货申请已关闭操作失败！");
        }
    }
    
}