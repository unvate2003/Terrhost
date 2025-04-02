<style>
	/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>	
<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
//if(empty($_SESSION['username'])){
    //header('location: /login');exit;
//}else{

if (xss($_GET['key_id'])){





//$key_id = (xss(addslashes($_GET['key_id'])));
//$query_post = "SELECT * FROM `san-pham-chua-ban` WHERE key_id = '$key_id' "; 
//$result = mysqli_query($conn, $query_post);
//$product = mysqli_fetch_array($result);

$key_id_title = (xss(addslashes($_GET['key_id'])));

$product_title = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `subcategories` WHERE key_id = '$key_id_title' "));

if ($product_title=='') {
    header('location: /404');
    exit;
}

$title = ''.$product_title['subcate'].' | ';

require $_SERVER['DOCUMENT_ROOT']."/layout/head.php";


$randstr = randso(5);
$randstr2 = randso(6);
$invoice_code = '#'.$randstr.'';
$order_code = '#'.$randstr2.'';
$id_count_order = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) FROM `lich-su-mua`")) ['COUNT(*)'];
$id_order = $id_count_order + 1;
?>
<!--
<main role="main" class="container">
-->
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
<div class="row">
    <div class="col-md-12 main">
        <div id="mainContent">
            <div class="content">
                <div class="col-md-8 page_frm">
                    <div class="panel-group">
                        <div class="panel panel-success">
                            <div class="panel-heading">Mua hàng</div>
                            <div class="panel-body">
                                <div class="">
                                    <!--
                                    <form name="orderFrm" id="orderFrm" action="" method="post" role="form" style="">
                                    -->
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan='2' class="warning">Thông tin sản phẩm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="30%" class="info" align="right">
                                                        Mã đơn hàng
                                                    </td>
                                                    <td width="70%" align="left">
                                                        <b>#<?= $id_order ?></b>
                                                    </td>
                                                </tr>	
                                                <tr>
                                                    <td width="30%" class="info" align="right">
                                                        Sản phẩm
                                                    </td>
                                                    <td width="70%" align="left">
                                                        <?= $product['subcate'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="30%" class="info" align="right">
                                                        Mô tả
                                                    </td>
                                                    <td width="70%" align="left">
                                                        <?= $product['mota'] ?> </td>
                                                </tr>
                                                <?php
                                                if(!empty($_SESSION['username'])){
                                                ?>
                                                <tr>
                                                    <td width="30%" class="info" align="right">
                                                        Số dư (VND)
                                                    </td>
                                                    <td width="70%" align="left">
                                                        <?php echo number_format($data['cash'], 0 , '' , '.'); ?>đ</td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td width="30%" class="info" align="right">
                                                        Giá bán
                                                    </td>
                                                    <td width="70%" align="left">
                                                        <ul class="list-group" style="margin-bottom:0px !important;">
                                                            <li class="list-group-item" id=""><b><?= number_format($product['rate']); ?></b>đ</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%" class="info" align="right">
                                                        Số lượng kho
                                                    </td>
                                                    <td width="70%" align="left">
                                                        <?= number_format(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".$key_id."'"))) ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%" class="danger" align="right">
                                                        Số lượng mua
                                                    </td>
                                                    <td width="70%" align="left">
                                                        <input type="number" id="soluong" id="soluong" min="1" max="<?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".$key_id."'")) ?>" value="0" style="width:80px;"> 
                                                            (tối đa  <?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".$key_id."'")) ?>)
                                                    </td>
                                                </tr>
                                                <?php
                                                if(!empty($_SESSION['username'])){
                                                ?>
                                                <tr>
                                                    <td width="30%" class="danger" align="right">
                                                        Số tiền phải thanh toán
                                                    </td>
                                                    <td width="70%" align="left">
                                                        <b id="tongthanhtoan">0</b> đ
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
        
                                                    <td width="30%" class="info" align="right">
                                                    </td>
        
                                                    <td width="70%" align="left">
                                                        <input type="hidden" name="txtCardID" value="1">
                                                        <!--button type="submit" class="btn btn-success" name="submitOrder" id="submitOrder">OK - MUA NGAY</button-->
                                                        <?php
                                                        if(!empty($_SESSION['username'])){
                                                        ?>
                                                        <button id="mua" type="button" class="btn btn-success p-x-md">OK - MUA NGAY</button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                        <button onclick="location.href='/login'" type="button" class="btn btn-success p-x-md">Cần Đăng Nhập Để Thanh Toán</button>
                                                        <?php
                                                        }
                                                        ?>
        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--
                                    </form>
                                    -->
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
                                    - <?= $setup['alert-payment']; ?>
                                        <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php 
    } else{
    header('location: /');exit;
    }
    
    } else{
    header('location: /');exit;
    }
    
    
    } else{
    header('location: /');exit;
    }

       ?>
