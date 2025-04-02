<?php
session_start();
if(empty($_SESSION['username'])){
	session_destroy();
	header('location: /');
	die();
}
include('../core/database.php');
include('../layout/head.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");
?>
<div id="content" class="main-content-white" style="padding: 20px;">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                 
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  layout-spacing">
                            <div class="statbox widget">
                                <div class="widget-header">                                
                               
                                            <h5 class="">Nạp Thẻ Tự Động</h5>
                                        
                                </div>
                                <div class="widget-content">
                                    <form><p></p>
                                                                                                      <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Warning - </strong> HÃY KIỂM TRA THẺ CHO CHẮC CHẮN TRƯỚC KHI NẠP, SAI MỆNH GIÁ SẼ MẤT THẺ VÀ KHÔNG ĐƯỢC CỘNG TIỀN !
</div>

<div class="form-group" id="mess">
                    <label>Loại thẻ :</label>
                  <select id="dCategory" name="dCategory" class="form-control">
 <option value="">Chọn loại thẻ</option>
                        <option value="1">Viettel</option>
                        <option value="2">Mobifone</option>
                        <option value="3">Vinaphone</option>
</select>
                </div>
<div class="form-group">
                    <label>Mệnh giá :</label>
                    <select id="dCount" name="dCount" class="form-control">
<option value="">Chọn Mệnh Giá</option>
<option value="10000">10.000</option>
<option value="20000">20.000</option>
<option value="50000">50.000</option>
<option value="100000">100.000</option>
<option value="200000">200.000</option>
<option value="500000">500.000</option>
</select>
                </div>      
        <div class="form-group">
                    <label>Số Seri :</label>
                     <input type="number" placeholder="Nhập Mã Seri"  id="dSeri" name="dSeri" class="form-control">
                </div>
 <div class="form-group">
                    <label>Mã Thẻ :</label>
                    <input type="number" placeholder="Nhập Mã Thẻ" id="dPin" name="dPin" class="form-control">
                </div>
            <div class="form-group text-center">    
<button id="submit" type="submit" class="btn btn-success"><i class="fa fa-money"></i> Nạp Thẻ</button>
     </div>   <div class="form-group" id="list_buy"></div>
                                    
                                    </form>

                                    
                                </div>
                                
                            </div>
                </div>        
                <div class="alert alert-warning" role="alert">
    <center><b>Lưu Ý:</b> Khi Đang Cộng Tiền Website Thì, Không Được Tải Lại Trang Nhé Nạp Thẻ <a href="#" class="alert-link">Chiết Khấu 25% </a>. Nạp Qua Thông Tin Chuyển Khoản Không Mất Chiết Khấu .
</center></div>
               <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
        <th>UID</th>
       	<th>Mệnh giá</th>
       	<th>Số seri</th>	
       	<th>Mã thẻ</th>	
       	<th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                 
                                                                         
        <?php
				$result = mysqli_query($conn,"SELECT * FROM `napthe` WHERE `username` = '".$_SESSION['username']."' ORDER BY id DESC LIMIT 0,50 ");
				if($result)
				{
				while($row = mysqli_fetch_assoc($result))
				{
				?>
               <tr>
                <td><?php echo $row['id']; ?></td>
                 <td><?php echo $row['count_card']; ?></td>
                 <td><?php echo $row['seri_card']; ?></td>
                 <td><?php echo $row['pin_card']; ?></td>
                 <td><?php 
                 if($row['status_card'] == '1'){
                    echo '<p style="color:#00ff00";><b>Thành Công</b></p>';
                 }elseif($row['status_card'] == '0')
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
                 
                 </div>
                 
                 </div>
                 </div>
 <link rel="stylesheet" href="https://v1.tangsub.info/admin/asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">                
<script>
    $('#submit').click(function() {
        var dCategory = $('#dCategory').val();
        var dCount = $('#dCount').val();
        var dSeri = $('#dSeri').val();
        var dPin = $('#dPin').val();
        if (!dCategory) {
            swal("Bạn Chưa Chọn Loại Thẻ", "error");
            return false;
        } else if (!dCount) {
            swal("Bạn Chưa Nhập Mệnh Giá", "error");
            return false;
        } else if (!dSeri) {
            swal("Bạn Chưa Nhập Mã Seri", "error");
            return false;
        } else if (!dPin) {
            swal("Bạn Chưa Nhập Mã Thẻ", "error");
            return false;
        }
        $('#submit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang Xử Lý')
        $.post('../post/napthengay.php', {
            dCategory: dCategory,
            dCount: dCount,
            dSeri: dSeri,
            dPin: dPin

        },  function(data) {
            swal(data['msg'], data['status']);
            $('#submit').prop('disabled', false).html('<i class="fa fa-spinner fa-spin"></i> Nạp Tiếp') 
        }, 'json')

    });
</script>
<div id="trave" style="display: none;">
<?php
require_once '../layout/script.php';
?>