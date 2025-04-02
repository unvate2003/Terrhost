<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    @header('Location: /');exit;
}else{

if($data['admin'] == 1){
require_once 'header.php';
if(isset($_POST['infoupdate'])) {
$partner = $_POST['partner'];
$partnerkey = $_POST['partnerkey'];
$cktsr = $_POST['cktsr'];
$cookie = $_POST['cookie'];
$info = mysqli_query($conn, "UPDATE setting SET 
        `partner` = '".mysqli_real_escape_string($conn, $partner).
     "',`partnerkey` = '".mysqli_real_escape_string($conn, $partnerkey).
     "',`cktsr` = '".mysqli_real_escape_string($conn, $cktsr).
     "',`cookie` = '".mysqli_real_escape_string($conn, $cookie).
     "'  WHERE `id`='1'");
if($info) {
$status = true;
$msg = "Cập nhập thông tin thành công";
}
else
{
$status = false;
$msg = "Đã có lỗi xảy ra. Vui lòng thử lại sau";
}
}


if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/setup-napthe';
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      

        <!-- Small boxes (Stat box) -->
        <div class="row">
        
          
  
            
                      <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Cấu hình thẻ siêu rẽ</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
                <div class="card-body">
                
                  
                  <div class="form-group">
                    <label>Partner ID Thesieure:</label>
                    <input type="text" class="form-control" name="partner" value="<?=$setup['partner'];?>">
                  </div>
                  <div class="form-group">
                    <label>Partner  Key Thesieure:</label>
                    <input type="text" name="partnerkey" class="form-control" value="<?=$setup['partnerkey'];?>">
                  </div>
                  <div class="form-group">
                    <label>Chiết khẩu Thẻ Siêu Rẻ:</label>
                    <input type="text" name="cktsr" class="form-control" value="<?=$setup['cktsr'];?>">
                  </div>
                  <div class="form-group">
                    <label>Cookie Thẻ Siêu Rẻ:</label>
                    <input type="text" name="cookie" class="form-control" value="<?=$setup['cookie'];?>">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="infoupdate" class="btn btn-dark">Cập Nhật</button>
                </div>
              </form>
            </div>
        </div>
        <!-- /.row -->
     

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  

<?php 
require 'footer.php';
?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/js/swap.js"></script>
</body></html>
<?php
require_once 'script.php';
}
else{
    require_once '../pages/404.php';
    
}
}

?>







