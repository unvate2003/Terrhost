<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){
require_once 'header.php';  
$title = " Danh Sách Thành Viên ";
if(@$_GET && @$_GET['xoa']){
    $id = @$_GET['xoa'];
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE `id` = '$id'"));
    if($check){
        $status = true;
        $msg = "Xóa thành viên thành công";
        mysqli_query($conn,"DELETE FROM `users` WHERE `id` = '$id'");
    }
}   
if(@$_GET && @$_GET['member']){
    $id = @$_GET['member'];
    $check = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users` WHERE `id` = '$id'"));
    if($check && $check['admin'] == 1 && $check['username'] != $data['username']){
        if($username == $check['username']){
          $status = false;
          $msg = "Có lỗi đã xảy ra";
        }else{
          $status = true;
          $msg = "Thành Công";
          mysqli_query($conn,"UPDATE `users` SET `admin`= 0 WHERE `id` = '$id'");
        }
    }
} 
if(@$_GET && @$_GET['admin']){
    $id = @$_GET['admin'];
    $check = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users` WHERE `id` = '$id'"));
    if($check && $check['admin'] == 0){
        $status = true;
        $msg = "Nâng Admin thành công";
        mysqli_query($conn,"UPDATE `users` SET `admin`= 1 WHERE `id` = '$id'");
    }
} 
if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/setup-member';
            }, 1300);
        <?php }else{ ?>
            swal('<?= $msg ?>',"error");
        <?php } ?>
</script>
<?php
}


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Quản Lý Thành Viên</h3>
                        </div>

                        <div class="card-body">
                            <div class="box-header primary">
                                <h3><?= $title; ?></h3>
                            </div>
                            <div class="box-body">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="zoom" ui-target="#animate"><i class="fa fa-plus"></i> Thêm Thành Viên </button>
<div class="table-responsive">
      <!--table id="example2" ui-jp="dataTable" class="table table-striped b-t b-b"-->
<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
            <tr>
            <th>#ID</th>
            <th>Email</th>
            <th>Username</th>
            <th>Time Creat</th>
            <th>Số dư</th>
            <th>Chức vụ</th>
            <th>Xóa</th>
            <th>Cộng/Trừ</th>
            <th>Add QTV</th>
           </tr>
        </thead>
            <tbody>
                     <?php
                      $query = mysqli_query($conn,"SELECT * FROM `users` ORDER BY id DESC");
                      $stt = 0;
                      while($row = mysqli_fetch_array($query)){
                      ?>
                     <tr>
                           <td><?= $row['id']; ?></td>
                           <td><?= $row['email']; ?></td>
                           <td><?= $row['username']; ?></td>
                           <td><?= $row['time']; ?></td>
                           <td><?= number_format($row['cash']); ?> VNĐ</td>
                           <td><?= $row['admin']==1?"Quản trị viên":"Thành viên"; ?></td>
                           <td>
                           <a type="button" class="btn btn-danger p-x-md" href="?xoa=<?= $row['id']; ?>">Xóa</a>
                           </td>
                           <td>
                           <a type="button" class="btn btn-success p-x-md" href="/setup-money?id=<?= $row['id']; ?>">Add tiền</a>
                           </td>
                           <td>
                            <?php if($row['admin'] == 1 && $row['username'] != $data['username']){?>
                            <a type="button" class="btn btn-primary p-x-md" href="?member=<?= $row['id']; ?>" style="width: 108px;">Thành viên</a>
                            <?php }else if($row['admin'] == 0){ ?> 
                            <a type="button" class="btn btn-info" href="?admin=<?= $row['id']; ?>" style="width: 108px;">Nâng Admin</a>
                            <?php }
                            else{
                              ?>
                              <!--a type="button" class="btn btn-warning" style="width: 108px;">Admin</a-->
                              <a type="button" class="btn btn-warning p-x-md" href="?member=<?= $row['id']; ?>"  style="width: 108px;">Hạ Admin</a>
                            <?php } ?>
                           </td>

                      </tr>
                      <?php
                      }
                      ?>
             </tbody>
      </table>
      </div>
            </div>
             </div>
            </div>
            </div>
            <!-- /.card -->

        </div>


      </div><!-- /.container-fluid -->

    <!-- /.content -->
  </div>

 <?php require 'footer.php'; ?>
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







