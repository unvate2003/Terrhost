<?php

require $_SERVER['DOCUMENT_ROOT'].'/core/database.php';
require('momo.php');
header("content-type: application/json;charset=utf-8");
$serverdb = LOCALHOST; // server data base
$udb = USERNAME; // user database
$pdb = PASSWORD; // pass database
$ndb = DATABASE; // name database

$rinngok = mysqli_connect($serverdb, $udb, $pdb, $ndb);

if ($rinngok->connect_error) {
    $return['status'] = false;
    $return['error'] = true;
    $return['message']   = $rinngok->connect_error;
    die(json_encode($return));
}

$rinngok->query("set names 'utf8' ");
@$momo = new ChatMomo($rinngok);
$requai = '';

$username = $_SESSION['username'];
$checkusite = mysqli_fetch_array(mysqli_query($rinngok, "SELECT * FROM `users` WHERE `username` = '$username' "));


if (!$checkusite) {
    $return['status'] = false;
    $return['error'] = true;
    $return['message']   = "Tài khoản không tồn tại";
    die(json_encode($return));
}

if ($checkusite['admin'] != 1) {
    $return['status'] = false;
    $return['error'] = true;
    $return['message']   = "Bạn không phải ADMIN !";
    die(json_encode($return));
}

$action = xss(addslashes($_POST['action']));

if (!empty($action)) {

    $act = xss(addslashes($_POST['act']));

    switch ($action) {
        case 'loginmomo':
            if (!empty($act)) {

                $phonemomo = @xss(addslashes($_POST['phonemomo']));
                $passmomo = @xss(addslashes($_POST['passmomo']));
                $codeotp = @xss(check_string($_POST['codeotp']));

                if (!empty($phonemomo)) {
                    switch ($act) {
                        case 'sendotp':
                            $requai = $momo->LoadData($phonemomo, $data['username'])->SendOTP();
                            if ($requai['status'] == 'success') {
                                $return['status'] = true;
                                $return['step'] = 'veryotp';
                                $return['message']   = $requai['message'];
                                die(json_encode($return));
                            } else {
                                $return['status'] = false;
                                $return['message']   = $requai['message'];
                                die(json_encode($return));
                            }
                            break;

                        case 'veryotp':
                            if (!empty($codeotp)) {
                                $requai = $momo->LoadData($phonemomo, $data['username'])->ImportOTP($codeotp);
                                if ($requai['status'] == 'success') {
                                    $return['status'] = true;
                                    $return['step'] = 'login';
                                    $return['message']   = $requai['message'];
                                    die(json_encode($return));
                                } else {
                                    $return['status'] = false;
                                    $return['message']   = $requai['message'];
                                    die(json_encode($return));
                                }
                            } else {
                                $return['status'] = false;
                                $return['message']   = 'Thiếu mã otp';
                                die(json_encode($return));
                            }

                            break;

                        case 'login':
                            if (!empty($passmomo)) {
                                $requai = $momo->LoadData($phonemomo, $data['username'])->LoginUser($passmomo);
                                if ($requai['status'] == 'success') {
                                    $return['status'] = true;
                                    $return['step'] = 'SUCCESS';
                                    $return['message']   = $requai['message'] . ' Số dư: ' . $requai['BALANCE'];
                                    die(json_encode($return));
                                } else {
                                    $return['status'] = false;
                                    $return['message']   = $requai['message'];
                                    die(json_encode($return));
                                }
                            } else {
                                $return['status'] = false;
                                $return['message']   = 'Thiếu mã otp';
                                die(json_encode($return));
                            }
                            break;

                        default:
                            $return['status'] = false;
                            $return['message']   = "Thiếu số điện thoại";
                            die(json_encode($return));
                            break;
                    }
                } else {
                    $return['status'] = false;
                    $return['message']   = "Thiếu số điện thoại";
                    die(json_encode($return));
                }
            } else {
                $return['status'] = false;
                $return['message']   = "Thiếu số điện thoại";
                die(json_encode($return));
            }
            break;

        default:
            $return['status'] = false;
            $return['message']   = "Thiếu số điện thoại";
            die(json_encode($return));
            break;
    }
} else {
    $return['status'] = false;
    $return['message']   = "Thiếu số điện thoại";
    die(json_encode($return));
}
