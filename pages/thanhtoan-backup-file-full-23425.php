<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
if(empty($_SESSION['username'])){
header('Location: /');
exit;
}else{
if (xss($_GET['key_id'])){
$key_id = (xss(addslashes($_GET['key_id'])));
$query_post = "SELECT * FROM `san-pham-chua-ban` WHERE key_id = '$key_id' "; 
$result = mysqli_query($conn, $query_post);
$product = mysqli_fetch_array($result); 
$title = "Trang chủ";
require $_SERVER['DOCUMENT_ROOT']."/layout/head.php";
$randstr = randso(5);
$randstr2 = randso(6);
$invoice_code = '#'.$randstr.'';
$order_code = '#'.$randstr2.''; 
?>
<main role="main" class="container">
<?php 
if (xss($_GET['key_id'])){
$key_id = (xss(addslashes($_GET['key_id']))); 
$query_post = "SELECT * FROM `subcategories` WHERE key_id = '$key_id' "; 
$result = mysqli_query($conn, $query_post);
$product = mysqli_fetch_array($result);
$getquery4 = $product['key_id'];
$query4 = mysqli_query($conn, "SELECT * FROM `san-pham-chua-ban` WHERE active ='1' AND subcatekey = '$getquery4' ");
$query4 = mysqli_fetch_assoc($query4);
if (xss(addslashes($_GET['key_id'] == $product['key_id']))){
if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/lich-su-mua.html?code=<?= $time ?>';
            }, 1300);
        <?php }else{ ?>
            swal('<?= $msg ?>',"error");
        <?php } ?>
</script>
<?php
}
?>   
<div class="col-md-12 main">
<div id="mainContent">
<div class="content">
<div class="col-md-8 page_frm">
<div class="panel-group">
<div class="panel panel-success">
<div class="panel-heading">Mua hàng</div>
<div class="panel-body">
 <div class="">
<div class="form-group" id = "mess">
</div>	
<table class="table table-hover table-bordered">
<thead>
<tr>
<th colspan="2" class="warning">Thông tin sản phẩm</th>
</tr>
</thead>
<tbody>
<tr>
<td width="30%" class="info" align="right">
Mã đơn hàng
</td>
<td width="70%" align="left">
<?= $invoice_code ?> </td>
</tr>	
<tr>
<td width="30%" class="info" align="right">
Sản phẩm
</td>
<td width="70%" align="left">
<?= $product['subcate'] ?> </td>
</tr>
<tr>
<td width="30%" class="info" align="right">
Mô tả
</td>
<td width="70%" align="left">
<?= $product['mota'] ?> </td>
</tr>
<tr>
<td width="30%" class="info" align="right">
Số dư ($)
</td>
<td width="70%" align="left">
<?php echo number_format($data['cash'], 0 , '' , '.'); ?> <sup>đ</sup> </td>
</tr>
<tr>
<td width="30%" class="info" align="right">
Giá bán
</td>
<td width="70%" align="left">
<ul class="list-group" style="margin-bottom:0px !important;">
<li class="list-group-item" id=""> <span class="badge" style="background-color: yellow;"><?= number_format($product['rate']); ?><sup>đ</sup></span></li>

</ul></td>
</tr>
<tr>
<td width="30%" class="danger" align="right">
Số lượng mua
</td>
<td width="70%" align="left">
<input type="number" id="soluong" id="soluong" min="1" max="<?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".$key_id."'")) ?>" value="0" style="width:60px;"> 
(tối đa  <?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".$key_id."'")) ?>)
</td>
</tr>
<tr>
<td width="30%" class="info" align="right">
Số tiền phải thanh toán
</td>
<td width="70%" align="left">
<b id="tongthanhtoan">0</b> đ
</td>
</tr>
<tr>
<td width="30%" class="info" align="right">
</td>
<td width="70%" align="left">
<input type="hidden" name="txtCardID" value="1">
<!--button type="submit" class="btn btn-success" name="submitOrder" id="submitOrder">OK - MUA NGAY</button-->
<button id="mua" type="button" class="btn btn-success p-x-md">OK - MUA NGAY</button>

</td>
</tr>
</tbody>
</table>

</div>
</div>
</div>
</div>
</div>
<div class="col-md-4 page_frm">
<div class="panel-group">
<div class="panel panel-danger">
<div class="panel-heading">Lưu ý</div>
<div class="panel-body">
<div style="text-align:justify">
- <?= $setup['alert-payment']; ?><br>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
    <?php 
    }
