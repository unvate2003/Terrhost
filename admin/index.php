<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){
require_once 'header.php';
$members = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM `users` ")) ['COUNT(*)']; 
$sell = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM `san-pham-da-ban` ")) ['COUNT(*)'];
$sale = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM `san-pham-chua-ban` ")) ['COUNT(*)']; 
$countticket = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM `ticket` ")) ['COUNT(*)']; 
$paymentsuccess = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(count_card) FROM `napthe` WHERE `status_card` = '1' ")) ['SUM(count_card)']; 
$paymomo = @mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) FROM `momo` WHERE `status` = 'success' ")) ['SUM(amount)']; 
$countpay = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(cash) FROM `users` ")) ['SUM(cash)']; 



if($_GET && $_GET['delete'] == "all"){

    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `log`"));
    if($check){
        mysqli_query($conn,"DELETE FROM `log`");
        header('Location: /admin');
    }
}   
 
?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <center>
                <h4 class="t-service"><img src="asset/img/setting.png" height="30" alt=""> Thống Kê Website</h4>
            </center>
            <p></p>
            <!-- Small boxes (Stat box) -->
            <div class="row">


                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $members ?></h3>
                            <p>Tổng Thành Viên</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-people"></i>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $countpay ?> </h3>
                            <p>Tổng Số Dư Thành Viên</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                        <!--
              <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
              -->
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $sell ?><sup style="font-size: 20px"></sup></h3>
                            <p>Sản Phẩm Đã Bán</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-checkmark-round"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $sale ?></h3>
                            <p>Sản Phẩm Chưa Bán</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-close"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3><?= $countticket ?></h3>
                            <p>Tổng Ticket Hỗ Trợ</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>

                    </div>
                </div>

                <!-- ./col -->
                <!--
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <!--
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $paymentsuccess ?></h3>
                            <p>Tổng Nạp Thành Viên</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>

                    </div>
                </div>
                -->
                <!-- ./col -->
                <!--
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <!--
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $paymomo ?></h3>
                            <p>Tổng Nạp Momo Thành Viên</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>

                    </div>
                </div>
                -->
                
            </div>
            <!-- /.row -->
            <!-- Main row -->

            <!--
        <p></p>
   <center>     <h4 class="t-service"><img src="asset/img/setting.png" height="30" alt=""> Cài Đặt Website</h4></center>
        <p></p>
        <div class="row">
          <div class="col-lg-4 col-6">
					<a rel="nofollow" href="/setup-system">
						<div class="card card-service box-service-panel">
						    <div class="card-body" data-toggle="tooltip" data-placement="bottom" title="Cài Đặt Website">
						        <div class="box-body text-center">
				                	<img src="asset/img/x1.png">
				                    <br>
				                    <span class="service-text">Cấu Hình Trang Web</span>
				                </div>
						    </div>
						</div>
					</a>
			    </div>
				<div class="col-lg-4 col-6">
					<a rel="nofollow" href="/setup-payment">
						<div class="card card-service box-service-panel">
						    <div class="card-body" data-toggle="tooltip" data-placement="bottom" title="Cấu hình thanh toán">
						        <div class="box-body text-center">
				                	<img src="asset/img/x2.png">
				                    <br>
				                    <span class="service-text">Cấu Hình Thanh Toán</span>
				                </div>
						    </div>
						</div>
					</a>
			    </div>
			    <div class="col-lg-4 col-6">
					<a rel="nofollow" href="/setup-product">
						<div class="card card-service box-service-panel">
						    <div class="card-body" data-toggle="tooltip" data-placement="bottom" title="Danh sách sản phẩm">
						        <div class="box-body text-center">
				                	<img src="asset/img/ctv.png">
				                    <br>
				                    <span class="service-text">Danh Sách Sản Phẩm</span>
				                </div>
						    </div>
						</div>
					</a>
			    </div>
			    <div class="col-lg-4 col-6">
					<a rel="nofollow" href="/add-product">
						<div class="card card-service box-service-panel">
						    <div class="card-body" data-toggle="tooltip" data-placement="bottom" title="Thêm nguồn sản phẩm">
						        <div class="box-body text-center">
				                	<img src="asset/img/cart2.png">
				                    <br>
				                    <span class="service-text">Thêm Nguồn Sản Phẩm</span>
				                </div>
						    </div>
						</div>
					</a>
			    </div>
			    <div class="col-lg-4 col-6">
					<a rel="nofollow" href="/setup-member">
						<div class="card card-service box-service-panel">
						    <div class="card-body" data-toggle="tooltip" data-placement="bottom" title="Quản lý thành viên">
						        <div class="box-body text-center">
				                	<img src="asset/img/user.png">
				                    <br>
				                    <span class="service-text">Quản Lý Thành Viên</span>
				                </div>
						    </div>
						</div>
					</a>
			    </div>
			    <div class="col-lg-4 col-6">
					<a rel="nofollow" href="/setup-money">
						<div class="card card-service box-service-panel">
						    <div class="card-body" data-toggle="tooltip" data-placement="bottom" title="Cộng/Trừ tiền thành viên">
						        <div class="box-body text-center">
				                	<img src="asset/img/money.png">
				                    <br>
				                    <span class="service-text">Cộng/Trừ Tiền Thành Viên</span>
				                </div>
						    </div>
						</div>
					</a>
			    </div>
			    
			    <div class="col-lg-4 col-6">
					<a rel="nofollow" href="/history-pay">
						<div class="card card-service box-service-panel">
						    <div class="card-body" data-toggle="tooltip" data-placement="bottom" title="Lịch sử nạp">
						        <div class="box-body text-center">
				                	<img src="asset/img/price.png">
				                    <br>
				                    <span class="service-text">Lịch Sử Nạp Thành Viên</span>
				                </div>
						    </div>
						</div>
					</a>
			    </div>
			    <div class="col-lg-4 col-6">
					<a rel="nofollow" href="/setup-ticket">
						<div class="card card-service box-service-panel">
						    <div class="card-body" data-toggle="tooltip" data-placement="bottom" title="Danh sách ticket">
						        <div class="box-body text-center">
				                	<img src="asset/img/ticket.png">
				                    <br>
				                    <span class="service-text">Danh Sách Ticket Hỗ Trợ</span>
				                </div>
						    </div>
						</div>
					</a>
			    </div>
			        <div class="col-lg-4 col-6">
					<a rel="nofollow" href="/history-login">
						<div class="card card-service box-service-panel">
						    <div class="card-body" data-toggle="tooltip" data-placement="bottom" title="Lịch sưt hoạt động">
						        <div class="box-body text-center">
				                	<img src="asset/img/ticket.png">
				                    <br>
				                    <span class="service-text">Lịch Sử Hoạt Động Thành Viên</span>
				                </div>
						    </div>
						</div>
					</a>
			    </div>
	</div>
	
            -->
        <!-- /.row (main row) -->

    <div class="col-lg-12">
        
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">NHẬT KÝ HOẠT ĐỘNG</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <a href="?delete=all"><button type="submit" name="submit" class="btn btn-info"><i class="fa fa-remove"></i> Xóa Tất Cả </button></a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>Username</th>
                                    <th>IP</th>
                                    <th>Count</th>
                                    <th>Content</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
  $i = 0;
  $A12A6 = mysqli_query($conn,"SELECT * FROM `log` ORDER BY id desc limit 0, 1000 ");
  while ($row1 = mysqli_fetch_array($A12A6) ) 
  {?>
                                <tr class="text-center">
                                    <td><?=$i;?> <?php $i++;?></td>
                                    <td><a href="edit-thanh-vien.php?username=<?=$row1['username'];?>">
                                            <?=$row1['username'];?>
                                    </td>
                                    <td><?=$row1['ip'];?></td>
                                    <td><?=$row1['count'];?></td>
                                    <td><?=$row1['content'];?></td>
                                    <td><?=date('d-m-Y H:i:s', $row1['time']);?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        
    </div>



        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#"><?= $setup['name-footer']; ?></a>.</strong> All rights reserved.
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
</body>

</html>
<script>
      $(function () {
        $('#example3').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "order": [[ 3, "desc" ]],
          "autoWidth": true
        });
      });
    </script>
<?php require_once 'script.php'; } else{ require_once '../pages/404.php'; } } ?>