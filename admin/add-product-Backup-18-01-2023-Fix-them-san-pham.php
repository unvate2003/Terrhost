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
if ($_POST && $_POST['type'] == 'them-san-pham' && isset($_POST['products'])) {
    $products = json_decode($_POST['products'], true);
    $category = xss(addslashes($_POST['category']));
    
    
    
    $subcategory = xss(addslashes($_POST['subcategory']));
    
    $checkey = mysqli_query($conn,"SELECT * FROM `subcategories` WHERE `subcateid` = '$subcategory'");
    $checksubkey = mysqli_fetch_assoc($checkey);
    $checkcate = $checksubkey['key_id']; 
    
    
    $duplicate = $_POST['duplicate'];
    $successCount = 0;
    $errorCount = 0;
    foreach ($products as $product) {
        $text = xss(addslashes($product));
        $text = str_replace(" ", "", $text);

        // Kiểm tra trùng lặp
        if ($duplicate == 'yes') {
            $check = mysqli_query($conn, "SELECT * FROM `san-pham-chua-ban` WHERE `text` = '$text' AND `subcate` = '$subcategory' AND `cate` = '$category'");
            if (mysqli_num_rows($check) > 0) {
                $errorCount++;
                continue; // Bỏ qua sản phẩm này nếu trùng lặp
                
            }
        }

        $key_id = md5(randma(10));
        $active = '1';
        $time = time();

        $query = mysqli_query($conn, "INSERT INTO `san-pham-chua-ban`(`key_id`, `text`, `cate`, `subcate`, `time`, `subcatekey`, `active`) VALUES ('$key_id', '$text', '$category', '$subcategory', '$time', '$checkcate', '$active')");
        
        if($query) {
            $successCount++;
        } else {
            $errorCount++;
        }
    }
    
    
    // Trả về kết quả
    //echo json_encode(['success' => true]);
    echo json_encode(['successCount' => $successCount, 'errorCount' => $errorCount, 'success' => true]);
    exit;
}

if($_POST && $_POST['type'] == 'xoa-san-pham' && isset($_POST['text']) && isset($_POST['category']) && isset($_POST['subcategory'])){
    $text = xss(addslashes($_POST['text']));
    $text = str_replace(" ","",$text);
    $cate = xss(addslashes($_POST['category']));
    $subcate = xss(addslashes($_POST['subcategory']));
    $checkey = mysqli_query($conn,"SELECT * FROM `subcategories` WHERE `subcateid` = '$subcate'");
    $checksubkey = mysqli_fetch_assoc($checkey);
    $checkcate = $checksubkey['key_id']; 
    $key_id = md5(randma(10));
    $active = '1';
    $time = time();
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `text` = '$text' AND `subcate` = '$subcate' AND cate = '$cate' "));
    if($check){
        $arr = array('success' => true);
     mysqli_query($conn,"DELETE FROM `san-pham-chua-ban` WHERE `text` = '$text' AND `subcate` = '$subcate' AND cate = '$cate' ");
    }else{
        $arr = array('error' => false);
  
    }
    echo json_encode($arr); exit;
}


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
            }, 1300);
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
                    $ret=mysqli_query($conn,"select id,CategoryName from tscategory where Is_Active=1 ORDER BY id DESC");
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
            
            
            <!--<table>
                <tr>
                    <td><label for="">Lọc trùng:</label></td>
                    <td>
                        <input type="radio" name="duplicate" id="duplicatee" value="1"> Bật<br/>
                        <input type="radio" name="duplicate" id="duplicatee" value="0"> Tắt
                    </td>
                
                </tr>
                
            </table>-->
            <label for="">Lọc trùng:</label>
            <select class="form-control" id="duplicate" name="duplicate">
                <option value="yes">Bật</option>
                <option value="no">Tắt</option>
            </select> 
            
            
          </div>
          <div class="form-group text-center">
            <button type="button" class="btn btn-primary" id="them-san-pham">Thêm ngay</button>
            <button type="button" class="btn btn-danger" id="xoa-san-pham">Xóa ngay</button>
          </div>
          <hr>
          <div class="form-group text-center">
            <button type="button" class="btn btn-info">Tổng: <span class="label rounded" id="total">0</span></button>
            <button type="button" class="btn btn-warning">Tiến trình: <span class="label rounded" id="loading">0</span>%</button>
            <button type="button" class="btn btn-success">Thành công: <span class="label rounded" id="success">0</span></button>
            <button type="button" class="btn btn-danger">Thất bại: <span class="label rounded" id="error">0</span></button>
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
				          <table id="example12" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
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

