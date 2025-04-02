<?php
session_start();
$_SESSION['username'] = $_COOKIE['idkhach'];
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if($_POST['type'] == 'napthecao'){
 if (!isset($_POST['telco']) || !isset($_POST['amount']) || !isset($_POST['serial']) || !isset($_POST['code'])) {
        $err = 'Bạn cần nhập đầy đủ thông tin';
    } else {
        $telco = addslashes($_POST['telco']);
        $amount = addslashes($_POST['amount']);
        $serial = addslashes($_POST['serial']);
        $code = addslashes($_POST['code']);
        
        $command = 'charging';  // Nap the
        $check = mysqli_query($conn, "select * from `napthe` where `code` = '".$code."' AND `seri` = '".$serial."'");
        $check = mysqli_num_rows($check);
        //require_once('/api.php'); 
        require_once $_SERVER['DOCUMENT_ROOT']."/auth/napthe/api.php";
        $request_id = rand(100000000, 999999999); /// Order id của bạn, ví dụ này lấy ngẫu nhiên để test
          //$request_id =  $setup['cuphap']."".$data['id'];
if($telco == '' || $amount == '' || $serial == '' || $code == ''){
    exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập đầy đủ thông tin!', 'type' => 'error')));
}elseif($check >= 1){
    exit(json_encode(array('status' => '1', 'msg' => 'Thẻ đã tồn tại trên hệ thống!', 'type' => 'error')));
}else
            $dataPost = array();
            $dataPost['partner_id'] = $partner_id;
            $dataPost['request_id'] = $request_id;
            $dataPost['telco'] = $telco;
            $dataPost['amount'] = $amount;
            $dataPost['serial'] = $serial;
            $dataPost['code'] = $code;
            $dataPost['command'] = $command;
            $sign = creatSign($partner_key, $dataPost);
            $dataPost['sign'] = $sign;
            
            $data = http_build_query($dataPost);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            curl_setopt($ch, CURLOPT_REFERER, $actual_link);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

            $obj = json_decode($result);
            
            if ($obj->status == 99) {
                $cookie = $data['cookie'];
                $url = "https://thesieure.com/doithecao?searchcode=".$telco;
                                $head=array(
                                "Host:thesieure.com",
                                "referer:https://thesieure.com/",
                                "cookie: $cookie"
                                );
                                $ch=curl_init();
                                curl_setopt($ch,CURLOPT_URL, $url);
                                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                                curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 10; SM-J600G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Mobile Safari/537.36");
                                curl_setopt($ch,CURLOPT_HTTPHEADER, $head);
                                $mr2 = curl_exec($ch);  
                                curl_close($ch); 
                                $data=explode('<table id="example1" class="table table-bordered table-striped dataTable">', $mr2)[1];
                                $trangthai = explode("<td>", $data)[1];
                                $mathe = explode("<td>", $data)[2];
                                $seri = explode("<td>", $data)[3];
                                $nhansotien = explode("<td>", $data)[9];
                                $data=explode("</table>", $data)[0];
                                $mathe2 = $amount;
                                if ($trangthai != "Thẻ Lỗi") {
                                    $gettrangthai = '2';
                                }
                                else
                                {
                                    $gettrangthai = '1';

                                }
                    $thucnhan = $amount - $amount * $setup['cktsr'] / 100;
                    mysqli_query($conn, "INSERT INTO napthe SET 
    `uid` = '".$_SESSION['username']."',
    `sotien` = '".$amount."',
    `seri` = '".$serial."',
    `code` = '".$code."',
    `loaithe` = '".$telco."',
    `tinhtrang` = '".$gettrangthai."',
    `noidung` =  '".$request_id."',
    `thucnhan` = '".$thucnhan."',
    `time` = '".time()."'");
     exit(json_encode(array('status' => '2', 'msg' => 'Bạn đã gửi thẻ thành thông! Thẻ của bạn sẽ được duyệt trong 30s - 1 phút', 'type' => 'success')));
                
                
                
            }else{
                $tbcmmm = $obj->message;
    exit(json_encode(array('status' => '1', 'msg' => ''.$tbcmmm.'', 'type' => 'error')));
}

        
    }
  
$tbcmmm = $obj->message;
}
?>