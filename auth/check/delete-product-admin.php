<?php  
//error_reporting(E_ALL ^ E_NOTICE);
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if($_POST){
    $value_add = 0;
    $value_update = 0;
    $list = xss(check_string($_POST['list']));
    $list = explode(PHP_EOL, $list);
    $cate = xss(check_string($_POST['category']));
    $subcate = xss(check_string($_POST['subcategory']));
    $checkey = mysqli_query($conn,"SELECT * FROM `subcategories` WHERE `subcateid` = '$subcate'");
    $checksubkey = mysqli_fetch_assoc($checkey);
    $checkcate = $checksubkey['key_id']; 
    $active = '1';
    $time = time();
    foreach($list as $sanpham)
    {	
       $count = count($list);
    	$key_id = md5(randma(10));
            mysqli_query($conn, "START TRANSACTION");
            $isDelete = mysqli_query($conn,"DELETE FROM `san-pham-chua-ban` WHERE `text` = '$sanpham' ");      
         mysqli_query($conn, "COMMIT");
            if($isDelete)
            {
                $value_add++;
            }
    }
exit(json_encode(array('code' => '1', 'total' => ''.$count.'', 'value' => ''.$value_add.'', 'update' => ''.$value_update.'')));
}
else
{
	echo json_encode(array('code' => 0, 'msg' => 'Opps! . What happened ?.'));
	exit;
}
?>  