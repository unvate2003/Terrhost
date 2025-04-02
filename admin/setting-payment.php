<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    @header('Location: /');exit;
}else{
require_once 'header.php';
if($data['admin'] == 1){
if(isset($_POST['them-bank'])){
   $namebank = xss(addslashes($_POST['namebank']));
   $tentaikhoan = xss(addslashes($_POST['tentaikhoan']));
   $sotaikhoan = xss(addslashes($_POST['sotaikhoan']));
   $logobank = xss(addslashes($_POST['logobank']));
   $naptoithieu = xss(addslashes($_POST['naptoithieu']));
   $status=1;
   $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `bank` WHERE `namestk` = '$sotaikhoan'"));
  if($check){
echo '<script> swal("Số tài khoản này đã tồn tại","error"); </script>';
  }else{
echo '<script> swal("Thêm Ngân Hàng Thành Công","success"); setTimeout(function(){ location.href = "" },1300);</script>';
     mysqli_query($conn,"INSERT INTO `bank`(`namebank`,`namectk`, `namestk`, `img`, `id_xep`, `status`) VALUES ('$namebank','$tentaikhoan','$sotaikhoan','$logobank','$naptoithieu','$status')");
  }
}
if(@$_GET && @$_GET['xoa']){
    $id = @$_GET['xoa'];
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `bank` WHERE `id` = '$id'"));
    if($check){
        $status = true;
        $msg = "Xóa tài khoản ngân hàng thành công";
        mysqli_query($conn,"DELETE FROM `bank` WHERE `id` = '$id'");
    }
} 
if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/setup-payment';
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
        <div class="row">
       <div class="col-md-12">
<div class="card-body">
                              <form action="" method="post">
                                   
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <center><label class="form-label" for="">Tên ngân hàng</label></center>
                                                <input  type="text" rows="5" cols="50" class="form-control" id="namebank" name="namebank" placeholder=" Nhập tên ngân hàng"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <center><label class="form-label" for="">Tên chủ tài khoản</label></center>
                                                <input  type="text" rows="5" cols="50" class="form-control" id="tentaikhoan" name="tentaikhoan" placeholder=" Nhập tên chủ tài khoản"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <center><label class="form-label" for="">Số tài khoản</label></center>
                                                <input  type="text" rows="5" cols="50" class="form-control" id="sotaikhoan" name="sotaikhoan" placeholder=" Nhập số tài khoản"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <center><label class="form-label" for="">Nạp tối thiểu</label></center>
                                                <input  type="text" rows="5" cols="50" class="form-control" id="naptoithieu" name="naptoithieu" placeholder=" Nhập số tiền nạp tối thiểu"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <center><label class="form-label" for="">Logo ngân hàng</label></center>
                                                <input  type="text" rows="5" cols="50" class="form-control" id="logobank" name="logobank" placeholder=" Nhập link logo ngân hàng"></input>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4 mr-auto ml-auto pt-3">
                                            <button type="submit" id="them-bank" name="them-bank" class="btn btn-primary btn-block">Thêm ngay <em class="fa fa-paper-plane"></em></button>
                                        </div>
                                </form>
                            </div>

        <div class="card card-primary">
    <div class="card-header"><h3>Quản Lý Ngân hàng</h3>
    </div>
    <hr>
    <div class="box-body">
        <div class="table-responsive">
            <!--table id="example2" ui-jp="dataTable" class="table table-striped b-t b-b"-->
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th style="width:170px;">Tên chủ tài khoản</th>
                        <th style="width:150px;">Số tài khoản</th>
                        <th style="width:150px;">Logo bank</th>
                        <th style="width:70px;">Giới hạn</th>
                        <th>Xóa</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php $query=mysqli_query($conn, "SELECT * FROM `bank` ORDER BY id DESC");
                    $stt=0 ;
                    while($row=mysqli_fetch_array($query)){
                      ?>
                    <tr>
                        <td>
                            <?=$row['id']; ?>
                        </td>
                        <td>
                            <?=$row['namectk']; ?>
                        </td>
                        <td>
                            <?=$row['namestk']; ?>
                        </td>
                        <td>
                            <img src="<?=$row['img']?>" height="45px">
                        </td>
                        <td>
                            <?= $row['id_xep']; ?>
                        </td>
                        <td> 
                            <a type="button" class="btn btn-danger p-x-md" href="?xoa=<?= $row['id']; ?>">Xóa</a>
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
      </div>
    </section>
    
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
</body></html>
<?php
require_once 'script.php';
}
else{
    require_once '../pages/404.php';
    
}
}

?>







