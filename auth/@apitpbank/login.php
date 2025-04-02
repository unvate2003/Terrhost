<?php
require $_SERVER['DOCUMENT_ROOT'].'/core/database.php';
require $_SERVER['DOCUMENT_ROOT']."/auth/@apitpbank/tpbank.php";
//error_reporting(0);
set_time_limit(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$TPBANK = new TPBANK;

$account = xss(addslashes($_POST['account']));
   $password = xss(addslashes($_POST['password']));
   $sotaikhoan = xss(addslashes($_POST['sotaikhoan']));
   $checklogin = json_decode($TPBANK ->get_token($account, $password));
//print_r($checklogin);
if (empty($account)) {
die(json_encode([
                        'status' => false,
                        'message' => 'Vui lòng điền tài khoản'
                    ]));
    }
    if (empty($password)) {
die(json_encode([
                        'status' => false,
                        'message' => 'Vui lòng điền mật khẩu'
                    ]));
    }
    if(empty($sotaikhoan))
    {
die(json_encode([
                        'status' => false,
                        'message' => 'Vui lòng điền số tài khoản'
                    ]));
    }
    $time = time();
   if($checklogin->error->error_code == 50525)
    {
        die(json_encode([
                        'status' => false,
                        'message' => 'Thông tin không chính xác'
                    ]));
   }
  else {
mysqli_query($conn,"INSERT INTO `tpbank`(`user_id`, `account`, `password`, `sotaikhoan`, `balance`,`access_token`) VALUES ('$username','$account','$password','$sotaikhoan','0', '$checklogin->access_token')");
die(json_encode([
                        'status' => true,
                        'message' => 'Thêm thành công'
                    ]));
     
  }


  ?>