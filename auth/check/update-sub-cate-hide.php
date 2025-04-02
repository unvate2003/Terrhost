<?php  
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Ho_Chi_Minh');
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if($_POST) {
$id= intval($_POST['id']);  
mysqli_query($conn, "UPDATE `subcategories` SET `active` = '1' WHERE `subcateid` = '$id' ");

}
else
{
	 echo json_encode(array('code' => 0, 'msg' => 'Opps! . What happened ?.'));
    exit;
}
?>  