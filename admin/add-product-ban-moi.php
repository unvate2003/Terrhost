<?php
/*
* @author: Nguyễn Hợp
* @contact: vuilashare@gmail.com
* @copyright: copyright © 2022
**/
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){
require_once 'header.php';
if(@$_GET && @$_GET['xoa']){
    $keyid = @$_GET['xoa'];
    $checkxoa = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `key_id` = '$keyid'"));
    if($checkxoa){
        $status = true;
        $msg = "Xóa sản phẩm thành công";
        mysqli_query($conn,"DELETE FROM `san-pham-chua-ban` WHERE `key_id` = '$keyid'");
    }
}
if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/add-product';
            }, 300);
        <?php }else{ ?>
            swal('<?= $msg ?>',"error");
        <?php } ?>
</script>
<?php
}
?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
      

        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm Sản Phẩm:</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
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
            <textarea class="form-control" id="list" rows="5"></textarea>
          </div>
          <div class="form-group text-center">
            <button type="button" class="btn btn-primary" id="them-san-pham">Thêm ngay</button>
            <button type="submit" class="btn btn-primary" id="loading" style="padding: 7px; display: none;" disabled><i class="fa fa-spinner fa-spin"></i>Vui lòng đợi trong giây lát</button>
            <button type="button" class="btn btn-danger" id="xoa-san-pham">Xóa ngay</button>
          </div>
          <hr>
          <div class="form-group text-center">
            <button type="button" class="btn btn-info">Tổng: <span class="label rounded" id="total"></span></button>
            <button type="button" class="btn btn-success">Thêm : <span class="label rounded" id="add"></span></button>
            <button type="button" class="btn btn-danger">Cập nhập: <span class="label rounded" id="success"></span></button>
             <button type="button" class="btn btn-warning">Lỗi: <span class="label rounded" id="error"></span></button>
          </div>
                </div>
                <!-- /.card-body -->

                
              </form>
            </div>


<div class="card card-primary">
    <div class="card-header"><h3>Quản Lý Sản Phẩm</h3>
    </div>
    <hr>
    <div class="box-body">
        <div class="table-responsive"> 
				          <table id="example12" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example12_info">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th>Nội dung </th>
                        <th>Chuyên mục chính</th>
                        <th>Chuyên mục phụ</th>
                        <th>Ngày tạo</th> 
                        <th>Giá tiền</th>
                        <th>Trạng Thái</th>
                        <th>Xoá </th>
                      </tr>
                    </thead>
                    
                  </table>
				  </div>
    </div>
</div>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!--
  <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
-->
<script >
    $(document).ready(function(){
        var tintuc = $('#example12').dataTable({
            "columns": [
                {"data": "id"},
                {"data": "sanpham"},
                {"data": "categories"},
                {"data": "subcategories"},
                {"data": "time"},
                {"data": "giatien"},
                {"data": "trangthai"},
                {"data": 'xoa' }
            ],
            "processing": true,
            "serverSide": true,
                "orderCellsTop": true,
                "fixedHeader": true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                'order': [[ 0, "desc" ]],
            "ajax": {
                url: '../Query/Get-Product.html',
                type: 'POST'
            }
        });
//setInterval( function () {
//tintuc.ajax.reload(null, false);},
//5000 );
    });

</script>
  <script type="text/javascript">    
        $('#them-san-pham').click(function(){
            $("#total").html("");
            $("#success").html("");
            $('#add').html("");
            $('#error').html("");
            var category = $('#category').val();
            var subcategory = $('#subcategory').val();
            var list = $('#list').val();
            
           $('#them-san-pham').hide();
           $('#xoa-san-pham').hide();
           $("#loading").show();
                if (!list) {
                    swal("Vui Lòng Nhập Sản Phẩm","error");
                    return false;
                }
                //$('#them-san-pham').prop('disabled', true)
                $.post('Query/Add-Product.html', {
                    category: category,
                    subcategory: subcategory,
                    list: list,
                }, function(data) {
                  console.log(data);
                  console.log(data.check2);
                  console.log(data.check);
                  if(data.code ==  1){
                   $("#total").append(data.total);
                   $('#add').append(data.value);
                   //$('#error').append(data.check2);
                   $('#success').append(data.update);
                   $("#loading").hide();
                   $('#them-san-pham').show();
                   $('#xoa-san-pham').show();
                   $("#example12").DataTable().ajax.reload(null, false );
                toastr.success('Thêm thành công '+data.value+' sản phẩm - Cập nhập thành công '+data.update+' sản phẩm ', 'Thông báo');
               }
                  if(data.check > 0){
                   //$("#total").append(data.total);
                   //$('#add').append(data.value);
                   $('#error').append(data.check);
                   //$('#success').append(data.update);
                   $("#loading").hide();
                   $('#them-san-pham').show();
                   $('#xoa-san-pham').show();
                toastr.error('Thất bại '+data.check+' sản phẩm đã tồn tại ', 'Thông báo');
                  }
                  else if(data.check2 >  0){
                   //$("#total").append(data.total);
                   //$('#add').append(data.value);
                   //$('#error').append(data.check2);
                   //$('#success').append(data.update);
                   $("#loading").hide();
                   $('#them-san-pham').show();
                   $('#xoa-san-pham').show();
                toastr.error('Thất bại '+data.check2+' đã tồn tại ', 'Thông báo');
                  }
                  else{
                   $("#loading").hide();
                   $('#them-san-pham').show();
                   $('#xoa-san-pham').show();
                //toastr.error('Thất bại' , 'Thông báo');
                  }
                },"json");
            });
          $('#xoa-san-pham').click(function(){
            $("#total").html("");
            $("#success").html("");
            $('#add').html("");
            $('#error').html("");
            $('#them-san-pham').hide();
            $('#xoa-san-pham').hide();
            $("#loading").show();
            var category = $('#category').val();
            var subcategory = $('#subcategory').val();
            var list = $('#list').val();
                if (!list) {
                    swal("Vui Lòng Nhập Sản Phẩm","error");
                    return false;
                }
                //$('#them-san-pham').prop('disabled', true)
                $.post('Query/Delete-Product.html', {
                    category: category,
                    subcategory: subcategory,
                    list: list,
                }, function(data) {
                  console.log(data);
                  console.log(data['code']);
                  console.log(data['value']);
                  if(data.code ==  1){
                   $("#total").append(data.total);
                   $('#add').append(data.update);
                   $('#error').append(data.check);
                   $('#success').append(data.value);
                   $("#loading").hide();
                   $('#them-san-pham').show();
                   $('#xoa-san-pham').show();
                   $("#example12").DataTable().ajax.reload(null, false );
                toastr.success('Xóa thành công '+data.total+' sản phẩm ', 'Thông báo');
                  }
                  else{
                   $("#loading").hide();
                   $('#them-san-pham').show();
                   $('#xoa-san-pham').show();
                toastr.error('Thất bại. Nhập không thành công ', 'Thông báo');
                  }
                },"json");
            });
</script>
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







