<?php require_once base64_decode('Li4vY29yZS9kYXRhYmFzZS5waHA=');require_once base64_decode('aGVhZGVyLnBocA==');if(empty($_SESSION[base64_decode('dXNlcm5hbWU=')])){header(base64_decode('TG9jYXRpb246IC8='));exit;}else{if($c0[base64_decode('YWRtaW4=')]==1){if(isset($_POST[base64_decode('dGhlbS1zYW4tcGhhbQ==')])&&isset($_POST[base64_decode('bGlzdA==')])){$s1=0;$e2=0;$c3=xss(check_string($_POST[base64_decode('bGlzdA==')]));$c3=explode(PHP_EOL,$c3);$s4=xss(check_string($_POST[base64_decode('Y2F0ZWdvcnk=')]));$o5=xss(check_string($_POST[base64_decode('c3ViY2F0ZWdvcnk=')]));$f6=mysqli_query($l7,"SELECT * FROM `subcategories` WHERE `subcateid` = '$o5'");$y8=mysqli_fetch_assoc($f6);$n9=$y8[base64_decode('a2V5X2lk')];$e10=base64_decode('MQ==');$l11=time();foreach($c3 as $b12){$h13=md5(randma(10));$q14=mysqli_query($l7,"SELECT * FROM `san-pham-chua-ban` WHERE `text` = '$b12' ");$q14=mysqli_num_rows($q14);if($q14==0){$c15=mysqli_query($l7,"INSERT INTO `san-pham-chua-ban`(`key_id`, `text`, `cate`, `subcate`, `time`, `subcatekey`, `active`) VALUES ('$h13', '$b12', '$s4', '$o5', '$l11', '$n9', '$e10')");if($c15){$s1++;}}else{$o16=mysqli_query($l7," SELECT * FROM `san-pham-chua-ban` WHERE `text` = '$b12' ");$o16=mysqli_fetch_assoc($o16);$w17=mysqli_query($l7,"UPDATE `san-pham-chua-ban` SET `cate` = '$s4', `text` = '$b12', `subcate` = '$o5', `time` = '$l11', `subcatekey` = '$n9', `active` = '$e10' WHERE `text` = '$b12' ");if($w17){$e2++;}}}echo base64_decode('PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPlN3YWwuZmlyZSgiVGjDoG5oIEPDtG5nIiwgIlRow6ptIA==').$s1.base64_decode('IHwgQ+G6rXAgbmjhuq10IA==').$e2.base64_decode('IHRow6BuaCBjw7RuZyIgLCJzdWNjZXNzIik7PC9zY3JpcHQ+');}?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm tài khoản</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM SẢN PHẨM</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                         <form action="" method="post">

                            <div class="form-group">
		                  <label>Danh Mục Chính:</label>
		                  <select class="form-control" id="category" name="category" onChange="getSubCat(this.value);">
		                    <option value="">Chọn Danh Mục Chính</option>
		                    <?php
		                    // Feching active categories
		                    $ret=mysqli_query($conn,"select id,CategoryName from tscategory where Is_Active=1 ORDER BY CategoryName ASC");
		                    while($result=mysqli_fetch_array($ret))
		                    {    
		                    ?>
		                    <option value="<?php echo htmlentities($result['id']);?>"><?php echo htmlentities($result['CategoryName']);?></option>
		                    <?php } ?>

		                    </select> 
		                </div>
		                <div class="form-group">
		                  <label>Danh Mục Phụ:</label>
		                  <select class="form-control" id="subcategory" name="subcategory">                        
		                  </select> 
		                  </div>
		                <div class="form-group">
				            <label for="">Dữ Liệu Sản Phẩm:</label>
				            <textarea class="form-control" id="list" name="list" rows="5" placeholder="1 dòng 1 tài khoản" required></textarea>
				        </div>  
                        
                            <button type="submit" id="them-san-pham" name="them-san-pham" class="btn btn-primary btn-block" >Thêm <em class="fa fa-paper-plane"></em></button>
                        </form>
                    </div>
                </div>
                <div class="card card-primary">
    <div class="card-header"><h3>Quản Lý Sản Phẩm</h3>
    </div>
    <hr>
    <div class="box-body">
        <div class="table-responsive">
            <!--table id="example2" ui-jp="dataTable" class="table table-striped b-t b-b"-->
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nội dung</th>
                        <th>Danh mục chính</th>
                        <th>Danh mục phụ</th>
                        <th >Ngày tạo</th>
                        <th>Giá tiền</th>
                        <th>Xóa</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $query=mysqli_query($conn, "SELECT * FROM `san-pham-chua-ban` ORDER BY id DESC"); $stt=0 ;
                    while($row=mysqli_fetch_array($query)){
                      $categoryid=$row[ 'cate'];
                      $subcatekey=$row[ 'subcatekey'];
                      $key_id=$row[ 'key_id'];
                      $checc3=mysqli_query($conn, "SELECT * FROM `tscategory` WHERE `id` = '$categoryid'");
                      $check3=mysqli_fetch_assoc($checc3);
                      $checc2=mysqli_query($conn, "SELECT * FROM `subcategories` WHERE `key_id` = '$subcatekey'"); 
                      $check2=mysqli_fetch_assoc($checc2);
                      $sttpost = @$row['active'];
                          if ($sttpost == '1'){
                            $trangthai = '<a class="catestthide btn btn-info" id="'.$row["key_id"].'" alt="'.$check2['subcate'].'">Công Khai</a>';
                            }
                            else
                            {
                             $trangthai = '<a class="catesttpost btn btn-danger" id="'.$row["key_id"].'" alt="'.$check2['subcate'].'">Chờ Duyệt</a>';
                              }
                      ?>
                    <tr>
                        <td>
                            <?=$row['id']; ?>
                        </td>
                        <td>
                            <?=$row['text']; ?>
                        </td>
                        <td>
                            <?=$check3['CategoryName']; ?>
                        </td>
                        <td>
                            <?=$check2['subcate']; ?>
                        </td>
                        <td>
                            <?= date('d-m-Y H:i:s',$row[ 'time']) ?>
                        </td>
                        <td>
                            <?= number_format($check2['rate']); ?> đ</td>
                        <td>
                            <a type="button" class="btn btn-danger p-x-md" href="?xoa=<?= $row['key_id']; ?>">Xóa</a>
                        </td>
                        <td><?= $trangthai ?></td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

            </div>
        </div>
    </section>
</div>



 <script>
function getSubCat(val) {
  $.ajax({
  type: "POST",
  url:'<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/CheckSub.html',
  data:'catid='+val,
  success: function(data){
    $("#subcategory").html(data);
  }
  });
  }
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
    title: 'Cập nhập bài viết \n " ' + title +' "  ',
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
             url:'<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/Product-Show.html',
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
    title: 'Cập nhập bài viết \n " ' + title +' "  ',
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
             url:'<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/Product-Hide.html',
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
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="#"><?= $setup['name-footer']; ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div>
  </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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