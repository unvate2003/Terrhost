<?php
/*
* Upgrade Nguyễn Hợp - HayCode.Net
*/
session_start();
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_SESSION['username']) && isset($_POST['soluong']) && $_POST['soluong'] > 0 && is_numeric($_POST['soluong'])){
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
	$soluong = $_POST['soluong'];
	$loai = $_POST['loai'];
		$query_post = "SELECT * FROM `subcategories` WHERE `key_id` = '".$loai."' "; 
		$result = mysqli_query($conn, $query_post);
		$checksub = mysqli_fetch_array($result);
		$gia = $checksub['rate'];
		$tongsanpham = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".$loai."'"));
	if($soluong > $tongsanpham){
		echo json_encode(array('code' => 0, 'msg' => 'Số Lượng Mua Không Được Lớn Hơn Số Lượng Kho Đang Có!'));
		exit;
	}
		$username = $_SESSION['username'];
		$vnd = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `cash` FROM `users` WHERE `username` = '".$_SESSION['username']."'"))['cash'];
		$thanhtien = $soluong * $gia;
	if($thanhtien > $vnd){
		echo json_encode(array('code' => 0, 'msg' => 'Bạn Không Đủ Tiền Để Mua Số Lượng Này!'));
		exit;
	}
	do {
	    $time = time();
        $check = mysqli_query($conn, "SELECT * FROM `lich-su-mua` WHERE `time` = '$time'");
        $count = mysqli_num_rows($check);
    } while ($count > 0);
	mysqli_query($conn,"UPDATE `users` SET `cash` = `cash` - ".$thanhtien." WHERE `username` = '".$username."'");
		$get = mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".$loai."' ORDER BY RAND() LIMIT 0, {$soluong}");
		if($get)
		{
			$fail = 0;
			while($row = mysqli_fetch_assoc($get))
			{
			$keycheck = $row['key_id'];
			$text = $row['text'];
			$cate = $row['cate'];
			$subcate = $row['subcate'];
			
			$checkquerydelete = mysqli_query($conn,"DELETE FROM `san-pham-chua-ban` WHERE `key_id` ='".$keycheck."' AND `subcatekey` = '$loai'");
		/*if($text != NULL){*/
		if($checkquerydelete){
			mysqli_query($conn,"INSERT INTO `san-pham-da-ban`(`subcatekey`, `key_id`, `text`, `cate`, `subcate`, `time`, `username`) VALUES ('".$loai."', '".$keycheck."', '".$text."', '".$cate."','".$subcate."', '".$time."', '".$username."')");
		}else{
			$fail = $fail + 1;
		}
			}
				$hoantien  = $gia * $fail;
				mysqli_query($conn,"UPDATE `users` SET `cash` = `cash` + ".$hoantien." WHERE `username` = '".$username."'");
	$success = $soluong - $fail;
		mysqli_query($conn,"INSERT INTO `lich-su-mua`(`cateid`, `subcateid`,`key_id`, `amount`, `time`, `username`) VALUES ('$cate','$subcate','$loai','$soluong','$time','$username')");

	$tienmua = $gia * $success;
		}
		echo json_encode(array('code' => 1, 'msg' => 'Mua '.$success.' Sản Phẩm Thành Công. Đã Trừ '.number_format($tienmua).'đ.', 'key' =>''.$time.''));
		exit;
}
else
{
	header('Location: /');
    exit;
}
?>