<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>api接口说明</title>
	<style type="text/css">
	.table>tr>td
	{
		border: 1px solid #ddd;
	}
	</style>
</head>
<body>
<div>
<div><a href="http://118.31.45.231/api.php/Home/Index/api">接口文档</a>>><h2>环球集货仓APP下单待交易的订单信息接口（单个商品）</h2></div>
<div>
  <h4>请求接口地址：http://118.31.45.231/api.php/Home/Order/getorderinfo</h4>
  传入参数
  <table class="table"  width="400" border="1" cellspacing="0" cellpadding="0">
     <tr>
      <td>字段名称</td>
      <td>字段类型</td>
      <td>字段长度</td>
      <td>是否必须</td>
      <td>字段含义</td>
     </tr>
      <tr>
      <td>loginName</td>
      <td>varchar</td>
      <td>255</td>
      <td></td>
      <td>登录名</td>
     </tr>
     </tr>
      <tr>
      <td>orderno</td>
      <td>varchar</td>
      <td>255</td>
      <td></td>
      <td>订单号</td>
     </tr>
  </table>
  返回参数
  <table class="table"  width="400" border="1" cellspacing="0" cellpadding="0">
     <tr>
      <td>字段名称</td>
      <td>字段类型</td>
      <td>字段长度</td>
      <td>是否必须</td>
      <td>字段含义</td>
     </tr>
     
     <tr>
      <td>OrdersInfo</td>
      <td>[]</td>
      <td></td>
      <td></td>
      <td>订单信息</td>
     </tr>
     <tr>
      <td>templateinfo</td>
      <td>[]</td>
      <td></td>
      <td></td>
      <td>快递运费信息</td>
     </tr>
     <tr>
      <td>AddressInfo</td>
      <td>[]</td>
      <td></td>
      <td></td>
      <td>个人收货地址信息</td>
     </tr>
  </table>
  </div>
</div>
</body>
</html>