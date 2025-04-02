<?php  
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Ho_Chi_Minh');
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if($_POST) {
$id= xss(addslashes($_POST['id']));
echo $id;
mysqli_query($conn, "UPDATE `san-pham-chua-ban` SET `active` = '0' WHERE `key_id` = '$id' ");

}
else
{
	 echo json_encode(array('code' => 0, 'msg' => 'Opps! . What happened ?.'));
    exit;
}
?>  