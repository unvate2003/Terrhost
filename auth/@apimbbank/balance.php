<?php
header('Content-Type: application/json, text/javascript; charset="utf-8"');
$return = 'no';

require $_SERVER['DOCUMENT_ROOT'].'/core/database.php';
require('mbbank.php');
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
$id = $_POST['id'];

$rinngok = mysqli_connect($serverdb, $udb, $pdb, $ndb) or die('Error connection');
@$MBBANK = new MBBANK($rinngok);
$NH = new NH;
if(empty($id) && is_numeric($id) == false && $id < 0){
    die(json_encode([
        'status' => false,
        'message' => 'Error'
    ]));
}

$getlistcard = $NH->get_row("SELECT * FROM `mbbankauto` WHERE `id` = '$id'");

if ($getlistcard) {
    @$lsgd = $MBBANK->LoadData($getlistcard['account'], $getlistcard['password'])->getbalance();
    if (@$lsgd['acct_list'] != null) {
        for ($i = 0; $i <= count($lsgd['acct_list']); $i++) {
            if (@$lsgd['acct_list'][$i]['acctNo'] == $getlistcard['accountno']) {

                $balance = [
                    'status' => true,
                    'acctNo' => $lsgd['acct_list'][$i]['acctNo'],
                    'message' => 'Số dư là: ' . number_format($lsgd['acct_list'][$i]['currentBalance']) . 'đ',
                    'blance' => $lsgd['acct_list'][$i]['currentBalance']
                ];
      $NH->update("mbbankauto", [
            'balance' => $lsgd['acct_list'][$i]['currentBalance']
        ], " `id` = '$id'  ");
            }
        }
echo json_encode($balance);
    } else {
        die(json_encode([
            'status' => true,
            'message' => 'Error'
        ]));
    }
} else {
    die(json_encode([
        'status' => false,
        'message' => 'Error'
    ]));
}