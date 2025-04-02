<?php
session_start();
if(empty($_SESSION['username'])){
	session_destroy();
	header('location: /');
	die();
}
include('../core/database.php');
$title = 'Nạp MoMo/Chuyển Khoản Ngân Hàng | ';
include('../layout/head.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");
?>


<div class="col-md-12" style="padding: 20px;">
    <div class="mb-4">
        <div class="row">
            <!--
            <div class="col-md-12 mb-3">
                <h5 class="text-primary">Tỷ giá: 1 VNĐ </h5>
            </div>
            -->
            
            <div class="col-md-12">
                <div class="alert text-white bg-secondary mb-3" role="alert">
                    <h5 class="text-white bg-heading font-weight-semi-bold">Khiếu nại nạp tiền:</h5>
                    <p>
                        - Bạn vui lòng chuyển khoản chính xác nội dung để được cộng tiền nhanh nhất.
                        <br>- Nếu sau 10 phút mà vẫn chưa được cộng tiền vui lòng liên hệ <a href="https://www.facebook.com/123vps/" style="color: yellow;">Facebook Admin</a>, <a href="https://t.me/nthnth123" style="color: yellow;">Telegram Admin</font></a>, <a href="http://zaloapp.com/qr/p/tlub8tbbwxwq" style="color: yellow;">Zalo Admin</a> <font color="yellow">(0858.533.566)</font>, <a href="https://zalo.me/g/pizbek864" style="color: yellow;">Box Chat Zalo</a> để được hỗ trợ.
                        <br>- Cố tình nạp dưới mức nạp sẽ không hỗ trợ.
                        <br>- Nếu nạp sai cú pháp, vui lòng liên hệ <a href="https://www.facebook.com/123vps/" style="color: yellow;">Facebook Admin</a>, <a href="https://t.me/nthnth123" style="color: yellow;">Telegram Admin</font></a>, <a href="http://zaloapp.com/qr/p/tlub8tbbwxwq" style="color: yellow;">Zalo Admin</a> <font color="yellow">(0858.533.566)</font>, <a href="https://zalo.me/g/pizbek864" style="color: yellow;">Box Chat Zalo</a> để được hỗ trợ.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
  function saochep(element){
    window.getSelection().removeAllRanges();let range=document.createRange();range.selectNode(typeof element==="string"?document.getElementById(element):element);window.getSelection().addRange(range);document.execCommand("copy");window.getSelection().removeAllRanges();swal("Sao chép thành công","success");}

</script>                       
<?php
require_once '../layout/script.php';
?>