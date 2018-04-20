<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class RechargeController extends Controller
{     
      //微信购买VIP
      public function wechat_buy_vip()
      {   
          
          header('Access-Control-Allow-Origin: *');
          header('Content-type: text/plain');
          $BASE_URL = $_SERVER['DOCUMENT_ROOT'];
          require_once  "/home/www/hqjhc/api/Common/Payment/wechatsdk1/WxPay.Api.php";
          require_once  "/home/www/hqjhc/api/Common/Payment/wechatsdk1/WxPay.Data.php";
          // 获取支付金额
          $total = $_GET['total'];
          $total = round($total*100); // 将元转成分
          if(empty($total)){
            $total = 1;
          }
          $level = $_GET['level'];
          $loginName = $_GET['loginName'];
          $UserInfo = $this->getUserInfo($loginName);
          $userid = $UserInfo['userid'];
          $data['examount'] = $UserInfo['usermoney'];
          $data['userid'] = $userid;
          $data['amount'] = $total/100;
          $data['remarks'] = 'APP端微信购买VIP';
          $data['datasrc'] = '2';
          $data['createTime'] = date("Y-m-d H:i:s",time());
          $data['status'] = 0;
          $data['level'] = $level;
          $data['orderNo'] = $this->create_order_no();
          $Recharge = M('viprecharge');
          $Recharge->add($data);

          // 商品名称
          $subject = '环球集货仓微信app充值';
          $out_trade_no = $data['orderNo'];
          $unifiedOrder = new \WxPayUnifiedOrder();
          $unifiedOrder->SetBody($subject);//商品或支付单简要描述
          $unifiedOrder->SetOut_trade_no($out_trade_no);
          $unifiedOrder->SetTotal_fee($total);
          $unifiedOrder->SetTrade_type("APP");
          $WxPayApi = new \WxPayApi();
          $result = $WxPayApi->unifiedOrder($unifiedOrder);
          if (is_array($result)) 
          {
            echo json_encode($result);
          }
      }
       //微信购买VIP回调
      public function wechat_vip_notify()
      {
          header('Access-Control-Allow-Origin: *');
          header('Content-type: text/plain');
          $postStr = file_get_contents("php://input");
          $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
          $out_trade_no = $postObj->out_trade_no;
          $result_code = $postObj->result_code;
          $return_code = $postObj->return_code;
          if($result_code == 'SUCCESS' && $return_code == 'SUCCESS')
          {
            $count = $this->getwechatvipoderInfo($out_trade_no);
            if($count == 1)
            {
                    $this->updateViporderstatus($out_trade_no);
                    $RechargeInfo = $this->getviporderInfobyOrderno($out_trade_no);
                    $userid = $RechargeInfo['userid'];
                    $level = $RechargeInfo['level'];
                    $UserInfo = $this->getUserInfoByUserid($userid);
                    $data['examount'] = $UserInfo['usermoney'];
                    $data['userid'] = $userid;
                    $data['amount'] = $RechargeInfo['amount'];
                    $data['datasrc'] = 2;
                    $data['createTime'] = date("Y-m-d H:i:s",time());
                    $data['orderNo'] = $RechargeInfo['orderno'];
                    $userInfo['vip'] = $level;
                    $Users = D('users');
                    $Users->where(['userid'=>$userid])->save($userInfo);
                    $logs_moneys_remark['amount'] = $RechargeInfo['amount'];
                    $logs_moneys_remark['moneyType'] = 1;
                    $logs_moneys_remark['accessType'] = 2;
                    $logs_moneys_remark['orderNo'] = $RechargeInfo['orderno'];
                    $logs_moneys_remark['datasource'] = 8;
                    $logs_moneys_remark['createTime'] = date("Y-m-d H:i:s",time());
                    $logs_moneys_remark['userid'] = $userid;       
                    $Logs_Recharge = M('logs_viprecharge');
                    $Logs_Moneys = M('logs_moneys');
                    $res = $Logs_Recharge->add($data);
                    $Logs_Moneys->add($logs_moneys_remark);
            }
          }
      }
       //获取订单信息
      public function getwechatvipoderInfo($out_trade_no)
      {
            $Recharge = D('viprecharge');
            return  $Recharge->where(['orderNo'=>$out_trade_no,'status'=>0])->count();
      }
      //钱包购买VIP
      public function bags_buy_vip()
      {
            header('Access-Control-Allow-Origin: *');
            header('Content-type: text/plain');
            $amount = I('post.total');
            $loginName = I('post.loginName');
            $level = I('post.level');
            $UserInfo = $this->getUserInfo($loginName);
            $userid = $UserInfo['userid'];     
            $usermoney = $UserInfo['usermoney'];
            if($amount > $usermoney)
            {
                $response['code'] = '000006';
                $response['msg'] = '余额不足！';
                header('Content-type:text/html; Charset=utf8');  
                header( "Access-Control-Allow-Origin:*");  
                header('Access-Control-Allow-Methods:POST');    
                header('Access-Control-Allow-Headers:x-requested-with,content-type');
                die(json_encode($response));
            }
            $data['examount'] = $UserInfo['usermoney'];
            $data['userid'] = $userid;
            $data['amount'] = $amount;
            $data['remarks'] = '钱包购买VIP';
            $data['datasrc'] = '3';
            $data['createTime'] = date("Y-m-d H:i:s",time());
            $data['status'] = 1;
            $data['level'] = $level;
            $data['orderNo'] = $this->create_order_no();
            $Recharge = M('viprecharge');
            $Recharge->add($data);
            $data['examount'] = $UserInfo['usermoney'];
            $data['userid'] = $userid;
            $data['amount'] = $amount;
            $data['datasrc'] = 3;
            $data['createTime'] = date("Y-m-d H:i:s",time());
            $data['orderNo'] = $this->create_order_no();
            $userInfo['vip'] = $level;
            $Users = D('users');          
            $Users->where(['userid'=>$userid])->save($userInfo);
            $logs_moneys_remark['amount'] = $amount;
            $logs_moneys_remark['moneyType'] = 1;
            $logs_moneys_remark['accessType'] = 2;
            $logs_moneys_remark['orderNo'] = $out_trade_no;
            $logs_moneys_remark['datasource'] = 10;
            $logs_moneys_remark['createTime'] = date("Y-m-d H:i:s",time());
            $logs_moneys_remark['userid'] = $userid;       
            $Logs_Recharge = M('logs_viprecharge');
            $Logs_Moneys = M('logs_moneys');
            $res = $Logs_Recharge->add($data);
            $Logs_Moneys->add($logs_moneys_remark);
            $response['code'] = '000008';
            $response['msg'] = '购买成功！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
      }
      
      //支付宝购买VIP
      public function zfb_buy_vip()
      {
            header('Access-Control-Allow-Origin: *');
            header('Content-type: text/plain');
            $BASE_URL = $_SERVER['DOCUMENT_ROOT'];
            require $BASE_URL.'/api/Common/Payment/alipaysdk/aop/AopClient.php';
            require $BASE_URL.'/api/Common/Payment/alipaysdk/aop/request/AlipayTradeAppPayRequest.php';
            // 获取支付金额
            $amount='';    
            $amount = I('get.total');
            $level = I('get.level');
            $total = floatval($amount);
            if(!$total){
                $total = 0.1;
            }
            $loginName = I('get.loginName');
            $UserInfo = $this->getUserInfo($loginName);
            $userid = $UserInfo['userid'];
            $data['examount'] = $UserInfo['usermoney'];
            $data['userid'] = $userid;
            $data['amount'] = $total;
            $data['remarks'] = 'APP端支付宝购买VIP';
            $data['datasrc'] = '1';
            $data['createTime'] = date("Y-m-d H:i:s",time());
            $data['status'] = 0;
            $data['level'] = $level;
            $data['orderNo'] = $this->create_order_no();
            $Recharge = M('viprecharge');
            $Recharge->add($data);
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
            $notify_url = urlencode('http://118.31.45.231/api.php/Home/Recharge/zfb_vip_notify');
            // 订单标题
            $subject = '集货仓APP支付宝购买vip';
            // 订单详情
            $body = '环球集货仓APP端支付宝购买vip'; 
            // 订单号，示例代码使用时间值作为唯一的订单ID号
            $out_trade_no = $data['orderNo'];
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
       //支付宝购买VIP结果回调通知
       public function zfb_vip_notify()
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
                $this->updateOrderstatus($out_trade_no);
                $RechargeInfo = $this->getviporderInfobyOrderno($out_trade_no);
                $userid = $RechargeInfo['userid'];
                $level = $RechargeInfo['level'];
                $UserInfo = $this->getUserInfoByUserid($userid);
                $data['examount'] = $UserInfo['usermoney'];
                $data['userid'] = $userid;
                $data['amount'] = $RechargeInfo['amount'];
                $data['datasrc'] = 1;
                $data['createTime'] = date("Y-m-d H:i:s",time());
                $data['orderNo'] = $RechargeInfo['orderno'];
                $userInfo['vip'] = $level;
                $Users = D('users');
                $Users->where(['userid'=>$userid])->save($userInfo);
                $logs_moneys_remark['amount'] = $RechargeInfo['amount'];
                $logs_moneys_remark['moneyType'] = 1;
                $logs_moneys_remark['accessType'] = 2;
                $logs_moneys_remark['orderNo'] = $RechargeInfo['orderno'];
                $logs_moneys_remark['datasource'] = 9;
                $logs_moneys_remark['createTime'] = date("Y-m-d H:i:s",time());
                $logs_moneys_remark['userid'] = $userid;       
                $Logs_Recharge = M('logs_viprecharge');
                $Logs_Moneys = M('logs_moneys');
                $res = $Logs_Recharge->add($data);
                $Logs_Moneys->add($logs_moneys_remark);
           }
           echo 'success';
       }
      //微信app充值
      public function wechatrecharege()
      {
          header('Access-Control-Allow-Origin: *');
          header('Content-type: text/plain');
          $BASE_URL = $_SERVER['DOCUMENT_ROOT'];
          require_once  "/home/www/hqjhc/api/Common/Payment/wechatsdk/WxPay.Api.php";
          require_once  "/home/www/hqjhc/api/Common/Payment/wechatsdk/WxPay.Data.php";
         
          $total = $_GET['total'];
          $total = round($total*100); // 将元转成分
          if(empty($total)){
            $total = 100;
          }
          $loginName = I('get.loginName');
          $UserInfo = $this->getUserInfo($loginName);
          $userid = $UserInfo['userid'];
          $data['examount'] = $UserInfo['usermoney'];
          $data['userid'] = $userid;
          $data['amount'] = $total/100;
          $data['remarks'] = 'APP端微信充值';
          $data['datasrc'] = '2';
          $data['createTime'] = date("Y-m-d H:i:s",time());
          $data['status'] = 0;
          $data['orderNo'] = $this->create_order_no();
          $Recharge = M('recharge');
          $Recharge->add($data);

          // 商品名称
          $subject = '环球集货仓微信app充值';
          $out_trade_no = $data['orderNo'];
          $unifiedOrder = new \WxPayUnifiedOrder();
          $unifiedOrder->SetBody($subject);//商品或支付单简要描述
          $unifiedOrder->SetOut_trade_no($out_trade_no);
          $unifiedOrder->SetTotal_fee($total);
          $unifiedOrder->SetTrade_type("APP");
          $WxPayApi = new \WxPayApi();
          $result = $WxPayApi->unifiedOrder($unifiedOrder);
          if (is_array($result)) 
          {
            echo json_encode($result);
          }
      }
      //微信APP充值回调
      public function wechatrecharge_notify()
      {
          header('Access-Control-Allow-Origin: *');
          header('Content-type: text/plain');
          $postStr = file_get_contents("php://input");
          $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
          $out_trade_no = $postObj->out_trade_no;
          $result_code = $postObj->result_code;
          $return_code = $postObj->return_code;
          if($result_code == 'SUCCESS' && $return_code == 'SUCCESS')
          {
            $count = $this->getwechatoderInfo($out_trade_no);
            if($count == 1)
            {
                  $this->updateOrderstatus($out_trade_no);
                  $RechargeInfo = $this->getorderInfobyOrderno($out_trade_no);
                  $userid = $RechargeInfo['userid'];
                  $UserInfo = $this->getUserInfoByUserid($userid);
                  $data['examount'] = $UserInfo['usermoney'];
                  $data['userid'] = $userid;
                  $data['amount'] = $RechargeInfo['amount'];
                  $data['datasrc'] = 2;
                  $data['createTime'] = date("Y-m-d H:i:s",time());
                  $data['orderNo'] = $RechargeInfo['orderno'];
                  $Fundsinfo['userMoney'] = $data['amount'] + $UserInfo['usermoney'];
                  $this->updateUserfundsInfo($userid,$Fundsinfo);
                  $logs_moneys_remark['amount'] = $RechargeInfo['amount'];
                  $logs_moneys_remark['moneyType'] = 1;
                  $logs_moneys_remark['accessType'] = 1;
                  $logs_moneys_remark['orderNo'] = $RechargeInfo['orderno'];
                  $logs_moneys_remark['datasource'] = 2;
                  $logs_moneys_remark['createTime'] = date("Y-m-d H:i:s",time());
                  $logs_moneys_remark['userid'] = $userid;       
                  $Logs_Recharge = M('logs_recharge');
                  $Logs_Moneys = M('logs_moneys');
                  $res = $Logs_Recharge->add($data);
                  $Logs_Moneys->add($logs_moneys_remark);
                  echo 'SUCCESS';
            }
          }
      }
      //获取订单信息
      public function getwechatoderInfo($out_trade_no)
      {
            $Recharge = D('recharge');
            return  $Recharge->where(['orderNo'=>$out_trade_no,'status'=>0])->count();
      }
      //支付宝充值
      public function zfbrecharge()
      {
            header('Access-Control-Allow-Origin: *');
            header('Content-type: text/plain');
            $BASE_URL = $_SERVER['DOCUMENT_ROOT'];
            require $BASE_URL.'/api/Common/Payment/alipaysdk/aop/AopClient.php';
            require $BASE_URL.'/api/Common/Payment/alipaysdk/aop/request/AlipayTradeAppPayRequest.php';
            // 获取支付金额
            $amount='';    
            $amount = I('get.total');
            $total = floatval($amount);
            if(!$total){
                $total = 0.1;
            }
            $loginName = I('get.loginName');
            $UserInfo = $this->getUserInfo($loginName);
            $userid = $UserInfo['userid'];
            $data['examount'] = $UserInfo['usermoney'];
            $data['userid'] = $userid;
            $data['amount'] = $total;
            $data['remarks'] = 'APP端支付宝充值';
            $data['datasrc'] = '1';
            $data['createTime'] = date("Y-m-d H:i:s",time());
            $data['status'] = 0;
            $data['orderNo'] = $this->create_order_no();
            $Recharge = M('recharge');
            $Recharge->add($data);           
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
            $notify_url = urlencode('http://118.31.45.231/api.php/Home/Recharge/zfbnotify');
            // 订单标题
            $subject = '集货仓APP端充值';
            // 订单详情
            $body = '环球集货仓APP端支付宝充值'; 
            // 订单号，示例代码使用时间值作为唯一的订单ID号
            $out_trade_no = $data['orderNo'];
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
       //支付宝充值回调通知
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
                $this->updateOrderstatus($out_trade_no);
                $RechargeInfo = $this->getorderInfobyOrderno($out_trade_no);
                $userid = $RechargeInfo['userid'];
                $UserInfo = $this->getUserInfoByUserid($userid);
                $data['examount'] = $UserInfo['usermoney'];
                $data['userid'] = $userid;
                $data['amount'] = $RechargeInfo['amount'];
                $data['datasrc'] = 1;
                $data['createTime'] = date("Y-m-d H:i:s",time());
                $data['orderNo'] = $RechargeInfo['orderno'];
                $Fundsinfo['userMoney'] = $data['amount'] + $UserInfo['usermoney'];
                $this->updateUserfundsInfo($userid,$Fundsinfo);
                $logs_moneys_remark['amount'] = $RechargeInfo['amount'];
                $logs_moneys_remark['moneyType'] = 1;
                $logs_moneys_remark['accessType'] = 1;
                $logs_moneys_remark['orderNo'] = $RechargeInfo['orderno'];
                $logs_moneys_remark['datasource'] = 1;
                $logs_moneys_remark['createTime'] = date("Y-m-d H:i:s",time());
                $logs_moneys_remark['userid'] = $userid;       
                $Logs_Recharge = M('logs_recharge');
                $Logs_Moneys = M('logs_moneys');
                $res = $Logs_Recharge->add($data);
                $Logs_Moneys->add($logs_moneys_remark);
           }
           echo 'success';
       }
       //获取用户信息
       public function getUserInfo($loginName)
       {
           $Users = D('users');
           return $Users->where(['loginName'=>$loginName])->find();
       }
       //更新订单状态
       public function updateViporderstatus($orderno)
       {
           $Recharge = D('viprecharge');
           $data['status'] = 1;
           return $Recharge->where(['orderNo'=>$orderno])->save($data);
       }
       //更新订单状态
       public function updateOrderstatus($orderno)
       {
           $Recharge = D('recharge');
           $data['status'] = 1;
           return $Recharge->where(['orderNo'=>$orderno])->save($data);
       }
       public function getviporderInfobyOrderno($orderno)
       {
           $Recharge = D('viprecharge');
           return $Recharge->where(['orderNo'=>$orderno])->find();
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
      /**
       * 生成订单号
       * @return string
      */
     public function create_order_no()
     {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
     }
}
