<?php
require $_SERVER['DOCUMENT_ROOT'].'/core/database.php';
require $_SERVER['DOCUMENT_ROOT']."/auth/@apitpbank/tpbank.php";
//error_reporting(0);
set_time_limit(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$TPBANK = new TPBANK;
$id = $_POST['id'];
if(empty($id) && is_numeric($id) == false && $id < 0){
    die(json_encode([
        'status' => false,
        'message' => 'Error'
    ]));
}

$getData=$NH->get_row(" SELECT * FROM `tpbank` WHERE `id` = '" . $id . "'");
        if($getData)
        {
                $access_token = $getData['access_token'];
                $stk = $getData['sotaikhoan'];
                $get_balance = $TPBANK->get_balance($access_token,$stk);
                $result = json_decode($get_balance, true);
//print_r($result['transactionInfos']['id']);
                //print_r($result);

if (isset($result)) {
                    
                    $NH->update("tpbank", [
            'balance' => $result['availableBalance']
        ], " `id` = '$id'  ");

                    $balance = [
                    'status' => true,
                    'acctNo' => $result['BBAN'],
                    'message' => 'Số dư là: ' . number_format($result['availableBalance']) . 'đ',
                    ];
                    echo json_encode($balance);
                   
                } else {
                    $check = json_decode($TPBANK ->get_token($getData['phone'],$getData['password']));
                    $NH->update("tpbank", [
                        'access_token'         => $check->access_token,
                    ], " `phone` = '" . $getData['phone'] . "' ");
                    
                    
                    die(json_encode([
                        'status' => false,
                        'message' => 'Số Dư : 0'
                    ]));
                }
            }
        else
        {
            die(json_encode([
                        'status' => false,
                        'message' => 'Token không tồn tại!'
                    ]));
        }

        ?>