<script>
var split;
var category;
var subcategory;
var key_id;
var total = 0;
var success = 0;
var error = 0;
var loading = 0;
$(()=>{
    $('#xoa-san-pham').click(()=>{
            var list = $('#list').val(); 
            category = $('#category').val();
            subcategory = $('#subcategory').val();

            if(!list){
                swal("Danh Sách Sản Phẩm Trống","error");
                return;
            }
            if(!category){
                swal("Danh Mục Chính Trống","error");
                return;
            }
            if(!subcategory){
                swal("Danh Mục Phụ Trống","error");
                return;
            } else {
                split = list.trim().split("\n");
                total = split.length;
                $('#total').html(total);
                success = 0;
                error = 0;
                $('#xoa-san-pham').prop('disabled',true);
                xoasp(0);
            }
    });
});
function xoasp(i){
       if(i >= total){
            $('#xoa-san-pham').prop('disabled', false);
            return;
        }
        var text = split[i];
        $.post('#',{type:'xoa-san-pham',text,category,subcategory},'json')
        .done((res)=>{
            if(JSON.parse(res).success){
                ++success;
                toastr.remove();
                $('#success').html(success);
                toastr.success('Xóa thành công '+success+' sản phẩm', 'Thông báo');
            }else{
                ++error;
                toastr.remove();
                $('#error').html(error);
                toastr.error('Xóa thất bại '+error+' sản phẩm', 'Thông báo');
            }
        var loading = ((success + error) / total * 100).toFixed(1);
        $('#loading').html(loading);
            xoasp(i+1);
        })
        .fail((err)=>{
            console.log(err);     
        });
}

</script>
 
<script>
$(function() {
    $('#them-san-pham').click(function() {
        var list = $('#list').val().trim();
        var category = $('#category').val();
        var subcategory = $('#subcategory').val();
        var duplicate = $('#duplicate').val();
        
        var success = 0;
        

        if (!list || !category || !subcategory) {
            swal("Vui Lòng Nhập Đầy Đủ Thông Tin", "error");
            return;
        }

            var products = list.split("\n");
            $('#total').html(products.length);
            $.post('#', { type: 'them-san-pham', products: JSON.stringify(products), category, subcategory, duplicate }, 'json')
            
            .done(function(res) {
                /*try {
                    var result = JSON.parse(res);
                    // Tiếp tục xử lý nếu không có lỗi
                } catch (e) {
                    console.error("Phản hồi không phải là JSON:", res);
                    // Xử lý lỗi hoặc hiển thị thông báo lỗi
                }*/
                if(JSON.parse(res).success == true){
                    var result = JSON.parse(res);
                    
                    var success = result.successCount;
                    var error = result.errorCount;
                    $('#success').html(success);
                    $('#error').html(error);
                    
                    toastr.success('Nhập thành công '+success+' sản phẩm', 'Thông báo');
                    console.log(result);
                }
            
            })
            .fail(function(err) {
                console.log(err);     
            });
    });
});
</script>

 
<!--<script>
var split;
var category;
var subcategory;
var duplicate;
var key_id;
var total = 0;
var success = 0;
var error = 0;
var loading = 0;
$(()=>{
    $('#them-san-pham').click(()=>{
            var list = $('#list').val(); 
            category = $('#category').val();
            subcategory = $('#subcategory').val();
            duplicate = $('#duplicate').val();

            if(!list){
                swal("Vui Lòng Nhập Danh Sách Sản Phẩm","error");
                return;
            }
            if(!category){
                swal("Vui Lòng Chọn Danh Mục Chính","error");
                return;
            }
            if(!subcategory){
                swal("Vui Lòng Chọn Danh Mục Phụ","error");
                return;
            }
            /*if(!duplicate){
                swal("Vui Lòng Chọn Chế Độ Lọc Trùng","error");
                return;    
            }*/ else {
                split = list.trim().split("\n");
                total = split.length;
                $('#total').html(total);
                success = 0;
                error = 0;
                $('#them-san-pham').prop('disabled',true);
                add(0);
            }
    });
});
function add(i){
       if(i >= total){
            $('#them-san-pham').prop('disabled', false);
            return;
        }
        var text = split[i];
        $.post('#',{type:'them-san-pham',text,category,subcategory,duplicate},'json')
        .done((res)=>{
            if(JSON.parse(res).success){
                ++success;
                toastr.remove();
                $('#success').html(success);
                toastr.success('Nhập thành công '+success+' sản phẩm', 'Thông báo');
            }else{
                ++error;
                toastr.remove();
                $('#error').html(error);
                toastr.error('Nhập thất bại '+error+' sản phẩm', 'Thông báo');
            }
        var loading = ((success + error) / total * 100).toFixed(1);
        $('#loading').html(loading);
            add(i+1);
        })
        .fail((err)=>{
            console.log(err);     
        });
}
</script>
-->

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







