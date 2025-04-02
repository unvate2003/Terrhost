<?php
session_start();
if(empty($_SESSION['username'])){
	session_destroy();
	header('location: /');
	die();
}
include('../core/database.php');
$title = 'Lịch sử mua | ';
include('../layout/head.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");

?>
<div id="content" class="main-content-white" style="padding: 20px;">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">



            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="widget-content">
                        <h4> Lịch Sử Giao Dịch</h4>
                    </div>

                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped nowrap dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sô Lượng</th>
                                    <th>Sản Phẩm</th>
                                    <th>Danh Mục</th>
                                    <th>Thời Gian</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                				$result = mysqli_query($conn,"SELECT * FROM `lich-su-mua` WHERE `username` = '".$_SESSION['username']."' ORDER BY id DESC ");
                				if($result) {
                				while($row = mysqli_fetch_assoc($result)) {
                                  $key_id = $row['key_id'];
                                  $query4 = mysqli_query($conn, "SELECT * FROM `subcategories` WHERE active ='1' AND key_id = '$key_id' ");
                                  $query4 = mysqli_fetch_assoc($query4);
                                  
                                  $query5 = mysqli_query($conn, "SELECT * FROM `tscategory` WHERE Is_Active ='1' AND id = '".$query4['cateid']."' ");
                                  $query5 = mysqli_fetch_assoc($query5);
				                ?>
				                <tr>
                                    <td>
                                        <?php echo $row['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($row['amount']); ?>
                                    </td>
                                    <td>
                                        <a href="<?= 'https://'.$_SERVER['HTTP_HOST'] ?>/lich-su-mua.html?code=<?= $row['time']?>">
                                            <b><?php echo $query4['subcate']; ?></b></a>
                                    </td>
                                    <td>
                                        <a href="<?= 'https://'.$_SERVER['HTTP_HOST'] ?>/lich-su-mua.html?code=<?= $row['time']?>">
                                            <b><?php echo $query5['CategoryName']; ?></b>
                                        </a>
                                    </td>
                                    <td style="width:400px;">
                                        <?php echo 'Đã mua ngày <font color="red"><b>'.date( 'd-m-Y', $row[ 'time']). '</font></b> vào lúc <b><font color="blue"> '.date( 'H:i:s', $row[ 'time']). '</font></b>' ?>
                                    </td>



                                    </td>
                                    <?php } } ?>


                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<!--
       <script>
 function _0xcd89(_0x15ae68,_0x4cc940){var _0x195ed6=_0x195e();return _0xcd89=function(_0xcd896,_0x11d14a){_0xcd896=_0xcd896-0xb4;var _0x159f84=_0x195ed6[_0xcd896];return _0x159f84;},_0xcd89(_0x15ae68,_0x4cc940);}function _0x195e(){var _0x17dfc4=['5366982EdVoyb','3XDrUlu','2907160ZmGcQa','324728NMfFmU','8MxJtkm','4aloTdu','691415RaACFf','3390zkfWcT','1816962DmhCFF','DataTable','desc','5996463VARqPW','13806INTKPG','#example2'];_0x195e=function(){return _0x17dfc4;};return _0x195e();}(function(_0x268fdb,_0x19c0d6){var _0x33708e=_0xcd89,_0x5c83c2=_0x268fdb();while(!![]){try{var _0x4a3577=parseInt(_0x33708e(0xb8))/0x1*(parseInt(_0x33708e(0xba))/0x2)+-parseInt(_0x33708e(0xb6))/0x3*(parseInt(_0x33708e(0xb7))/0x4)+parseInt(_0x33708e(0xbb))/0x5+parseInt(_0x33708e(0xb5))/0x6+-parseInt(_0x33708e(0xbd))/0x7*(parseInt(_0x33708e(0xb9))/0x8)+-parseInt(_0x33708e(0xc1))/0x9*(parseInt(_0x33708e(0xbc))/0xa)+parseInt(_0x33708e(0xc0))/0xb;if(_0x4a3577===_0x19c0d6)break;else _0x5c83c2['push'](_0x5c83c2['shift']());}catch(_0x4909da){_0x5c83c2['push'](_0x5c83c2['shift']());}}}(_0x195e,0xb005b),$(function(){var _0x5f3eb9=_0xcd89;$(_0x5f3eb9(0xb4))[_0x5f3eb9(0xbe)]({'order':[[0x3,_0x5f3eb9(0xbf)]],'paging':!![],'lengthChange':!![],'searching':!![],'ordering':!![],'info':!![],'autoWidth':!![]});}));
</script>
-->
<script>
  $(function () {
    $('#example2').DataTable({
       order: [[0, 'desc']], 
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
<?php
require_once '../layout/script.php';
?>