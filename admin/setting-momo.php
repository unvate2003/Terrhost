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
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `cron_momo` WHERE `id` = '$id'"));
    if($check){
        $status = true;
        $msg = "Xóa tài khoản momo thành công";
        mysqli_query($conn,"DELETE FROM `cron_momo` WHERE `id` = '$id'");
    }
}  
if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/setup-momo';
            }, 500);
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
            <div class="card-header">
                <h6 class="card-title mb-3">Đăng nhập momo</h6>
            </div>
            <div class="card-body">
               <form submit-ajax="rin1906" action="<?= 'https://'.$_SERVER['HTTP_HOST']?>/Query/ApiMomo.html" method="post">
                    <input type="hidden" name="action" value="loginmomo">
                    <o id="act"></o>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <center><label class="form-label" for="">Số điện thoại</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="phonemomo" value="" placeholder=" Nhập tên số điện thoại momo"></input>
                            </div>
                        </div>
                        <div class="col-md-12 password hidden">
                            <div class="form-group">
                                <center><label class="form-label" for="">Mật khẩu</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="passmomo" value="" placeholder=" Nhập mật khẩu momo"></input>
                            </div>
                        </div>
                        <div class="col-md-12 codeotp hidden">
                            <div class="form-group">
                                <center><label class="form-label" for="">Mã xác thực</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="codeotp" value="" placeholder=" Nhập mã xác thực"></input>
                            </div>
                        </div>

                        <div class="col-md-4 mr-auto ml-auto pt-3">
                            <o id="buttonInput"></o>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("div.hidden").hide();
        $("#act").html('<input type="hidden" name="act" value="sendotp">');
        $("#buttonInput").html('<button callback="callback" type="submit" class="btn btn-primary btn-block">Đăng nhập <em class="fa fa-paper-plane"></em></button>');
    });

    function callback(res) {
        if (res.status === true && res.step === 'veryotp') {
            $("div.codeotp").show();
            $("#act").html('<input type="hidden" name="act" value="veryotp">');
            $("#buttonInput").html('<button callback="callback" type="submit" class="btn btn-primary btn-block">Xác thực <em class="fa fa-paper-plane"></em></button>');
        }
        if (res.status === true && res.step === 'login') {
            $("div.codeotp").remove();
            $("div.password").show();
            $("#act").html('<input type="hidden" name="act" value="login">');
            $("#buttonInput").html('<button callback="callback" type="submit" class="btn btn-primary btn-block">Đăng nhập <em class="fa fa-paper-plane"></em></button>');
        }

        if (res.status === true && res.step === 'SUCCESS') {
            location.reload();
        }

        swal(
            res.message,
            res.status === true ? "success" : "error"
        );
    }
</script>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary mb-3">
            <div class="card-header">
                <h6 class="card-title mb-3">Danh sách account momo</h6>
            </div>
                <div class="table-responsive scrollbar">
                     <table id="DataTables_Table_0_wrapper" class="table table-bordered table-hover" role="grid">
                            <thead class="bg-200 text-900">
                                <tr role="row" history>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 58.8438px;">#</th>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="Người buff: activate to sort column ascending" style="width: 162.031px;">Số điện thoại</th>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="type order: activate to sort column ascending" style="width: 193.031px;">Số dư </th>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="type order: activate to sort column ascending" style="width: 193.031px;">Tên </th>
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 211.047px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getlistcard = mysqli_query($conn, "SELECT * FROM `cron_momo` WHERE `user_id` = '$username' ORDER BY `id` DESC ");
                               
                                if ($getlistcard) {
                                    while($rowucard=mysqli_fetch_array($getlistcard)) { ?>
                                        <tr class="odd">
                                            <td><?= $rowucard['id'] ?></td>
                                            <td><?= $rowucard['phone'] ?></td>
                                            <td><?= number_format($rowucard['BALANCE']) ?></td>
                                           <td><?= $rowucard['user_id'] ?></td>
                                            <td>
                                                 <a type="submit" class="btn btn-danger btn-sm" href="?xoa=<?= $rowucard['id']; ?>">Xóa</a>
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
<?php
require_once 'script.php';
}
else{
    require_once '../pages/404.php';
    
}
}

?>
