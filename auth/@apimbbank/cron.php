<?php
require $_SERVER['DOCUMENT_ROOT'].'/core/database.php';
require('mbbank.php');
header('Content-Type: application/json, text/javascript; charset="utf-8"');
$return = 'no';
$serverdb = LOCALHOST;
$udb = USERNAME;
$pdb = PASSWORD;
$ndb = DATABASE;

$rinngok = mysqli_connect($serverdb, $udb, $pdb, $ndb) or die('Error connection');
if ($rinngok->connect_error) {
    $return['status'] = false;
    $return['error'] = true;
    $return['message']   = $rinngok->connect_error;
    die(json_encode($return));
}

$rinngok->query("set names 'utf8' ");
@$MBBANK = new MBBANK($rinngok);
$NH = new NH;
//$username = $NH->check('account_mbbank');
//$password = $NH->check('password_mbbank');
$getlistcard = $NH->get_list("SELECT * FROM `mbbankauto` WHERE 1");

if ($getlistcard) {
    foreach ($getlistcard as $rows) {
        $lsgd = $MBBANK->LoadData($rows['account'], $rows['password'])->Checkhistory(1, $rows['accountno']);
        if (!empty(@$lsgd['result']['transactionHistoryList']) || $lsgd['result']['transactionHistoryList'] != null) {
                $transactionHistoryList = $lsgd['result']['transactionHistoryList'];
                for ($i = 0; $i < count($transactionHistoryList); $i++) {
                $tranId = $transactionHistoryList[$i]['tranId'];
                $tranIdok = substr($tranId, 0, 16);
                $creditAmount =  $transactionHistoryList[$i]['creditAmount'];
                $content =  $transactionHistoryList[$i]['content'];
                $description =  $transactionHistoryList[$i]['description'];
                $contentok =  @trim(str_replace('.', '', explode('TU:', explode($NH->site('cuphap'), $content)[1])[0]));
                $description = @explode('TU:',$description)[1];
                //echo $description.'</br>';
                $io =  $transactionHistoryList[$i]['io'];
                if ($io == 1) {
                    $checkNH = $NH->get_row("SELECT * FROM `users` WHERE `id` = '$contentok'");
                    if ($checkNH) {
                        $checktranid = $NH->get_row("SELECT * FROM `history_naptien` WHERE `type` = 'Bank' AND `tranid` = '$tranIdok' ");
                        if (!$checktranid) {
                            $create = $NH->insert("history_naptien", [
                                'type'          => 'Bank',
                                'username'      => $checkNH['username'],
                                'loaithe'       => 'Mbbank Auto',
                                'menhgia'       => $creditAmount,
                                'sothe'         => 'Mbbank Auto',
                                'soseri'        => 'Mbbank auto',
                                'thucnhan'      => $creditAmount,
                                'trangthai'     => 1,
                                'date'          => gettime(),
                                'tranid'        => $tranIdok,
                                'namemomo'        => $description
                            ]);

                            if ($create) {
                                $update1 = $NH->cong("users", "cash", $creditAmount, " `id` = '$contentok'");
                                $ghilog = $NH->insert("log_site", [
                                    'username' => $checkNH['username'],
                                    'note'          => ' Vừa Nạp Mbbank Auto ' . number_format($creditAmount) . ' vào lúc ' . gettime() . '',
                                    'ip'            => getip(),
                                    'date'          => gettime()
                                ]);
                            }
                            echo 'Đã cộng tiền cho user '.$checkNH['username'].' với số tiền là ' . number_format($creditAmount) . ' VNĐ  vào lúc ' . gettime() . '';
                        }
                    }

                    $mbbank[] = [
                        'tranId' => $tranIdok,
                        'creditAmount' => $creditAmount,
                        'content' => $contentok,
                        //'Noidung' => $content,
                         'description' => $description,
                        'io' => $io
                    ];
                }
            }
      //echo json_encode($mbbank);
        }
    }
}