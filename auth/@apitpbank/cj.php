<?php
require $_SERVER["DOCUMENT_ROOT"] . "/core/database.php";


/*
$query = mysqli_query($conn,"SELECT * FROM `users` ORDER BY id DESC");
while($row = mysqli_fetch_array($query)){
    
    $username1 = $row['username'];
    //echo $username1;
    $username2 = strtolower($row['username']);
    mysqli_query($conn, "UPDATE users SET `username`='$username2' WHERE `username`='$username1'");
                    //$char = $row['username'];
                    //$pos = strpos($cuphap, $char);
                }
*/

require $_SERVER["DOCUMENT_ROOT"] . "/auth/@apitpbank/tpbank.php";
//header("content-type: application/json;charset=utf-8");
error_reporting(0);
set_time_limit(0);
date_default_timezone_set("Asia/Ho_Chi_Minh");
$TPBANK = new TPBANK();
if (isset($_GET["name"])) {
    $getData = $NH->get_row("SELECT * FROM `tpbank` WHERE `user_id` = '" . $_GET["name"] . "'");
    if ($getData) {
        $access_token = $getData["access_token"];
        $stk = $getData["sotaikhoan"];

        $login = $TPBANK->get_history($access_token, $stk);

        if(@strpos($login, 'Error 401: Full authentication is required to access this resource') !== false) {
            $check = json_decode(
                $TPBANK->get_token($getData["account"], $getData["password"])
            );
            $NH->update(
                "tpbank",
                [
                    "access_token" => $check->access_token,
                ],
                " `account` = '" . $getData["account"] . "' "
            );
        } else {
            $login = json_decode($login);
            //print_r($login);
            $lsgd = is_array($login->transactionInfos)
                ? $login->transactionInfos
                : [$login->transactionInfos];

            foreach ($lsgd as $lsgd) {
                $idbank = $lsgd->id;
                $magiaodich = $lsgd->reference;
                $cuphap = strtolower($lsgd->description);
                $sotien = $lsgd->amount;
                $sodu = $lsgd->runningBalance;
                $ngaygiaodich = $lsgd->valueDate;
                $chuyentien = $lsgd->creditDebitIndicator;
                /*echo 'ID :'.$idbank.'<br>';
                echo 'Mã giao dich : '.$magiaodich.'</br>';
                echo 'Cú Pháp : '.$cuphap.'</br>';
                echo 'Số tiền : '.$sotien.'</br>';
                echo 'Số dư sau giao dịch : '.$sodu.'</br>';
                echo 'Ngày giao dịch : '.$ngaygiaodich.'</br>';*/
                //echo ''.$cuphap.'<br/>';
                
                
                $query = mysqli_query($conn,"SELECT * FROM `users` ORDER BY id DESC");
                while($row = mysqli_fetch_array($query)){
                    
                    $char = $row['username'];
                    if($char == $cuphap) {
                        $char == $cuphap;
                        $pos = true;
                    } else if($char != $cuphap) {
                        $pos = strpos($cuphap, $char);
                    }
                    if ($pos == true) {
                        if ($chuyentien == "CRDT") {
                            $checkNH = $NH->get_row(
                                "SELECT * FROM `users` WHERE `username` = '$char'"
                            );
                            if ($checkNH) {
                                $checktranid = $NH->get_row(
                                    "SELECT * FROM `history_naptien` WHERE `type` = 'Bank' AND `tranid` = '$magiaodich' "
                                );
                                if (!$checktranid) {
                                    $create = $NH->insert("history_naptien", [
                                        "type" => "Bank",
                                        "username" => $checkNH["username"],
                                        "loaithe" => "TPBank Auto",
                                        "menhgia" => $sotien,
                                        "sothe" => "TPBank Auto",
                                        "soseri" => "TPBank auto",
                                        "thucnhan" => $sotien,
                                        "trangthai" => 1,
                                        "date" => gettime(),
                                        "tranid" => $magiaodich,
                                        "namemomo" => $cuphap
                                    ]);
                                    if ($create) {
                                        $update1 = $NH->cong("users", "cash", $sotien, " `username` = '$char'");
                                        $ghilog = $NH->insert("log_site", [
                                            'username' => $checkNH['username'],
                                            'note'          => ' Vừa Nạp Tpbank Auto ' . number_format($sotien) . ' vào lúc ' . gettime() . '',
                                            'ip'            => getip(),
                                            'date'          => gettime()
                                        ]);
                                        echo 'Đã cộng tiền cho user '.$checkNH['username'].' với số tiền là ' . number_format($sotien) . ' VNĐ  vào lúc ' . gettime() . '</br>';
                                    } //end create
                                } //end checktranid
                            } //end checkNH
                        } //end foreach
                    
                
                    if ($pos == true) {
                        echo 'Dữ liệu lọc: '.$char.'<br/>';
                    } else {
                        echo 'Dữ liệu lọc: Không xác định<br/>';
                    }
                    echo 'Cú Pháp: '.$cuphap.'</br>';
                    echo 'Số tiền: '.number_format($sotien).'đ</br>';
                    echo 'Mã giao dich: '.$magiaodich.'</br>';
                    echo 'Ngày giao dịch: '.$ngaygiaodich.'</br>';
                    $check_giao_dich = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `history_naptien` WHERE `tranid`='$magiaodich'"));
                    if($check_giao_dich) {
                        $trangthai='<font color="blue">Đã cộng</font>';
                    } else {
                        $trangthai='<font color="red">Chưa cộng</font>';
                    }
                    echo 'Trạng thái: '.$trangthai.'<br/>';
                    echo '=====<br/>';
                    
                    
                    } // Check Username Nếu cố thì cộng
                
                
                
                } // While Username
                
                
                
                
                
                
                
                    $tpbank[] = [
                                "Ma giao dich" => $magiaodich,
                                "So tien" => $sotien,
                                "So du" => $sodu,
                                "Ngay giao dich" => $ngaygiaodich,
                                "Noi dung" => $cuphap
                            ];
            } //end else
        } //end chuyentien
        echo json_encode($tpbank,true, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } // end getdata
    else {
        die(
            json_encode([
                "status" => false,
                "message" => "Lỗi !!",
            ])
        );
    }
} //end getname
?>
