<?php
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
$q = intval($_GET['q']);
//$query2=mysqli_query($conn, "SELECT * FROM `subcategories` WHERE active ='1' AND cateid = '$q' ");
//$query2 = mysqli_fetch_assoc($query2);
//$getsubcatekey = $query2['key_id'];
$query3=mysqli_query($conn, "SELECT * FROM `san-pham-chua-ban` WHERE active ='1' AND cate = '$q' ORDER BY id DESC");
//$query3 = mysqli_fetch_assoc($query3);
?>
<table border="1" cellspacing="0" cellpadding="5">

<tr>
<th>ID</th>
<th>Tên Sản Phẩm</th>
<th>Mô tả</th>
</tr>
<?php
while($getrow = mysqli_fetch_array($query3)){
$getquery4 = $getrow['subcate'];
$query4=mysqli_query($conn, "SELECT * FROM `subcategories` WHERE active ='1' AND subcateid = '$getquery4' ");
$query4 = mysqli_fetch_assoc($query4);
?>
<tr>
<td><?= $getrow['id'] ?></td>
<td><?= $query4['subcate'] ?></td>
<td><?= $query4['rate'] ?></td>
</tr>
<?php
}
?>
</table>
