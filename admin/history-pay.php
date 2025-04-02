<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){

if($_GET && $_GET['delete'] == "all"){

    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `napthe`"));
    if($check){
        mysqli_query($conn,"DELETE FROM `napthe`");
        header('Location: /history-pay');
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
              <h3 class="card-title">Danh Sách Nạp Tiền</h3>
            </div>

            <div class="card-body">
              <div class="box-header primary">
                <h3></h3>
              </div>
              <div class="box-body">

                <div class="form-group">
                  <a href="">
                    <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-remove"></i> Xóa Tất Cả </button>
                  </a>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped dataTable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Loại</th>
                            <th>Cron</th>
                            <th>Username</th>
                            <th>Tên Tài Khoản</th>
                            <th>Mệnh Giá</th>
                            <th>Trạng Thái</th>
                            <th>TranID</th>
                            <th>Thời Gian</th>
    
                          </tr>
                        </thead>
                        
                        <tbody>
    
                          <?php
                          $query = mysqli_query($conn,"SELECT * FROM `history_naptien` ORDER BY id DESC");
                          $stt = 0;
                          while($row = mysqli_fetch_array($query)){
    						
                          ?>
                          <tr>
                            <td>
                              <?= $row['id']; ?>
                            </td>
                            <td>
                              <?= $row['type']; ?>
                            </td>
                            <td>
                              <?= $row['loaithe'] ;?>
                            </td>
                            <td>
                              <?= $row['username']; ?>
                            </td>
                            <td>
                              <?= $row['namemomo'] ;?>
                            </td>
                            <td>
                              <?= number_format($row['menhgia']) ;?>
                            </td>
                            <td>
                              <? if($row['trangthai']=="1" ) { echo "Thành Công"; } ?>
                            </td>
                            <td>
                              <?= $row['tranid'] ;?>
                            </td>
                            <td>
                              <?= $row['date'] ;?>
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
        <!-- /.Col -->
        
          
        
          
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Danh Sách Thẻ Nạp</h3>
            </div>

            <div class="card-body">
              <div class="box-header primary">
                <h3></h3>
              </div>
              <div class="box-body">

                <div class="form-group">
                  <a href="?delete=all">
                    <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-remove"></i> Xóa Tất Cả </button>
                  </a>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped dataTable">
                        <thead>
                          <tr>
                      <tr>
                        <th>UID</th>
                        <th>Tên Tài Khoản</th>
                        <th>Loại thẻ</th>
                        <th>Mệnh giá</th>
                        <th>Số seri</th>
                        <th>Mã thẻ</th>
                        <th>Trạng thái</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
				$result = mysqli_query($conn,"SELECT * FROM `napthe`");
				if($result)
				{
				while($row = mysqli_fetch_assoc($result))
				{
				?>
               <tr>
               <td><?php echo $row['ID']; ?></td>
               <td><?php echo $row['uid']; ?></td>
               <td><?php echo $row['loaithe']; ?></td>
                 <td><?php echo $row['sotien']; ?></td>
                 <td><?php echo $row['seri']; ?></td>
                 <td><?php echo $row['code']; ?></td>
                 <td><?php 
                 if($row['tinhtrang'] == '1'){
                    echo '<p style="color:#00ff00";><b>Thành Công</b></p>';
                 }elseif($row['tinhtrang'] == '0')
                  echo '<p style="color:#FF0000";><b>Thất Bại</b></p>';
                 ?></td>
                 <?php
				}
				}
				?>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.Col -->
        
<?php /*
?>
        <div class="col-md-12">
          <!-- general form elements -->
          

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Danh Sách Momo Nạp</h3>
            </div>

            <div class="card-body">
              <div class="box-header primary">
                <h3></h3>
              </div>
              <div class="box-body">

                <div class="form-group">
                  <a href="">
                    <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-remove"></i> Xóa Tất Cả </button>
                  </a>
                </div>
                <div class="table-responsive">
                  <table ui-jp="dataTable" class="table table-striped b-t b-b">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Mã GD</th>
                        <th>Tài Khoản</th>
                        <th>Số Tiền</th>
                        <th>Số Điện Thoại</th>
                        <th>Tên Người Gửi</th>
                        <th>Nội Dung</th>
                        <th>Thời Gian</th>
                        <th>Trạng Thái</th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $query = mysqli_query($conn,"SELECT * FROM `momo` ORDER BY id DESC");
                      $stt = 0;
                      while($row = mysqli_fetch_array($query)){
						
                      ?>
                      <tr>
                        <td>
                          <?=+ +$stt; ?>
                        </td>
                        <td>
                          <?= $row[ 'tranId']; ?>
                        </td>
                        <td>
                          <?= $row[ 'username'] ;?>
                        </td>
                        <td>
                          <?= $row[ 'amount']; ?>
                        </td>
                        <td>
                          <?= $row[ 'partnerId'] ;?>
                        </td>
                        <td>
                          <?= $row[ 'partnerName'] ;?>
                        </td>
                        <td>
                          <?= $row[ 'comment'] ;?>
                        </td>
                        <td>
                          <?= $row[ 'time'] ;?>
                        </td>
                        <td>
                          <? if($row[ 'status']=="success" ) { echo "Thành Công"; } ?>
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
        <!-- /.Col -->
<?php */ ?>
        </div>
        <!--
     <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
-->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="#"><?= $setup['name-footer']; ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div>
  </footer>
  <!-- Control Sidebar 
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here
  </aside>
  <!-- /.control-sidebar -->
  
</div>
</body></html>

<script>
      $(function () {
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "order": [[ 0, "desc" ]],
          "pageLength": 10,
          "autoWidth": true
        });
      });
    </script>
<?php
require_once 'script.php';
}
else{
    require_once '../pages/404.php';
    
}
}

?>







