<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){
require_once 'header.php';
if(@$_GET && @$_GET['xoa']){
    $id = @$_GET['xoa'];
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `mbbankauto` WHERE `id` = '$id'"));
    if($check){
        $status = true;
        $msg = "Xóa danh mục thành công";
        mysqli_query($conn,"DELETE FROM `mbbankauto` WHERE `id` = '$id'");
    }
}  
if(isset($_POST['them-bank'])){
   $account = xss(addslashes($_POST['account']));
   $password = xss(addslashes($_POST['password']));
   $accountno = xss(addslashes($_POST['accountno']));
   $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `mbbankauto` WHERE `accountno` = '$accountno'"));
  if($check){
echo '<script> swal("Tài khoản này đã tồn tại !!!","error"); </script>';
  }else{
echo '<script> swal("Thêm Thành Công","success"); setTimeout(function(){ location.href = "" },300);</script>';
     mysqli_query($conn,"INSERT INTO `mbbankauto`(`account`, `password`, `accountno`, `balance`) VALUES ('$account','$password','$accountno','0')");
  }
}

if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/setup-mbbank';
            }, 432500);
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
        <div class="card card-primary mb-3">
            <div class="card-header ">
                <h6 class="card-title mb-3">Đăng nhập mbbank</h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <center><label class="form-label" for="">Tài khoản đăng nhập</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" id="account" name="account" value="" placeholder=" Nhập tên tên tài khoản đăng nhập"></input>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <center><label class="form-label" for="">Mật khẩu</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" id="password" name="password" value="" placeholder=" Nhập mật khẩu"></input>
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <center><label class="form-label" for="">Số tài khoản</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" id="accountno" name="accountno" value="" placeholder=" Nhập số tài khoản"></input>
                            </div>
                        </div>

                        <div class="col-md-4 mr-auto ml-auto pt-3">
                            <button type="submit" id="them-bank" name="them-bank" class="btn btn-primary btn-block" >Thêm <em class="fa fa-paper-plane"></em></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary mb-3">
            <div class="card-header">
                <h6 class="card-title mb-3">Danh sách account mbbank</h6>
            </div>
                <div class="table-responsive scrollbar">
                   
                        <table id="DataTables_Table_0_wrapper" class="table table-bordered table-hover" role="grid">
                            <thead class="bg-200 text-900">
                                <tr role="row" history>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 58.8438px;">#</th>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="Người buff: activate to sort column ascending" style="width: 162.031px;">Tài khoản</th>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="type order: activate to sort column ascending" style="width: 193.031px;">Mật khẩu </th>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="Trạng thái: activate to sort column ascending" style="width: 211.047px;">Số tài khoản</th>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="Trạng thái: activate to sort column ascending" style="width: 211.047px;">Số dư</th>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 211.047px;">Xóa</th>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 211.047px;">Lấy số dư</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                                    $getlistcard = mysqli_query($conn, "SELECT * FROM `mbbankauto`  ORDER BY `id` DESC ");
                               
                                if ($getlistcard) {
                                    while($rowucard=mysqli_fetch_array($getlistcard)) { ?>
                                        <tr class="odd">
                                            <td><?= $rowucard['id'] ?></td>
                                            <td><?= $rowucard['account'] ?></td>
                                            <td><?= $rowucard['password'] ?></td>
                                            <td><?= $rowucard['accountno'] ?></td>
                                            <td><?= number_format($rowucard['balance']) ?> đ</td>
                                            
                                            <td>
                                                <a type="submit" class="btn btn-danger btn-sm" href="?xoa=<?= $rowucard['id']; ?>">Xóa</a>
                                            </td>
                                            <td>
                                                <form submit-ajax="rin1906" action="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/ApiMbbank.html" method="post">
                                                    <input type="hidden" name="id" value="<?= $rowucard['id'] ?>">
                                                    <button type="submit" class="btn btn-success btn-sm">Lấy số dư</button>
                                                </form>
                                            </td>

                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="dataTables_empty">
                                            <center>Không có dữ liệu để hiển thị</center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    
                </div>
            
        </div>
    </div>
</div>
<!-- /.content -->
</div>
</div>
        <!-- /.row -->
     

    </section>

  </div>
  <script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/js/backend-bundle.min.js"></script>
  <script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/js/swap.js"></script>
<!-- /.content-wrapper -->
<?php
require_once 'script.php';
}
else{
    require_once '../pages/404.php';
    
}
}

?>
