<?php  
error_reporting(E_ALL ^ E_NOTICE);
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if($_POST){
$id= xss(intval($_POST['id']));
mysqli_query($conn, "UPDATE `subcategories` SET `active` = '0' WHERE `subcateid` = '$id'");
}
else
{
	echo json_encode(array('code' => 0, 'msg' => 'Opps! . What happened ?.'));
	exit;
}
?>  