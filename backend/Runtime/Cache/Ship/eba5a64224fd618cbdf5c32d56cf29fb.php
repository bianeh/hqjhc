<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>商品管理</title>
  <link href="__CSS__/WdatePicker.css" rel="stylesheet">
  <link href="__CSS__/style.css" rel="stylesheet">
  <!-- 每行tr背景颜色 -->
  <script type="text/javascript" src="__JS__/jquery.js"></script>
</head>
<body>
  <div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="/admin.php/Ship/Shipping/index">运费模板管理</a></li>
    <li><a href="">运费模板详情</a></li>
    </ul>
  </div>
  <div class="formbody">
    <div class="formtitle">
      <span>运费模板列表：</span>
    </div>
    <div class="padding border_bottom mbottom">
    </div>

    <table class="parkManageTab detailTab">
      <thead>
        <tr style="border:none">
          <th style="border-right:none;text-align:left;color:blue" colspan=3 >模板名称：<?php echo ($template_row["template_name"]); ?></th>
          <th style="border-right:none;border-left:none" colspan=2>添加时间：<?php echo date('Y-m-d',$template_row[create_date]); ?></th>
          <th style="border-left:none"><a style="color:#0893E6" href="U('delete',array('template_id'=>$template_row[template_id]))">删除</a></th>
        </tr>
        <tr>
          <th>运送方式</th>
          <th>运送到</th>
          <th><?php if(($template_row["price_way"]) == "1"): ?>首件(个)<?php endif; ?>
            <?php if(($template_row["price_way"]) == "2"): ?>首重(kg)<?php endif; ?>
            <?php if(($template_row["price_way"]) == "3"): ?>首体积(m³)<?php endif; ?>
          </th>
          <th>首费(元)</th>
          <th><?php if(($template_row["price_way"]) == "1"): ?>续件(个)<?php endif; ?>
            <?php if(($template_row["price_way"]) == "2"): ?>续重(kg)<?php endif; ?>
            <?php if(($template_row["price_way"]) == "3"): ?>续体积(m³)<?php endif; ?>
          </th>
          <th>续费(元)</th>
        </tr>
      </thead>
      <tbody>
        <?php if(is_array($way_list)): $i = 0; $__LIST__ = $way_list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$way): $mod = ($i % 2 );++$i;?><tr>
            <td>
              <?php if(($way["shipping_way"]) == "0"): ?>快递<?php endif; ?>
              <?php if(($way["shipping_way"]) == "1"): ?>EMS<?php endif; ?>
              <?php if(($way["shipping_way"]) == "2"): ?>平邮<?php endif; ?>
            </td>
            <td><?php echo ($way["area_name"]); ?></td>
            <td><?php echo ($way["first_num"]); ?></td>
            <td><?php echo ($way["first_fee"]); ?></td>
            <td><?php echo ($way["continue_num"]); ?></td>
            <td><?php echo ($way["continue_fee"]); ?></td>
          </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
      </tbody>
    </table>
  </div>
  <script type="text/javascript" src="__DATEP__/WdatePicker.js"></script>
</body>
</html>