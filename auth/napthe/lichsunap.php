<?php
session_start();
$_SESSION['username'] = $_COOKIE['idkhach'];
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if(empty($_SESSION['username'])){
	session_destroy();
	header('location: /');
	die();
}
include('../layout/head.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");
?>


<!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">LỊCH SỬ NẠP THẺ </h4>
                </div>
                <div class="pd-20 card-box">
                    <div class="table-responsive mb-4 mt-4">
                        <table id="example1" class="data-table table hover table-bordered table-striped multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">STT</th>
                                    <th>SERI</th>
                                    <th>PIN</th>
                                    <th>LOẠI THẺ</th>
                                    <th>MỆNH GIÁ</th>
                                    <th>THỰC NHẬN</th>
                                    <th>THỜI GIAN</th>
                                    <th>TRẠNG THÁI</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
    <?php
    
    
    $i = 1;
    $gettrangthai = array("<span style='color:#32bf32;'>Bình thường</span>", "<span style='color:red;'>Đã band</span>");
    
    
        $kq_result = mysqli_query($conn, "SELECT * FROM `napthe` WHERE `uid` = '".$username."' AND `loaithe` NOT LIKE 'MOMO'");
    
    while($get = mysqli_fetch_assoc($kq_result)){
        if($get['tinhtrang'] == '0'){
        $thucnhanthe = number_format($get['thucnhan']);
        }elseif($get['tinhtrang'] == '1'){
        $thucnhanthe = number_format($get['thucnhan']);
        }elseif($get['tinhtrang'] == '2'){
        $thucnhanthe = '0';    
        }
    ?>
                                <tr>
                                    <td><?=$i;?> <?php $i++;?></td>
                                    <td><?=$get['seri'];?></td>
                                    <td><?=$get['code'];?></td>
                                    <td><span class="badge badge-danger"><?=$get['loaithe'];?></span></td>
                                    <td><?php echo number_format($get['sotien']); ?><sup></td>
                                    <td><?php echo $thucnhanthe; ?></td>
                                    <td><span class="badge badge-dark"><?php echo date("d/m/Y H:i", $get['time']); ?></span></td>
                                    <td><?php echo get_string_tinhtrangthe($get['tinhtrang']); ?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

<script>
      $(function () {
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "order": [[ 0, "desc" ]],
          "autoWidth": true
        });
      });
</script>
            <!-- Export Datatable End -->

