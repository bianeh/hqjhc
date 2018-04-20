<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class DealsController extends Controller{
      //微信交易
    public function wechat_do_deals()
    {
            $total_money = I('get.total_money');
            $loginName = I('get.loginName');
            $goodsorderinfo = I('get.goodsorderinfo');
            $price = floatval($total_money);
            $addressid = I('get.addressid');
            $sameorderno = I('get.sameorderno');
            $count = $this->checkUser($loginName);
            if($count != 1)
            {
                $response['code'] = '000004';
                $response['msg'] = '登录用户名不存在！';
                header('Content-type:text/html; Charset=utf8');  
                header( "Access-Control-Allow-Origin:*");  
                header('Access-Control-Allow-Methods:POST');    
                header('Access-Control-Allow-Headers:x-requested-with,content-type');
                die(json_encode($response));
            }       
            header('Access-Control-Allow-Origin: *');
            header('Content-type: text/plain');
            $BASE_URL = $_SERVER['DOCUMENT_ROOT'];
            require_once  "/home/www/hqjhc/api/Common/Payment/wechatsdk3/WxPay.Api.php";
            require_once  "/home/www/hqjhc/api/Common/Payment/wechatsdk3/WxPay.Data.php";
            $UserInfo = $this->getUserInfo($loginName);
            $userid = $UserInfo['userid'];
            $arr['orderno'] = $this->create_order_no();
            $arr['otherorderno'] = $sameorderno;
            $arr['actualpayMoney'] = $price;
            $arr['userid'] = $userid;
            $arr['payType'] = 1;
            $arr['createTime'] = date("Y-m-d H:i:s",time());
            $arr['datasrc'] = 5;
            $arr['remarks'] = "微信购物车订单交易！";
            $arr['status'] = 0;
            $this->order_settlement($arr);
            /**
             * 修改订单的收货地址
             */    
            $OrdersInfo = $this->getsameOrdersInfo($sameorderno);
            foreach ($OrdersInfo as $key => $value) {
                $orderinfo['addressid'] = $addressid;
                $orderno = $value['orderno'];
                $this->updateordersInfo($orderinfo,$orderno);
            }
            // 商品名称
            $subject = '环球集货仓微信app充值';
            $out_trade_no = $arr['orderno'];
            $unifiedOrder = new \WxPayUnifiedOrder();
            $unifiedOrder->SetBody($subject);//商品或支付单简要描述
            $unifiedOrder->SetOut_trade_no($out_trade_no);
            $unifiedOrder->SetTotal_fee($price*100);
            $unifiedOrder->SetTrade_type("APP");
            $WxPayApi = new \WxPayApi();
            $result = $WxPayApi->unifiedOrder($unifiedOrder);
            if (is_array($result)) 
            {
              echo json_encode($result);
            }
    }
    
    //微信交易回调通知
       public function wechatnotify()
       {   
          header('Access-Control-Allow-Origin: *');
          header('Content-type: text/plain');
          $postStr = file_get_contents("php://input");
          $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
          $out_trade_no = $postObj->out_trade_no;
          $result_code = $postObj->result_code;
          $return_code = $postObj->return_code;
          $total_amount = $postObj->total_fee;
          if($result_code == 'SUCCESS' && $return_code == 'SUCCESS')
          {
            $count = $this->getwechatoderInfo($out_trade_no);
            if($count == 1)
            {
                 $this->updatesettlementInfo($out_trade_no);
                 $ordersettlementInfo = $this->getordersettlementInfo($out_trade_no);
                 $order_no = $ordersettlementInfo['otherorderno'];
                 $this->updateOrderstatus($order_no);
                 
                 $OrdersInfo = $this->getsameOrdersInfo($order_no);
                 foreach ($OrdersInfo as $key => $value) {
                        $orderno = $value['orderno'];
                        $this->updateOrderstatus($orderno);  
                    }
                $addressid = $OrdersInfo['addressid'];
                $userid = $OrdersInfo['userid'];                 
                $logs_moneys['amount'] = $total_amount/100;
                $logs_moneys['moneyType'] = 1;
                $logs_moneys['accessType'] = 2;
                $logs_moneys['orderNo'] = $this->create_order_no();
                $logs_moneys['createTime'] = date("Y-m-d H:i:s",time());
                $logs_moneys['datasource'] = 13;
                $logs_moneys['userid'] = $userid;
                $logs_moneys['otherOrderno'] = $orderno;
                $this->logs_moneys_info($logs_moneys); 
                echo "SUCCESS";
            }
          }
       }
    public function getwechatoderInfo($orderno)
       {
            $Ordersettlement = D('order_settlement');
            return $Ordersettlement->where(['orderno'=>$orderno,'status'=>0])->count();
       }
    //支付宝批量交易
    public function zfb_do_deals()
    {
            $total_money = I('get.total_money');
            $loginName = I('get.loginName');
            $goodsorderinfo = I('get.goodsorderinfo');
            $price = floatval($total_money);
            $addressid = I('get.addressid');
            $sameorderno = I('get.sameorderno');
            $count = $this->checkUser($loginName);
            if($count != 1)
            {
                $response['code'] = '000004';
                $response['msg'] = '登录用户名不存在！';
                header('Content-type:text/html; Charset=utf8');  
                header( "Access-Control-Allow-Origin:*");  
                header('Access-Control-Allow-Methods:POST');    
                header('Access-Control-Allow-Headers:x-requested-with,content-type');
                die(json_encode($response));
            }       
            header('Access-Control-Allow-Origin: *');
            header('Content-type: text/plain');
            $BASE_URL = $_SERVER['DOCUMENT_ROOT'];
            require $BASE_URL.'/api/Common/Payment/alipaysdk/aop/AopClient.php';
            require $BASE_URL.'/api/Common/Payment/alipaysdk/aop/request/AlipayTradeAppPayRequest.php';
            // 获取支付金额
            $amount='';    
            $amount = $price;
            $total = floatval($amount);
            if(!$total){
                $total = 0.1;
            }
            $UserInfo = $this->getUserInfo($loginName);
            $userid = $UserInfo['userid'];
            $arr['orderno'] = $this->create_order_no();
            $arr['otherorderno'] = $sameorderno;
            $arr['actualpayMoney'] = $price;
            $arr['userid'] = $userid;
            $arr['payType'] = 1;
            $arr['createTime'] = date("Y-m-d H:i:s",time());
            $arr['datasrc'] = 4;
            $arr['remarks'] = "支付宝购物车订单交易！";
            $arr['status'] = 0;
            $this->order_settlement($arr);
            /**
             * 修改订单的收货地址
             */
            
            $OrdersInfo = $this->getsameOrdersInfo($sameorderno);
            foreach ($OrdersInfo as $key => $value) {
                $orderinfo['addressid'] = $addressid;
                $orderno = $value['orderno'];
                $this->updateordersInfo($orderinfo,$orderno);
            }
            $aop = new \AopClient;
            $aop->gatewayUrl = "https://openapi.alipay.com/gateway.do";
            $aop->appId = "2017112000051992";
            $aop->rsaPrivateKey = "MIIEpAIBAAKCAQEA052+59MUlgsfRpaIt5QePO3ZD+gYSHgd7d1RYXuR+6YhUtGQCRVFgqeTnq8lysL6UWa48TkxyeQxc1WVJ8RfI4voA/9Qw8wCepoffyqoddm9K0245YsunikGE1ATvx08bac7XtwuHZWCTpoQA7SQbFkLIdu+ukZd+63qIwluS2g8rzAXO3sHvOYDt5uDQddDewTJCy7ir54xeKTbhqCl1ctZmVVlc3toBHFVkGgjkWfQzJck6vy2973EwlW+bZ82smBjbl3+k1v1g+H4Rv8D+4Uu8mTsCxafS/j1wQgmP/kn5+on506SpkYwPvzmmoIbfJ9dr2B0E5jiQ5N9YTapgwIDAQABAoIBAQCLpjEiqaCPN/3Gxnaot12RFeFF5wOHZ4VQwNoAu9xltoeNMPCdneUGSPJZKPqGqU8pwuFPh0/9DNM5aoQI/0VNnvlZEfdJjusf32/jqtILG8sDtcHL8aKtCyOQQSsW1wNW1aKPgjwIl+6rUm45E8KvTb/T80EVinRhL68wufuIVKhBuJco9MLFOXWnEs+SslAwu7E0aYAoakFrio+nyCNIVDYM+Oj5CypVEg4pgUrNVBj9LZTZNYZ8KNjfx76N2EZb+w21Heexue4KNILRCFBQi9c10xgsar0KzXKce/YNmvJnoqhGcNWq2pM96w/RO6HAoV7g4mwhROCYH3+5brDJAoGBAP3wfGqw1hCQyb1XZT0sBlgesHHyHP8S3brPZe73JkEtbjbJ43VbdhWD1WH5LHiogeECTTcxmMsrsnzY6YxSl+TvaYKY3to/S/RjGssuhRT8Y9MS86rxn/0RuDQLCnjzMBb/vaLkdq4bApyXDPCcF4PQCVIDGdKV/rQupmELTxcfAoGBANVVVz2C/cdsD2zOXaUAsOu4sYtkv64CKEUMJ+u8VEXpF+iWfx7Kb9YVxuZjOWSP6k8hGjzDwK1MRqH1AkBuuKnnLnw00+4Im0vztjkw9puekbyPKIfm7PrOK9FnM+xgrIkOvLlUl8l7s2/+6ZZllGTfujV/INetSxabLGNRtJUdAoGBAIdTWipNNLa9QhU59sSjqnnZWPRQLy2rcygzkEHJycQgHsTpz+JhrEsI53T/obhnLFepr1aDgsZ68fJgcg2KklG5WEP1jYVHCAYjrkqq7tbhLZ11Uw89FqJ5h+2MGLed+Xm4LeoZ0Dk2Qa0LPiUXOdzPx7fB2UgFESgaWCYNLcfHAoGAeZBc2ydmt5nDHGxn/ltrdZdUTKtHcr+19MqdgP5bQ081GYuQupn+qo7UPXpzPPOpQBgL3G5rwBTD9wwnkVHGlsKuwYZU8cIjxF8HCoX1MO5l+33UScT0a2LKo1Pcyai5CIzGTBGBQQXlVT98GgCeU/ENKejcbSpJrIMWAy6O6Z0CgYAsFThTOiDGORGYpEZCdY2XOL1oWZAhKffn/DI55QhjemVDAYZElDBGgXlNf1fgqBFBcCWh/2g5XUV4QKM0zGJjdL3HEZSbYUYMYYo361Bbg+U0U5hH2smfwSBVW9oa6h/1qkzuhLiD6MmcBcbDcHtMK3Nohb9i2SidC1acHO8QRg==";
            $aop->charset = "UTF-8";
            $aop->signType = "RSA2";
            $aop->alipayrsaPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA052+59MUlgsfRpaIt5QePO3ZD+gYSHgd7d1RYXuR+6YhUtGQCRVFgqeTnq8lysL6UWa48TkxyeQxc1WVJ8RfI4voA/9Qw8wCepoffyqoddm9K0245YsunikGE1ATvx08bac7XtwuHZWCTpoQA7SQbFkLIdu+ukZd+63qIwluS2g8rzAXO3sHvOYDt5uDQddDewTJCy7ir54xeKTbhqCl1ctZmVVlc3toBHFVkGgjkWfQzJck6vy2973EwlW+bZ82smBjbl3+k1v1g+H4Rv8D+4Uu8mTsCxafS/j1wQgmP/kn5+on506SpkYwPvzmmoIbfJ9dr2B0E5jiQ5N9YTapgwIDAQAB';
            //实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
            $request = new \AlipayTradeAppPayRequest();
            
            // 异步通知地址
            $notify_url = urlencode('http://118.31.45.231/api.php/Home/Deals/zfbnotify');
            // 订单标题
            $subject = '集货仓APP端支付购买交易';
            // 订单详情
            $body = '环球集货仓APP端支付宝购买交易'; 
            // 订单号，示例代码使用时间值作为唯一的订单ID号
            $out_trade_no = $arr['orderno'];
            //SDK已经封装掉了公共参数，这里只需要传入业务参数
            $bizcontent = "{\"body\":\"".$body."\","
                            . "\"subject\": \"".$subject."\","
                            . "\"out_trade_no\": \"".$out_trade_no."\","
                            . "\"timeout_express\": \"30m\","
                            . "\"total_amount\": \"".$total."\","
                            . "\"product_code\":\"QUICK_MSECURITY_PAY\""
                            . "}";
            $request->setNotifyUrl($notify_url);
            $request->setBizContent($bizcontent);
            //这里和普通的接口调用不同，使用的是sdkExecute
            $response = $aop->sdkExecute($request);
            // 注意：这里不需要使用htmlspecialchars进行转义，直接返回即可
            echo $response;
    }
    
    //支付宝交易回调通知
       public function zfbnotify()
       {
           $BASE_URL = $_SERVER['DOCUMENT_ROOT'];
           require $BASE_URL.'/api/Common/Payment/alipaysdk/aop/AopClient.php';
           $aop = new \AopClient;
           $aop->alipayrsaPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAgMXDCMcHEmwerWmj18LF9mw3umfKhAXwnQaR2NlW84tMTNwqmOzgB9A37s+UCPIdXLzWGXIjgeXGmHVXHaBSq1shaQFmvHp8PzYyCyUGGm659KNzGYuED+/eBKV6N3i+PeAM/hwuEg0OJQL1UzfoNE+751HFNOc3kHLecwNqUKucLPE9G/ZtiAYwhxVpUCY0D29T9BlNa0I6Eb+QslahU8bXH6gwE0/Zz8HNffhSMY9QxItLXTEi1ZkaqmOdRYahyQtObaGOWnbyG/R27hDo5sl/uKGq5xzp27ITwTmvsY5x/3LFXd/V++Rime1DzUn3Ebx+0UdA6jMihZwpjDw0fwIDAQAB';
           $flag = $aop->rsaCheckV1($_POST,NULL,"RSA2");
           $out_trade_no = $_POST['out_trade_no'];
           $trade_no = $_POST['trade_no'];
           $trade_status = $_POST['trade_status'];
           $total_amount = $_POST['total_amount'];
           $app_id = $_POST['app_id'];
          
           $data['out_trade_no'] = $out_trade_no;
           $data['trade_no'] = $trade_no;
           $data['trade_status'] = $trade_status;
           $data['total_amount'] = $total_amount;
           $data['app_id'] = $app_id;
           if($flag)
           {
                 if($trade_status != 'TRADE_FINISHED' && $trade_status != 'TRADE_SUCCESS')
                 {
                      exit('fail');
                 }
                 $this->updatesettlementInfo($out_trade_no);
                 $ordersettlementInfo = $this->getordersettlementInfo($out_trade_no);   
                 $order_no = $ordersettlementInfo['otherorderno'];
                 $this->updateOrderstatus($order_no);
                 $OrdersInfo = $this->getsameOrdersInfo($order_no);
                 foreach ($OrdersInfo as $key => $value) {
                        $orderno = $value['orderno'];
                        $this->updateOrderstatus($orderno);  
                }
                $addressid = $OrdersInfo['addressid'];
                $userid = $OrdersInfo['userid'];                 
//                $arr['orderno'] = $this->create_order_no();
//                $arr['actualpayMoney'] = $dprice;
//                $arr['userid'] = $userid;
//                $arr['payType'] = 3;
//                $arr['createTime'] = date("Y-m-d H:i:s",time());
//                $arr['orderStatus'] = 1;
//                $arr['datasrc'] = 6;
//                $arr['remarks'] = "账户进行购物车订单交易！";
//                $this->order_settlement($arr); 
                $logs_moneys['amount'] = $total_amount;
                $logs_moneys['moneyType'] = 1;
                $logs_moneys['accessType'] = 2;
                $logs_moneys['orderNo'] = $this->create_order_no();
                $logs_moneys['createTime'] = date("Y-m-d H:i:s",time());
                $logs_moneys['datasource'] = 11;
                $logs_moneys['userid'] = $userid;
                $logs_moneys['otherOrderno'] = $orderno;
                $this->logs_moneys_info($logs_moneys); 
           }
           echo 'success';
       }
    //处理批量交易
    public function do_deals()
    {
        $total_money = I('post.total_money');
        $loginName = I('post.loginName');
        $goodsorderinfo = I('post.goodsorderinfo');
        $dprice = floatval($total_money);
        $addressid = I('post.addressid');
        $count = $this->checkUser($loginName);
        if($count != 1)
        {
            $response['code'] = '000004';
            $response['msg'] = '登录用户名不存在！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        $UserInfo = $this->getUserInfo($loginName);
        $userid = $UserInfo['userid'];
        $usermoney = $UserInfo['usermoney'];
        if($usermoney < $dprice)
        {
            $response['code'] = '000002';
            $response['msg'] = '用户账户金额不足！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        $res = $this->updateUserfunds($userid,$usermoney,$price);
        foreach ($goodsorderinfo as $key => $value) {
            $orderno = $value['orderno'];
            $this->updateOrderstatus($orderno); 
            $orderinfo['addressid'] = $addressid;
            $this->updateordersInfo($orderinfo,$orderno);
            }  
            $arr['orderno'] = $this->create_order_no();
            $arr['actualpayMoney'] = $dprice;
            $arr['userid'] = $userid;
            $arr['payType'] = 3;
            $arr['createTime'] = date("Y-m-d H:i:s",time());
            $arr['orderStatus'] = 1;
            $arr['datasrc'] = 6;
            $arr['remarks'] = "账户进行购物车订单交易！";
            $this->order_settlement($arr); 
            $logs_moneys['amount'] = $dprice;
            $logs_moneys['moneyType'] = 1;
            $logs_moneys['accessType'] = 2;
            $logs_moneys['orderNo'] = $this->create_order_no();
            $logs_moneys['createTime'] = date("Y-m-d H:i:s",time());
            $logs_moneys['datasource'] = 12;
            $logs_moneys['userid'] = $userid;
            $logs_moneys['otherOrderno'] = $orderno;
            $this->logs_moneys_info($logs_moneys); 
        
            $response['code'] = '000008';
            $response['msg'] = '交易操作成功！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        
    }
    
     //=============================公用函数 start =============================//
     //或取相同订单信息
     public function getsameOrdersInfo($sameorderno)
     {
         $Orders = D('orders');
         return $Orders->where(['sameorderNo'=>$sameorderno])->select();
     }
     //更改购物车的状态
       public function updateshopcartstatus($orderno)
       {   
           $Shop_cart = D('shop_cart');
           $data['status'] = 1;
           $Shop_cart->where(['orderNo'=>$orderno])->save($data);
       }
       //更改用户的订单的收货地址信息
       public function updateordersInfo(array $orderinfo,$orderno)
       {
           $Orders = D('orders');
           $Orders->where(['orderNo'=>$orderno])->save($orderinfo);
       }
       //获取orders信息
       public function getOrdersInfo($orderno)
       {
           $Orders = D('orders');
           return $Orders->where(['orderno'=>$orderno])->find();
       }
       //更新交易订单状态
       public function updatesettlementInfo($orderno)
       {
           $Ordersettlement = D('order_settlement');
           $data['status'] = 1;
           $Ordersettlement->where(['orderno'=>$orderno])->save($data);
       }
       //获取交易订单信息
       public function getordersettlementInfo($orderno)
       {
          $Ordersettlement = D('order_settlement');
          return $Ordersettlement->where(['orderno'=>$orderno])->find();
       }
       //更新订单状态
       public function updateRechargestatus($orderno)
       {
           $Recharge = D('recharge');
           $data['status'] = 1;
           return $Recharge->where(['orderNo'=>$orderno])->save($data);
       }
       //根据订单号查询
       public function getorderInfobyOrderno($orderno)
       {
           $Recharge = D('recharge');
           return $Recharge->where(['orderNo'=>$orderno])->find();
       }
       //更新用户的可用余额
      public function updateUserfundsInfo($userid,$Fundsinfo)
      {
         $Users = M('users');
         return $Users->where(['userid'=>$userid])->save($Fundsinfo);
       }
       //根据userid获取用户信息
       public function getUserInfoByUserid($userid)
       {
           $Users = M('users');
           return $Users->where(['userid'=>$userid])->find();
       }
       
       
    public function order_address(array $arr)
    {
        $Order_address =  D('order_address');
        $Order_address->add($arr);
    }
    public function getOrderInfo($orderno)
    {
        $Orders = M('orders');
        return $Orders->where(['orderNo'=>$orderno])->find();
    }
    public function getGoodsInfo($goodsid)
    {
        $Goods = M('goods');
        return $Goods->where(['id'=>$goodsid])->find();
    }
    public function getBrandidInfo($brandid)
    {
        $Brands = M('brands');
        return $Brands->where(['brandid'=>$brandid])->find();
    }
    public function checkUser($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->count();
    }
    public function getUserInfo($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->find();
    }
    public function updateUserfunds($userid,$usermoney,$price)
    {
        $Users = D('users');
        $data['userMoney'] = $usermoney - $price;
        return $Users->where(['userid'=>$userid])->save($data);
    }
    public function updateOrderstatus($orderno)
    {
        $Orders = D('orders');
        $orders_info['orderStatus'] = 1;
        $orders_info['applystatus'] = 1;
        $orders_info['payTime'] = date("Y-m-d H:i:s",time());
        $Orders->where(['orderNo'=>$orderno])->save($orders_info);
    }
    public function order_settlement(array $arr)
    {
        $Ordersettlement = D('order_settlement');
        $Ordersettlement->add($arr);
    }
    public function logs_moneys_info(array $arr)
    {
        $Logs_moneys = D('logs_moneys');
        $Logs_moneys->add($arr);
    }
     /**
     * 生成订单号
     * @return string
     */
    public function create_order_no()
    {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
    //===============================公用函数 end =============================//
}