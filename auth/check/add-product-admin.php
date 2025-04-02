<?php  
//error_reporting(E_ALL ^ E_NOTICE);
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if($_POST){
    $value_add = 0;
    $value_update = 0;
    $value_check = 0;
    $value_check2= 0;
    $list = xss(check_string($_POST['list']));
    $list = explode(PHP_EOL, $list);
    $cate = xss(check_string($_POST['category']));
    $subcate = xss(check_string($_POST['subcategory']));
    $checkey = mysqli_query($conn,"SELECT * FROM `subcategories` WHERE `subcateid` = '$subcate'");
    $checksubkey = mysqli_fetch_assoc($checkey);
    $checkcate = $checksubkey['key_id']; 
    $active = '1';
    $time = time();
    $count = count($list);
    $start = microtime(true);
    foreach($list as $sanpham)
    {	
  
$check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `text` = '$sanpham' AND `subcate` = '$subcate' AND cate = '$cate'"));
$check2 = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-da-ban` WHERE `text` = '$sanpham' AND `subcate` = '$subcate' AND cate = '$cate'"));
    if($check >0){
        $value_check++;
    } else if($check2 >0){
        $value_check2++;
    } else{
    	$key_id = md5(randma(10));
    	$checksp = mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `text` = '$sanpham' ");
    	$checksp = mysqli_num_rows($checksp);
        if($checksp == 0)
        {
          mysqli_query($conn, "START TRANSACTION");
           $isAdd = mysqli_query($conn,"INSERT INTO `san-pham-chua-ban`(`key_id`, `text`, `cate`, `subcate`, `time`, `subcatekey`, `active`) VALUES ('$key_id', '$sanpham', '$cate', '$subcate', '$time', '$checkcate', '$active')");
         mysqli_query($conn, "COMMIT");
            if($isAdd)
            {
                $value_add++;
            }
        }
        else
        {	
            $row_sanpham = mysqli_query($conn, " SELECT * FROM `san-pham-chua-ban` WHERE `text` = '$sanpham' ");
            $row_sanpham = mysqli_fetch_assoc($row_sanpham);
          mysqli_query($conn, "START TRANSACTION");
            $isUpdate = mysqli_query($conn,"UPDATE `san-pham-chua-ban` SET `cate` = '$cate', `text` = '$sanpham', `subcate` = '$subcate', `time` = '$time', `subcatekey` = '$checkcate', `active` = '$active' WHERE `text` = '$sanpham' ");
         mysqli_query($conn, "COMMIT");
            if($isUpdate)
            {
                $value_update++;
            }
        }
    }
}
 $end = microtime(true);
exit(json_encode(array('code' => '1', 'total' => ''.$count.'', 'value' => ''.$value_add.'', 'update' => ''.$value_update.'', 'check' => ''.$value_check.'', 'check2' => ''.$value_check2.'')));
mysqli_commit($conn);
}
else
{
	echo json_encode(array('code' => 0, 'msg' => 'Opps! . What happened ?.'));
	exit;
}
?>  