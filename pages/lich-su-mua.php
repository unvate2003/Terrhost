<?php
/*
|---------------------------------------------------------|
|                   CODER NGUYỄN HỢP                  |
|                    ZALO : RIN1906                    |
|---------------------------------------------------------|
*/
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('location: /');exit;
}else{
$title = 'Nội Dung Đơn Hàng | ';
require_once '../layout/head.php';
$code = $_GET['code'];
$total = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `lich-su-mua` WHERE `time` = '$code' AND `username` = '$username'"));
if($total) {
?>
       

        <!--  END SIDEBAR  -->
<div id="content" class="main-content" style="padding: 20px;">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">



            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="statbox widget">
                    <div class="widget-header">
                        <h4>Thông Tin Đơn Hàng</h4>
                        <?php
                        $result = mysqli_query($conn,"SELECT * FROM `lich-su-mua` WHERE `time` = '$code'and `username` = '".$_SESSION['username']."'");
                		if($result) {
                			$row = mysqli_fetch_assoc($result);
                            $key_id = $row['key_id'];
                            $query4 = mysqli_query($conn, "SELECT * FROM `subcategories` WHERE active ='1' AND key_id = '$key_id' ");
                            $query4 = mysqli_fetch_assoc($query4);
                                  
                            $query5 = mysqli_query($conn, "SELECT * FROM `tscategory` WHERE Is_Active ='1' AND id = '".$query4['cateid']."' ");
                            $query5 = mysqli_fetch_assoc($query5);
                				       
                		}
                        ?>
                                    
                        <div class="alert alert-primary">
                        Sản Phẩm: <?php echo $query4['subcate']; ?>
                        <br/>Danh Mục: <?php echo $query5['CategoryName']; ?>
                        <br/>Số Lượng: <?php echo number_format($row['amount']); ?>
                        <br/>Ngày Mua: <?php echo date( 'd-m-Y', $row[ 'time']); ?>
                        
                        <br/>Mô Tả: <?php echo $query4['mota']; ?>
                            <div class="alert alert-primary">
                            <b>Lưu ý:</b> Mỗi dòng sẽ là 1 tài khoản, ngăn cách bằng dấu "<font color="black"><b>:</b></font>" hoặc dấu "<font color="black"><b>|</b></font>" nha!</br>
                            <table>
                                <tr>
                                    <td>
                                       <b>Ví dụ:</b>
                                    </td>
                                    
                                    <td>
                                        <font color="blue">username</font><font color="black"><b>:</b></font><font color="red">password</font><br>
                                        <font color="blue">username</font><font color="black"><b>|</b></font><font color="red">password</font>
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>
                            
                            
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="widget-content">
                        <form>


                            <div class="box-body">
                                <?php if(!$total){ ?>
                                <div class="form-group text-center">
                                    <h3 class="text-danger">Lịch sử mua không tồn tại!</h3>
                                </div>
                                <?php }else{ ?>
                                
                                
                                
                                <div class="form-group">
                                    <div class=" pull-left">
                                    <label>Danh sách sản phẩm:</label>
                                    </div>
                                    
                                    <div class="pull-right">
                                    <a href="javascript:;" onclick="saochep('content_codeRecharge');" class="btn btn-primary"><i class="fa fa-clone"></i> Sao Chép</a>
                                    </div>
                                    
                                    
                                    <textarea class="form-control" id="content_codeRecharge" rows="15"><?php
                                            $query =  mysqli_query($conn,"SELECT * FROM `san-pham-da-ban` WHERE `time` = '$code' AND `username` = '$username'");
                                            $countline = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM `san-pham-da-ban` WHERE `time` = '$code' AND `username` = '$username'")) ['COUNT(*)'];
                                            $i=1;
                                            while($row = mysqli_fetch_array($query)) {
                                                echo ''.$row['text'] .'';
                                                    if($i<$countline) {
                                                        echo "\n";
                                                    }
                                                $i++;
                                            }
                                        ?></textarea>
                                </div>
                                <?php } ?>
                            </div>
                    </div>
                    </form>


                </div>
            </div>
        </div>

        <!--
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2022 <a target="_blank" href="https://haycode.net">HayCode.Net</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
            -->
    </div>

    <!-- End -->
</div>
<script>
  function saochep(element){
    window.getSelection().removeAllRanges();let range=document.createRange();range.selectNode(typeof element==="string"?document.getElementById(element):element);window.getSelection().addRange(range);document.execCommand("copy");window.getSelection().removeAllRanges();swal("Sao chép thành công","success");}
function copyToClipboard(text) {
   const elem = document.createElement('textarea');
   elem.value = text;
   document.body.appendChild(elem);
   elem.select();
   document.execCommand('copy');
   document.body.removeChild(elem);
}
</script>  
<?php
} else {
    echo '
        <div class="form-group text-center">
            <h3 class="text-danger">Lịch sử mua không tồn tại!</h3>
        </div>';
}
require_once '../layout/script.php';
}
?>
                            