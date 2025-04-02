<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
if(empty($_POST['username']) || empty($_POST['password'])){
exit();
}



$username = xss(addslashes(strtolower($_POST['username'])));
$password = xss(md5(addslashes($_POST['password'])));

$timeband= time()+300;

$checkip1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `log` WHERE `ip`='$ip' "));
if($checkip1 and $checkip1['count'] >= 5) {
    $captcha =  $_POST['captcha'];
    //echo $_SESSION['CaptchaCode'].'</br>';
    //echo $_REQUEST['captcha'];
    if(($captcha != $_SESSION['CaptchaCode'])) {
        mysqli_query($conn, "UPDATE `log` SET `content` = 'Thực hiện đăng nhập vào hệ thống!', `count` = `count` + '1', `time` = '$timeband', `username` = '$username' WHERE `ip` ='$ip'");
        die('<script type="text/javascript">setTimeout(function(){ location.href = "/login" },1300); swal("Mã Captcha Không Hợp Lệ!","error");</script>');
    }
}

if(check_username(check_string($username)) == false)
{
	die('<script type="text/javascript">swal("Tài khoản bao gồm các ký tự chữ cái, chữ số, dấu gạch dưới. Độ dài 6-32 ký tự","error");</script>');
}

if(strlen($password) < 5 || strlen($password) > 32 || strlen($username) < 5 || strlen($username) > 32)
{
	die('<script type="text/javascript">swal("Bạn Nhập Không Đủ Ký Tự","error");</script>');
}


$dem = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE `username` ='".mysqli_real_escape_string($conn,$username)."'"));
if($dem == 1){
	$dem = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE `username` ='".mysqli_real_escape_string($conn,$username)."' AND `password` = '".mysqli_real_escape_string($conn,$password)."'"));
	if($dem == 1){
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
	setcookie("idkhach", $username, time() + (86400 * 10000), "/");
    setcookie("pass", $password, time() + (86400 * 10000), "/");
	mysqli_query($conn, "INSERT INTO `history-log` (username, useragent, ip, time) VALUES ('$username', '$browser', '$ip','".time()."')");
	//mysqli_query($conn, "INSERT INTO `log` SET `content` = 'Thực hiện đăng nhập vào hệ thống ! ', `time` = '".time()."', `username` = '$username' ");
	die('<script type="text/javascript">swal("Đăng Nhập Thành Công","success"); setTimeout(function(){ location.href = "/" },1300); toastr.success("Đăng Nhập Thành Công...", "Thông báo");</script>');
	} else {
	    
	$checkip2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `log` WHERE `ip`='$ip' "));
	if(empty($checkip2)) {
	    mysqli_query($conn, "INSERT INTO `log` SET `content` = 'Thực hiện đăng nhập vào hệ thống!', `ip` = '$ip', `count` = '1', `time` = '$timeband', `username` = '$username'");
	 } else {
	    //$checkip3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `log` WHERE `ip`='$ip' "));
	    mysqli_query($conn, "UPDATE `log` SET `content` = 'Thực hiện đăng nhập vào hệ thống!', `count` = `count` + '1', `time` = '$timeband', `username` = '$username' WHERE `ip` ='$ip'");
	 }
	die('<script type="text/javascript">setTimeout(function(){ location.href = "/login" },1300); swal("Tài Khoản Hoặc Mật Khẩu Của Bạn Chưa Chính Xác","error");</script>');
	}
}
else
{
die('<script type="text/javascript">swal("Xin Lỗi! Tài Khoản Này Không Tồn Tại","error");</script>');
}
}
?>
