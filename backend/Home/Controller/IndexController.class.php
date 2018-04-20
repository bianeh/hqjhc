<?php
namespace Home\Controller;
use \Common\Controllers\BaseController;
class IndexController extends BaseController
{
    public function index()
    {   
        $Data = M('logs_staffs_logins');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 10);
        $show       = $Page->show();
        $orderby['loginid']='desc';
        $list = $Data->where($con)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list as $key => $value) {
            $createstaffid = $value['staffid'];
            if($createstaffid != '')
            {
                $staffModel = new \Common\Model\StaffsModel();
                $res = $staffModel ->modelStaffsByid($createstaffid);
                $list[$key]['staffname'] = $res['loginname'];
            }
            else
            {
                $list[$key]['staffname'] = '';
            }

        }
        
        //今日下单数目
        $todayOrdernum = $this->getTodayorderNums();
        //获取今日成交额
        $todaymoney = $this->getTodaydealmoney();
        //新增会员数目
        $usersnum = $this->getUsersNums();
        //已发布产品数
        $goodsnum = $this->getproductNums();
        //获取每个月新增的会员
        $info = $this->getUserinfo();
        $date = [];
        $count = [];
        foreach ($info as $key => $value) {
            $date[] = $value['months'];
            $count[]= $value['count'];
        }
        //获取每个月的微商下单量
        $orderInfo = $this->getordersMonth();
        $orderdate = [];
        $ordercount = [];
        foreach ($orderInfo as $key => $value) {
            $orderdate[] = $value['months'];
            $ordercount[]= $value['count'];
        }
        $this->assign('date', json_encode($date));
        $this->assign('count', json_encode($count));
        $this->assign('orderdate', json_encode($orderdate));
        $this->assign('ordercount', json_encode($ordercount));
        $this->assign('todayordernum',$todayOrdernum);
        $this->assign('todaymoney',$todaymoney);
        $this->assign('usersnum',$usersnum);
        $this->assign('goodsnum',$goodsnum);
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //获取每个与的微商下单量
    public function getordersMonth()
    {
        $sql = "select DATE_FORMAT(createTime,'%Y/%m') months,count(orderid) count from hqjhc_orders group by months";
        $Model =M(); // 实例化一个model对象 没有对应任何数据表
        return $Model->query($sql);
    }
    //获取每个月新增的会员
    public function getUserinfo()
    {  
        
        $sql = "select DATE_FORMAT(createTime,'%Y/%m') months,count(userid) count from hqjhc_users group by months";
        $Model =M(); // 实例化一个model对象 没有对应任何数据表
        return $Model->query($sql);
    }
    //获取今日下单数
    public function getTodayorderNums()
    {
        $Orders = D('orders');
        $NowTime = date('Y-m-d',time());
        $con['createTime'] = ['gt',$NowTime];
        return $Orders->where($con)->count();
    }
    //获取今日成交额
    public function getTodaydealmoney()
    {
        $Order_settlement = D('order_settlement');
        return  $Order_settlement->where(['status'=>1])->sum('actualpayMoney');
    }
    //获取会员的数目
    public function getUsersNums()
    {
        $Users = D('users');
        return $Users->count();
    }
    //获取已发布的产品数
    public function getproductNums()
    {
        $Goods = D('goods');
        return $Goods->count();
    }
}
?>