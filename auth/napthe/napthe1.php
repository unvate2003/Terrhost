<?php
session_start();
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
        $check = mysqli_query($conn, "select * from `napthe` where `sothe` = '".$code."' AND `soseri` = '".$serial."'");
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
                $cookie = 'lang_code=eyJpdiI6IlwvdFczQWVBcmxrSHVmSjE1Y3JESVFRPT0iLCJ2YWx1ZSI6ImRORjNSWVZjSzRsdGdpQjRLRUJXbHc9PSIsIm1hYyI6IjM4YTBmMDljN2M0Mjc5MzUxOTk1M2VjNzUwZWZiN2VlMzQ5NThkNzE0MGE0ZmU3ZDA1ZmQxZmRkMTA1MWQzYmUifQ==; client_info=eyJpdiI6InRrSEVYa0JuRFlsUElkY0tVUVl1M0E9PSIsInZhbHVlIjoiTWNrRG1IbFFoSWdTdkhiYTVEWER4Zz09IiwibWFjIjoiY2FmM2FkMDc0OTRkM2IyN2ExNzdjNWQ3MTNkYWE3YjI2NDFiOGFhZjhlMjkyOTVhNjgwZTBhY2U0MzkwMTdjMiJ9; remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d=eyJpdiI6ImtmNTdjVndNYURGUXFOUEQ0S3lna0E9PSIsInZhbHVlIjoiZjRtK2VBQlNZbFZoTDdnbkkzNmFkeWNoM29rRGgrdHJ0emxKcFlzcjdZSEFBVWhcLzBvRndDQ0taVVFrd0txNUE2T1BqWVdcL1AyNHZMT1BcL05mQ2Y0TDE3cmpVVHQraks4b1wvMHY5QUhWWnRXcHNDVndXZ1pYK2QyTGU3c0YwVVQrbEgrN1hGMkpTTFE4RFVEdll5d2tuajFUWDZ0S05nQW5cL0J3cm1aNm5IbzNUT2hcLzhaQkZLbmxpMjFTK1pWd2pvIiwibWFjIjoiMGMzMjgwZGNhNTc4ZjQ4ZGRhYjM2ZWU0NDI5MzYwM2U5ZWFjNzhkMWIyZjg0MzViZmZiZmU1YWRjM2M4NGVmZiJ9; user_secure=eyJpdiI6Ilo2V2xzcGhlTkdBNnJqVUtTMXgyZ3c9PSIsInZhbHVlIjoibUtPQk10Wjl4QTIwYVowVjBNVkJ0YzVNNE9vNW92N0JLbU84bmNzbXFoa2gzSURmd1JNMUlkRGhCRXJpcmVPdSIsIm1hYyI6ImQ2YTcyYjk4ZWJjNzAyNGNiZDhjYTA2ZjRhOWI4NWQxOGY1ZGQzYWYxYzc1MmI1Y2I1ZjU4YTQ0ODQzNDg0OGYifQ==; PHPSESSID=9eq7kl9tcj48kdrmcjs77kfl26; TCK=bb8098385f6e2ed76cae168d9db9ea03; XSRF-TOKEN=eyJpdiI6IkgxY1dHR2xyZjA5RytNQjBHM2dMN0E9PSIsInZhbHVlIjoibVl0anM1ak5kdCtWbjlqSW83QkRCczIzOWdzQzdhc0pIVEFMaFNxNFgrMU9nM04zRDFmbUwwcFV0UlZVVTI5NSIsIm1hYyI6IjIyNTEwMGVlZmVmNGJjMGVkM2MyZGNkNDUxNjJlNDQxYjllMzU3N2U0ODUwMDFmZGEyNmVjMTM1YjExZGFlN2YifQ==; web_session=eyJpdiI6IjYyOWNPQW5cL0VZbGQ0Y3NvYnFmcmpRPT0iLCJ2YWx1ZSI6IlRmMkFwTytoSUJEK252Y0NLS2JZM2NKMEZhRHZQK1wvN0RDTFJMcm16dUREdXVSajdGYURZWlBNM2lYUnZ2OUdVIiwibWFjIjoiNTI3ZGRhZmJlZGEwNmY1YTM0MTFjODIwZTFiMDQ2NjYxN2M0YzkyOWZkM2M4MzRkMjE2Y2Q4NTRhNmY0YTZlZiJ9';
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
    `type` = 'napthe',
    `username` = '".$username."',
    `menhgia` = '".$amount."',
    `soseri` = '".$serial."',
    `sothe` = '".$code."',
    `loaithe` = '".$telco."',
    `trangthai` = '$gettrangthai',
    `noidung` =  '".$setup['cuphap']."".$data['id']."',
    `thucnhan` = '".$nhansotien."',
    `date` = '".time()."'");
     exit(json_encode(array('status' => '2', 'msg' => 'Bạn đã gửi thẻ thành thông ! thẻ của bạn sẽ được duyệt trong 30s - 1 phút', 'type' => 'success')));
                
                
                
            }else{
                $tbcmmm = $obj->message;
    exit(json_encode(array('status' => '1', 'msg' => ''.$tbcmmm.'', 'type' => 'error')));
}

        
    }
  
$tbcmmm = $obj->message;
}
?>