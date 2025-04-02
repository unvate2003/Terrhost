<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){  
require_once 'header.php';
if(@$_GET && @$_GET['xoa']){
    $id = @$_GET['xoa'];
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `subcategories` WHERE `key_id` = '$id'"));
    if($check){
        $status = true;
        $msg = "Xóa danh mục thành công";
        mysqli_query($conn,"DELETE FROM `subcategories` WHERE `key_id` = '$id'");
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


if(isset($_POST['them-danh-muc-con'])){
   $categoryid = xss(addslashes($_POST['categories']));
   $subcatname = xss(addslashes($_POST['subcategory']));
   $mota = xss(addslashes($_POST['note']));
   $rate = xss(addslashes($_POST['rate']));
   $key_id = md5(randma(10));
   $status=1;
   $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `subcategories` WHERE `subcate` = '$categoryid'"));
  if($check){
  	$status = false;
  	$msg = "Danh Mục này đã tồn tại";
    //echo '<script> swal("Có lỗi xảy ra. Vui lòng thử lại sau","error"); </script>';
  }else{
  	$status = true;
  	$msg = "Thêm Danh Mục Thành Công ";
    //echo '<script> swal("Edit Danh Mục Thành Công","success"); setTimeout(function(){ location.href = "" },1300);</script>';
     mysqli_query($conn,"INSERT INTO subcategories(cateid,subcate,mota,active,rate,key_id) VALUES ('$categoryid','$subcatname','$mota','$status','$rate','$key_id')");
  }
} 
if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/add-sub-cate';
            }, 1300);
        <?php }else{ ?>
            swal('<?= $msg ?>',"error");
        <?php } ?>
