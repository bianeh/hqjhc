<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class PaymentController extends Controller
{
    //支付接口支付
    public function payment()
    {
        $method = I('post.method');
        //支付宝充值
        if($method == 1)
        {
            $this->recharge_zfb();
        }
        //微信充值
        if($method == 2)
        {
            $this->recharge_wechat();
        }
        //普通充值
        if($method == 3)
        {
            $this->recharge_account();
        }
    }
    //支付宝充值
    public function recharge_zfb()
    {
        header("Content-type: text/html; charset=utf-8");
        $BASE_URL = $_SERVER['DOCUMENT_ROOT'];
        require $BASE_URL.'/api/Common/Payment/alipay/wappay/service/AlipayTradeService.php';
        require $BASE_URL.'/api/Common/Payment/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php';
        require $BASE_URL.'/api/Common/Payment/alipay/config.php';
        //登录名
        $loginName = I('post.loginName');
        //付款金额，必填
        $total_amount = $_POST['WIDtotal_amount'];
        $count  = $this->checkUser($loginName);
        if($count != 1)
        {
            die();
        }
        $UserInfo = $this->getUserInfo($loginName);
        $userid = $UserInfo['userid'];
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $this->create_order_no();
        //订单名称，必填
        $subject = '环球集货仓支付宝充值';
        //商品描述，可空
        $body = $_POST['WIDbody'];
        //超时时间
        $timeout_express="1m";
        $recharge['userid'] = $userid;
        $recharge['amount'] = $total_amount;
        $recharge['status'] = 0;
        $recharge['orderNo'] = $out_trade_no;
        $recharge['createTime'] = date("Y-m-d H:i:s",time());
        $recharge['examount'] = $UserInfo['usermoney'];
        $recharge['datasrc'] = 1;
        $recharge['remarks'] = '支付宝充值';
        $this->recharge_order($recharge);
        $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setTimeExpress($timeout_express);
        $payResponse = new \AlipayTradeService($config);
        $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);
        return ;
    }
    //支付宝充值回调函数
    public function recharge_zfb_callback()
    {
        
    }
    //充值前充值订单记录
    public function recharge_order(array $data)
    {
        $Recharge = D('recharge');
        $Recharge->add($data);
    }
     /**
     * 生成订单号
     * @return string
     */
    public function create_order_no()
    {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
    //核对登录名
    public function checkUser($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->count();
    }
    //获取用户信息
    public function getUserInfo($loginName)
    {
        $Users = D('users');
        return $Users->where(['loginName'=>$loginName])->find();
    }
}
