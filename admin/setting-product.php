<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){
if($_GET && $_GET['xoa']){
    $id = $_GET['xoa'];
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `danh-sach-san-pham` WHERE `id` = '$id'"));
    if($check){   
    mysqli_query($conn,"DELETE FROM `danh-sach-san-pham` WHERE `id` = '$id'");
           header('Location: /setup-product');
            
    }
}
if($_POST && $_POST['type'] == 'them-loai-san-pham' && isset($_POST['value']) && isset($_POST['rate']) && isset($_POST['ratemax'])){
  $value = xss(addslashes($_POST['value']));
  $rate = xss(addslashes($_POST['rate']));
  $ratemax = xss(addslashes($_POST['ratemax']));
  $cate = xss(addslashes($_POST['cate']));
  $key_id = md5($value);
  $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `danh-sach-san-pham` WHERE `key_id` = '$key_id'"));
  if($check){
     $arr = array('error' => 'Sản phẩm này đã tồn tại');
  }else{
     $arr = array('success' => 'Thêm thành công, đang chuyển hướng');
     mysqli_query($conn,"INSERT INTO `danh-sach-san-pham`(`key_id`, `value`, `rate`, `ratemax`,`cate`) VALUES ('$key_id','$value','$rate', '$ratemax', '$cate')");
  }
  echo json_encode($arr); exit;
}
require $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
?>

<!-- / .modal -->
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
                <h3 class="card-title">Thêm Danh Sách Sản Phẩm</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
           <div class="card-body">
        <div class="box-header primary">
          <h3><?php //$title; ?></h3>
        </div>
        <div class="box-body">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="zoom" ui-target="#animate"><i class="fa fa-plus"></i> Thêm loại sản phẩm mới</button>
        <div class="table-responsive">
      <table ui-jp="dataTable" class="table table-striped b-t b-b">
        <thead>
            <tr>
            <th>#</th>
            <th>KeyID</th>
            <th>Danh Mục</th>
            <th>Tên sản phẩm</th>
            <th>Giá thấp nhất</th>
            <th>Giá cao nhất</th>
            <th>Thao tác</th>
           </tr>
        </thead>
            <tbody>
                     <?php
                      $query = mysqli_query($conn,"SELECT * FROM `danh-sach-san-pham` ORDER BY id DESC");
                      $stt = 0;
                      while($row = mysqli_fetch_array($query)){
                        $cate = $row['cate'];
                       $categories = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM categories WHERE id = $cate")); 
                      ?>
                      <tr>
                           <td><?= ++$stt; ?></td>
                           <td><?= $row['key_id']; ?></td>
                           <td><b><?= $categories['title']; ?></b></td>
                           <td><?= $row['value']; ?></td>
                           <td><?= number_format($row['rate']); ?> đ</td>
                           <td><?= number_format($row['ratemax']); ?> đ</td>
                           <td><a type="button" class="btn btn-danger p-x-md" href="?xoa=<?= $row['id']; ?>">Xóa</a>
                           <a type="button" onClick="alert('Thêm Sản Phẩm');" class="btn btn-danger p-x-md" href="/zimbabwe/them-san-pham.html">Thêm Sản Phẩm</a>
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
        <!-- /.row -->
     
<div id="m-a-a" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title">Thêm loại sản phẩm mới</h5>
      </div>
      <div class="modal-body p-lg">
         <div class="form-group">
                        <label for="">Chọn Danh Mục:</label>
                        <!--input type="text" name="username" value="<?php echo $checkk['username']; ?>" class="form-control" placeholder="Nhập tên đăng nhập cần cộng/trừ tiền" required-->
                        <select class="form-control">
                        <?php
                        $req = mysqli_query($conn, "SELECT * FROM `categories`");
                        while($res = mysqli_fetch_assoc($req)){
                        ?>
                        <option value="<?= $res['id'] ?>" id="cate"><?= $res['title']?> </option>
                        <?php
                        }
                        ?>
                        </select>
                    </div>
        <div class="form-group">
          <label for="">Tên sản phẩm:</label>
          <input type="text" id="value" class="form-control" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="form-group">
          <label for="">Giá thấp nhất:</label>
          <input type="number" id="rate" class="form-control" placeholder="Nhập giá sản phẩm">
        </div>
        <div class="form-group">
          <label for="">Giá cao nhất:</label>
          <input type="number" id="ratemax" class="form-control" placeholder="Nhập giá sản phẩm">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger p-x-md" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary p-x-md" id="them-loai-san-pham">Thêm</button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script>
     $(()=>{
         $('#them-loai-san-pham').click(()=>{
            const value = $('#value').val();
            const rate = $('#rate').val();
            const ratemax = $('#ratemax').val();
            const cate = $('#cate').val();
            if(!value){
                swal("Vui Lòng Nhập Tên Sản Phẩm","error");
                return;
            }else if(!rate){
                swal("Vui Lòng Nhập Giá Sản Phẩm","error");
                return;
            }else if(!ratemax){
                swal("Vui Lòng Nhập Giá Sản Phẩm","error");
                return;
            }else if(!cate){
                swal("Vui Lòng Chọn Danh Mục","error");
                return;
            }else{
                $('#them-loai-san-pham').prop('disabled',true).html('<i class="fa fa-spinner fa-spin"></i> Đang Xử Lý');
                $.post('#',{type:'them-loai-san-pham',value,rate,ratemax,cate},'json')
                .done((res)=>{
                    var data = JSON.parse(res);
                    if(data.success){
                        swal(data.success,"success");
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }else{
                        swal(data.error,"error");
                    }
                    $('#them-loai-san-pham').prop('disabled',false).html("Thêm");   
                })
                .fail((err)=>{
                   console.log(err);     
                });
            }
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







