<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";

$request = mysqli_real_escape_string($conn, $_POST["query"]);
$query = "SELECT * FROM users WHERE username LIKE '%".$request."%'";

$result = mysqli_query($conn, $query);

$all_member_data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $all_member_data[] = $row["username"];
 }
 echo json_encode($all_member_data);
}

?>
