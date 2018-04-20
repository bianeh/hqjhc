<?php if (!defined('THINK_PATH')) exit();?>  <!DOCTYPE html>
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
    <a href="/" class="logo" style="background: #3c8dbc;color:#fff">
      <span class="logo-mini"><b>环球集货仓</b>系统</span>
      <span class="logo-lg"><b>环球集货仓</b>系统</span>
    </a>
    <nav class="navbar navbar-static-top" style="background: #3c8dbc;color:#fff">
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

  <script type="text/javascript" charset="utf-8" src="<?php echo (ROOT_URL); ?>/Public/common/plugins/editor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?php echo (ROOT_URL); ?>/Public/common/plugins/editor/ueditor.all.min.js"> </script>
  <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
  <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
  <script type="text/javascript" charset="utf-8" src="<?php echo (ROOT_URL); ?>/Public/common/plugins/editor/lang/zh-cn/zh-cn.js"></script>
  <style>
/*  .formspec{
    display: none;
  }*/
  .form-group{
    margin-top: 5px;
    margin-bottom:1px;
  }
  .br{
    height: 5px;
  }
  .xinhao{
     color:red;
  }
  .ggtitle{
      
  }
/*  .weight{
      display:none;
  }
  .googds_erama{
      diplay:none;
  }*/
  </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        产品添加
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 后台</a></li>
        <li><a href="<?php echo U('Product/Index/index');?>">产品管理</a></li>
        <li class="active">添加产品</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">产品添加</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box box-warning">
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" id="addProduct" method="post" action="<?php echo U('Product/Index/doAddProduct');?>">
                <!-- text input -->
                <div class="form-group">
                    <span class="xinhao">*</span><label>商品名称</label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="商品名称">
                </div>
                 <div class="form-group">
                  <span class="xinhao">*</span><label>供货商昵称</label>
                  <input type="text" id="offername" name="offername" class="form-control" placeholder="供货商昵称">
                </div>
                <div class="form-group">
                  <span class="xinhao">*</span><label>商品编号</label>
                  <input type="text" id="code_num" name="code_num" class="form-control" placeholder="商品编号">
                </div>
                <div class="form-group">
                  <label>商品一级分类</label>
                  <select multiple="" name="goodsCatIdfirst" class="form-control">
                  <option value=''>请选择</option>
                  <?php if(is_array($goodscatslist)): $i = 0; $__LIST__ = $goodscatslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class="goodscats" value="<?php echo ($vo["catid"]); ?>"><?php echo ($vo["catname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
                  <div class="form-group">
                  <label>商品二级分类</label>
                  <select multiple="" name="goodsCatIdmiddle" class="form-control childtwo">
                  </select>
                </div>
                <div class="form-group">
                  <label>商品三级分类</label>
                  <select multiple="" name="goodsCatIdlast" class="form-control childthree">
                  </select>
                </div>
                
<!--                <div class="form-group">
                  <label>规格模板</label>
                  <select multiple="" name="" class="form-control">
                  <option value=''>请选择</option>
                  <?php if(is_array($templateinfo)): $i = 0; $__LIST__ = $templateinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class="item_id" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
                <div class="form-group specattr2" style="border:1px solid #ddd;padding:10px" >
                    
                </div>-->
                <div class="form-group">
                  <label>
                  商品规格
                  </label>
                  <input type="hidden" value='1' name="isSpec" />
              </div>
              <div class="formspec row">
               <div class="form-group spec">
                    <div class="col-xs-12">
                           <div class="col-xs-11">
                           </div>
                           <button type="button" class="btn bg-olive btn-flat margin addspec"><i class="fa fa-fw fa-plus"></i>继续添加</button> 
                    </div>   
               </div>
               <div class="col-xs-12 br"></div>
               <div class="col-xs-12">
                    <div class="col-xs-2 ggtitle">
                         <span><span class="xinhao">*</span>自定义规格（尺寸/颜色）</span>
                  </div>
                  <div class="col-xs-2 ggtitle">
                         <span><span class="xinhao">*</span>自定义规格（尺寸/颜色）</span>
                  </div>
                  <div class="col-xs-1 ggtitle">
                         <span><span class="xinhao">*</span>会员价格（元）</span>
                  </div>
                  <div class="col-xs-1 ggtitle">
                         <span><span class="xinhao">*</span>库存</span>
                  </div>
                  <div class="col-xs-1 ggtitle">
                         <span>供货商价格(元)</span>
                  </div>
                   <div class="col-xs-2 ggtitle">
                         <span>条形码</span>
                  </div>
                  <div class="col-xs-2 ggtitle">
                         <span>商品重量（kg）</span>
                  </div>
                  <div class="col-xs-1 ggtitle">
                         <span>操作</span>
                  </div>
                     </div>
                 <div class="form-group spec col-xs-12">
                     
                  <div class="col-xs-2">
                  <input type="text" class="form-control" name="speca[]" placeholder="">
                  </div>
                  <div class="col-xs-2">
                  <input type="text" class="form-control" name="specb[]" placeholder="">
                  </div>
                  <div class="col-xs-1">
                  <input type="text" class="form-control" name="specPrice[]" placeholder="">
                  </div>
                  <div class="col-xs-1">
                  <input type="text" class="form-control" name="specnum[]" placeholder="">
                  </div>
                  <div class="col-xs-1">
                  <input type="text" class="form-control" name="offerPrice[]" placeholder="">
                  </div>
                     <div class="col-xs-2">
                  <input type="text" class="form-control" name="code[]" placeholder="">
                  </div>
                     <div class="col-xs-2">
                  <input type="text" class="form-control" name="weight[]" placeholder="">
                  </div>
                  <div class="col-xs-1">
                    <button type="button" class="btn-danger">删除</button> 
                  </div>
                </div>
              </div>
               <br>
                <span class="xinhao">*</span><label>商品市场价格</label>
                 <div class="input-group">
                  <input type="text" id="marketPrice" name="marketPrice" class="form-control" placeholder="商品市场价格">
                  <span class="input-group-addon">.00</span>
                </div>   
                <span class="xinhao">*</span><label>商品价格</label>
                <div class="input-group">
                  <input type="text" id="goods_price" name="goods_price" class="form-control" placeholder="商品价格">
                  <span class="input-group-addon">.00</span>
                </div>
                 <span class="xinhao">*</span><label>供货商价格</label>
                 <div class="input-group">
                  <input type="text" id="offersPrice" name="offersPrice" class="form-control" placeholder="供货商价格">
                  <span class="input-group-addon">.00</span>
                </div>
                 <span class="xinhao">*</span><label>商品库存</label>
                 <div class="input-group">
                  <input type="text" id="number" name="number" class="form-control" placeholder="商品库存">
                  <span class="input-group-addon">件</span>
                </div>
                 <div class="form-group">
                  <label>商品主图</label>
                  <input name="display_img"  onchange="readyup(this)" id="display_img" multiple="" type="file" class="form-control">
                  <div style="width:100px;height:80px;background: #dddddd;margin-top:3px">
                      <img id="show_display_img" height="80px" width="100px" src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/boxed-bg.jpg" />
                  </div>
                  <input type="hidden" name="goods_display_img" value=""/>
                </div>
                 <div class="form-group">
                  <label>
                  是否转发视频
                  </label>
                  <input type="radio" value='1' class="istv" name="istv"  />是
                  <input type="radio" value='0' class="istv"  checked name="istv" checked/>否
                  </div>
                  <div class="form-group tv" style="display:none">
                  <label>上传小视频</label>
                  <input name="other_imgs"  onchange="readyup(this)" id="other_imgs" multiple=""  type="file" class="form-control">
                  <!-- <div style="width:100px;height:80px;background: #dddddd;margin-top:3px">
                      <img id="show_other_img1" height="80px" width="100px" src="<?php echo (PUBLIC_URL); ?>/backend/dist/img/boxed-bg.jpg" />
                  </div> -->
                  <input type="hidden" name="goods_other_img1" value=""/>
                </div>
                <div class="form-group imgf">
                  <span class="xinhao">*</span><label>商品附图1</label>
                  <input name="other_img1"  onchange="readyup(this)" id="other_img1" multiple="" type="file" class="form-control">
                  <div style="width:100px;height:80px;background: #dddddd;margin-top:3px">
                      <img id="show_other_img1" height="80px" width="100px" src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/boxed-bg.jpg" />
                  </div>
                  <input type="hidden" name="goods_other_img1" value=""/>
                </div>

                <div class="form-group imgf">
                  <span class="xinhao">*</span><label>商品附图2</label>
                  <input name="other_img2"  onchange="readyup(this)" id="other_img2" multiple="" type="file" class="form-control">
                  <div style="width:100px;height:80px;background: #dddddd;margin-top:3px">
                      <img id="show_other_img2" height="80px" width="100px" src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/boxed-bg.jpg" />
                  </div>
                  <input type="hidden" name="goods_other_img2" value=""/>
                </div>

                <div class="form-group imgf">
                  <span class="xinhao">*</span><label>商品附图3</label>
                  <input name="other_img3"  onchange="readyup(this)" id="other_img3" multiple="" type="file" class="form-control">
                  <div style="width:100px;height:80px;background: #dddddd;margin-top:3px">
                      <img id="show_other_img3" height="80px" width="100px" src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/boxed-bg.jpg" />
                  </div>
                  <input type="hidden" name="goods_other_img3" value=""/>
                </div>


                <div class="form-group imgf">
                  <span class="xinhao">*</span><label>商品附图4</label>
                  <input name="other_img4"  onchange="readyup(this)" id="other_img4" multiple="" type="file" class="form-control">
                  <div style="width:100px;height:80px;background: #dddddd;margin-top:3px">
                      <img id="show_other_img4" height="80px" width="100px" src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/boxed-bg.jpg" />
                  </div>
                  <input type="hidden" name="goods_other_img4" value=""/>
                </div>

                <div class="form-group">
                  <label>商品单位</label>
                  <input type="text" id="unit" name="unit" class="form-control" placeholder="商品单位">
                </div>
                <div class="form-group">
                  <span class="xinhao">*</span><label>单次最多购买数量</label>
                  <input type="text" id="once_shop_maxnum" name="once_shop_maxnum" class="form-control" placeholder="单次最多购买数量">
                </div>
                <div class="form-group">
                  <span class="xinhao">*</span><label>个人最多购买数量</label>
                  <input type="text" id="user_shop_maxnum" name="user_shop_maxnum" class="form-control" placeholder="个人最多购买数量">
                </div>
                 <div class="form-group">
                  <label>排序</label>
                  <input type="text" id="user_shop_maxnum" name="sort" class="form-control" placeholder="排序">
                </div>
               <div class="form-group">
                  <label>
                  是否包邮
                  </label>
                  <input type="radio" value='0'  class="freight" name="freight" checked />是
                  <input type="radio" value='1'  class="freight" name="freight" />否
              </div>
                <div class="form-group freightmb" style="display:none">
                  <label>运输模板</label>
                  <select multiple="" name="templateid" class="form-control">
                    <?php if(is_array($goodstemplatelist)): $i = 0; $__LIST__ = $goodstemplatelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["template_id"]); ?>"><?php echo ($vo["template_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
                <div class="form-group">
                  <span class="xinhao">*</span><label>商品品牌</label>
                  <select multiple="" name="brandid" class="form-control">
                    <?php if(is_array($brandslist)): $i = 0; $__LIST__ = $brandslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["brandid"]); ?>"><?php echo ($vo["brandname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>           
                <div class="form-group">
                  <span class="xinhao">*</span><label>商品类型</label>
                  <select multiple="" name="type" class="form-control">
                    <option>实体商品</option>
                    <option>虚拟商品</option>
                    <option>虚拟物品（卡密）</option>
                  </select>
                </div>
                <div class="form-group">
                  <span class="xinhao">*</span><label>商品描述</label>
                  <script id="editor" name="description" type="text/plain" style="width:100%;height:500px;"></script>
                </div>
                <div class="form-group">
                  <label>
                  是否精品
                  </label>
                  <input type="radio" value='1'  name="isBest"  />是
                  <input type="radio" value='0'  name="isBest" checked/>否
              </div>
              <div class="form-group">
                  <label>
                  是否新品
                  </label>
                  <input type="radio" value='1'  name="isNew"  />是
                  <input type="radio" value='0'  name="isNew" checked/>否
              </div>
              <div class="form-group">
                  <label>
                  是否推荐
                  </label>
                  <input type="radio" value='1'  name="isRecom"  />是
                  <input type="radio" value='0'  name="isRecom" checked/>否
              </div>
              <input type="hidden" name="createstaffid" value='<?php echo ($data["stffid"]); ?>'/>
              </form>
                <div class="form-group">
                    <button id="addProductOperate" class="btn bg-olive btn-flat margin"><i class="fa fa-fw fa-plus"></i>添加</button>
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
  <script src="<?php echo (ROOT_URL); ?>/Public/common/js/jquery.min.js?v=2.1.4"></script>
  <script src="<?php echo (ROOT_URL); ?>/Public/common/js/bootstrap.min.js?v=3.3.6"></script>
  <script src="<?php echo (ROOT_URL); ?>/Public/common/js/ajaxfileupload.js"></script>
  <script>
      var offername = document.getElementById('offername');
      offername.onblur = function()
      {
          var offerloginName = offername.value;
          $.ajax({
             method:"POST",
             url:"<?php echo U('Product/Index/check_offers');?>",
             data:{offerloginName:offerloginName}
           }).done(function(msg){
               var data = JSON.parse(msg);
               var code = data['code'];
               if(code == '000000')
               {
                   alert('请填写正确的供货商信息！');
               }
           });
          
      }
  </script>
  <script>
    var ue = UE.getEditor('editor');
    var addProductOperate = document.getElementById("addProductOperate");
    addProductOperate.onclick=function()
    {     
          var name = document.getElementById("name");
          var code_num = document.getElementById("code_num");
          var goods_price = document.getElementById("goods_price");
          var marketPrice = document.getElementById("marketPrice");
          var number = document.getElementById('number');
          var once_shop_maxnum = document.getElementById('once_shop_maxnum');
          var user_shop_maxnum = document.getElementById('user_shop_maxnum');
          var goods_price_val = goods_price.value;
          var marketPrice_val = marketPrice.value;
          var code_num_val = code_num.value;
          var name_val = name.value;
          var number_val = number.value;
          var once_shop_maxnum_val = once_shop_maxnum.value;
          var user_shop_maxnum_val = user_shop_maxnum.value;
          if(name_val != "")
          {   
              if(code_num_val != "")
              {   
                  if(goods_price_val != '')
                  {   if(marketPrice_val != '')
                      {   
                          if(number_val != '')
                          {   
                              if(once_shop_maxnum_val != '')
                              {   
                                  if(user_shop_maxnum_val != '')
                                  {
                                      document.getElementById("addProduct").submit();
                                  }else
                                  {
                                      alert('个人最多购买的数量不能为空！');
                                  }
                                  
                              }else
                              {
                                  alert('单次最多购买的数量不能为空！');
                              }
                              
                          }else{
                              alert('商品库存不能为空！');
                          }
                          
                      }else
                      {
                          alert('商品市场价格不能为空！');
                      }
                      
                  }else{
                      alert('商品价格不能为空！');
                  }
                  
              }else{
                  alert('商品条形码不能为空！');
              }
          }else{
              alert('商品名称不能为空！');
          }
          
    }
    $(document).ready(function(){
       $(".goodscats").click(function(){
            var val = $(this).val();
            $.ajax({
             method:"POST",
             url:"<?php echo U('Product/Index/getgoodscatschild');?>",
             data:{catid:val}
           }).done(function(msg){
               $(".childtwo option").remove(); 
               $(".childthree option").remove();
               $(".childtwo").append(msg);
           });
       });
        $("body").on('click','.goodscatstwo',function(){
            var val = $(this).val();
            $.ajax({
             method:"POST",
             url:"<?php echo U('Product/Index/getgoodscatschildtwo');?>",
             data:{catid:val}
           }).done(function(msg){
               $(".childthree option").remove();
               $(".childthree").append(msg);
           });
        });
        
        $(".item_id").click(function(){
             var item_id = $(this).val();
             $.ajax({
             method:"POST",
             url:"<?php echo U('Product/Index/getattrvalinfo');?>",
             data:{item_id:item_id}
             }).done(function(msg){
               var data = JSON.parse(msg);
               var str1 = data['str1']; 
               $(".specattr2").html(str1);
           });
        });

        $("body").on('click','.specselect',function(){
          var val = $(this).val();
          if(val == 1)
          {
            $(".formspec").css("display","block");
            $(".weight").css("display","none");
            $(".googds_erama").css("display","none");
          }
          if(val == 0)
          {
            $(".formspec").css("display","none");
            $(".weight").css("display","block");
            $(".googds_erama").css("display","block");
          }
        });


        var  specselect_val = $("input[name='isSpec']:checked").val();
        if(specselect_val == 1)
        {
           $(".formspec").css("display","block");
        }
        

        $("body").on('click','.istv',function(){
          var val = $(this).val();
          if(val == 1)
          {
            $(".tv").css("display","block");
            $(".imgf").css("display","none");
          }
          if(val == 0)
          {
            $(".tv").css("display","none");
            $(".imgf").css("display","block");
          }
        });
        $("body").on('click','.addspec',function(){
           $(".formspec").append("<div class= col-xs-12 form-group spec  ><div class=col-xs-2 ><input type=text name=speca[] class=form-control placeholder=></div><div class=col-xs-2><input type=text name=specb[] class=form-control placeholder=></div><div class=col-xs-1><input type=text class=form-control name=specPrice[] placeholder=></div><div class=col-xs-1><input type=text class=form-control name=specnum[] placeholder=></div><div class=col-xs-1><input type=text name=offerPrice[] class=form-control placeholder=></div><div class=col-xs-2><input type=text name=code[] class=form-control placeholder=></div><div class=col-xs-2><input type=text name=weight[] class=form-control placeholder=></div><div class=col-xs-1><button type=button class='btn-danger'>删除</button></div></div><div class=col-xs-12 br></div>");
        });

        $(".freight").click(function(){
            var freight_val = $(this).val();
            if(freight_val == 1)
            {
              $(".freightmb").css("display","block");
            }
            if(freight_val == 0)
            {
              $(".freightmb").css("display","none");
            }
        });
        var freight_val = $("input[name='freight']:checked").val();
        if(freight_val == 1)
        {
           $(".freightmb").css("display","block");
        }
        $("body").on('click','.btn-danger',function(){
            $(this).parent().parent('div').remove();
        });
    });
  </script>
  <script>
      function readyup(obj)
    {       
            var id = obj.id;
            ajaxFileUpload(id);
    }
    function ajaxFileUpload(id) 
    {
            var Img_show = "show_"+id;
            $.ajaxFileUpload
            (
                    {
                        url: "<?php echo U('Upload/Index/upload_product');?>?id="+id,
                        secureuri: false,
                        fileElementId: id,
                        dataType: 'json',
                        success: function (data, status)
                        {  
                           var code = data['code'];
                           if(code == '000000')
                           {
                               alert('图片尺寸必须是640 X 640！');
                               return;
                           }
                           if(code == '000002')
                           {
                               $("#"+Img_show).attr("src", data.showimgurl);
                               $(":input[name=goods_"+id+"]").val(data.imgurl);
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