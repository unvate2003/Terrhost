<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){  

require_once 'header.php';



if(isset($_POST['them-loai-danh-muc'])){
   $title = xss(addslashes($_POST['categories']));
   $link = chuyenChuoi($title);
   $status=1;
   $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `tscategory` WHERE `CategoryName` = '$title'"));
  if($check){
echo '<script> swal("Danh Mục này đã tồn tại","error"); </script>';
  }else{
echo '<script> swal("Thêm Danh Mục Thành Công","success"); setTimeout(function(){ location.href = "" },1300);</script>';
     mysqli_query($conn,"INSERT INTO `tscategory`(`CategoryName`, `Description`, `Is_Active`) VALUES ('$title','$title','$status')");
  }
}


if(isset($_POST['update-cate'])){
   $subcateid = xss(addslashes($_POST['subcateid']));
   $categoryid = xss(addslashes($_POST['subcateedit']));
   //$categoryid = xss(addslashes($_POST['suncaterdit2']));
   $subcatname = xss(addslashes($_POST['subcategoryedit']));
   $mota = xss(addslashes($_POST['noteedit']));
   $rate = xss(addslashes($_POST['rateedit']));
   $status=1;
   $update = date('Y-d-m H:i:s', time());
   $checc3 = mysqli_query($conn,"SELECT * FROM `tscategory` WHERE `CategoryName` = '$categoryid'");
   $check3 = mysqli_fetch_assoc($checc3);
   $getid = $check3['id'];
   $check2 = mysqli_query($conn,"UPDATE `subcategories` SET `cateid` = '$getid' ,`subcate` = '$subcatname', `mota` = '$mota', `update` = '$update', `active` = '$status', `rate` = '$rate'  WHERE `subcateid` = '$subcateid'");
  if($check2){
  	$status = true;
  	$msg = "Chỉnh Sửa Danh Mục Thành Công ";
  }else{
  	$status = false;
  	$msg = "Có lỗi xảy ra. Vui lòng thử lại sau ";
  }
}


?>  <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
    
        <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm Danh Mục</h3>
              </div>
                <div class="card-body">
                <form action="" method="POST">
                  
                    <div class="form-group">
                        <label for="">Danh Mục Chính:</label>
                        <input type="text"  id="categories" name="categories" class="form-control" placeholder="Tên danh mục chính" required>
                    </div>
                    <button type="submit" id="them-loai-danh-muc" class="btn btn-primary btn-block p-x-md" name="them-loai-danh-muc">Thêm </button>
                </form>
                </div>
              </div>

               
        <div class="card card-primary">
    <div class="card-header"><h3>Quản Lý Danh Mục</h3>
    </div>
    <hr>
    <div class="box-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Danh Mục</th>
                        <th>Thời gian tạo</th>
                        <th>Cập nhập lần cuối</th>
                        <th>Thứ tự</th>
                        <th>Kích hoạt</th>
                        <th>Chỉnh sửa</th>
                        <th>Xóa</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php $query=mysqli_query($conn, "SELECT * FROM `tscategory` ORDER BY id DESC");
                    $stt=0;
                    
                    while($row=mysqli_fetch_array($query)){
                        $sttpost = @$row['Is_Active'];
                        if ($sttpost == '1'){
                            $trangthai = '<label class="btn btn-info" id="'.$row["id"].'" alt="'.$row['CategoryName'].'">Công Khai</label>';
                        } else {
                            $trangthai = '<label class="btn btn-danger" id="'.$row["id"].'" alt="'.$row['CategoryName'].'">Chờ</label>';
                        }
                    ?>
                    <tr id="<?=$row['id']; ?>">
                        <td>
                            <?=$row['id']; ?>
                        </td>
                        <td>
                            <?=$row['priority']; ?>
                        </td>
                        <td>
                            <span id="subcategory<?php echo htmlentities($row['id']); ?>"><?=$row['CategoryName']; ?></span>
                        </td>
                        <td>
                            <?=$row['PostingDate']; ?>
                        </td>
                        <td>
                           <?=$row['UpdationDate']?>
                        </td>
                        <td>
                            <?= $trangthai ?>
                        </td>
                        <td><button type="button" class="btn btn-success edit" value="<?= $row['subcatid'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>
                        <td> 
                            <a type="button" class="btn btn-danger p-x-md" href="?xoa=<?= $row['key_id']; ?>">Xóa</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
            </div>
        </div>
        <!-- /.row -->
     
 <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Chỉnh sửa danh mục</h4></center>
                </div>
                <form action="" method="POST">
                <div class="modal-body">
				<div class="container-fluid">
					
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">ID Danh Mục:</span>
						<input type="text" style="width:350px;" class="form-control" id="subcateid" name="subcateid" >
					</div>
					 <div class="form-group">
                  <label for="exampleInputEmail1">Chọn Danh Mục Chính</label>
                  <select type="text" class="form-control" id="subcateedit" name="subcateedit" onChange="getSubCat(this.value);" required>
                    <option id="subcateedit2" name="subcateedit2" type="text"></option>
                    <?php
                    $ret=mysqli_query($conn,"select id,CategoryName from tscategory where Is_Active=1");
                    while($result=mysqli_fetch_array($ret))
                    {    
                    ?>
                    <option value="<?php echo htmlentities($result['CategoryName']);?>"><?php echo htmlentities($result['CategoryName']);?></option>
                    <?php } ?>

                    </select> 
                </div>
                    <div class="form-group input-group">
                  <span class="input-group-addon" style="width:150px;">Danh mục phụ:</span>
                  <input type="text" style="width:350px;" class="form-control" id="subcategoryedit" name="subcategoryedit" required>
                  </div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Mô tả:</span>
						<input type="text" style="width:350px;" class="form-control" id="noteedit" name="noteedit" required>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Giá tiền:</span>
						<input type="text" style="width:350px;" class="form-control" id="rateedit" name="rateedit" required>
					</div>	

				</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" id="update-cate" name="update-cate" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> </i> Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>

      </div>
    </section>

  </div>

 <?php //require 'footer.php'; ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  
  
<script>
	$(document).ready(function(){
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		var subcate=$('#subcate'+id).text();
		var subcategory=$('#subcategory'+id).text();
		var note=$('#note'+id).text();
		var rate=$('#rate'+id).text();
       var res = rate.replace(/ đ/g, "");
       var res = res.replace(/,/g, "");
		console.log(rate);
		$('#edit').modal('show');
		$('#subcateid').val(id);
		$('#subcateedit2').val(subcate);
		$('#subcategoryedit').val(subcategory);
		$('#noteedit').val(note);
		$('#rateedit').val(res);
		var x = document.getElementById("subcateedit2").value;
  		document.getElementById("subcateedit2").innerHTML = x;
       
  		//var y = document.getElementById('rate').getAttribute('value')
	});
});
</script>
<!--  
<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
-->
</div>
</body></html>
<?php
require_once 'script.php';
}
else{
    require_once '../pages/404.php';
    
}
}

?>







