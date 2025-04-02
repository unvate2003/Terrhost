<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
require_once 'header.php';

if($data['admin'] == 1){
//mysqli_query($conn,"INSERT INTO `history_naptien` (`type`) VALUES ('Admin')");
    
    
$id = @$_GET['id'];
$checkk = @mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users` WHERE `id` = '$id'"));

if(isset($_POST['submit'])){
   $user = xss($_POST['username']);
   $type = xss($_POST['type']);
   
   $rawCash = xss(addslashes($_POST['cash']));
   $cash = str_replace(',', '', $rawCash);

   $acc = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users` WHERE `username` = '$user'"));
   if(!$user || !$cash || !is_numeric($cash)){
        $status = false;
        $msg = "Thông tin cộng/trừ tiền không hợp lệ";
   }else if(!$acc){
        $status = false;
        $msg = "Tên đăng nhập không tồn tại";
   }else{
       if($type == 1) {
                $status = true;
                $time = gettime();
                $msg = "Cộng tiền thành công";
                mysqli_query($conn,"UPDATE `users` SET `cash`= `cash` + $cash WHERE `username` = '$user'");
                mysqli_query($conn,"INSERT INTO `history_naptien` SET `type`='Admin Cộng Tiền',  `username`='$user', `menhgia`='$cash', `date` = '$time', `thucnhan`='$cash', `trangthai`='1'");
        } else if($type == 2) {
                $status = true;
                $time = gettime();
                $msg = "Trừ tiền thành công";
                mysqli_query($conn,"UPDATE `users` SET `cash`= `cash` - $cash WHERE `username` = '$user'");
                mysqli_query($conn,"INSERT INTO `history_naptien` SET `type`='Admin Trừ Tiền',  `username`='$user', `menhgia`='$cash', `date` = '$time', `thucnhan`='$cash', `trangthai`='1'");
        }   
   }
}

if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/setup-money';
            }, 2000);
        <?php }else{ ?>
            swal('<?= $msg ?>',"error");
        <?php } ?>
</script>
<?php
}
?> 
<!--
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  -->
   <script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/bootstrap3-typeahead.min.js"></script>
  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid"></div>
        <!-- /.container-fluid -->
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
                            <h3 class="card-title">Cộng/Trừ Tiền Thành Viên</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <a href="/history-pay">
                                <i class="fa fa-arrow-right"></i>
                                Xem lịch sử cộng tiền
                            </a>
                            <form ui-jp="parsley" novalidate action="#" method="POST">
                                <div class="form-group">
                                    <label for="">Tên đăng nhập:</label>
                                        <input type="text" name="username" id="username" value="<?php echo @$checkk['username']; ?>" class="form-control input-lg" autocomplete="off" placeholder="Nhập tên tài khoản" />
                                            <!--select class="form-control" name="username">
                                			    <?php
                                                $req = mysqli_query($conn, "SELECT * FROM `users`");
                                                while($res = mysqli_fetch_assoc($req)){
                                                ?>
                                                <option value="<?= $res['username'] ?>"><?= $res['username']?> </option>
                                                <?php
                                                }
                                                ?>					
                    		                </select-->
                                </div>
                                <div class="form-group">
                                    <!--<label for="">Thao Tác</label>
                                        <!--<select class="form-control" name="type">
                                            <option value="1">Cộng Tiền</option>
                                            <option value="2">Trừ Tiền</option>
                                        </select>-->
                                        <table>
                                            <tr>
                                                <td>
                                                    <label for="">Thao Tác:</label>
                                                </td>
                                                <td>
                                                    <input type="radio" id="addMoney" name="type"  value="1" checked="checked"><label for="addMoney">Cộng tiền</label>
                                                    </br>
                                                    <input type="radio" id="deductMoney" name="type"  value="2"><label for="deductMoney">Trừ tiền</label>
                                                </td>
                                                
                                            </tr>
                                        </table>
                                </div>
                                <div class="form-group">
                                    <label for="">Số tiền:</label>
                                        <input type="text" name="cash" id="pricechange" value="0" class="form-control" placeholder="Nhập số tiền cần cộng" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block p-x-md" name="submit">Cập Nhật </button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
          <!-- /.row -->
        </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <strong>Copyright &copy; 2020 <a href="#"> <?= $setup['name-footer']; ?> </a>. </strong> All rights reserved.
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
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->

<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/overlayscrollbars/js/jquery.overlayscrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/dist/js/demo.js"></script>

<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/dist/js/pages/dashboard.js"></script>
</body></html>
<script>
		$(document).ready(function() {
			$('#price').on('input', function() {
				// Chuyển đổi giá trị đầu vào thành một số nguyên
				var num = parseInt($(this).val().replace(/\D/g, ''));

				// Định dạng chuỗi thành giá tiền
				var formattedNum = num.toLocaleString('en-US');

				// Cập nhật giá trị đầu vào với giá trị đã định dạng
				$(this).val(formattedNum);
			});
		});
</script>
<script>
    $(document).on('keyup','#pricechange',function(){
			var num = $(this).val().replace(/\D/gi,'');
			$(this).val(num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		});
</script>
<script>
$(document).ready(function(){
 $('#username').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:'<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/Check.html',
    method:'POST',
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
 
});
</script>

<?php
}
else{
    require_once '../pages/404.php';
    
}
}

?>







