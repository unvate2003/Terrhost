<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản Trị Viên</title>
    <link rel="shortcut icon" href="https://nickvui.com/assets/themes/images/favicon/favicon-rounded-admin.ico">
    <!-- Google Font: Source Sans Pro -->
    <!--
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/fontawesome-free/css/all.min.css?ver=<?= time(); ?>">
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/font-awesome-4.7.0/css/font-awesome.min.css?ver=<?= time(); ?>" type="text/css" />

<!--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css?ver=<?= time(); ?>">
-->
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/ionicons/2-0-1/css/ionicons.min.css?ver=<?= time(); ?>">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css?ver=<?= time(); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css?ver=<?= time(); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/dist/css/adminlte.min.css?ver=<?= time(); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/overlayscrollbars/css/overlayscrollbars.min.css?ver=<?= time(); ?>">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/daterangepicker/daterangepicker.css?ver=<?= time(); ?>">
    <!-- summernote -->

    <!-- Plugins Sweetalert2 -->
    <link href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/sweetalert2/sweetalert2.min.css?ver=<?= time(); ?>" rel="stylesheet" type="text/css" />
    
    <!-- Plugins Toastr -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/toastr/toastr.min.css?ver=<?= time(); ?>" type="text/css" />

    <!-- Plugins DataTables -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/datatable/dataTables.bootstrap4.min.css?ver=<?= time(); ?>" type="text/css" />
    
    <!-- Plugins Sweetalert2 -->
    <script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/sweetalert2/sweetalert2.min.js?ver=<?= time(); ?>"></script>
    
    
    <!-- Plugins Jquery -->
    <script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/jquery/jquery-3.6.0.min.js?ver=<?= time(); ?>"></script>
    
    <!-- Function -->
    <script type="text/javascript" src="https://nickvui.com/assets/themes/js/swap.js?ver=1680367899"></script>
    
    
    
    
    <style>
    body {
	  font-size: .875rem;
	}
	
        body[data-topbar=colored] #page-topbar{background-color:#F07538}.page-title-box{background-color:#F07538;padding:5px 12px 65px 12px}.form-control:focus{border:1px solid #F07538}.bg-main{background-color:#F07538!important}body[data-topbar=colored] .dropdown.show .header-item{background-color:#F07538}#sidebar-menu ul li a .uim-svg{fill:#F07538!important}.mm-active{color:#F07538!important}.mm-active .active{color:#F07538!important}.nav-pills .nav-link.active,.nav-pills .show>.nav-link{color:#fff;background-color:#F07538}.vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>a{color:#F07538;font-weight:700}.box-price-service{text-align:center;font-size:22px;font-weight:700;letter-spacing:3px;color:#1fab89;background-color:#bcffdc;border-radius:50px}.page-item.active .page-link{z-index:3;color:#fff;background-color:#F07538;border-color:#F07538}.menu-img{height:17px;margin:4px;padding-left:3px;display:inline-block}.bank-style{border-radius:20px;border:2px solid #F07538;padding:15px}.box-service-panel{border:1.2px solid #1a4ae8;border-radius:10px}.box-service-panel:hover{border:2px solid #1a4ae8;transform:translate3d(0,0,0);backface-visibility:hidden;perspective:1000px}.service-text{padding-top:12px;font-weight:600;color:#3a3a3a;box-sizing:border-box}.box-service-panel img{height:40px;margin-bottom:12px}@keyframes shake{10%,90%{transform:translate3d(-1px,0,0)}20%,80%{transform:translate3d(2px,0,0)}30%,50%,70%{transform:translate3d(-4px,0,0)}40%,60%{transform:translate3d(4px,0,0)}}
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<!--
<body class="hold-transition sidebar-mini">
-->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Tìm Kiếm" aria-label="Tìm Kiếm">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                 Niscaz Records
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/admin" class="brand-link">
      <img src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="/" class="d-block">Về Website</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                                       with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin" class="nav-link active">
                                        <i class="fa fa-home nav-icon"></i>
                                        <p>Trang Chủ</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/setup-system" class="nav-link">
                                <i class="nav-icon fa fa-cogs"></i>
                                <p>
                                    Cấu Hình Website
                
                                </p>
                            </a>
                        </li>
                
                        <li class="nav-item">
                            <a href="/add-categories" class="nav-link">
                                <i class="nav-icon fa fa-list text-danger"></i>
                                <p>
                                    Thêm Danh Mục Chính
                
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/add-sub-cate" class="nav-link">
                                <i class="nav-icon fa fa-list-ol text-primary"></i>
                                <p>
                                    Thêm Danh Mục Phụ
                
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/add-product" class="nav-link">
                                <i class="nav-icon fa fa-plus-square text-warning"></i>
                                <p>
                                    Thêm Nguồn Sản Phẩm
                
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/product-pay" class="nav-link">
                                <i class="nav-icon fa fa-check-square text-success"></i>
                                <p>
                                    Sản phẩm đã bán
                
                                </p>
                            </a>
                        </li>
                        </li>
                
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-university"></i>
                                <p>
                                    Thanh Toán
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/setup-payment" class="nav-link">
                                        <i class="nav-icon fa fa-money"></i>
                                        <p>
                                            Cấu Hình Thanh Toán
                
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/setup-mbbank" class="nav-link">
                                        <i class="nav-icon fa fa-bank"></i>
                                        <p>
                                            Mbbank Auto
                
                                        </p>
                                    </a>
                
                                </li>
                                <li class="nav-item">
                                    <a href="/setup-tpbank" class="nav-link">
                                        <i class="nav-icon fa fa-bank"></i>
                                        <p>
                                            TPbank Auto
                
                                        </p>
                                    </a>
                
                                </li>
                                <li class="nav-item">
                                    <a href="/setup-momo" class="nav-link">
                                        <i class="nav-icon fa fa-gg"></i>
                                        <p>
                                            Momo Auto
                
                                        </p>
                                    </a>
                
                                </li>
                                <li class="nav-item">
                                    <a href="/setup-napthe" class="nav-link">
                                        <i class="nav-icon fa fa-credit-card"></i>
                                        <p>
                                            Cấu Hình Nạp Thẻ
                
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    Thành Viên
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                
                
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/setup-member" class="nav-link">
                                        <i class="nav-icon fa fa-user-circle"></i>
                                        <p>
                                            Quản Lý Thành Viên
                
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/setup-money" class="nav-link">
                                        <i class="nav-icon fa fa-pencil-square-o"></i>
                                        <p>
                                            Edit Tiền Thành Viên
                
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                
                
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-history"></i>
                                <p>
                                    Lịch Sử Web
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/history-pay" class="nav-link">
                                        <i class="nav-icon fa fa-link"></i>
                                        <p>
                                            Lịch Sử Nạp Thành Viên
                
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/history-login" class="nav-link">
                                        <i class="nav-icon fa fa-history"></i>
                                        <p>
                                            Lịch Sử Đăng Nhập
                
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                
                
                        <li class="nav-item">
                            <a href="/setup-ticket" class="nav-link">
                                <i class="nav-icon fa fa-sticky-note"></i>
                                <p>
                                    Ticket Hỗ Trợ
                
                                </p>
                            </a>
                        </li>
                
                    </ul>
                    </li>
                
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>