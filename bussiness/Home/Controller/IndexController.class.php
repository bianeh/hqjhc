<?php
namespace Home\Controller;
use \Common\Controllers\BaseController;
use Home\Model\OffersfeedbackModel;
class IndexController extends BaseController {
    public function index()
    {   
        $offerid = $this->_data['offerid'];
        //获取今日下单数
        $todayorders = $this->getTodayorders($offerid);
        //获取今日成交金额
        $todaymoney = $this->getTodaydeal($offerid);
        
        if(!$todaymoney)
        {
            $todaymoney = '0.00';
        }
        //获取商品关注人数
        $productfavoritesnum = $this->getproductfavoritesnums($offerid);
        //已发布产品的总数
        $productnums = $this->getproductnums($offerid);
        //获取每个月的销量
        $offerid = $this->_data['offerid'];
        $orderInfo = $this->getorderspermonths($offerid);
        $orderdate = [];
        $ordercount = [];
        foreach ($orderInfo as $key => $value) {
            $orderdate[] = $value['months'];
            $ordercount[]= $value['count'];
        }
        //获取每个月的财务收入
        $FundsInfo = $this->getfundspermonths($offerid);
        $fundsdate = [];
        $fundscount = [];
        foreach ($FundsInfo as $key => $value) {
            $fundsdate[] = $value['months'];
            $fundscount[]= $value['money'];
        }
        $this->assign('fundsdate', json_encode($fundsdate));
        $this->assign('fundscount', json_encode($fundscount));
        $this->assign('orderdate', json_encode($orderdate));
        $this->assign('ordercount', json_encode($ordercount));
        $this->assign('todayorders',$todayorders);
        $this->assign('todaymoney',$todaymoney);
        $this->assign('productfavoritesnum',$productfavoritesnum);
        $this->assign('productnums',$productnums);
    	$this->assign("data",$this->_data);
        $this->display();
    }
    //获取每个月的财务收入
    public function getfundspermonths($offerid)
    {
        $sql = "select DATE_FORMAT(a.createTime,'%Y/%m') months,sum(a.actualpayMoney) money from hqjhc_order_settlement a left join hqjhc_orders b ON a.orderNo = b.orderNo left join hqjhc_goods c ON b.goodsid = c.id where c.offerid = $offerid group by months";
        $Model =M();
        return $Model->query($sql);
    }
    //获取每个月的销量
    public function getorderspermonths($offerid)
    {
        $sql = "select DATE_FORMAT(hqjhc_orders.createTime,'%Y/%m') months,count(hqjhc_orders.orderid) count from hqjhc_orders left join hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id where hqjhc_goods.offerid = $offerid group by months";
        $Model =M();
        return $Model->query($sql);
    }
    //获取已发布产品总数
    public function getproductnums($offerid)
    {
         $Favorites = D('goods');
         $con['hqjhc_goods.offerid'] = $offerid;
         $count = $Favorites
                 ->where($con)
                 ->count();
         return $count;
    }
    //获取商品关注人数
    public function getproductfavoritesnums($offerid)
    {
         $Favorites = D('favorites');
         $con['hqjhc_goods.offerid'] = $offerid;
         $count = $Favorites
                 ->join("LEFT JOIN hqjhc_goods ON hqjhc_goods.id = hqjhc_favorites.targetid")
                 ->where($con)
                 ->count();
         return $count;
    }
    //获取今日成交金额
    public function getTodaydeal($offerid)
    {
        $Order_settlement = D('order_settlement');
        $con['hqjhc_goods.offerid'] = $offerid;
        $con['hqjhc_order_settlement.status'] = 1;
        $count = $Order_settlement
                ->join("LEFT JOIN hqjhc_orders ON hqjhc_order_settlement.orderNo = hqjhc_orders.orderNo")
                ->join("LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id")
                ->where($con)
                ->sum('hqjhc_order_settlement.actualpayMoney');
        return $count;
                
    }
    //获取今日下单数
    public function getTodayorders($offerid)
    {
        $Orders = D('orders');
        $con['hqjhc_goods.offerid'] = $offerid;
        $count = $Orders
              ->join("LEFT JOIN hqjhc_goods ON hqjhc_orders.goodsid = hqjhc_goods.id")
              ->where($con)
              ->count();
        return $count;
    }
    
    /**
     * 反馈提交
     */
    public function doAddfeedback()
    {
         $OffersfeedbackModel = new OffersfeedbackModel();
         $res = $OffersfeedbackModel->modelAddfeedback();
         if($res == 1)
         {
         	 $this->success("反馈提交操作成功！");
         }
         else
         {
         	$this->error($res);
         }
    }
}
?>