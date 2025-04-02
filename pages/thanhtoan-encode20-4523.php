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
				function _0x17dd(_0x4a35bc,_0x44fcb5){var _0x1d181c=_0x1d18();return _0x17dd=function(_0x17ddac,_0xfbe22d){_0x17ddac=_0x17ddac-0x1dd;var _0x20aea7=_0x1d181c[_0x17ddac];return _0x20aea7;},_0x17dd(_0x4a35bc,_0x44fcb5);}var _0x2b1ad1=_0x17dd;(function(_0x4a9497,_0x2a4876){var _0x4ae3e2=_0x17dd,_0x4c41f9=_0x4a9497();while(!![]){try{var _0x15e058=-parseInt(_0x4ae3e2(0x1f1))/0x1*(parseInt(_0x4ae3e2(0x1df))/0x2)+-parseInt(_0x4ae3e2(0x1e7))/0x3+parseInt(_0x4ae3e2(0x1e1))/0x4+parseInt(_0x4ae3e2(0x1e3))/0x5+parseInt(_0x4ae3e2(0x1dd))/0x6+parseInt(_0x4ae3e2(0x1eb))/0x7+-parseInt(_0x4ae3e2(0x1ea))/0x8;if(_0x15e058===_0x2a4876)break;else _0x4c41f9['push'](_0x4c41f9['shift']());}catch(_0x40038a){_0x4c41f9['push'](_0x4c41f9['shift']());}}}(_0x1d18,0x4cb12));if(soluong<0x0){toastr[_0x2b1ad1(0x1e6)](_0x2b1ad1(0x1f7),_0x2b1ad1(0x1de)),$('#mua')[_0x2b1ad1(0x1fb)](_0x2b1ad1(0x1e5),!![]);return;}if(soluong=='')return toastr[_0x2b1ad1(0x1e6)]('Vui\x20Lòng\x20Nhập\x20Đầy\x20Đủ\x20Thông\x20Tin\x20\x20!!!\x20',_0x2b1ad1(0x1de)),swal(_0x2b1ad1(0x1f2),_0x2b1ad1(0x1e6)),![];if(soluong==0x0)return toastr[_0x2b1ad1(0x1e6)](_0x2b1ad1(0x1f2),'Thông\x20báo'),swal(_0x2b1ad1(0x1f2),_0x2b1ad1(0x1e6)),![];$(_0x2b1ad1(0x1fc))[_0x2b1ad1(0x1fb)](_0x2b1ad1(0x1e5),!![]),$(_0x2b1ad1(0x1fc))['addClass'](_0x2b1ad1(0x1e8))[_0x2b1ad1(0x1f6)](_0x2b1ad1(0x1f5))[_0x2b1ad1(0x1ec)](_0x2b1ad1(0x1e5),_0x2b1ad1(0x1e5)),$[_0x2b1ad1(0x1f8)]({'url':_0x2b1ad1(0x1e9),'type':_0x2b1ad1(0x1ee),'dataType':'json','data':{'soluong':soluong,'loai':loai,'loai':loai},'success':function(_0x505b76){var _0x34fd2d=_0x2b1ad1;_0x505b76[_0x34fd2d(0x1f0)]==0x1?(swal(_0x505b76[_0x34fd2d(0x1fa)],_0x34fd2d(0x1f3)),setTimeout(function(){var _0x54b588=_0x34fd2d;window[_0x54b588(0x1fd)]['href']=_0x54b588(0x1e0)+_0x505b76[_0x54b588(0x1f9)];},0x7d0)):($('#mess')['html'](_0x505b76['msg']),toastr[_0x34fd2d(0x1e6)](_0x505b76[_0x34fd2d(0x1fa)],_0x34fd2d(0x1e4)),swal(_0x505b76['msg'],'error'),$('#mua')[_0x34fd2d(0x1ed)](_0x34fd2d(0x1e8))[_0x34fd2d(0x1ef)]('btn\x20btn-primary')[_0x34fd2d(0x1f6)](_0x34fd2d(0x1e2))[_0x34fd2d(0x1f4)](_0x34fd2d(0x1e5)));}});function _0x1d18(){var _0xe552a8=['attr','removeClass','post','addClass','code','1nrpWzW','Vui\x20Lòng\x20Nhập\x20Đầy\x20Đủ\x20Thông\x20Tin\x20\x20!!!\x20','success','removeAttr','Đang\x20Lọc\x20Dữ\x20Liệu...','html','TÍNH\x20BUG\x20À\x20CHÚ\x20EM\x20\x20!!!\x20','ajax','key','msg','prop','#mua','location','2939496TctySC','Thông\x20báo','955460lPxSwS','/lich-su-mua.html?code=','2096584oVmPcI','OK\x20-\x20MUA\x20NGAY','987335RdbnEB','Thông\x20Báo','disabled','error','1183308rzmEzV','btn\x20btn-info','/Query/Order.html','4628128BLSCAo','3872981Capvha'];_0x1d18=function(){return _0xe552a8;};return _0x1d18();}
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