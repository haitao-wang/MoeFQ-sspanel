<?php
require_once '../lib/config.php';
require_once '_check.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $site_name;  ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="http://cdn.bootcss.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="http://cdn.moefont.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../asset/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link href="../asset/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="../user/style-kotori.css" rel="stylesheet" type="text/css" />
    <link href="../user/style-kotori.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        body{
            font-family: "Hiragino Sans GB", "Microsoft YaHei","WenQuanYi Micro Hei",Comic sans ms;
        }
        .user-header{
            height:auto!important;
        }
        .box-title{
            font-family:Microsoft YaHei;
        }
    </style>
</head>
<body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <a href="index.php" style="background-color:rgb(34,45,50);" class="logo"><?php echo $site_name;  ?></a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation" style="background-color:rgb(34,45,50);" >
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a> 
                <ul class="nav navbar-nav top-menu">
                    <li>
                        <a href="index.php">
                            <i class="fa fa-dashboard"></i> <span>仪表盘</span>
                        </a>
                    </li>

                    <li>
                        <a href="node.php">
                            <i class="fa fa-sitemap"></i> <span>节点一览</span>
                        </a>
                    </li>

                    <li >
                        <a href="my.php">
                            <i class="fa fa-user"></i> <span>用户中心</span>
                        </a>
                    </li>


                    <li >
                        <a href="price.php">
                            <i class="fa  fa-money"></i> <span>服务价格</span>
                        </a>
                    </li>

                    <li>
                        <a href="recharge.php">
                            <i class="fa fa-credit-card"></i> <span>充值萌币</span>
                        </a>
                    </li>

                    <li>
                        <a href="invite.php">
                            <i class="fa fa-users"></i> <span>邀请好友</span>
                        </a>
                    </li>

                    <li  >
                        <a href="sys.php">
                            <i class="fa fa-align-left"></i> <span>系统信息</span>
                        </a>
                    </li>
                </ul>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo \Ss\User\Comm::Gravatar($U->GetEmail());  ?>" class="user-image" alt="User Image"/>
                                <span class="hidden-xs"><?php echo $U->GetUserName(); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo \Ss\User\Comm::Gravatar($U->GetEmail());  ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $U->GetEmail(); ?><span style="font-family:Microsoft Yahei;"> (<?php echo $U->UserRole(); ?>)</span>
                                        <?php if($ko->kotoriNeedInfo('role',$uid) == 'vip1' || $ko->kotoriNeedInfo('role',$uid) == 'vip2'):?>
                                         <small>VIP到期时间：剩余 <?php echo $ko->kotoriNeedInfo('role_timeout',$uid); ?> 天</small>
                                        <?php endif;?>
                                        <small>加入时间：<?php echo $U->RegDate(); ?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="my.php" class="btn btn-default btn-flat">个人信息</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">退出</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo \Ss\User\Comm::Gravatar($U->GetEmail());  ?>" class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info moe-side-menu">
                        <p><?php echo $U->GetUserName(); ?></p>

                        <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                    </div>
                </div>

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li>
                        <a href="index.php">
                            <i class="fa fa-dashboard"></i> <span>仪表盘</span>
                        </a>
                    </li>

                    <li>
                        <a href="node.php">
                            <i class="fa fa-sitemap"></i> <span>节点一览</span>
                        </a>
                    </li>

                    <li >
                        <a href="my.php">
                            <i class="fa fa-user"></i> <span>用户中心</span>
                        </a>
                    </li>


                    <li >
                        <a href="price.php">
                            <i class="fa  fa-money"></i> <span>服务价格</span>
                        </a>
                    </li>

                   <li>
                        <a href="recharge.php">
                            <i class="fa fa-credit-card"></i> <span>充值萌币</span>
                        </a>
                    </li>                    

                    <li>
                        <a href="invite.php">
                            <i class="fa fa-users"></i> <span>邀请好友</span>
                        </a>
                    </li>

                    <li  >
                        <a href="sys.php">
                            <i class="fa fa-align-left"></i> <span>系统信息</span>
                        </a>
                    </li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>