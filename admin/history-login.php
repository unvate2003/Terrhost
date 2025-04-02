<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){

if($_GET && $_GET['delete'] == "all"){

    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `history-log`"));
    if($check){
        mysqli_query($conn,"DELETE FROM `history-log`");
        header('Location: /history-login');
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
                <h3 class="card-title">Lịch Sử Hoạt Động Thành Viên</h3>
              </div>
              
           <div class="card-body">
        <div class="box-header primary">
          <h3></h3>
        </div>
        <div class="box-body">
        
        <div class="form-group">
    <a href="?delete=all"><button type="submit" name="submit" class="btn btn-info"><i class="fa fa-remove"></i> Xóa Tất Cả </button></a>
        </div>
        <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
  <thead>
                                        <tr>
        <th>#ID</th>
       	<th>Tài Khoản</th>
       	<th>User Agent</th>	
       	<th>Địa Chỉ IP</th>
       	<th>Thời Gian</th> 	
       	
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
				$result = mysqli_query($conn,"SELECT * FROM `history-log`");
				if($result)
				{
				while($row = mysqli_fetch_assoc($result))
				{
				?>
               <tr>
                <td><?php echo $row['id']; ?></td>
                 <td><?php echo $row['username']; ?></td>
                 <td><?php echo $row['useragent']; ?></td>
                 <td><?php echo $row['ip']; ?></td>
                 <td><?php echo date('d-m-Y, H:i:s', $row['time']); ?></td>
              
                 
                
                 </td>
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
            <!-- /.card -->

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







