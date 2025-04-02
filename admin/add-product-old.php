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
if($_POST && $_POST['type'] == 'them-san-pham' && isset($_POST['text']) && isset($_POST['category']) && isset($_POST['subcategory'])){
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
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `text` = '$text' AND `subcate` = '$subcate' AND cate = '$cate'"));
    if($check){
        $arr = array('error' => false);
    }else{
        $arr = array('success' => true);
         mysqli_query($conn,"INSERT INTO `san-pham-chua-ban`(`key_id`, `text`, `cate`, `subcate`, `time`, `subcatekey`, `active`) VALUES ('$key_id', '$text', '$cate', '$subcate', '$time', '$checkcate', '$active')");
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
        mysqli_query($conn,"DELETE FROM `san-pham-chua-ban` WHERE `key_id` = 'key$id'");
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
    <section class="content">
      <div class="container-fluid">
      

        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm Sản Phẩm</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                <div class="form-group">
                  <label>Chọn Danh Mục Chính</label>
                  <select class="form-control" id="category" name="category" onChange="getSubCat(this.value);">
                    <option value="">Chọn Danh Mục Chính </option>
                    <?php
                    // Feching active categories
                    $ret=mysqli_query($conn,"select id,CategoryName from tscategory where Is_Active=1");
                    while($result=mysqli_fetch_array($ret))
                    {    
                    ?>
                    <option value="<?php echo htmlentities($result['id']);?>"><?php echo htmlentities($result['CategoryName']);?></option>
                    <?php } ?>

                    </select> 
                </div>
                <div class="form-group">
                  <label>Chọn Danh Mục Phụ</label>
                  <select class="form-control" id="subcategory" name="subcategory">                        
                  </select> 
                  </div>
                  <div class="form-group">
            <label for="">Dữ liệu sản phẩm</label>
            <textarea class="form-control" id="list" rows="5"></textarea>
          </div>
          <div class="form-group text-center">
            <button type="button" class="btn btn-primary" id="them-san-pham">Thêm ngay</button>
            <button type="button" class="btn btn-danger" id="xoa-san-pham">Xóa ngay</button>
          </div>
          <hr>
          <div class="form-group text-center">
            <button type="button" class="btn btn-info">Tổng: <span class="label rounded" id="total">0</span></button>
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
                            <?= number_format($check2['rate']); ?> VNĐ</td>
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
        <!-- /.row -->
     

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script>
$('#xoa-san-pham').click(()=>{
});
</script>
  <script>
var split;
var category;
var subcategory;
var key_id;
var total = 0;
var success;
var error;
$(()=>{
    $('#them-san-pham').click(()=>{
            var list = $('#list').val(); 
            category = $('#category').val();
            subcategory = $('#subcategory').val();

            if(!list){
                swal("Vui Lòng Nhập Danh Sách Sản Phẩm","error");
                return;
            }if(!category){
                swal("Vui Lòng Chọn Danh Mục Chính","error");
                return;
            }if(!subcategory){
                swal("Vui Lòng Chọn Danh Mục Phụ","error");
                return;
            }else{
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
            $('#them-san-pham').prop('disabled',false);
            return;
        }
        var text = split[i];
        $.post('#',{type:'them-san-pham',text,subcategory,category},'json')
        .done((res)=>{
            if(JSON.parse(res).success){
                ++success;
                $('#success').html(success);
                toastr.success('Nhập thành công '+success+' sản phẩm', 'Thông báo');
            }else{
                ++error;
                $('#error').html(error);
                toastr.error('Thất bại ', 'Thông báo');
            }
            add(i+1);
        })
        .fail((err)=>{
            console.log(err);     
        });
}
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







