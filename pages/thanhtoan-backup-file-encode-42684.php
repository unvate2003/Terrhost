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
				function _0x2534(){var _0x315be0=['1407326uzcKap','322224ldTGnn','1598448AykPNc','108BRRCkS','1624044DgIHaf','8239544kOUObM','7RvsQkJ','119295gpsmrL','9vhGAOW','121MTuIvT','3wDjEAR','9897830roPtPU'];_0x2534=function(){return _0x315be0;};return _0x2534();}(function(_0x565415,_0xf25a44){var _0x45701b=_0x4b85,_0x202b8d=_0x565415();while(!![]){try{var _0x23001c=parseInt(_0x45701b(0x10c))/0x1+-parseInt(_0x45701b(0x10b))/0x2*(parseInt(_0x45701b(0x115))/0x3)+parseInt(_0x45701b(0x10e))/0x4*(parseInt(_0x45701b(0x112))/0x5)+-parseInt(_0x45701b(0x10f))/0x6+-parseInt(_0x45701b(0x111))/0x7*(-parseInt(_0x45701b(0x110))/0x8)+-parseInt(_0x45701b(0x113))/0x9*(-parseInt(_0x45701b(0x10a))/0xa)+-parseInt(_0x45701b(0x114))/0xb*(parseInt(_0x45701b(0x10d))/0xc);if(_0x23001c===_0xf25a44)break;else _0x202b8d['push'](_0x202b8d['shift']());}catch(_0x5628f6){_0x202b8d['push'](_0x202b8d['shift']());}}}(_0x2534,0x85702));function _0x4b85(_0x423cb1,_0x2fdd22){var _0x253464=_0x2534();return _0x4b85=function(_0x4b857d,_0x5494a8){_0x4b857d=_0x4b857d-0x10a;var _0x535f31=_0x253464[_0x4b857d];return _0x535f31;},_0x4b85(_0x423cb1,_0x2fdd22);}var soluong=$('#soluong')['val']();
				var loai = '<?= xss(addslashes($_GET['key_id'])); ?>'; 
				
				var _0x46433d=_0x3890;function _0x3890(_0x4799b3,_0x4dde98){var _0x5e65c1=_0x5e65();return _0x3890=function(_0x3890f6,_0x408a37){_0x3890f6=_0x3890f6-0xda;var _0x4e8d26=_0x5e65c1[_0x3890f6];return _0x4e8d26;},_0x3890(_0x4799b3,_0x4dde98);}(function(_0x4f79d3,_0x542044){var _0x371ebd=_0x3890,_0x37b2a6=_0x4f79d3();while(!![]){try{var _0x201702=parseInt(_0x371ebd(0xeb))/0x1+-parseInt(_0x371ebd(0xec))/0x2*(parseInt(_0x371ebd(0xfb))/0x3)+-parseInt(_0x371ebd(0xe0))/0x4+-parseInt(_0x371ebd(0xdc))/0x5*(-parseInt(_0x371ebd(0xdd))/0x6)+parseInt(_0x371ebd(0xe2))/0x7*(parseInt(_0x371ebd(0xe6))/0x8)+-parseInt(_0x371ebd(0xe8))/0x9*(-parseInt(_0x371ebd(0xf1))/0xa)+parseInt(_0x371ebd(0xf6))/0xb*(-parseInt(_0x371ebd(0xfc))/0xc);if(_0x201702===_0x542044)break;else _0x37b2a6['push'](_0x37b2a6['shift']());}catch(_0x5a757f){_0x37b2a6['push'](_0x37b2a6['shift']());}}}(_0x5e65,0x49715));function _0x5e65(){var _0x4f2d19=['4918QKviTi','#mua','key','prop','TÍNH\x20BUG\x20À\x20CHÚ\x20EM\x20\x20!!!\x20','1700890BPCxbk','btn\x20btn-info','error','Thông\x20Báo','#mess','88qjAiVN','removeClass','removeAttr','btn\x20btn-primary','code','183DSxSeK','301116lXBvMI','href','attr','5gXOuWy','1989336tGyxFN','/lich-su-mua.html?code=','addClass','89728NPMkNv','location','420SSpNox','/Query/Order.html','Vui\x20Lòng\x20Nhập\x20Đầy\x20Đủ\x20Thông\x20Tin\x20\x20!!!\x20','disabled','20184NQTnSf','msg','9FykMgJ','OK\x20-\x20MUA\x20NGAY','Thông\x20báo','20971HBbzic'];_0x5e65=function(){return _0x4f2d19;};return _0x5e65();}if(soluong<0x0){toastr[_0x46433d(0xf3)](_0x46433d(0xf0),'Thông\x20báo'),$(_0x46433d(0xed))['prop'](_0x46433d(0xe5),!![]);return;}if(soluong=='')return toastr['error'](_0x46433d(0xe4),_0x46433d(0xea)),swal(_0x46433d(0xe4),_0x46433d(0xf3)),$(_0x46433d(0xed))[_0x46433d(0xef)]('disabled',!![]),![];if(soluong==0x0)return toastr['error'](_0x46433d(0xe4),_0x46433d(0xea)),swal('Vui\x20Lòng\x20Nhập\x20Đầy\x20Đủ\x20Thông\x20Tin\x20\x20!!!\x20',_0x46433d(0xf3)),$(_0x46433d(0xed))[_0x46433d(0xef)](_0x46433d(0xe5),!![]),![];$(_0x46433d(0xed))[_0x46433d(0xef)](_0x46433d(0xe5),!![]),$(_0x46433d(0xed))[_0x46433d(0xdf)](_0x46433d(0xf2))['html']('Đang\x20Lọc\x20Dữ\x20Liệu...')[_0x46433d(0xdb)](_0x46433d(0xe5),_0x46433d(0xe5)),$['ajax']({'url':_0x46433d(0xe3),'type':'post','dataType':'json','data':{'soluong':soluong,'loai':loai,'loai':loai},'success':function(_0x2c809c){var _0x10a02d=_0x46433d;_0x2c809c[_0x10a02d(0xfa)]==0x1?(swal(_0x2c809c[_0x10a02d(0xe7)],'success'),setTimeout(function(){var _0x55f4b7=_0x10a02d;window[_0x55f4b7(0xe1)][_0x55f4b7(0xda)]=_0x55f4b7(0xde)+_0x2c809c[_0x55f4b7(0xee)];},0x7d0)):($(_0x10a02d(0xf5))['html'](_0x2c809c[_0x10a02d(0xe7)]),toastr['error'](_0x2c809c[_0x10a02d(0xe7)],_0x10a02d(0xf4)),swal(_0x2c809c['msg'],_0x10a02d(0xf3)),$(_0x10a02d(0xed))[_0x10a02d(0xf7)]('btn\x20btn-info')[_0x10a02d(0xdf)](_0x10a02d(0xf9))['html'](_0x10a02d(0xe9))[_0x10a02d(0xf8)](_0x10a02d(0xe5)));}});
			});
			$('#soluong').keyup(function(){
			var _0x39450a=_0x3942;function _0x3942(_0x4bd445,_0x1d0872){var _0x3ede93=_0x3ede();return _0x3942=function(_0x394286,_0x534b99){_0x394286=_0x394286-0x1ec;var _0x2d71e7=_0x3ede93[_0x394286];return _0x2d71e7;},_0x3942(_0x4bd445,_0x1d0872);}function _0x3ede(){var _0x40bec9=['15uWcSJb','#soluong','95QihfKk','948114SNdZLo','816476AavBcP','13414401PMHYZb','322832ZFQWBD','157338CsVHbq','287EJuMFv','3858500imJOfE','9JypLmp','4902EBDUsK'];_0x3ede=function(){return _0x40bec9;};return _0x3ede();}(function(_0x114218,_0x424290){var _0x1bb7f3=_0x3942,_0x525b39=_0x114218();while(!![]){try{var _0x16c142=parseInt(_0x1bb7f3(0x1f1))/0x1*(-parseInt(_0x1bb7f3(0x1ee))/0x2)+-parseInt(_0x1bb7f3(0x1f2))/0x3+-parseInt(_0x1bb7f3(0x1f3))/0x4*(-parseInt(_0x1bb7f3(0x1ef))/0x5)+-parseInt(_0x1bb7f3(0x1f6))/0x6*(parseInt(_0x1bb7f3(0x1f7))/0x7)+parseInt(_0x1bb7f3(0x1f5))/0x8*(parseInt(_0x1bb7f3(0x1ed))/0x9)+parseInt(_0x1bb7f3(0x1ec))/0xa+parseInt(_0x1bb7f3(0x1f4))/0xb;if(_0x16c142===_0x424290)break;else _0x525b39['push'](_0x525b39['shift']());}catch(_0x4b0991){_0x525b39['push'](_0x525b39['shift']());}}}(_0x3ede,0x9acaa));var soluong=$(_0x39450a(0x1f0))['val']();
			var loai = '<?= xss(addslashes($_GET['key_id'])); ?>';
			var _0x382a4e=_0x2e41;(function(_0x4da7cd,_0x1796bb){var _0xa116a2=_0x2e41,_0x5d6fc6=_0x4da7cd();while(!![]){try{var _0x133288=-parseInt(_0xa116a2(0x1ce))/0x1+-parseInt(_0xa116a2(0x1db))/0x2*(-parseInt(_0xa116a2(0x1da))/0x3)+parseInt(_0xa116a2(0x1d7))/0x4*(parseInt(_0xa116a2(0x1de))/0x5)+parseInt(_0xa116a2(0x1e0))/0x6*(-parseInt(_0xa116a2(0x1d5))/0x7)+-parseInt(_0xa116a2(0x1d1))/0x8*(parseInt(_0xa116a2(0x1dd))/0x9)+-parseInt(_0xa116a2(0x1cf))/0xa*(-parseInt(_0xa116a2(0x1d6))/0xb)+-parseInt(_0xa116a2(0x1dc))/0xc*(parseInt(_0xa116a2(0x1cd))/0xd);if(_0x133288===_0x1796bb)break;else _0x5d6fc6['push'](_0x5d6fc6['shift']());}catch(_0x13c89e){_0x5d6fc6['push'](_0x5d6fc6['shift']());}}}(_0x585a,0xe577a));if(soluong<0x0){toastr[_0x382a4e(0x1d4)](_0x382a4e(0x1df),_0x382a4e(0x1d0)),$('#mua')['prop'](_0x382a4e(0x1d2),!![]);return;}function _0x2e41(_0x376fe5,_0x3acfea){var _0x585aae=_0x585a();return _0x2e41=function(_0x2e41b,_0x244542){_0x2e41b=_0x2e41b-0x1cd;var _0x3acc95=_0x585aae[_0x2e41b];return _0x3acc95;},_0x2e41(_0x376fe5,_0x3acfea);}if(soluong==0x0){toastr['error']('Nạp\x20Tiền\x20Rồi\x20Mua\x20!!!\x20',_0x382a4e(0x1d0)),$(_0x382a4e(0x1d8))['prop'](_0x382a4e(0x1d2),!![]),$(_0x382a4e(0x1d3))[_0x382a4e(0x1d9)](0x0);return;}function _0x585a(){var _0x314d14=['183285SUQJbV','145oMnLJF','Nạp\x20Tiền\x20Rồi\x20Mua\x20!!!\x20','6tBVdPq','675649mXFWhZ','249798FPODFa','11517370YipwyM','Thông\x20báo','56sfpLjf','disabled','#tongthanhtoan','error','2822386oVkeBa','11aDNOZf','113936RjPJLA','#mua','html','2859165IuhPNF','2NWfLKM','276HLOGza'];_0x585a=function(){return _0x314d14;};return _0x585a();}
			if(loai == '<?= xss(addslashes($_GET['key_id'])) ?>' && soluong > <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".xss(addslashes($_GET['key_id']))."' ")); ?>){
				function _0x3c8a(){var _0x319d3b=['8496156KjxgVD','3812MkmORk','1728940hBaYIJ','#mua','12809601DuBlOc','920IfrHMd','5GVDjyq','Số\x20Lượng\x20Không\x20Được\x20Lớn\x20Hơn\x20Số\x20Sản\x20Phẩm\x20Đang\x20Có\x20ở\x20Hệ\x20Thống\x20!!!\x20','325000stQiaQ','error','60894GSiAgL','prop','1422ibmDzZ','27626680uAumMp'];_0x3c8a=function(){return _0x319d3b;};return _0x3c8a();}var _0x321633=_0x2617;function _0x2617(_0x47f399,_0x1617e0){var _0x3c8a79=_0x3c8a();return _0x2617=function(_0x2617ed,_0x272439){_0x2617ed=_0x2617ed-0x17d;var _0x3c0eea=_0x3c8a79[_0x2617ed];return _0x3c0eea;},_0x2617(_0x47f399,_0x1617e0);}(function(_0x1e72d7,_0x432fdf){var _0x36667e=_0x2617,_0x52e208=_0x1e72d7();while(!![]){try{var _0x46af8f=parseInt(_0x36667e(0x186))/0x1+-parseInt(_0x36667e(0x185))/0x2*(-parseInt(_0x36667e(0x182))/0x3)+-parseInt(_0x36667e(0x17e))/0x4+parseInt(_0x36667e(0x18a))/0x5*(-parseInt(_0x36667e(0x184))/0x6)+parseInt(_0x36667e(0x188))/0x7+-parseInt(_0x36667e(0x189))/0x8*(-parseInt(_0x36667e(0x180))/0x9)+-parseInt(_0x36667e(0x183))/0xa;if(_0x46af8f===_0x432fdf)break;else _0x52e208['push'](_0x52e208['shift']());}catch(_0x5c1787){_0x52e208['push'](_0x52e208['shift']());}}}(_0x3c8a,0xef5f9),toastr[_0x321633(0x17f)](_0x321633(0x17d),'Thông\x20báo'),$(_0x321633(0x187))[_0x321633(0x181)]('disabled',!![]));return;
			}
			var gia = <?php $query_post = "SELECT * FROM `subcategories` WHERE key_id = '".xss(addslashes($_GET['key_id']))."' "; 
				$result = mysqli_query($conn, $query_post);
				$checksub = mysqli_fetch_array($result);
				echo $gia = $checksub['rate']; ?>;
			var tien = gia * soluong;
			var vnd = <?= $vnd = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `cash` FROM `users` WHERE `username` = '".$_SESSION['username']."'"))['cash']; ?>;
			function _0x38cb(){var _0x51d54b=['Thông\x20báo','1100157pVfYuJ','prop','303284YOogmx','4BYpGNd','2737716xTzIYn','error','6XGxLSG','47050IFFafw','9224696ILfsmf','5405981oxZvsj','4589380mIZVZK','6633CvrRkR','Bạn\x20Không\x20Đủ\x20Tiền\x20Để\x20Mua\x20Số\x20Lượng\x20Này\x20!!!\x20'];_0x38cb=function(){return _0x51d54b;};return _0x38cb();}var _0x1829ff=_0x4a82;(function(_0x4d0f8f,_0x371c3f){var _0x35b45b=_0x4a82,_0x58d860=_0x4d0f8f();while(!![]){try{var _0x477ef1=-parseInt(_0x35b45b(0x10a))/0x1+-parseInt(_0x35b45b(0xfe))/0x2+-parseInt(_0x35b45b(0x100))/0x3+parseInt(_0x35b45b(0xff))/0x4*(-parseInt(_0x35b45b(0x106))/0x5)+-parseInt(_0x35b45b(0x102))/0x6*(parseInt(_0x35b45b(0x105))/0x7)+parseInt(_0x35b45b(0x104))/0x8+parseInt(_0x35b45b(0x107))/0x9*(parseInt(_0x35b45b(0x103))/0xa);if(_0x477ef1===_0x371c3f)break;else _0x58d860['push'](_0x58d860['shift']());}catch(_0x50c897){_0x58d860['push'](_0x58d860['shift']());}}}(_0x38cb,0xbb0be));function _0x4a82(_0x49a786,_0x1f4528){var _0x38cb55=_0x38cb();return _0x4a82=function(_0x4a821d,_0x4f43ff){_0x4a821d=_0x4a821d-0xfd;var _0x17f9f0=_0x38cb55[_0x4a821d];return _0x17f9f0;},_0x4a82(_0x49a786,_0x1f4528);}tien>vnd&&(toastr[_0x1829ff(0x101)](_0x1829ff(0x108),_0x1829ff(0x109)),$('#mua')[_0x1829ff(0xfd)]('disabled',!![]));
			var _0x53235d=_0x4a3d;function _0x4a3d(_0x39fbe3,_0x2aff9d){var _0x557cae=_0x557c();return _0x4a3d=function(_0x4a3d19,_0x59ba6c){_0x4a3d19=_0x4a3d19-0xae;var _0x2f2bd4=_0x557cae[_0x4a3d19];return _0x2f2bd4;},_0x4a3d(_0x39fbe3,_0x2aff9d);}function _0x557c(){var _0x19c7d8=['30269jLzgGB','disabled','3408320xCwzRV','toString','replace','2686461gPcIZz','14568okRydW','3366EMxOLH','21639288CAQIDf','prop','7575kYgTUQ','#mua','9fLlObA','2FxBqRb','11720780WGaMBI','3136wtiIlo'];_0x557c=function(){return _0x19c7d8;};return _0x557c();}(function(_0x94c571,_0x55fe12){var _0x232c40=_0x4a3d,_0x38bb7a=_0x94c571();while(!![]){try{var _0x1f93c6=-parseInt(_0x232c40(0xbb))/0x1+parseInt(_0x232c40(0xb8))/0x2*(-parseInt(_0x232c40(0xb0))/0x3)+-parseInt(_0x232c40(0xbd))/0x4+-parseInt(_0x232c40(0xb5))/0x5*(-parseInt(_0x232c40(0xb2))/0x6)+-parseInt(_0x232c40(0xba))/0x7*(-parseInt(_0x232c40(0xb1))/0x8)+-parseInt(_0x232c40(0xb7))/0x9*(parseInt(_0x232c40(0xb9))/0xa)+parseInt(_0x232c40(0xb3))/0xb;if(_0x1f93c6===_0x55fe12)break;else _0x38bb7a['push'](_0x38bb7a['shift']());}catch(_0x7e35aa){_0x38bb7a['push'](_0x38bb7a['shift']());}}}(_0x557c,0xa6c09),$('#tongthanhtoan')['html'](tien[_0x53235d(0xae)]()[_0x53235d(0xaf)](/(\d)(?=(\d{3})+(?!\d))/g,'$1,')),$(_0x53235d(0xb6))[_0x53235d(0xb4)](_0x53235d(0xbc),![]));
			});
</script>
<?php
require $_SERVER['DOCUMENT_ROOT']."/layout/script.php";
      
}
?>