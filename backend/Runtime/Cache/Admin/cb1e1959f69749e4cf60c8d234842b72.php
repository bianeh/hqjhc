<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Access-Control-Allow-Origin" content="*">  
  <title>环球集货仓系统后台</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/dist/css/skins/_all-skins.min.css">
  <!-- 每行tr背景颜色 -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
/*      button{
          border:1px solid #3c8dbc !important;
      }*/
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="/" class="logo" style="background:#2e6da4;color:#fff">
      <span class="logo-mini"><b>环球集货仓</b>系统</span>
      <span class="logo-lg"><b>环球集货仓</b>系统</span>
    </a>
    <nav class="navbar navbar-static-top" style="background: #2e6da4;color:#fff">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">供货商最新反馈</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"> 欢迎<?php echo ($data["loginname"]); ?>登录</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="background:#3c8dbc;">
                <img src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  管理员 - <?php echo ($data["loginname"]); ?>
                  <small>现在时间 <?php echo date('Y-m-d H:i:s',time())?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">超级管理员ADMIN</a>
                  </div>
                </div> -->
                <!-- /.row -->
              <!-- </li> -->
              <!-- Menu Footer-->
              <li class="user-footer" style="height: 130px">
                <div class="" style="text-align: center;">
                  <a href="#" >个人信息</a>
                </div>
                <div class="" style="text-align: center;">
                  <a href="#" >清理缓存</a>
                </div>
                <div class="" style="text-align: center;">
                  <a href="<?php echo U('/User/Login/dologinout');?>" >退出登录</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <style type="text/css">
  .isShowselect{
    height: 26px;
    width: 155px;
  }
  .table{
      font-size:14px;
  }
  .btn{
      padding:5px;
      font-size:12px;
      margin:0px;
  }
  .txt
  {
      height:30px;
  }
  </style>
<style type="text/css">
a{
  color:#b8c7ce;
}
</style>
<!-- <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/dist/css/skins/_all-skins.min.css"> -->
<aside class="main-sidebar" style="background:#1e282c;color:#1e282c">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
          
          <?php print_r($this->_data); ?>
        <div class="pull-left info">
          <p>平台管理员<?php echo ($data["loginname"]); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree" style="color:#fff">
        <li class="header">MAIN NAVIGATION</li>
        <li id="Article" class="treeview">
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>资讯新闻管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Article/Index/index');?>"><i class="fa fa-circle-o"></i>资讯新闻列表</a></li>
            <li><a href="<?php echo U('Article/Articlecat/index');?>"><i class="fa fa-circle-o"></i>资讯新闻分类</a></li>
            <li><a href="<?php echo U('Article/Recycle/index');?>"><i class="fa fa-circle-o"></i>回收站</a></li>
          </ul>
        </li>
        <li id="ProductGrade" class="treeview">
          <a href="#">
            <i class="fa fa-sitemap"></i>
            <span>品牌活动档期管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Grade/Index/index');?>"><i class="fa fa-circle-o"></i>品牌活动档期列表</a></li>
          </ul>
        </li>
        <li id="Advs" class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>系统广告管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Advs/Index/index');?>"><i class="fa fa-circle-o"></i>系统广告管理</a></li>
          </ul>
        </li>
        <li id="Product" class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>品牌产品管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Product/Brands/index');?>"><i class="fa fa-circle-o"></i>品牌列表</a></li>
            <li><a href="<?php echo U('Product/Goodscats/index');?>"><i class="fa fa-circle-o"></i>货仓产品分类</a></li>
            <li><a href="<?php echo U('Product/Index/index');?>"><i class="fa fa-circle-o"></i>产品列表</a></li>
