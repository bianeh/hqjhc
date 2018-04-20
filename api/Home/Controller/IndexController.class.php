<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    CONST DATAFLAG = 0;
    CONST UPSTATUS = 3;
    /**
     * APP首页接口
     * @return [type] [description]
     */
    public function index()
    {   
        $loginName = I('post.loginName');
    	$Nowdate = date("Y-m-d H:i:s");
    	//全部产品的条件
    	$con['hqjhc_goods.dataFlag'] = self::DATAFLAG;
    	$con['hqjhc_grade.dataFlag'] = self::DATAFLAG;
        $con['hqjhc_goods.status'] = self::UPSTATUS;
    	$con['hqjhc_grade.enddate'] = ['gt',$Nowdate];
    	//上架产品的条件，进行中的产品条件
    	$map['hqjhc_goods.dataFlag'] = self::DATAFLAG;
    	$map['hqjhc_grade.dataFlag'] = self::DATAFLAG;
    	$map['hqjhc_goods.status'] = self::UPSTATUS;
    	$map['hqjhc_grade.enddate'] = ['gt',$Nowdate];
    	$map['hqjhc_grade.startdate'] = ['lt',$Nowdate];
    	//即将开始的产品条件
    	$where['hqjhc_goods.dataFlag'] = self::DATAFLAG;
    	$where['hqjhc_grade.dataFlag'] = self::DATAFLAG;
        $where['hqjhc_goods.status'] = self::UPSTATUS;
    	$where['hqjhc_grade.startdate'] = ['gt',$Nowdate];
        $field = 'hqjhc_brands.brandName as brandName,
        	hqjhc_brands.brandLogo as brandLogo,
                hqjhc_goods.brandid as brandid,
        	hqjhc_goods.name as goodname,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.description as description,
        	hqjhc_goods.marketPrice as marketPrice,
        	hqjhc_goods.goods_other_img1 as goods_other_img1,
        	hqjhc_goods.goods_other_img2 as goods_other_img2,
        	hqjhc_goods.goods_other_img3 as goods_other_img3,
            hqjhc_goods.goods_other_img4 as goods_other_img4,
            hqjhc_grade.enddate as enddate,
            hqjhc_goods.id as id,
            hqjhc_grade.startdate as startdate';
        $Grades = M('grade');
        //全部产品信息
        $productinfos = $Grades
        ->field($field)
        ->join('LEFT JOIN hqjhc_brands ON hqjhc_grade.brandid = hqjhc_brands.brandid')
        ->join('LEFT JOIN hqjhc_goods ON hqjhc_brands.brandid = hqjhc_goods.brandid')
        ->where($con)
        ->select();
        //进行中产品信息
        $presentproductinfos = $Grades
        ->field($field)
        ->join('hqjhc_brands ON hqjhc_grade.brandid = hqjhc_brands.brandid')
		->join('hqjhc_goods ON hqjhc_grade.brandid = hqjhc_goods.brandid')
		->where($map)
		->select();
        //即将开始产品信息
		$previewproductinfos = $Grades
		->field($field)
		->join('hqjhc_brands ON hqjhc_grade.brandid = hqjhc_brands.brandid')
		->join('hqjhc_goods ON hqjhc_grade.brandid = hqjhc_goods.brandid')
		->where($where)
		->select();
        if($loginName)
        {
            $UserInfo = $this->getUserinfoByuserName($loginName);
            $userid = $UserInfo['userid'];
            $webnotifyInfo = $this->getwebnotify($userid);
        }
        $favoriteInfo = $this->getgzinfo($userid);
        foreach ($productinfos as $key => $value) {
            $id = $value['id'];
            if($userid)
            {
                $count = $this->getproductsharestatus($id,$userid);
                if($count >= 1)
                {
                    $productinfos[$key]['sharestatus'] = 1;
                }else
                {
                    $productinfos[$key]['sharestatus'] = 0;
                }
            }else{
                    $productinfos[$key]['sharestatus'] = 0;
            }
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
        foreach ($presentproductinfos as $key => $value) {
            $presentproductinfos[$key]['description'] = strip_tags(htmlspecialchars_decode($value['description']));
        }
        foreach ($previewproductinfos as $key => $value) {
            $previewproductinfos[$key]['description'] = strip_tags(htmlspecialchars_decode($value['description']));
        }
        $messageInfo = $this->getMessageInfo();
        $adsinfo = $this->getadsInfo();
        $response['code'] = '000008';
        $response['msg'] = '成功获取数据！';
        $response['productinfos'] = isset($productinfos) ? $productinfos : '';
        $response['presentproductinfos'] = isset($presentproductinfos) ? $presentproductinfos : '';
        $response['previewproductinfos'] = isset($previewproductinfos) ? $previewproductinfos : '';
        $response['previewmessageinfos'] = isset($messageInfo) ? $messageInfo : '';
        $response['adsinfo'] = isset($adsinfo) ? $adsinfo : '';
        $response['webnotifyinfo'] = isset($webnotifyInfo) ? $webnotifyInfo : '';
        $count = $this->getwebnotifys($userid);
        if($count >= 1)
        {
           $response['webstatus'] = 1;
         } else {
           $response['webstatus'] = 0;
        }
        $response['favoriteInfo'] = $favoriteInfo;
        
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        print_r(json_encode($response));
    }
    //首页已分享状态
    public function getproductsharestatus($goodsid,$userid)
    {
        $Share = D('share');
        return $Share->where(['userid'=>$userid,'productid'=>$goodsid])->count();
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
    //获取预告公告信息
    public function getMessageInfo()
    {
        $Messages = D('messages');
        return $Messages->where(['dataFlag'=>self::DATAFLAG])->select();   
    }
    //获取首页banner图片
    public function getadsInfo()
    {
        $Ads = D('ads');
        return $Ads->where(['adpositionid'=>1,'dataFlag'=>self::DATAFLAG])->select();
    }
    //获取站内信信息
    public function getwebnotify($userid)
    { 
        $Web_notify = D('web_notify');
        $con['type']  = array('in','0,1');
        $con['userid'] = $userid;
        $con['dataFlag'] = self::DATAFLAG;
        return $Web_notify->where($con)->select();
    }
    //根据用户名称获取用户信息
    public function getUserinfoByuserName($loginName)
    {
         $Users = D('users');
         return $Users->where(['loginName'=>$loginName])->find();
    }
    //获取个人站内信
   public function getwebnotifys($userid)
   {
       $Web_notify = D('web_notify');
       $con['type']  = array('in','0,1');
       $con['userid'] = $userid;
       $con['dataFlag'] = self::DATAFLAG;
       return $Web_notify->where($con)->count();
   }
    //======================================接口说明start=================================================//
    //APP端首页接口说明
    public function home()
    {
    	$this->display();
    }
    //获取短信接口
    public function getmsgcode()
    {
        $this->display();
    }
    //登录接口
    public function login()
    {
        $this->display();
    }
    //文档接口
    public function api()
    {  
        $this->display();
    }
    //关注的商品列表
    public function favoritelist()
    {
        $this->display();
    }
    //关注商品接口
    public function doFavorite()
    {
        $this->display();
    }
    //取消商品关注接口
    public function cancel()
    {
        $this->display();
    }
    //下单接口
    public function do_order()
    {
        $this->display();
    }
    //商品详情&下单接口
    public function shopdetail()
    {
        $this->display();
    }
    //获取省份接口
    public function province()
    {
        $this->display();
    }
      //获取市级接口
    public function city()
    {
        $this->display();
    }
      //获取县级接口
    public function county()
    {
        $this->display();
    }
    //添加收货地址接口
    public function addaddress()
    {
        $this->display();
    }
    //收货地址信息列表
    public function addressinfo()
    {
        $this->display();
    }
    //设置默认地址的操作
    public function setaddressdefault()
    {
        $this->display();
    }
    //交易界面接口
    public function deal()
    {
        $this->display();
    }
    //加入购物车接口
    public function shop_cart()
    {
        $this->display();
    }
    //购物车信息列表
    public function shopcartlist()
    {
        $this->display();
    }
    //删除用户地址信息列表
    public function deleteaddress()
    {
        $this->display();
    }
    //测试接口
    public function testapi()
    {
        $this->display();
    }
    //订单待交易的接口
    public function orderinfostepone()
    {
        $this->display();
    }
    //单品交易接口
    public function shopdeal()
    {
        $this->display();
    }
    //用户中心接口
    public function userinfo()
    {
        $this->display();
    }
    //订单信息接口
    public function orderinfo()
    {
        $this->display();
    }
    //分享接口
    public function share()
    {
        $this->display();
    }
    //专场活动信息
    public function brandsgoods()
    {
        $this->display();
    }
    //支付宝接口
    public function payment()
    {
        $this->display();
    }
    //支付宝支付
    public function rechargezfb()
    {
        $this->display();
    }
    //修改地址页面
    public function editaddressinfo()
    {
        $this->display();
    }
    //根据规格a和规格b来获取对应的规格信息
    public function specab()
    {
        $this->display();
    }
    //根据规格a获取对应的规格信息
    public function specb()
    {
        $this->display();
    }
    //================================================接口说明end===================================================//

}