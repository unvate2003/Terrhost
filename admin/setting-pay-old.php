<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){
require_once 'header.php';  
$title = " Quản lí sản phẩm ";
if(@$_GET && @$_GET['xoa']){
    $id = @$_GET['xoa'];
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-da-ban` WHERE `key_id` = '$id'"));
    if($check){
        $status = true;
        $msg = "Xóa sản phẩm thành công";
        mysqli_query($conn,"DELETE FROM `san-pham-da-ban` WHERE `key_id` = '$id'");
    }
}    
if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/product-pay';
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
                         <div class="card card-primary">
    <div class="card-header"><h3>Quản Lý Sản Phẩm Đã Bán</h3>
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
                        <th>Thời gian</th>
                        <th>Số tiền</th>
                        <th>Người mua</th>
                        <th>Xóa</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php $query=mysqli_query($conn, "SELECT * FROM `san-pham-da-ban` ORDER BY id DESC");
                    $stt=0 ;
                    while($row=mysqli_fetch_array($query)){
                      //$categoryid=$row['cate'];
                      $subcatekey=$row['subcatekey'];
                      $key_id=$row[ 'key_id'];
                      $checc2=@mysqli_query($conn, "SELECT * FROM `subcategories` WHERE `key_id` = '$subcatekey'"); 
                      $check2=@mysqli_fetch_assoc($checc2);
                      $categoryid = @$check2['cateid'];
                      $checc3=@mysqli_query($conn, "SELECT * FROM `tscategory` WHERE `id` = '$categoryid'");
                      $check3=@mysqli_fetch_assoc($checc3);
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
                            <?= date('H:i:s d-m-Y',$row[ 'time']) ?>
                        </td>
                        <td>
                            <?= number_format($check2['rate']); ?> VNĐ
                        </td>
                        <td>
                            <?= $row['username']; ?> 
                        </td>
                        <td> 
                            <a type="button" class="btn btn-danger p-x-md" href="?xoa=<?= $row['key_id']; ?>">Xóa</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
            </div>
            <!-- /.card -->

        </div>


      </div><!-- /.container-fluid -->
    </section>
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







