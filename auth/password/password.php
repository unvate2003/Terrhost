<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
date_default_timezone_set("Asia/Ho_Chi_Minh");
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
if(empty($_POST['password']) || empty($_POST['repassword'])){
exit();
}
$password = addslashes($_POST['password']);
$repassword = md5($_POST['repassword']);
$passold = md5($_POST['passold']);
if(strlen($password) < 6 || strlen($password) > 32)
{
	die('<script type="text/javascript">swal("Mật Khẩu Chưa Đủ Mạnh","error");</script>');
}
   if (strcmp($_POST['password'], $_POST['repassword']) != 0) {
   die('<script type="text/javascript">swal("2 Mật Khẩu Không Trùng Nhau","error");</script>');
}
  if (strcmp($_POST['password'], $_POST['passold']) != 0) {
mysqli_query($conn,"UPDATE users SET `password` = '".mysqli_real_escape_string($conn,$repassword)."',`repassword` = '".mysqli_real_escape_string($conn,$repassword)."'  WHERE `username`='$username'");
die('<script type="text/javascript">swal("Đổi Mật Khẩu Thành Công","success"); setTimeout(function(){ location.href = "/logout" },10);</script>');
	}else{
die('<script type="text/javascript">swal("Mật Khẩu Mới Và Mật Khẩu Cũ Không Được Trùng Nhau","error");</script>');
  }	
}
?>
