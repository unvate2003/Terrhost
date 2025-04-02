<?php  
error_reporting(E_ALL ^ E_NOTICE);
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if($_POST){
$id= xss(addslashes($_POST['id']));
mysqli_query($conn, "UPDATE `san-pham-chua-ban` SET `active` = '1' WHERE `key_id` = '$id'");
}
else
{
	echo json_encode(array('code' => 0, 'msg' => 'Opps! . What happened ?.'));
	exit;
}
?>  