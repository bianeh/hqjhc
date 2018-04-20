<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>供货商系统后台</title>
  <!-- Tell the browser to be responsive to screen width -->
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
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo (ROOT_URL); ?>/Public/backend/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo" style="background: #008d4c">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>供货商后台</b>系统</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>供货商后台</b>系统</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background: #00a65a">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="background:#00a65a">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
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
                  <!-- end message -->
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
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ($data["loginname"]); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo ($data["loginname"]); ?>
                  <small><?php echo date('Y-m-d H:i:s',time())?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo U('/User/Login/dologinout');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
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

  </style>
<style type="text/css">
a{
  color:#b8c7ce;
}
.active{
    display:block;
}
</style>
<aside class="main-sidebar" style="background:#1e282c;color:#1e282c">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (ROOT_URL); ?>/Public/backend/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>供货商<?php echo ($data["loginname"]); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li id="Product" class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>产品管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul id="aticles" class="treeview-menu">
            <li><a href="<?php echo U('Product/Index/index');?>"><i class="fa fa-circle-o"></i>产品列表</a></li>
          </ul>
        </li>
        <li id="Orders" class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>订单管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul id="products" class="treeview-menu">
            <li><a href="<?php echo U('Order/Index/index');?>" class="pre"><i class="fa fa-circle-o"></i>订单列表</a></li>
          </ul>
        </li>
         <li id="Orders" class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>退货/退款</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul id="products" class="treeview-menu">
            <li><a href="<?php echo U('Orderaf/Index/index');?>"><i class="fa fa-circle-o"></i>退货退款列表</a></li>
          </ul>
        </li>
        <li id="Offers" class="treeview">
          <a href="#">
            <i class="fa fa-industry"></i>
            <span>资料信息</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo U('Offers/Index/index');?>"><i class="fa fa-circle-o"></i>资料信息</a></li>
            <li><a href="<?php echo U('Offers/Index/resetpwdpage');?>"><i class="fa fa-circle-o"></i>修改密码</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jquery/dist/jquery.min.js"></script>
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">工作台</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo ($todayorders); ?></h3>
              <p>今日下单数</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo U('Order/Index/index');?>" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo ($todaymoney); ?><sup style="font-size: 20px"></sup></h3>
              <p>今日成交金额</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right">更多</i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo ($productfavoritesnum); ?></h3>

              <p>商品关注人数</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right">更多</i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo ($productnums); ?></h3>

              <p>已发布产品数</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo U('Product/Index/index');?>" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">近6月销量</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i>销量</li>
            </ul>
            <div class="tab-content no-padding">
              <div class="chart tab-pane active" id="revenue-chart" style="position:relative; width: 100%;height:400px;"></div>
            </div>
          </div>
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#sales-chart" data-toggle="tab">近6月财务收入</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i>财务收入</li>
            </ul>
            <div class="tab-content no-padding">
              <div class="chart tab-pane active" id="sales-chart" style="position:relative; width: 100%;height:400px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
          <!-- TO DO List -->
          <div class="box box-primary" style="display: none">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">【平台公告】</h3>

              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
               <ul class="todo-list">
                <li>
                  <!-- drag handle -->
                  <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <!-- checkbox -->
                  <!-- todo text -->
                  <span style="width: 20%" class="text">ID编号</span>
                  <span style="width: 20%" class="text">标题</span>
                  <span style="width: 20%" class="text">内容</span>
                  <span style="width: 20%" class="text">发布时间</span>
                </li>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                  <!-- drag handle -->
                  <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <span style="width: 20%" class="text"><?php echo ($vo["loginid"]); ?></span>
                  <span style="width: 20%" class="text"><?php echo ($vo["staffname"]); ?></span>
                  <span style="width: 20%" class="text"><?php echo ($vo["logintime"]); ?></span>
                  <span style="width: 20%" class="text"><?php echo ($vo["loginip"]); ?></span>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
              </ul>
            </div>
          </div>
          <!-- /.box -->

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">平台反馈</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form id="feedbackform" action="<?php echo U('Home/Index/doAddfeedback');?>" method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="title" placeholder="标题:">
                </div>
                <div>
                  <textarea class="textarea" name="content" placeholder="内容"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <input type="hidden" name="offerid" value="<?php echo ($data["offerid"]); ?>" />
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" id="feedbacksubmit" class="pull-right btn btn-default" id="sendEmail">提交
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable" style="display: none">

          <!-- solid sales graph -->
          <div class="box box-solid bg-teal-gradient" style="background: #ffffff !important;color:#888">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title" style="color:#888">近6月收入</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style="height:400px;"></div>
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
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
        <!-- /.control-sidebar-menu -->

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
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
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
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
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
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/dist/js/adminlte.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/common/js/echarts.common.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo (ROOT_URL); ?>/Public/backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
 <script type="text/javascript">
      $(document).ready(function(){
        $("#Product").click(function(){
            localStorage.setItem("Id", '#Product');
        });
      });
      var id = localStorage.getItem("Id");
      if(id)
      {
        $(id).addClass('active');
      } 
  </script>

</body>
</html>
<script type="text/javascript">
        var feedbacksubmit = document.getElementById("feedbacksubmit");
        feedbacksubmit.onclick=function(){
            var feedbackform = document.getElementById("feedbackform");
            feedbackform.submit();
        }
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('revenue-chart'));
        myChart.title = '坐标轴刻度与标签对齐';
        option = {
            color: ['#3398DB'],
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    data : <?php echo ($orderdate); ?>,
                    axisTick: {
                        alignWithLabel: true
                    }
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    name:'直接访问',
                    type:'bar',
                    barWidth: '60%',
                    data:<?php echo ($ordercount); ?>
                }
            ]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        var myChart = echarts.init(document.getElementById('sales-chart'));

        // 指定图表的配置项和数据
        myChart.title = '坐标轴刻度与标签对齐';

        option = {
            color: ['#3398DB'],
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    data : <?php echo ($fundsdate); ?>,
                    axisTick: {
                        alignWithLabel: true
                    }
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    name:'直接访问',
                    type:'bar',
                    barWidth: '60%',
                    data:<?php echo ($fundscount); ?>
                }
            ]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        var myChart = echarts.init(document.getElementById('line-chart'));
        myChart.title = '坐标轴刻度与标签对齐';
        option = {
        backgroundColor: '#2c343c',

        title: {
            text: '每月收入情况',
            left: 'center',
            top: 20,
            textStyle: {
                color: '#888'
            }
        },

        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },

        visualMap: {
            show: false,
            min: 80,
            max: 600,
            inRange: {
                colorLightness: [0, 1]
            }
        },
        series : [
            {
                name:'每月收入',
                type:'pie',
                radius : '55%',
                center: ['50%', '50%'],
                data:[
                    {value:335, name:'2017/01'},
                    {value:310, name:'2017/02'},
                    {value:274, name:'2017/03'},
                    {value:235, name:'2017/04'},
                    {value:400, name:'2017/05'}
                ].sort(function (a, b) { return a.value - b.value; }),
                roseType: 'radius',
                label: {
                    normal: {
                        textStyle: {
                            color: 'rgba(255, 255, 255, 0.3)'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        lineStyle: {
                            color: 'rgba(255, 255, 255, 0.3)'
                        },
                        smooth: 0.2,
                        length: 10,
                        length2: 20
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#c23531',
                        shadowBlur: 200,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                },

                animationType: 'scale',
                animationEasing: 'elasticOut',
                animationDelay: function (idx) {
                    return Math.random() * 200;
                }
            }
        ]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>