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
<div><a href="http://118.31.45.231/api.php/Home/Index/api">接口文档</a>>><h2>环球集货仓APP端首页接口</h2></div>
<div>
  <h4>请求接口地址：http://118.31.45.231/api.php/Home/Index/index</h4>
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
      <td>id</td>
      <td>int</td>
      <td>11</td>
      <td></td>
      <td>产品id编号</td>
     </tr>
     <tr>
      <td>previewmessageinfos</td>
      <td>array()</td>
      <td></td>
      <td></td>
      <td>公告预告信息</td>
     </tr>
     <tr>
      <td>adsinfo</td>
      <td>array()</td>
      <td></td>
      <td></td>
      <td>广告banner图</td>
     </tr>
     <tr>
      <td>webnotifyinfo</td>
      <td>array()</td>
      <td></td>
      <td></td>
      <td>个人站内信息</td>
     </tr>
     <tr>
      <td>productinfos</td>
      <td>array()</td>
      <td></td>
      <td></td>
      <td>全部产品</td>
     </tr>
     <tr>
      <td>presentproductinfos</td>
      <td>array()</td>
      <td></td>
      <td></td>
      <td>进行中的产品</td>
     </tr>
     <tr>
      <td>previewproductinfos</td>
      <td>array()</td>
      <td></td>
      <td></td>
      <td>即将开始的产品</td>
     </tr>
     <tr>
      <td>brandName</td>
      <td>varchar</td>
      <td>255</td>
      <td></td>
      <td>品牌名称</td>
     </tr>
     <tr>
      <td>brandLogo</td>
      <td>varchar</td>
      <td>255</td>
      <td></td>
      <td>品牌LOGO</td>
     </tr>
     <tr>
      <td>goodname</td>
      <td>varchar</td>
      <td>255</td>
      <td></td>
      <td>产品名称</td>
     </tr>
     <tr>
      <td>goods_price</td>
      <td>decimal</td>
      <td>(10,2)</td>
      <td></td>
      <td>价格</td>
     </tr>
     <tr>
     <tr>
      <td>description</td>
      <td>varchar</td>
      <td>255</td>
      <td></td>
      <td>商品描述</td>
     </tr>
     <tr>
      <td>marketPrice</td>
      <td>decimal</td>
      <td>(10,2)</td>
      <td></td>
      <td>市场价</td>
     </tr>
      <td>goods_other_img1</td>
      <td>varchar</td>
      <td>255</td>
      <td></td>
      <td>附图一</td>
     </tr>
     <tr>
      <td>goods_other_img1</td>
      <td>varchar</td>
      <td>255</td>
      <td></td>
      <td>附图二</td>
     </tr>
     <tr>
      <td>goods_other_img1</td>
      <td>varchar</td>
      <td>255</td>
      <td></td>
      <td>附图三</td>
     </tr>
     <tr>
      <td>goods_other_img1</td>
      <td>varchar</td>
      <td>255</td>
      <td></td>
      <td>附图四</td>
     </tr>
      <tr>
      <td>enddate</td>
      <td>datetime</td>
      <td></td>
      <td></td>
      <td>专场活动结束日期</td>
     </tr>
       <tr>
      <td>startdate</td>
      <td>datetime</td>
      <td></td>
      <td></td>
      <td>专场活动开始日期</td>
     </tr>
  </table>
  </div>
</div>
</body>
</html>