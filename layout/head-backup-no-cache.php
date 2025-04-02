<?php
@session_start();
/* Code thoi gian tai trang */
$my_timer = microtime();
$time_parts = explode(' ', $my_timer);
$time_right_now = $time_parts[1] + $time_parts[0];
$starting_time = $time_right_now;
/* Het code thoi gian tai trang */
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $setup['description']; ?>" />
    <meta name="author" content="<?= $setup['name-admin']; ?>" />
    <meta name="keywords" content="<?= $setup['keywords']; ?>" />
    <meta name="distribution" content="Global" />
    <meta name="robots" content="index,follow" />
    <link rel="shortcut icon" href="<?php echo ''.$setup['link-icon'] ?>" />
    
    <title><?php echo ''.$title.''.$setup[ 'title'].'' ?></title>
    <link rel="canonical" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/" />
    <link rel="shortlink" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/" />
    
    <link rel="dns-prefetch" href='//www.google.com' />
    <link rel="dns-prefetch" href='//cdn.jsdelivr.net' />
    <link rel="dns-prefetch" href='//cdnjs.cloudflare.com' />
    <link rel="dns-prefetch" href='//s.w.org' />
    
    <!-- Preload Font Awesome -->
    <link rel="preload font" as="font" type="font/woff2" crossorigin="anonymous" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/font-awesome-4.7.0/fonts/fontawesome-webfont.woff2?v=4.7.0" />

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/font-awesome-4.7.0/css/font-awesome.min.css?ver=<?= time(); ?>" type="text/css" />

    <!-- Bootstrap Core CSS  -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/bootstrap-4.6.1/css/bootstrap.min.css?ver=<?= time(); ?>" type="text/css" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/css/style.css?ver=<?= time(); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/css/themes.css?ver=<?= time(); ?>" type="text/css" />
    
     <!-- Plugins ionicons -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/css/ionicons.min.css?ver=<?= time(); ?>" type="text/css" />

    <!-- Plugins Sweetalert2 -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/sweetalert2/sweetalert2.min.css?ver=<?= time(); ?>" type="text/css" />
    
    <!-- Plugins Toastr -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/toastr/toastr.min.css?ver=<?= time(); ?>" type="text/css" />
    
    <!-- Plugins DataTables -->
    <link rel="stylesheet" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/datatable/dataTables.bootstrap4.min.css?ver=<?= time(); ?>" type="text/css" />
    
    <!-- Plugins Sweetalert2 -->
    <script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/sweetalert2/sweetalert2.min.js?ver=<?= time(); ?>"></script>

    <!-- Plugins Jquery -->
    <script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/jquery/jquery-3.6.0.min.js?ver=<?= time(); ?>"></script>
</head>

<?php
$rand_bg=rand(1,20);
$url_bg=''.$homeurl.'/assets/themes/images/background/bg-'.$rand_bg.'';
?>
<body style="background-image: url(<?= $url_bg ?>.jpg);">
    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
        <a class="navbar-brand logo" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>">
          <img src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/images/favicon/favicon-rounded.png" alt="Trang Chủ" height="25" width="25">
            <?php //echo $setup['title']; ?> Shop Nick Vui
        </a>
        <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/">Trang chủ <span class="sr-only">(current)</span></a>
                </li>

                <?php if(!empty($_SESSION[ 'username'])){ ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/lich-su-mua">Lịch Sử Mua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/ticket">Gửi Ticket Hỗ Trợ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nạp tiền</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/nap-tien">MoMo/Chuyển Khoản Ngân Hàng</a>
                        <a class="dropdown-item" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/nap-the-cao-baotri">Nạp thẻ cào (Bảo Trì)</a>
                        <a class="dropdown-item" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/khieu-nai-nap-tien">Khiếu Nại Nạp Tiền</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tài khoản</a>
                    
                    <div class="dropdown-menu" aria-labelledby="dropdown02">
                        <a class="dropdown-item" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/profile">Thông Tin Tài Khoản</a>
                        <a class="dropdown-item" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/historylog">Lịch Sử Hoạt Động</a>
                        <a class="dropdown-item" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/logout">Đăng Xuất</a>
                    </div>
                </li>
                <?php if($data['admin']==1 ){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin" target="_blank">Admin Panel</a>
                </li>
                <?php } } else { ?>
                <li class="nav-item">
                    <a href="/login" class="btn btn-success">Đăng Nhập</a>
                </li>
                <li class="nav-item">
                    <a href="/signup" class="btn btn-warning">Đăng Kí</a>
                </li>
                <?php } ?>
            </ul>

        </div>
    </nav>
    <div class="alert alert-success">
        <strong><marquee scrollamount="10"><?= $setup['notification']; ?> </marquee></strong>
    </div>
    <div class="container bg-light mb-4">
        <!-- Div Container -->