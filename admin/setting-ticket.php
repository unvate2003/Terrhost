<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){

if($_GET && $_GET['xoa']){
    $id = $_GET['xoa'];
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `ticket` WHERE `id` = '$id'"));
    if($check){
        mysqli_query($conn,"DELETE FROM `ticket` WHERE `id` = '$id'");
        header('Location: /setup-ticket');
    }
}   
if($_GET && $_GET['delete'] == "all"){

    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `ticket`"));
    if($check){
        mysqli_query($conn,"DELETE FROM `ticket`");
        header('Location: /setup-ticket');
    }
}   
if($_GET && $_GET['huyduyet']){
    $id = $_GET['huyduyet'];
    $check = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `ticket` WHERE `id` = '$id'"));
    if($check && $check['status'] == 1){
        mysqli_query($conn,"UPDATE `ticket` SET `status`= 0 WHERE `id` = '$id'");
        header('Location: /setup-ticket');
    }
}  
if($_GET && $_GET['duyet']){
    $id = $_GET['duyet'];
    $check = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `ticket` WHERE `id` = '$id'"));
    if($check && $check['status'] == 0){
        mysqli_query($conn,"UPDATE `ticket` SET `status`= 1 WHERE `id` = '$id'");
        header('Location: /setup-ticket');
    }
}  
require_once 'header.php';


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
                            <h3 class="card-title">Danh Sách Ticket Hỗ Trợ</h3>
                        </div>

                        <div class="card-body">
                            <div class="box-header primary">
                                <h3></h3>
                            </div>
                            <div class="box-body">

                                <div class="form-group">
                                    <a href="?delete=all">
                                        <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-remove"></i> Xóa Tất Cả Ticket </button>
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped nowrap dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                <th>UID</th>
                                                <th>Tài Khoản</th>
                                                <th>Tiêu Đề</th>
                                                <th>Nội Dung</th>
                                                <th>Thời Gian</th>
                                                <th>Trạng thái</th>
                                                <th>Trả Lời Của Admin</th>
                                                <th>Hành Động</th>
                                                <th>Duyệt</th>
                                                <th>Trả lời</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $result= mysqli_query($conn, "SELECT * FROM `ticket` ORDER BY id DESC LIMIT 10000  ");
                                            if($result) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row[ 'id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row[ 'username']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row[ 'title']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row[ 'manager']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row[ 'time']; ?>
                                                </td>
                                                <td>
                                                    <?php if($row[ 'status']=='1' ){ echo '<p style="color:#00ff00";><b>Đã Duyệt </b></p>'; }elseif($row[ 'status']=='0' ) echo '<p style="color:#FF0000";><b>Chưa Duyệt</b></p>'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row[ 'reply']; ?>
                                                </td>
                                                <td>
                                                    <a href="?xoa=<?= $row['id']; ?>">
                                                        <button type="submit" class="btn btn-warning">Xóa</button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php if($row[ 'status']==1 ){?>
                                                    <a type="button" onClick="alert('Bạn Muốn Hủy Duyệt Đơn Này Chứ ?');" class="btn btn-info p-x-md" href="?huyduyet=<?= $row['id']; ?>">Set Chưa Duyệt</a>
                                                    <?php }else if($row[ 'status']==0 ){ ?>
                                                    <a type="button" onClick="alert('Bạn Muốn Duyệt Đơn Này Chứ ?');" class="btn btn-info p-x-md" href="?duyet=<?= $row['id']; ?>">Duyệt Đơn</a>
                                                    <?php } ?>
                                                </td>
                                                <!-- Button trigger modal -->
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Trả Lời Ticket</button>
                                                </td>
                                                <?php } } ?>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->

            </div>

        </div>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
 <?php //require 'footer.php'; ?>
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