else{
header('Location: /404');exit;
      }
  }
       else{
header('Location: /404');exit;
      }
  }
      else{
header('Location: /404');exit;
      }

       ?>
    </main>
<link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script type="text/javascript">
$('#mua').click(function(){
				var soluong = $('#soluong').val();
				var loai = '<?= xss(addslashes($_GET['key_id'])); ?>'; 
				
				if(soluong < 0){
					toastr.error('TÍNH BUG À CHÚ EM  !!! ', 'Thông báo');
					$('#mua').prop('disabled', true);
					return;
				}
				if (soluong == '') {
					toastr.error('Vui Lòng Nhập Đầy Đủ Thông Tin  !!! ', 'Thông báo');
					swal('Vui Lòng Nhập Đầy Đủ Thông Tin  !!! ', 'error');
					$('#mua').prop('disabled', true);
					return false;
				}
				if (soluong == 0) {
					toastr.error('Vui Lòng Nhập Đầy Đủ Thông Tin  !!! ', 'Thông báo');
					swal('Vui Lòng Nhập Đầy Đủ Thông Tin  !!! ', 'error');
					$('#mua').prop('disabled', true);
					return false;
				}
				$('#mua').prop('disabled', true);
				    $('#mua').addClass('btn btn-info').html('Đang Lọc Dữ Liệu...').attr('disabled','disabled');
				$.ajax({
					url :'/Query/Order.html',
					type : 'post',
					dataType : 'json',
					data : {
						soluong: soluong,
						loai,loai
					},
					success:function(data) {
					if (data.code == 1)
                {
                	swal(data.msg,'success');
                	setTimeout(function() {
                    window.location.href = '/lich-su-mua.html?code='+data.key;
                }, 2000)
                }
                else
                {
					$("#mess").html(data.msg);
					toastr.error(data.msg, 'Thông Báo');
					swal(data.msg,'error');
					$('#mua').removeClass('btn btn-info').addClass('btn btn-primary').html('OK - MUA NGAY').removeAttr('disabled');
				}
				}
				}); 
			});
			$('#soluong').keyup(function(){
			var soluong = $('#soluong').val();
			var loai = '<?= xss(addslashes($_GET['key_id'])); ?>';
			if(soluong < 0){
				toastr.error('Nạp Tiền Rồi Mua !!! ', 'Thông báo');
				$('#mua').prop('disabled', true);
				return;
			}
			if(soluong == 0){
				toastr.error('Nạp Tiền Rồi Mua !!! ', 'Thông báo');
				$('#mua').prop('disabled', true);
				$('#tongthanhtoan').html(0);
				return;
			}
			if(loai == '<?= xss(addslashes($_GET['key_id'])) ?>' && soluong > <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".xss(addslashes($_GET['key_id']))."' ")); ?>){
				toastr.error('Số Lượng Không Được Lớn Hơn Số Sản Phẩm Đang Có ở Hệ Thống !!! ', 'Thông báo');
				$('#mua').prop('disabled', true);
				return;
			}
			var gia = <?php $query_post = "SELECT * FROM `subcategories` WHERE key_id = '".xss(addslashes($_GET['key_id']))."' "; 
				$result = mysqli_query($conn, $query_post);
				$checksub = mysqli_fetch_array($result);
				echo $gia = $checksub['rate']; ?>;
			var tien = gia * soluong;
			var vnd = <?= $vnd = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `cash` FROM `users` WHERE `username` = '".$_SESSION['username']."'"))['cash']; ?>;
			if(tien > vnd){
				toastr.error('Bạn Không Đủ Tiền Để Mua Số Lượng Này !!! ', 'Thông báo');
				$('#mua').prop('disabled', true);
			}
			$('#tongthanhtoan').html(tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
			$('#mua').prop('disabled', false);
			});
</script>
<?php
require $_SERVER['DOCUMENT_ROOT']."/layout/script.php";
      
}
?>