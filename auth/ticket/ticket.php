<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
if(empty($_POST['title']) || empty($_POST['manager'])){
exit();
}
$title = xss(addslashes($_POST['title']));
$manager = xss(addslashes($_POST['manager']));
$username = $_SESSION['username'];
   if(strlen($manager) < 12 || strlen($manager) > 500)
{
	die('<script type="text/javascript">swal("Nội Dung Phải Dài Hơn 12 Và Thấp Hơn 500 Ký Tự","error");</script>');
}
else
{
$_SESSION['username'] = $username;
	$_SESSION['username'] = $username;
  mysqli_query($conn, "INSERT INTO ticket (username, title, manager, status, time, useragent) VALUES ('$username', '$title', '$manager', '0', '".date("H:i d-m-Y")."','$browser')");
die('<script type="text/javascript">swal("Gửi Ticket Thành Công","success"); setTimeout(function(){ location.href = "" },1200);</script>');
}
}
        

?>