<!--            <li><a href="<?php echo U('Product/Spectemplate/index');?>"><i class="fa fa-circle-o"></i>产品规格模板</a></li>
            <li><a href="<?php echo U('Product/Specattr/index');?>"><i class="fa fa-circle-o"></i>产品规格标签</a></li>
            <li><a href="<?php echo U('Product/Specattrval/index');?>"><i class="fa fa-circle-o"></i>产品规格值</a></li>-->
          </ul>
        </li>
        <li id ="Admin" class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>公司职员管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Admin/Index/index');?>"><i class="fa fa-circle-o"></i>公司职员信息</a></li>
            <li><a href="<?php echo U('Admin/Roles/index');?>"><i class="fa fa-circle-o"></i>公司部门管理</a></li>
            <li><a href="<?php echo U('Admin/Privileges/index');?>"><i class="fa fa-circle-o"></i>权限资源管理</a></li>
          </ul>
        </li>
        <li id="Offers" class="treeview">
          <a href="#">
            <i class="fa fa-industry"></i>
            <span>供货商会员管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Offers/Index/index');?>"><i class="fa fa-circle-o"></i>供货商会员信息</a></li>
            <li><a href="<?php echo U('Offers/Feedback/index');?>"><i class="fa fa-circle-o"></i>反馈信息</a></li>
          </ul>
        </li>
        <li id ="WechatBus" class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>微商信息管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Users/Index/index');?>"><i class="fa fa-circle-o"></i>微商信息列表</a></li>
            <li><a href="<?php echo U('Users/Address/index');?>"><i class="fa fa-circle-o"></i>地址信息管理</a></li>
            <li><a href="javascript:void(0)" onclick="javascript:alert('此模块在开发当中')"><i class="fa fa-circle-o"></i>优惠券信息</a></li>
            <li><a href="javascript:void(0)" onclick="javascript:alert('此模块在开发当中')"><i class="fa fa-circle-o"></i>积分记录</a></li>
            <li><a href="<?php echo U('Users/Vip/index');?>"><i class="fa fa-circle-o"></i>会员记录</a></li>
            <li><a href="<?php echo U('Users/Vipset/index');?>"><i class="fa fa-circle-o"></i>会员购买设置</a></li>
            <li><a href="javascript:void(0)" onclick="javascript:alert('此模块在开发当中')"><i class="fa fa-circle-o"></i>反馈信息</a></li>
          </ul>
        </li>
        <li id="Orders" class="treeview">
          <a href="#">
            <i class="fa fa-cart-arrow-down"></i>
            <span>订单管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Order/Index/index');?>"><i class="fa fa-circle-o"></i>订单管理列表</a></li>
            <li><a href="<?php echo U('Orderaf/Index/index');?>"><i class="fa fa-circle-o"></i>退款/退货</a></li>
          </ul>
        </li>
        <li id="Voucher" class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>优惠券管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Ticket/Index/index');?>"><i class="fa fa-circle-o"></i>优惠券列表</a></li>
          </ul>
        </li>
        <li id="Express" class="treeview">
          <a href="#">
            <i class="fa fa-truck"></i>
            <span>快递管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Ship/Shipping/index');?>"><i class="fa fa-circle-o"></i>运费模板管理</a></li>
          </ul>
        </li>
        <li id="Fund" class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>财务管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Funds/Recharge/index');?>"><i class="fa fa-circle-o"></i>微商用户充值记录</a></li>
            <li><a href="<?php echo U('Funds/Ordersettlement/index');?>"><i class="fa fa-circle-o"></i>微商用户交易记录</a></li>
            <li><a href="<?php echo U('Funds/Viprecharge/index');?>"><i class="fa fa-circle-o"></i>微商购买VIP记录</a></li>
            <li><a href="<?php echo U('Funds/Userslogsmoneys/getentrance');?>"><i class="fa fa-circle-o"></i>微商会员支入记录</a></li>
            <li><a href="<?php echo U('Funds/Userslogsmoneys/getpay');?>"><i class="fa fa-circle-o"></i>微商会员支出记录</a></li>
          </ul>
        </li>
         <li id="Message" class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>站内信短信管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Message/Index/index');?>"><i class="fa fa-circle-o"></i>通告预告管理</a></li>
            <li><a href="<?php echo U('Message/Webnotify/index');?>"><i class="fa fa-circle-o"></i>站内信息管理</a></li>
            <li><a href="<?php echo U('Message/Messageinfo/index');?>"><i class="fa fa-circle-o"></i>短信管理</a></li>
          </ul>
        </li>
         <li id="System" class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i>
            <span>系统设置</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="javascript:void(0)" onclick="javascript:alert('此模块在开发当中')"><i class="fa fa-circle-o"></i>缓存清理</a></li>
            <li><a href="javascript:void(0)" onclick="javascript:alert('此模块在开发当中')"><i class="fa fa-circle-o"></i>系统参数</a></li>
          </ul>
        </li>
         <li id="Logs" class="treeview">
          <a href="#">
            <i class="fa fa-pencil-square"></i>
            <span>系统日志管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="javascript:void(0)" onclick="javascript:alert('此模块在开发当中')"><i class="fa fa-circle-o"></i>管理员登录日志</a></li>
              <li><a href="javascript:void(0)" onclick="javascript:alert('此模块在开发当中')"><i class="fa fa-circle-o"></i>供货商登录日志</a></li>
              <li><a href="javascript:void(0)" onclick="javascript:alert('此模块在开发当中')"><i class="fa fa-circle-o"></i>微商登录日志</a></li>
              <li><a href="javascript:void(0)" onclick="javascript:alert('此模块在开发当中')"><i class="fa fa-circle-o"></i>资金流入流出日志</a></li>
              <li><a href="javascript:void(0)" onclick="javascript:alert('此模块在开发当中')"><i class="fa fa-circle-o"></i>模块操作日志</a></li>
          </ul>
        </li>
         <li id="Logs" class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i>
            <span>数据统计</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="javascript:void(0)" onclick="javascript:alert('此模块在开发当中')"><i class="fa fa-circle-o"></i>数据统计</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/morris.js/morris.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/dist/js/demo.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/dist/js/adminlte.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/common/js/echarts.common.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function(){
        $("#Article").click(function(){
            localStorage.setItem("Id", '#Article');
        });
        $("#Product").click(function(){
            localStorage.setItem("Id", '#Product');
        });
        $("#Admin").click(function(){
            localStorage.setItem("Id", '#Admin');
        });
        $("#Offers").click(function(){
            localStorage.setItem("Id", '#Offers');
        });
        $("#WechatBus").click(function(){
            localStorage.setItem("Id", '#WechatBus');
        });
        $("#Orders").click(function(){
            localStorage.setItem("Id", '#Orders');
        });
        $("#Voucher").click(function(){
            localStorage.setItem("Id", '#Voucher');
        });
        $("#Express").click(function(){
            localStorage.setItem("Id", '#Express');
        });
        $("#Fund").click(function(){
            localStorage.setItem("Id", '#Fund');
        });
        $("#Logs").click(function(){
            localStorage.setItem("Id", '#Logs');
        });
        $("#ProductGrade").click(function(){
            localStorage.setItem("Id",'#ProductGrade');
        });
        $("#Advs").click(function(){
            localStorage.setItem("Id",'#Advs');
        });
        $("#Message").click(function(){
            localStorage.setItem("Id",'#Message');
        });
        $("#System").click(function(){
            localStorage.setItem("Id",'#System');
        })
      });
      var id = localStorage.getItem("Id");
      if(id)
      {
        $(id).addClass('active');
      } 
  </script>

  <!-- Left side column. contains the logo and sidebar -->
  <style>
  /*.privileges>h4{
    font-weight: bold;
  }*/
  .privileges>label{
    width:100px;
    text-align: right;
    /*border-bottom: 1px dashed #888;*/
  }
  </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        部门添加
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 后台</a></li>
        <li><a href="<?php echo U('Admin/Roles/index');?>">部门管理</a></li>
        <li class="active">添加部门</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">部门添加</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box box-warning">

            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" id="addUser" method="post" action="<?php echo U('Admin/Roles/doAddRole');?>">
                <!-- text input -->
                <div class="form-group">
                  <label>部门名称</label>
                  <input type="text" id="loginName" name="loginName" class="form-control" placeholder="部门名称">
                </div>
                <div class="form-group">
                  <label>部门描述</label>
                  <textarea class="form-control" placeholder="部门描述"></textarea>
                </div>
                <div class="form-group">
                  <label>部门权限</label>
                  <div class="privileges">
                       <h4>资讯公告管理<input id="news_title" type="checkbox" onchange="click_news_title()" name=""></h4>
                       <?php if(is_array($infoone)): $i = 0; $__LIST__ = $infoone;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label><?php echo ($vo["privilegename"]); ?></label><input class="news_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                       <h4>系统品牌档期管理<input type="checkbox" id="grade_title" onchange="click_grade_title()" name=""></h4>
                       <?php if(is_array($infotwo)): $i = 0; $__LIST__ = $infotwo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><label><?php echo ($vt["privilegename"]); ?></label><input class="grade_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                       <h4>系统广告管理<input type="checkbox" id="system_title" onchange="click_system_title()" name=""></h4>
                       <?php if(is_array($infothree)): $i = 0; $__LIST__ = $infothree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vth): $mod = ($i % 2 );++$i;?><label><?php echo ($vth["privilegename"]); ?></label><input class="system_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                       <h4>品牌产品管理<input type="checkbox" id="brands_title" onchange="click_brands_title()" name=""></h4>
                       <?php if(is_array($infofour)): $i = 0; $__LIST__ = $infofour;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><label><?php echo ($vt["privilegename"]); ?></label><input class="brands_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                       <h4>公司职员管理<input type="checkbox" id="staffs_title" onchange="click_staffs_title()" name=""></h4>
                       <?php if(is_array($infofive)): $i = 0; $__LIST__ = $infofive;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><label><?php echo ($vt["privilegename"]); ?></label><input class="staffs_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                       <h4>供货商会员管理<input type="checkbox" id="offers_title" onchange="click_offers_title()" name=""></h4>
                       <?php if(is_array($infosix)): $i = 0; $__LIST__ = $infosix;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><label><?php echo ($vt["privilegename"]); ?></label><input class="offers_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                        <h4>微商信息管理<input type="checkbox" id="users_title" onchange="click_users_title()" name=""></h4>
                       <?php if(is_array($infoseven)): $i = 0; $__LIST__ = $infoseven;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><label><?php echo ($vt["privilegename"]); ?></label><input class="users_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                        <h4>订单管理<input type="checkbox" id="orders_title" onchange="click_orders_title()" name=""></h4>
                       <?php if(is_array($infoeight)): $i = 0; $__LIST__ = $infoeight;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><label><?php echo ($vt["privilegename"]); ?></label><input class="orders_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                        <h4>优惠券管理<input type="checkbox" id="tickets_title" onchange="click_tickets_title()" name=""></h4>
                       <?php if(is_array($infonine)): $i = 0; $__LIST__ = $infonine;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><label><?php echo ($vt["privilegename"]); ?></label><input class="tickets_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                        <h4>快递管理<input type="checkbox" id="express_title" onchange="click_express_title()" name=""></h4>
                       <?php if(is_array($infoten)): $i = 0; $__LIST__ = $infoten;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><label><?php echo ($vt["privilegename"]); ?></label><input class="express_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                       </volist>
                        <h4>短信消息管理<input type="checkbox" id="messages_title" onchange="click_messages_title()" name=""></h4>
                       <?php if(is_array($infotwf)): $i = 0; $__LIST__ = $infotwf;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><label><?php echo ($vt["privilegename"]); ?></label><input class="messages_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                       </volist>
                        <h4>系统日志管理<input type="checkbox" id="logs_title" onchange="click_logs_title()" name=""></h4>
                       <?php if(is_array($infothr)): $i = 0; $__LIST__ = $infothr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><label><?php echo ($vt["privilegename"]); ?></label><input class="logs_listinfo" type="checkbox" name=""><?php endforeach; endif; else: echo "" ;endif; ?>
                  </div>
                </div>
                <input type="hidden" name="createstaffid" value="<?php echo ($data["stffid"]); ?>"/>
              </form>
                <div class="form-group">
                    <button id="addUserOperate" class="btn bg-olive btn-flat margin"><i class="fa fa-fw fa-plus"></i>添加</button>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="">环球集货仓</a>.</strong> All rights
    reserved.
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
      </div>
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
        </form>
      </div>
    </div>
  </aside>
  <div class="control-sidebar-bg"></div>