</script>
<?php
}
?>


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
                <h3 class="card-title">Thêm Danh Mục Phụ</h3>
              </div>
                <div class="card-body">
                <form action="" method="POST">
                  
                    <div class="form-group">
                        <label for="">Danh Mục Chính:</label>
                       <select class="form-control" name="categories" id="categories" required>
                          <option value="">Chọn Danh Mục Chính</option>
                            <?php
                            $ret=mysqli_query($conn,"SELECT id,CategoryName FROM  tscategory WHERE Is_Active=1 ORDER BY CategoryName ASC");
                            while($result=mysqli_fetch_array($ret))
                            {    
                            ?>
                            <option value="<?php echo htmlentities($result['id']);?>"><?php echo htmlentities($result['CategoryName']);?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Danh Mục Phụ:</label>
                        <input type="text"  id="subcategory" name="subcategory" class="form-control" placeholder="Tên Danh Mục Phụ" required>
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả:</label>
                        <input type="text"  id="note" name="note" class="form-control" placeholder="Mô tả" required>
                    </div>
                    <div class="form-group">
                        <label for="">Giá tiền:</label>
                        <input type="text"  id="rate" name="rate" class="form-control" placeholder="Giá tiền" required>
                    </div>
                    <button type="submit" id="them-danh-muc-con" class="btn btn-primary btn-block p-x-md" name="them-danh-muc-con">Thêm </button>
                </form>
                </div>
              </div>
               <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm Danh Mục</h3>
              </div><br>
               <div class="table-responsive">
       <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
        <thead>
            <tr>
            <th>#ID</th>
            <th>Danh Mục</th>
            <th>Danh mục phụ</th>
            <th>Giá tiền</th>
            <th>Mô tả</th>
            <th>Ngày tạo</th>
            <th>Cập nhật lần cuối</th>
            <th>Trạng thái</th>
            <th>Chỉnh sửa</th>
            <th>Xóa</th>
           </tr>
        </thead>
            <tbody>
                     <?php 
                        $query=mysqli_query($conn,"SELECT tscategory.CategoryName AS catname,tscategory.id AS getcateid,subcategories.subcate AS subcatname,subcategories.rate AS rate,subcategories.key_id AS key_id,subcategories.mota AS mota,subcategories.postdate AS postdate,subcategories.update AS cateupdate,subcategories.subcateid AS subcatid,subcategories.active AS trangthai
                        	FROM subcategories JOIN tscategory ON subcategories.cateid=tscategory.id ORDER BY subcategories.subcateid DESC");
                        $cnt=0;
                        /*
                        $rowcount=mysqli_num_rows($query);
                        if($rowcount==0)
                        {
                        ?>
                        <tr>

                        <td colspan="7" align="center"><h3 style="color:red">No record found</h3></td>
                        </tr>
                        <?php 
                        } else {
                        */
                        while($row=mysqli_fetch_array($query))
                        {
                        	$sttpost = @$row['trangthai'];
                        	if ($sttpost == '1'){
				            $trangthai = '<a class="catestthide btn btn-info" id="'.$row["subcatid"].'" alt="'.$row['catname'].'">Công Khai</a>';
				          }
				          else
				          {
				           $trangthai = '<a class="catesttpost btn btn-danger" id="'.$row["subcatid"].'" alt="'.$row['catname'].'">Chờ Duyệt</a>';
          					}
                        ?>
                          <tr id="<?= $row['subcatid']?>">
                        <th scope="row"><?php echo htmlentities(++$cnt);?></th>
                        <td><span id="subcate<?php echo htmlentities($row['subcatid']); ?>" title="<?php echo htmlentities($row['catname']);?>"><?php echo htmlentities($row['catname']);?></span></td>
                        <td><span id="subcategory<?php echo htmlentities($row['subcatid']); ?>"><?php echo htmlentities($row['subcatname']);?></span></td>
                        <td><span id="rate<?php echo htmlentities($row['subcatid']); ?>" value="<?php echo htmlentities($row['rate']); ?>"><?php echo htmlentities(number_format($row['rate']));?> đ</span></td>
                        <td><span id="note<?php echo htmlentities($row['subcatid']); ?>"><?php echo htmlentities($row['mota']);?></span></td>
                        <td><?php echo htmlentities($row['postdate']);?></td>
                        <td><?php echo htmlentities($row['cateupdate']);?></td>
                        <td style="width :120px;"><?= $trangthai ?></td>
                        <td><button type="button" class="btn btn-success edit" value="<?= $row['subcatid'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>
                        <td><a type="button" class="btn btn-danger" href="?xoa=<?= $row['key_id']; ?>">Xóa</a> </td>
                        </tr>
                      <?php
                      }
                    //}
                      ?>
             </tbody>
      </table>
      </div> 
    </div>
            </div>
        </div>


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
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<!--
<link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
-->
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
<script type="text/javascript">
$(document).ready(function()
  {
$("#example1").on('click', '.catesttpost', function(){
        var id = $(this).attr('id');
        var title = $(this).attr('alt');
        var data = 'id=' + id ;
        var parent = $(this).parent().parent();
  swal({
    title: 'Cập nhập bài viết \n " ' + title +' " ',
    text: 'Bạn có muốn cập nhập bài viết thành công khai?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Vâng, Tôi muốn !',
    cancelButtonText: "Không, Hủy bỏ !",
    closeOnConfirm: false,
    closeOnCancel: false
  },
   function(isConfirm){    
    if (isConfirm){
      swal("Thành Công!", "Bài viết đã được cập nhập công khai", "success");
        $.ajax(
        {
            type: "POST",
             url:'<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/Cate-Show.html',
             data: data,
             cache: false,
             success: function()
             {
              parent.fadeIn('slow', function() {location.reload(true);});
             }
         });
    } 
    else {
      swal("Hủy Bỏ", "Quá trình đã bị dừng lại :)", "error"); 
    }
  });     
      });
    });

	$(document).ready(function()
  {
$("#example1").on('click', '.catestthide', function(){
        var id = $(this).attr('id');
        var title = $(this).attr('alt');
        var data = 'id=' + id ;
        var parent = $(this).parent().parent();
  swal({
    title: 'Cập nhập bài viết \n " ' + title +' " ',
    text: 'Bạn có muốn Ẩn bài viết này?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Vâng, Tôi muốn !',
    cancelButtonText: "Không, Hủy bỏ !",
    closeOnConfirm: false,
    closeOnCancel: false
  },
   function(isConfirm){    
    if (isConfirm){
      swal("Thành Công!", "Bài viết đã được Ẩn thành công", "success");
        $.ajax(
        {
            type: "POST",
             url:'<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/Cate-Hide.html',
             data: data,
             cache: false,
          
             success: function()
             {
              parent.fadeIn('slow', function() {location.reload(true);});
             }
         });
    } 
    else {
      swal("Hủy Bỏ", "Quá trình đã bị dừng lại :)", "error"); 
    }
  });     
      });
    });

</script>

</body></html>
<?php
require_once 'script.php';
}
else{
    require_once '../pages/404.php';
    
}
}

?>
