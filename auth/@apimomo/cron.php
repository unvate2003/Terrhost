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
$NH = new NH;
$getlistcard = $NH->get_list("SELECT * FROM `cron_momo` WHERE 1");


if ($getlistcard) {
    foreach ($getlistcard as $rows) {
//$gethistt = $momo->LoadData($rows['phone'], $rows['user_id'])->RefreshTokenLogin();
//$gethistt = $momo->LoadData($rows['phone'], $rows['user_id'])->LoginUser($rows['password']);
$gethistt = $momo->LoadData($rows['phone'], $username)->Checklist();
        if (@$gethistt['momoMsgHistory'] != null) {
            foreach ($gethistt['momoMsgHistory'] as $listhis) {
                $tranId = $listhis['tranId'];
                $partnerID = $listhis['partnerID'];
                $comment = str_replace(' ', '', trim(ltrim($listhis['comment'], $NH->site('cuphap'))));
                $amount = $listhis['amount'];
                $partnerName = $listhis['partnerName'];
                $checuNH = $NH->get_row("SELECT * FROM `users` WHERE `id` = '$comment'");

                if ($checuNH) {
                    $checktranid = $NH->get_row("SELECT * FROM `history_naptien` WHERE `type` = 'Momo' AND `tranid` = '$tranId'");

                    if (!$checktranid) {
                        // echo 'đang cộng';
                        $create = $NH->insert("history_naptien", [
                            'type'          => 'Momo',
                            'username'      => $checuNH['username'],
                            'loaithe'       => 'momoauto',
                            'menhgia'       => $amount,
                            'sothe'         => 'momoauto',
                            'soseri'        => 'momoauto',
                            'thucnhan'      => $amount,
                            'trangthai'     => 1,
                            'date'          => gettime(),
                            'tranid'        => $tranId,
                            'namemomo'      => $partnerName,
                            'phonemomo'      => $creditAmount
                        ]);

                        if ($create) {
                            $update1 = $NH->cong("users", "cash", $amount, " `id` = '$comment' ");
                            $ghilog = $NH->insert("log_site", [
                                'username' => $checuNH['username'],
                                'note'          => ' Vừa nạp momo auto ' . $amount . ' vào lúc ' . gettime() . '',
                                'ip'            => getip(),
                                'date'          => gettime()
                            ]);
                        }
                    } else {
                        echo 'Đã cộng cho tài khoản '.$checuNH['username'].' với số tiền là ' . number_format($amount) . ' VNĐ  vào lúc ' . gettime() . '';
                    }
                } else {
                    //echo 'ko có u';
                }
            }
        } else {
            echo ('Không có lịch sử');
        }
    }
}

//print_r($gethistt);
