<?php
session_start();
if(empty($_SESSION['username'])){
	session_destroy();
	header('location: /');
	die();
}
include('../core/database.php');
$title = 'Gửi Tiket Hỗ Trợ | ';
include('../layout/head.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");
if($_GET && $_GET['xoa']){
    $id = $_GET['xoa'];
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `ticket` WHERE `id` = '$id'"));
    if($check){
        $status = true;
        $msg = "Xóa ticket thành công";
        mysqli_query($conn,"DELETE FROM `ticket` WHERE `id` = '$id'");
        //header('Location: /ticket');
    }else {
        $status = false;
        $msg = "Đã có lỗi xảy ra. Vui lòng liên hệ với Admin";
    }
}  
if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/ticket';
            }, 1300);
        <?php }else{ ?>
            swal('<?= $msg ?>',"error");
        <?php } ?>
</script>
<?php
}
?>
<div id="content" class="main-content" style="padding: 20px;">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  layout-spacing">
                            <div class="statbox widget">
                                <div class="widget-header">                                
                               
                                            <h5 class="">Gửi Hỗ Trợ </h5>
                                        
                                </div>
                                <div class="widget-content">
                                    <form><p></p>
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Chức năng đang được thử nghiệm và phát triển! Liên hệ Admin để được hỗ trợ nha</strong>
</div>


<div class="col-md-4">
                Liện Hệ:</br>
                - Facebook: <a href="https://www.facebook.com/123vps/">Facebook Admin</a> (@123vps)
                </br>
                - Telegram: <a href="https://t.me/nthnth123">Telegram Admin</a> (@nthnth123)
                </br>
                - Zalo: <a href="http://zaloapp.com/qr/p/tlub8tbbwxwq">Nguyễn Tiến Hùng</a> (0858.533.566)
                <br>
                - Nhóm Chat Zalo: <a href="https://zalo.me/g/pizbek864">NickVui.Com - Box Chat Zalo</a>
            </div>
<!--
 <div class="form-group">
                    <label>Tiêu Đề</label>
                    <input type="text" placeholder="Vấn Đề Gặp Phải" id="title" name="title" class="form-control">
                </div>
                <div class="table table-striped">
    <label>Nội Dung </label>
    <textarea class="form-control" name="manager" id="manager" rows="4"></textarea>
  </div>
 <div class="form-group text-center">
<button onclick="submit();" id="submit" type="submit" class="btn btn-success btn-rounded"><i class="fa fa-send"></i> Gửi Hỗ Trợ</button>
                                 </div>
                                    </form>

                                    
                                </div>
                                
                            </div>
                </div>        
                
               <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="example2" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
        <th>UID</th>
       	<th>Tài Khoản</th>
       	<th>Tiêu Đề</th>	
       	<th>Nội Dung</th>
       	<th>Thời Gian</th> 	
       	<th>Trạng thái</th>
        <th>Trả Lời Của Admin</th> 
        <th> User Agent</th>
       	<th>Hành Động</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
				$result = mysqli_query($conn,"SELECT * FROM `ticket` WHERE `username` = '".$_SESSION['username']."' ORDER BY id DESC LIMIT 0,5 ");
				if($result)
				{
				while($row = mysqli_fetch_assoc($result))
				{
				?>
               <tr>
                <td><?php echo $row['id']; ?></td>
                 <td><?php echo $row['username']; ?></td>
                 <td><?php echo $row['title']; ?></td>
                 <td><?php echo $row['manager']; ?></td>
                 <td><?php echo $row['time']; ?></td>
              
                 
                 <td><?php 
                 if($row['status'] == '1'){
                    echo '<p style="color:#00ff00";><b>Đã Duyệt </b></p>';
                 }elseif($row['status'] == '0')
                  echo '<p style="color:#FF0000";><b>Chưa Duyệt</b></p>';
                 ?></td>
                 <td><?php echo $row['reply']; ?></td>
                 <td><?php echo $row['useragent']; ?></td>
                 <td><a href="?xoa=<?= $row['id']; ?>"> <button type="submit" class="btn btn-warning">Xóa</button></a>
                 
                 </td>
                 <?php
				}
				}
				?>
                                                                         

            </tr>             
                                    </tbody>
                                     
                                </table>
                            </div>                  
                            
                            
                            
                            
                            -->  
                        </div>  

                 
                 </div>

                 </div>
                 </div>
             
                 </div>
                 
                 </div>
                 </div>

