<?php
require $_SERVER['DOCUMENT_ROOT'].'/core/database.php';
require $_SERVER['DOCUMENT_ROOT']."/auth/@apitpbank/tpbank.php";
//header("content-type: application/json;charset=utf-8");
//error_reporting(0);
set_time_limit(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$TPBANK = new TPBANK;
 if (isset($_GET["name"])) 
    {
        $getData=$NH->get_row(" SELECT * FROM `tpbank` WHERE `user_id` = '" . $_GET["name"] . "'");
        if($getData)
        {
                $access_token = $getData['access_token'];
                $stk = $getData['sotaikhoan'];

                $login = $TPBANK->get_history($access_token,$stk );
                print_r($login);
                if(@strpos($login, 'Error 401: Full authentication is required to access this resource') !== false)
                {
                    $check = json_decode($TPBANK ->get_token($getData['account'],$getData['password']));
                    $NH->update("tpbank", [
                        'access_token'         => $check->access_token,
                    ], " `account` = '" . $getData['account'] . "' ");
                }
                else {
$login= json_decode($login);
print_r($login);
$lsgd = is_array($login->transactionInfos) ? $login->transactionInfos : array($login->transactionInfos);

foreach ( $lsgd as $lsgd )
{
$idbank = $lsgd->id;
$magiaodich = $lsgd->reference;
$cuphap = $lsgd->description;
$sotien = $lsgd->amount;
$sodu = $lsgd->runningBalance;
$ngaygiaodich = $lsgd->valueDate;
$chuyentien = $lsgd->creditDebitIndicator;
echo 'ID :'.$idbank.'<br>';
echo 'Mã giao dich : '.$magiaodich.'</br>';
echo 'Cú Pháp : '.$cuphap.'</br>';
echo 'Số tiền : '.$sotien.'</br>';
echo 'Số dư sau giao dịch : '.$sodu.'</br>';
echo 'Ngày giao dịch : '.$ngaygiaodich.'</br>';
if ($chuyentien == "CRDT") {
$checkNH = $NH->get_row("SELECT * FROM `users` WHERE `username` = '$cuphap'");
                    if ($checkNH) {
                        $checktranid = $NH->get_row("SELECT * FROM `history_naptien` WHERE `type` = 'Bank' AND `tranid` = '$magiaodich' ");
                        if (!$checktranid) {
                            $create = $NH->insert("history_naptien", [
                                'type'          => 'Bank',
                                'username'      => $checkNH['username'],
                                'loaithe'       => 'TPBank Auto',
                                'menhgia'       => $sotien,
                                'sothe'         => 'TPBank Auto',
                                'soseri'        => 'TPBank auto',
                                'thucnhan'      => $sotien,
                                'trangthai'     => 1,
                                'date'          => gettime(),
                                'tranid'        => $magiaodich,
                                'namemomo'        => $cuphap
                            ]);
                            if ($create) {
                                $update1 = $NH->cong("users", "cash", $sotien, " `username` = '$cuphap'");
                                $ghilog = $NH->insert("log_site", [
                                    'username' => $checkNH['username'],
                                    'note'          => ' Vừa Nạp Tpbank Auto ' . number_format($sotien) . ' vào lúc ' . gettime() . '',
                                    'ip'            => getip(),
                                    'date'          => gettime()
                                ]);
                            }//end create
                            echo 'Đã cộng tiền cho user '.$checkNH['username'].' với số tiền là ' . number_format($sotien) . ' VNĐ  vào lúc ' . gettime() . '';
                        } //end checktranid 
                    }//end checkNH 
                    $tpbank[] = [
                        'Ma giao dich' => $magiaodich,
                        'So tien' => $sotien,
                        'So du' => $sodu,
                        'Ngay giao dich' => $ngaygiaodich,
                        'Noi dung' => $cuphap
                    ];
                }//end foreach 
            }//end else
         } //end chuyentien
      echo json_encode($tpbank,true, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }// end getdata
        
        else
        {
die(json_encode([
                        'status' => false,
                        'message' => 'Lỗi !!'
                    ]));
        }
    }//end getname
  ?>