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


<div class="col-md-12">
        <div class="row">
            <!--
            <div class="col-md-12 mb-3">
                <h5 class="text-primary">Tỷ giá: 1 VNĐ </h5>
            </div>
            -->
            <?php 
                $getbank = mysqli_query($conn, "SELECT * FROM `bank` WHERE `status` = '1' "); 
                 while ($bank = mysqli_fetch_assoc($getbank)) {
            ?>
            
            
            <div class="mb-3 col-sm-6">
                <div class="card-deck mb-3">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal text-center"><img src="<?=$bank['img']?>" height="65px"></h4>
                        </div>
                        <div class="card-body">
                            
                            <ul class="list-unstyled mb-4">
                                <li>Tên ngân hàng:
                                <b><?=$bank['namebank']?></b>
                                </li>
                                <li>
                                    Số tài khoản:
                                    <a href="javascript:" onclick="saochep('stk_<?=$bank['id']?>')">
                                    <b class="text-warning" id="stk_<?=$bank['id']?>">
                                        <?=$bank['namestk']?>
                                        <i class="fa fa-clone" style="color: blue;"></i>
                                    </b>
                                    </a>
                                </li>
                                <li>
                                    Tên:
                                    <b><?=$bank['namectk']?></b>
                                </li
                                <li>
                                    <span class="fw-bold">Nạp tối thiểu:
                                        <b class="text-right"><?= number_format($bank['id_xep'])?> VNĐ</b></span>
                                </li>
                                <li>
                                    <span class="fw-bold">Chú ý: Hệ thống tự cộng tiền (Tối đa 5 phút). Nhớ nhập đúng nội dung chuyển khoản nha!
                                        <b class="text-right"></b>
                                    </span>
                                </li>
                                
                                <li>
                                    <b>Nội dung:</b>
                                    
                                    <a href="javascript:;" onclick="saochep('content_codeRecharge');">
                                        <b class="text-warning" id="content_codeRecharge"><?= $data['username']; ?></b>
                                        <i class="fa fa-clone" style="color: blue;"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--
            <div class="mb-3 col-sm-6">
                <h5 class="text-info text-center"><img src="<?=$bank['img']?>" height="65px"> <button class="btn btn-primary btn-sm">Auto</button></h5>
                <div class="card border-0 bg-success rounded-10">
                    <div class="card-body p-20 text-white">
                        <h5 class="text-white">
                            <span class="fw-bold">Tên ngân hàng:
                                <b class="text-right"><?=$bank['namebank']?></b>
                            </span>
                        </h5>
                        <h5 class="text-white">
                            <span class="fw-bold">Số tài khoản:
                                <a href="javascript:" onclick="saochep('stk_<?=$bank['id']?>')">
                                <b id="stk_<?=$bank['id']?>" class="text-right text-warning">
                                    <?=$bank['namestk']?>
                                    <i class="fa fa-clone" style="color: blue;"></i>
                                </b>
                                </a>
                            </span>
                        </h5>
                        <h5 class="text-white">
                            <span class="fw-bold">Tên:
                                <b class="text-right text-warning"><?=$bank['namectk']?></b>
                            </span>
                        </h5>
                        <h5 class="text-white">
                            <span class="fw-bold">Nạp tối thiểu:
                                <b class="text-right"><?= number_format($bank['id_xep'])?> VNĐ</b></span>
                        </h5>
                        <h5 class="text-white">
                            <span class="fw-bold">Chú ý: Hệ thống tự cộng tiền (Tối đa 5 phút). Nhớ nhập đúng nội dung chuyển khoản nha!
                            <b class="text-right"></b>
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
            -->
            <?php }?>
            <!--
            <div class="col-md-12">
                <h5 class="text-primary">Nội dung chuyển khoản:</h5>
                <div class="alert text-white bg-warning mb-3" role="alert">
                    <h4 class="text-white bg-heading font-weight-semi-bold text-center">
                                    <a href="javascript:;" onclick="saochep('content_codeRecharge');">
                                        <b class="text-white" id="content_codeRecharge"><?= $data['username']; ?></b>
                                        <i class="fa fa-clone"></i>
                                    </a>
                                </h4>
                </div>
            </div>
            -->
            
            <div class="col-md-12">
                <div class="alert text-white bg-secondary mb-3" role="alert">
                    <h5 class="text-white bg-heading font-weight-semi-bold">Lưu ý:</h5>
                    <p>
                        - Bạn vui lòng chuyển khoản chính xác nội dung để được cộng tiền nhanh nhất.
                        <br>- Nếu sau 10 phút mà vẫn chưa được cộng tiền, vui lòng liên hệ <a href="https://www.facebook.com/123vps/" style="color: yellow;">Facebook Admin</a>, <a href="https://t.me/nthnth123" style="color: yellow;">Telegram Admin</font></a>, <a href="http://zaloapp.com/qr/p/tlub8tbbwxwq" style="color: yellow;">Zalo Admin</a> <font color="yellow">(0858.533.566)</font>, <a href="https://zalo.me/g/pizbek864" style="color: yellow;">Box Chat Zalo</a> để được hỗ trợ.
                        <br>- Cố tình nạp dưới mức nạp sẽ không hỗ trợ.
                        <br>- Nếu nạp sai cú pháp, vui lòng liên hệ <a href="https://www.facebook.com/123vps/" style="color: yellow;">Facebook Admin</a>, <a href="https://t.me/nthnth123" style="color: yellow;">Telegram Admin</font></a>, <a href="http://zaloapp.com/qr/p/tlub8tbbwxwq" style="color: yellow;">Zalo Admin</a> <font color="yellow">(0858.533.566)</font>, <a href="https://zalo.me/g/pizbek864" style="color: yellow;">Box Chat Zalo</a> để được hỗ trợ.
                    </p>
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