 <?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
date_default_timezone_set("Asia/Ho_Chi_Minh");
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
if(empty($_POST['username']) || empty($_POST['password'])){
exit();
}



$time = time();
$email = xss(addslashes($_POST['email']));
$username = xss(addslashes(strtolower($_POST['username'])));
$password = xss(md5(addslashes( $_POST['password'] ) ));
$repassword = xss(addslashes( $_POST['repassword'] ) );
$captcha =  $_POST['captcha'];

echo $_SESSION['CaptchaCode'].'</br>';
echo $_REQUEST['captcha'];
if(($captcha != $_SESSION['CaptchaCode']))
    {
      die('<script type="text/javascript">swal("Mã Captcha Không Hợp Lệ!","error");</script>');
  }
if(check_username(check_string($username)) == false)
{
	die('<script type="text/javascript">swal("Tài khoản bao gồm các ký tự chữ cái, chữ số, dấu gạch dưới. Độ dài 5-16 ký tự","error");</script>');
}
if(strlen($password) < 5 || strlen($password) > 32 )
{
	die('<script type="text/javascript">swal("Mật khẩu từ 5 đến 32 kí tự","error");</script>');
}
   if (strcmp($_POST['password'], $_POST['repassword']) != 0) {
   die('<script type="text/javascript">swal("2 Mật Khẩu Không Trùng Nhau","warning");</script>');
}
$dem = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE `username` ='".mysqli_real_escape_string($conn,$username)."'"));
$dem2 = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE `email` ='".mysqli_real_escape_string($conn,$email)."'"));

if($dem >= 1){
	//$_SESSION['username'] = $username;
die('<script type="text/javascript">swal("Tài Khoản Đã Tồn Tại","error"); setTimeout(function(){ location.href = "/signup" },1300);</script>');
} else
if($dem2 >= 1){
	//$_SESSION['username'] = $username;
die('<script type="text/javascript">swal("Email Đã Tồn Tại","error"); setTimeout(function(){ location.href = "/signup" },1300);</script>');
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('<script type="text/javascript">swal("Email Nhập Không Hợp Lệ","error"); setTimeout(function(){ location.href = "/signup" },1300);</script>');
}
else
{
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
setcookie("idkhach", $username, time() + (86400 * 10000), "/");
setcookie("pass", $password, time() + (86400 * 10000), "/");
mysqli_query($conn,"INSERT INTO users SET `username` = '".strtolower(mysqli_real_escape_string($conn,$username))."',`password` = '".mysqli_real_escape_string($conn,$password)."',`repassword` = '".mysqli_real_escape_string($conn,$repassword)."',`email` = '".mysqli_real_escape_string($conn,$email)."',`cash` = '0',`ip` = '$ip',`useragent` = '$browser', `time` = '".date("H:i d-m-Y")."'");
die('<script type="text/javascript">swal("Đăng Ký Thành Công !","success"); setTimeout(function(){ location.href = "/" },1300); toastr.success("Đăng Ký Thành Công...", "Thông báo");</script>');
}
}
?>