</div>

 

</body>
</html>
  <!-- 全局js -->
  <script src="<?php echo (PUBLIC_URL); ?>/common/js/jquery.min.js?v=2.1.4"></script>
  <script src="<?php echo (PUBLIC_URL); ?>/common/js/bootstrap.min.js?v=3.3.6"></script>
  <script src="<?php echo (PUBLIC_URL); ?>/common/js/ajaxfileupload.js"></script>
 <script>
    var addUserOperate = document.getElementById("addUserOperate");
    addUserOperate.onclick=function()
    {     
          var loginNameVal = document.getElementById("loginName").value;
          var loginPwdVal = document.getElementById("loginPwd").value;
          var staffNameVal = document.getElementById("staffName").value;
          var staffNoVal = document.getElementById("staffNo").value;
          if(loginNameVal != '')
          {
               if(loginPwdVal != '')
                {
                       document.getElementById("addUser").submit();
                }else
                {
                    alert('请输入密码');
                    return;
                }
              
          }
          else
          {
              alert('请输入账号昵称');
              return;
          }
      }
  </script>
  <script>
      function readyup()
    {
            ajaxFileUpload();
    }
    function ajaxFileUpload() {
            $.ajaxFileUpload
            (
                    {
                        url: "<?php echo U('Upload/Index/upload');?>",
                        secureuri: false,
                        fileElementId: 'file',
                        dataType: 'json',
                        success: function (data, status)
                        {
                           var code = data['code'];
                           if(code == '000002')
                           {
                               $("#img1").attr("src", data.showimgurl);
                               $(":input[name=staffPhoto]").val(data.imgurl);
                           }
                        },
                        error: function (data, status, e)
                        {
                          alert(data.msg);
                        }
                    }
            )
            return false;
        }
  </script>
  <script>
      function click_news_title() {
            var flag = document.getElementById("news_title").checked;
            var cks = document.getElementsByClassName("news_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
       function click_grade_title() {
            var flag = document.getElementById("grade_title").checked;
            var cks = document.getElementsByClassName("grade_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
        function click_system_title() {
            var flag = document.getElementById("system_title").checked;
            var cks = document.getElementsByClassName("system_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
        function click_brands_title() {
            var flag = document.getElementById("brands_title").checked;
            var cks = document.getElementsByClassName("brands_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
        function click_staffs_title() {
            var flag = document.getElementById("staffs_title").checked;
            var cks = document.getElementsByClassName("staffs_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
        function click_offers_title() {
            var flag = document.getElementById("offers_title").checked;
            var cks = document.getElementsByClassName("offers_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
        function click_users_title() {
            var flag = document.getElementById("users_title").checked;
            var cks = document.getElementsByClassName("users_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
        function click_orders_title() {
            var flag = document.getElementById("orders_title").checked;
            var cks = document.getElementsByClassName("orders_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
        function click_tickets_title() {
            var flag = document.getElementById("tickets_title").checked;
            var cks = document.getElementsByClassName("tickets_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
        function click_express_title() {
            var flag = document.getElementById("express_title").checked;
            var cks = document.getElementsByClassName("express_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
        function click_messages_title() {
            var flag = document.getElementById("messages_title").checked;
            var cks = document.getElementsByClassName("messages_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
        function click_logs_title() {
            var flag = document.getElementById("logs_title").checked;
            var cks = document.getElementsByClassName("logs_listinfo");
            if (flag) {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = true;
             }
            } else {
             for ( var i = 0; i < cks.length; i++) {
              cks[i].checked = false;
             }
            }
           }
  </script>