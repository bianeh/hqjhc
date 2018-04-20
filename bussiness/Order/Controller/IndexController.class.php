<?php
namespace Order\Controller;
use Common\Controllers\BaseController;
use Order\Model\OrdersModel;
class IndexController extends BaseController {
    CONST DATAFLAG = 0;
    CONST paymentOrderStatus = 0;
    CONST WAITEXPESS = 1;
    CONST CHECKEDORDER = 2;
    CONST expressedorder = 3;
    CONST canceledorder = 4;
    CONST completeorder = 5;
    CONST recycleorder = 6;
    //获取全部的订单信息
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
        $con['hqjhc_orders.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_goods.offerid'] = $this->_data['offerid'];
        $Data = M('orders');
        $count  = $Data
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id")
                ->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $offerid = $this->_data['offerid'];
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.orderid as orderid,
                hqjhc_orders.num as num,
                hqjhc_orders.spec1 as spec1,
                hqjhc_orders.spec2 as spec2,
                hqjhc_orders.remarks as remarks,
                hqjhc_orders.orderStatus as orderstatus,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_orders.addressid")
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
        $con['hqjhc_goods.offerid'] = $this->_data['offerid'];
        $Data = M('orders');
        $count  = $Data
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id")
                ->where($con)->count();  
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
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
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
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_orders.addressid")
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
        $con['hqjhc_goods.offerid'] = $this->_data['offerid'];
        $offerid = $this->_data['offerid'];
        $Data = M('orders');
        $count      = $Data
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id")
                ->where($con)->count();  
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
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
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
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_orders.addressid")
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
        $con['hqjhc_goods.offerid'] = $this->_data['offerid'];
        $Data = M('orders');
        $count  = $Data
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id")
                ->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $offerid = $this->_data['offerid'];
        $orderby['hqjhc_orders.orderid']='desc';
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
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
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_orders.addressid")
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
        $con['hqjhc_goods.offerid'] = $this->_data['offerid'];
        $Data = M('orders');
        $count = $Data
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id")
                ->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $offerid = $this->_data['offerid'];
        $orderby['hqjhc_orders.orderid']='desc';
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
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
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_orders.addressid")
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
    public function compeleteorder(){
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
        $con['hqjhc_orders.orderStatus'] = self::completeorder;
        $con['hqjhc_goods.offerid'] = $this->_data['offerid'];
        $Data = M('orders');
        $count = $Data
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id")
                ->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $offerid = $this->_data['offerid'];
        $orderby['hqjhc_orders.orderid']='desc';
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.marketPrice as marketprice,
                hqjhc_orders.orderNo as orderno,
                hqjhc_orders.createTime as createtime,
                hqjhc_orders.expressName as expressname,
                hqjhc_orders.expressNo as expressno,
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
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_orders.addressid")
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
        $con['hqjhc_goods.offerid'] = $this->_data['offerid'];
        $Data = M('orders');
        $count = $Data
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id")
                ->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $offerid = $this->_data['offerid'];
        $orderby['hqjhc_orders.orderid']='desc';
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
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
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_orders.addressid")
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
    public function recycleorder(){
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
        $con['hqjhc_goods.offerid'] = $this->_data['offerid'];
        $Data = M('orders');
        $count = $Data
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id")
                ->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $offerid = $this->_data['offerid'];
        $orderby['hqjhc_orders.orderid']='desc';
        $orderby['hqjhc_orders.orderid']='desc';
        $field = '
        	hqjhc_brands.brandLogo as brandLogo,
        	hqjhc_goods.goods_display_img as goods_display_img,
        	hqjhc_goods.name as name,
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
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_orders.addressid")
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
    //取消订单
    public function cancelorder()
    {
        $data['orderStatus'] = 4;
        $orderno = I('get.orderno');
        $Orders = D('orders');
        $res = $Orders->where(['orderNo'=>$orderno])->save($data);
        if($res)
        {
            $this->success('取消订单成功！');
        }
    }
    //获取微商用户的id编号
    public function getUsersInfo($loginName)
    {
        $Users = M('users');
        return $Users->where(['loginName'=>$loginName])->find();
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
    
     //查看订单详情
    public function orderinfo()
    {    
        $orderid = I('get.id');
        $con['orderid'] = $orderid;
        $Data = M('orders');
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
                hqjhc_user_address.userName as username,
                hqjhc_user_address.userPhone as userphone,
                hqjhc_user_address.areaidPath as areaidPath,
                hqjhc_user_address.userAdress as useraddress';
        $list = $Data
                ->field($field)
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_orders.goodsid")
                ->join("LEFT JOIN hqjhc_brands ON hqjhc_orders.brandsid = hqjhc_brands.brandid")
                ->join("LEFT JOIN hqjhc_order_address ON hqjhc_order_address.orderno = hqjhc_orders.orderno")
                ->join("LEFT JOIN hqjhc_user_address ON hqjhc_user_address.addressid = hqjhc_orders.addressid")
                ->where($con)
                ->find();
        $areaidPath = $list['areaidpath'];
        $areapath = explode('-', $areaidPath);
        $province = $areapath[0];
        $city = $areapath[1];
        $xian = $areapath[2];
        $Area = D('area');
        $provinceinfo  = $Area->where(['region_id'=>$province])->find();
        $cityinfo  = $Area->where(['region_id'=>$city])->find();
        $xianinfo = $Area->where(['region_id'=>$xian])->find();
        $list['province'] = $provinceinfo['region_name'];
        $list['city'] = $cityinfo['region_name'];
        $list['xian'] = $xianinfo['region_name'];
        $this->assign('orderinfo',$list);
        $this->display();
    }
    
}