<!--
</main>
-->
<?php
if(!empty($_SESSION['username'])){
?>
<script type="text/javascript">
                
$('#mua').click(function(){
                toastr.remove();
				var soluong = $('#soluong').val();
				var loai = '<?= xss(addslashes($_GET['key_id'])); ?>';
				
				var gia = <?php $query_post = "SELECT * FROM `subcategories` WHERE key_id = '".xss(addslashes($_GET['key_id']))."' "; 
				$result = mysqli_query($conn, $query_post);
				$checksub = mysqli_fetch_array($result);
				echo $gia = $checksub['rate']; ?>;
			    var tien = gia * soluong;
			    var vnd = <?= $vnd = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `cash` FROM `users` WHERE `username` = '".$_SESSION['username']."'"))['cash']; ?>;

				if (soluong == '') {
					toastr.error('Vui Lòng Nhập Số Lượng Mua!', 'Thông báo');
					swal('Vui Lòng Nhập Số Lượng Mua!', 'error');
					$('#mua').prop('disabled', true);
					return false;
				} else
				if(soluong < 0){
					toastr.error('Số Lượng Mua Không Hợp Lệ!', 'Thông báo');
					swal('Số Lượng Mua Không Hợp Lệ!', 'error');
					$('#mua').prop('disabled', true);
					return false;
				} else
				if (soluong == 0) {
					toastr.error('Vui Lòng Nhập Số Lượng Mua!', 'Thông báo');
					swal('Vui Lòng Nhập Số Lượng Mua!', 'error');
					$('#mua').prop('disabled', true);
					return false;
				} else
				if(loai == '<?= xss(addslashes($_GET['key_id'])) ?>' && soluong > <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".xss(addslashes($_GET['key_id']))."' ")); ?>){
				    toastr.error('Số Lượng Mua Không Được Lớn Hơn Số Lượng Kho Đang Có!', 'Thông Báo');
				    swal('Số Lượng Mua Không Được Lớn Hơn Số Lượng Kho Đang Có!', 'error');
				    $('#mua').prop('disabled', true);
					return false;
				} else
				/*
				var gia = <?php $query_post = "SELECT * FROM `subcategories` WHERE key_id = '".xss(addslashes($_GET['key_id']))."' "; 
				$result = mysqli_query($conn, $query_post);
				$checksub = mysqli_fetch_array($result);
				echo $gia = $checksub['rate']; ?>;
			    var tien = gia * soluong;
			    var vnd = <?= $vnd = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `cash` FROM `users` WHERE `username` = '".$_SESSION['username']."'"))['cash']; ?>;
			    */
			    if(tien > vnd){
			    	toastr.error('Bạn Không Đủ Tiền Để Mua Số Lượng Này!', 'Thông báo');
			    	swal('Bạn Không Đủ Tiền Để Mua Số Lượng Này!', 'error');
				    $('#mua').prop('disabled', true);
				    return false;
			    } else {
				
			    $('#mua').addClass('btn btn-info').html('Đang Lọc Dữ Liệu...').attr('disabled','disabled');
			    toastr.options.timeOut = 0;
                toastr.options.extendedTimeOut = 0;
			    toastr.success('Đang Lọc Dữ Liệu...', 'Thông báo');
			    }
			    
			    
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
                    toastr.success("Mua Thành Công", "Thông báo");
                	swal(data.msg,'success');
                	setTimeout(function() {
                    window.location.href = '/lich-su-mua.html?code='+data.key;
                }, 1300)
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
            toastr.remove();
			var soluong = $('#soluong').val();
			var loai = '<?= xss(addslashes($_GET['key_id'])); ?>';
			
			var gia = <?php $query_post = "SELECT * FROM `subcategories` WHERE key_id = '".xss(addslashes($_GET['key_id']))."' "; 
			$result = mysqli_query($conn, $query_post);
			$checksub = mysqli_fetch_array($result);
			echo $gia = $checksub['rate']; ?>;
			var tien = gia * soluong;
			var vnd = <?= $vnd = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `cash` FROM `users` WHERE `username` = '".$_SESSION['username']."'"))['cash']; ?>;
			if(soluong < ''){
				toastr.error('Vui Lòng Nhập Số Lượng Mua!', 'Thông báo');
				$('#tongthanhtoan').html(0);
				$('#mua').prop('disabled', true);
				
				return false;
			} else
			if(soluong < 0){
				toastr.error('Số Lượng Mua Không Hợp Lệ!', 'Thông báo');
				$('#tongthanhtoan').html(0);
				$('#mua').prop('disabled', true);

				return false;
			} else
			if(soluong == 0){
				toastr.error('Vui Lòng Nhập Số Lượng Mua!', 'Thông báo');
				$('#tongthanhtoan').html(0);
				$('#mua').prop('disabled', true);
				
				return false;
			} else
			/*
			if(soluong > <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".xss(addslashes($_GET['key_id']))."' ")); ?>){
				toastr.error('Vui Lòng Nhập Số Lượng Mua!', 'Thông báo');
				$('#tongthanhtoan').html(0);
				$('#mua').prop('disabled', true);
				
				return;
			}
			*/
			if(loai == '<?= xss(addslashes($_GET['key_id'])) ?>' && soluong > <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".xss(addslashes($_GET['key_id']))."' ")); ?>){
				toastr.error('Số Lượng Mua Không Được Lớn Hơn Số Lượng Kho Đang Có!', 'Thông báo');
				$('#tongthanhtoan').html(0);
				$('#mua').prop('disabled', true);
				
				return false;
			} else
			/*
			var gia = <?php $query_post = "SELECT * FROM `subcategories` WHERE key_id = '".xss(addslashes($_GET['key_id']))."' "; 
				$result = mysqli_query($conn, $query_post);
				$checksub = mysqli_fetch_array($result);
				echo $gia = $checksub['rate']; ?>;
			var tien = gia * soluong;
			var vnd = <?= $vnd = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `cash` FROM `users` WHERE `username` = '".$_SESSION['username']."'"))['cash']; ?>;
			*/
			if(tien > vnd){
				toastr.error('Bạn Không Đủ Tiền Để Mua Số Lượng Này!', 'Thông báo');
				$('#tongthanhtoan').html(tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
				$('#mua').prop('disabled', true);
				
				return false;
			} else {
			
			$('#tongthanhtoan').html(tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
			$('#mua').prop('disabled', false);
			}
			
			});
</script>
<?php
}
require $_SERVER['DOCUMENT_ROOT']."/layout/script.php";
//}
?>