<script>
  $(function () {
    $('#example2').DataTable({
       order: [[3, 'desc']], 
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      //'order': [[ '', 'desc' ]],
      'autoWidth'   : true
    })
  })
</script>
<script type="text/javascript">
        $('#submit').click(function(){
            var _0x58baab=_0x575c;(function(_0x4f5595,_0x59116c){var _0x355f25=_0x575c,_0x2eddac=_0x4f5595();while(!![]){try{var _0x4a6b0b=parseInt(_0x355f25(0xe8))/0x1*(parseInt(_0x355f25(0xeb))/0x2)+-parseInt(_0x355f25(0xe5))/0x3+parseInt(_0x355f25(0xe4))/0x4+-parseInt(_0x355f25(0xe3))/0x5*(parseInt(_0x355f25(0xea))/0x6)+parseInt(_0x355f25(0xec))/0x7+-parseInt(_0x355f25(0xe9))/0x8+-parseInt(_0x355f25(0xef))/0x9*(-parseInt(_0x355f25(0xe7))/0xa);if(_0x4a6b0b===_0x59116c)break;else _0x2eddac['push'](_0x2eddac['shift']());}catch(_0x200897){_0x2eddac['push'](_0x2eddac['shift']());}}}(_0xd615,0xb2acf));var title=$(_0x58baab(0xee))[_0x58baab(0xe6)](),manager=$(_0x58baab(0xed))[_0x58baab(0xe6)]();function _0x575c(_0x9e2738,_0x59f60c){var _0xd615c7=_0xd615();return _0x575c=function(_0x575c1c,_0x4fde24){_0x575c1c=_0x575c1c-0xe3;var _0x4b479f=_0xd615c7[_0x575c1c];return _0x4b479f;},_0x575c(_0x9e2738,_0x59f60c);}if(!title)return swal('Vui\x20Lòng\x20Nhập\x20Tiêu\x20Đề\x20Cần\x20Hỗ\x20Trợ',_0x58baab(0xf0)),![];else{if(!manager)return swal(_0x58baab(0xf1),'info'),![];}function _0xd615(){var _0x23966e=['2hGXJvk','3966837nBbXwC','#manager','#title','63RzWfxV','info','Vui\x20Lòng\x20Nhập\x20Nội\x20Dung\x20Cần\x20Hỗ\x20Trợ','200xpZThv','1837828GbkmWc','3631665aqWgEY','val','3204280bOxWLV','697246DdDeSw','10386400GxQkEC','108852Zwqsiu'];_0xd615=function(){return _0x23966e;};return _0xd615();}
                var _0x4dd97f=_0x35ba;function _0x35ba(_0x9aa1dc,_0x262a24){var _0x78273f=_0x7827();return _0x35ba=function(_0x35ba06,_0x28739b){_0x35ba06=_0x35ba06-0x1c6;var _0xe71449=_0x78273f[_0x35ba06];return _0xe71449;},_0x35ba(_0x9aa1dc,_0x262a24);}(function(_0x301939,_0x2983d0){var _0x1c6a95=_0x35ba,_0x45a2c1=_0x301939();while(!![]){try{var _0x304dc5=parseInt(_0x1c6a95(0x1d1))/0x1+parseInt(_0x1c6a95(0x1c6))/0x2+parseInt(_0x1c6a95(0x1d0))/0x3*(parseInt(_0x1c6a95(0x1d3))/0x4)+-parseInt(_0x1c6a95(0x1cb))/0x5*(-parseInt(_0x1c6a95(0x1d4))/0x6)+-parseInt(_0x1c6a95(0x1cc))/0x7*(-parseInt(_0x1c6a95(0x1c7))/0x8)+-parseInt(_0x1c6a95(0x1ce))/0x9*(-parseInt(_0x1c6a95(0x1d2))/0xa)+-parseInt(_0x1c6a95(0x1c9))/0xb*(parseInt(_0x1c6a95(0x1ca))/0xc);if(_0x304dc5===_0x2983d0)break;else _0x45a2c1['push'](_0x45a2c1['shift']());}catch(_0x2ebf37){_0x45a2c1['push'](_0x45a2c1['shift']());}}}(_0x7827,0x30574),$(_0x4dd97f(0x1cd))[_0x4dd97f(0x1cf)]('disabled',!![])[_0x4dd97f(0x1d5)](_0x4dd97f(0x1c8)));function _0x7827(){var _0x48303a=['prop','10866tAbxRL','299639LPJsTB','2646830KUujKa','388powBxB','831354kbVMQC','html','698996qTjcuW','64lmAfqC','<i\x20class=\x22fa\x20fa-spinner\x20fa-spin\x22></i>\x20Đang\x20Xử\x20Lý','11jbnads','18298512KJqMhT','10CfeLJo','158032TZMfVS','#submit','9mdAGpj'];_0x7827=function(){return _0x48303a;};return _0x7827();}
                $.post('<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/Ticket.html', {
                    title: title,
                    manager: manager
                }, function(data, status) {
                   function _0xda96(_0x210e2e,_0x25db15){var _0x3db317=_0x3db3();return _0xda96=function(_0xda96b4,_0x75c6a9){_0xda96b4=_0xda96b4-0x11f;var _0x5bd0e6=_0x3db317[_0xda96b4];return _0x5bd0e6;},_0xda96(_0x210e2e,_0x25db15);}var _0x21fe1e=_0xda96;function _0x3db3(){var _0x4757e4=['130jPCDYp','#trave','234054uqQasg','30nIUrMs','45604gofOHd','430725zmOVvF','384604JXvTcb','2799588SjXEpi','html','2947848eUFmkK','7bYfHqA','disabled','<i\x20class=\x22fa\x20fa-spinner\x20fa-spin\x22></i>\x20Gửi\x20Thêm','2oGPoRj','1617201FhoMcU','#submit'];_0x3db3=function(){return _0x4757e4;};return _0x3db3();}(function(_0x3e297a,_0x3d6e73){var _0x589d0c=_0xda96,_0x3809b6=_0x3e297a();while(!![]){try{var _0x2604cf=parseInt(_0x589d0c(0x124))/0x1*(parseInt(_0x589d0c(0x12c))/0x2)+parseInt(_0x589d0c(0x121))/0x3+parseInt(_0x589d0c(0x123))/0x4*(-parseInt(_0x589d0c(0x11f))/0x5)+parseInt(_0x589d0c(0x126))/0x6+parseInt(_0x589d0c(0x129))/0x7*(parseInt(_0x589d0c(0x128))/0x8)+parseInt(_0x589d0c(0x12d))/0x9*(-parseInt(_0x589d0c(0x122))/0xa)+parseInt(_0x589d0c(0x125))/0xb;if(_0x2604cf===_0x3d6e73)break;else _0x3809b6['push'](_0x3809b6['shift']());}catch(_0x546dd5){_0x3809b6['push'](_0x3809b6['shift']());}}}(_0x3db3,0x84a3d),$(_0x21fe1e(0x120))['html'](data),$(_0x21fe1e(0x12e))['prop'](_0x21fe1e(0x12a),![])[_0x21fe1e(0x127)](_0x21fe1e(0x12b)));
                });
            });
         
</script>

<div id="trave" style="display: none;">
<?php
require_once '../layout/script.php';
?>