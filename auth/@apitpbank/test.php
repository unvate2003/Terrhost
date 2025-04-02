<?php
require $_SERVER['DOCUMENT_ROOT']."/core/database.php"; $query = mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");
$str = "MBVCB.1718658208.879279.haycode";
echo 'kí tự cần tìm '.$str.'</br>';



while($row = mysqli_fetch_array($query)){

$char = $row['username'];
$pos = strpos($str, $char);
if ($pos == true) {
   echo "Tồn tại tài khoản '" .$char. "'  trong cơ sỡ dữ liệu";
echo $char;
}
}