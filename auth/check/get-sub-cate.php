<?php
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if(!empty($_POST["catid"])) 
{
 $id=intval($_POST['catid']);
$query=mysqli_query($conn,"SELECT * FROM subcategories WHERE cateid=$id and active=1 ORDER BY subcate ASC, rate ASC");
?>
<option value="">Chọn Danh Mục Phụ</option>
<?php
 while($row=mysqli_fetch_array($query))
 {
  ?>
  <option value="<?php echo htmlentities($row['subcateid']); ?>"><?php echo htmlentities($row['subcate']); ?></option>
  <?php
 }
}
?>