<?php
/*
* @author: Nguyễn Hợp
* @contact: vuilashare@gmail.com
* @copyright: copyright © 2022
**/
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // ASc or desc
$searchValue = mysqli_real_escape_string($conn,$_POST['search']['value']); // Search value
## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and (text like '%".$searchValue."%' or 
        id like '%".$searchValue."%' or key_id like '%".$searchValue."%' ) ";
}
## Total number of records without filtering
$sel = mysqli_query($conn, "SELECT count(*) AS allcount FROM `san-pham-chua-ban`");
$records = @mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];
## Total number of records with filtering
$sel = mysqli_query($conn,"SELECT count(*) AS allcount FROM `san-pham-chua-ban` WHERE 1 ".$searchQuery);
$records = @mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];
## Fetch records
$empQuery = "SELECT * FROM `san-pham-chua-ban` WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." LIMIT ".$row.",".$rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();
while ($row = @mysqli_fetch_assoc($empRecords)) {
	$cate = $row['cate'];
    $subcate = $row['subcate'];
    $active = $row['active'];
    $date = $row['time'];
    $keyid = $row['key_id'];

    //$uid = $_SESSION['user_id'];
	$categories = @mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tscategory WHERE id = $cate"));
	$subcategories = @mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `subcategories` WHERE cateid = $cate"));
    //$getuser = @mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM salrk_members WHERE id = $uid"));
		if($active == '0'){$active = '<a name="catestthide" class="btn label label-info catestthide" id="'.$keyid.'" alt="'.$keyid.'">Công Khai</a>';}
        if($active == '1'){$active = '<a name="catesttpost" class="btn label label-danger catesttpost" id="'.$keyid.'" alt=" ">Chờ Duyệt</a>';}
       $giatien  = number_format($subcategories['rate']);
     	$xoa = '<a name="delete" class="btn btn-danger btn-sm delete" id="'.$row['id'].'" alt=" " href="?xoa='.$row['key_id'].'" ><i class="fa fa-trash"></i> </a>';
                      
    $data[] = array(
    		"id"=>'<small>'.$row['id'].'</small>',
    		"sanpham"=>'<small>'.$row['text'].'</small>',
            "categories"=>'<small class="label label-success">'.$categories['CategoryName'].'</small>',
    		"subcategories"=>'<small class="label label-primary">'.$subcategories['subcate'].'</small>',
            "time"=>'<small class="label label-warning">'.date('d/m/Y h:m', $row['time']).'</small>',
            "giatien"=>'<small class="label label-warning">'.$giatien.' đ</small>',
            "trangthai"=>'<small>'.$active.'</small>',
    		"xoa"=>$xoa
    	);
}
## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);
echo json_encode($response);
