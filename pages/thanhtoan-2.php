<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/core/database.php";
// Hàm randso và xss được giả định là đã tồn tại
// function xss($data){ /* ... implementation ... */ return $data; }
// function randso($length){ /* ... implementation ... */ return substr(str_shuffle("0123456789"), 0, $length); }

// --- Lấy dữ liệu MỘT LẦN ở đầu trang ---
$key_id = null;
$product = null;
$stock_quantity = 0;
$user_balance = 0;
$next_order_id = 1; // Giá trị mặc định
$alert_payment_message = isset($setup['alert-payment']) ? $setup['alert-payment'] : 'Kiểm tra kỹ thông tin trước khi mua.'; // Mặc định
$is_logged_in = !empty($_SESSION['username']);
$user_data = null; // Sẽ chứa dữ liệu người dùng nếu đăng nhập

// Kiểm tra key_id hợp lệ
if (isset($_GET['key_id']) && !empty(trim($_GET['key_id']))) {
    // !!! CẢNH BÁO SQL INJECTION !!! Nên dùng Prepared Statements
    $key_id_unsafe = $_GET['key_id']; // Giữ lại giá trị gốc để dùng trong JS nếu cần
    $key_id = xss(addslashes(trim($key_id_unsafe)));

    // Lấy thông tin sản phẩm (subcategories)
    $query_product = "SELECT * FROM `subcategories` WHERE key_id = '$key_id'";
    $result_product = mysqli_query($conn, $query_product);

    if ($result_product && mysqli_num_rows($result_product) > 0) {
        $product = mysqli_fetch_assoc($result_product);

        // Lấy số lượng tồn kho (san-pham-chua-ban)
        // !!! CẢNH BÁO SQL INJECTION !!!
        $query_stock = "SELECT COUNT(*) as count FROM `san-pham-chua-ban` WHERE `active` ='1' AND `subcatekey` = '$key_id'";
        $result_stock = mysqli_query($conn, $query_stock);
        if ($result_stock) {
            $stock_data = mysqli_fetch_assoc($result_stock);
            $stock_quantity = (int)$stock_data['count'];
        }

        // Lấy thông tin người dùng nếu đăng nhập
        if ($is_logged_in) {
            $username_unsafe = $_SESSION['username'];
            $username_safe = xss(addslashes($username_unsafe));
            // !!! CẢNH BÁO SQL INJECTION !!!
            $query_user = "SELECT * FROM `users` WHERE `username` = '$username_safe'";
            $result_user = mysqli_query($conn, $query_user);
            if ($result_user && mysqli_num_rows($result_user) > 0) {
                 $user_data = mysqli_fetch_assoc($result_user);
                 $user_balance = (float)$user_data['cash']; // Lấy số dư
            } else {
                // Xử lý trường hợp session username có nhưng không tìm thấy user trong DB
                $is_logged_in = false;
                unset($_SESSION['username']); // Xóa session không hợp lệ
            }
        }

        // Lấy ID đơn hàng tiếp theo (Vẫn có thể bị race condition)
        // !!! CẢNH BÁO SQL INJECTION (nếu bảng có thể bị ảnh hưởng) !!!
        $query_order_count = "SELECT COUNT(*) as count FROM `lich-su-mua`";
        $result_order_count = mysqli_query($conn, $query_order_count);
        if ($result_order_count) {
            $order_count_data = mysqli_fetch_assoc($result_order_count);
            $next_order_id = (int)$order_count_data['count'] + 1;
        }

    } else {
        // Sản phẩm không tồn tại, chuyển hướng
        header('location: /404');
        exit;
    }
} else {
    // Không có key_id, chuyển hướng
    header('location: /');
    exit;
}

// --- Thiết lập tiêu đề trang ---
$title = htmlspecialchars($product['subcate']) . ' | Thanh toán | ';
require $_SERVER['DOCUMENT_ROOT'] . "/layout/head.php"; // Đã bao gồm thẻ <head> và có thể là CSS chung

?>

<?php /* --- CSS để ẩn mũi tên input number --- */ ?>
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

<?php /* --- Hiển thị thông báo từ server (nếu có) --- */ ?>
<?php if (isset($msg) && isset($status)): // Giả sử $msg và $status được set từ xử lý POST trước đó ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        swal('<?= addslashes(htmlspecialchars($msg)) ?>', '<?= $status === true ? "success" : "error" ?>');
        <?php if($status === true && isset($time)) { // $time giả sử là mã đơn hàng hoặc timestamp ?>
        setTimeout(() => {
            window.location.href = '/lich-su-mua.html?code=<?= htmlspecialchars($time) ?>';
        }, 1300);
        <?php } ?>
    });
</script>
<?php endif; ?>


<?php /* --- Phần HTML Giao Diện Mới Với Inline CSS --- */ ?>
<div class="row justify-content-center" style="margin-top: 20px;"> <?php /* Thêm khoảng cách trên */ ?>

    <div class="col-lg-7 mb-4">
        <div class="card" style="box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);">
            <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h5 class="mb-0 d-flex align-items-center">
                    <i class="fa fa-shopping-basket mr-2" style="color: #28a745;"></i> Chi Tiết Thanh Toán
                </h5>
            </div>
            <div class="card-body" style="padding: 1.5rem;"> <?php /* Padding nhiều hơn */ ?>

                <h6 class="text-muted mb-3">Thông tin sản phẩm</h6>
                <dl class="row" style="font-size: 0.9rem;"> <?php /* Cỡ chữ nhỏ hơn chút cho dl */ ?>
                    <dt class="col-sm-4 text-sm-right" style="color: #6c757d; font-weight: 500; padding-top: 0.3rem;">Sản phẩm:</dt>
                    <dd class="col-sm-8" style="font-weight: 500; margin-bottom: 0.75rem;"><?= htmlspecialchars($product['subcate']) ?></dd>

                    <dt class="col-sm-4 text-sm-right" style="color: #6c757d; font-weight: 500; padding-top: 0.3rem;">Mô tả:</dt>
                    <dd class="col-sm-8" style="font-weight: 500; margin-bottom: 0.75rem;"><?= nl2br(htmlspecialchars($product['mota'])) ?></dd>

                    <dt class="col-sm-4 text-sm-right" style="color: #6c757d; font-weight: 500; padding-top: 0.3rem;">Đơn giá:</dt>
                    <dd class="col-sm-8" style="font-weight: 500; margin-bottom: 0.75rem;">
                        <span style="font-size: 1.25rem; color: #e44d26;"><?= number_format($product['rate'], 0, ',', '.') ?> đ</span>
                    </dd>

                    <dt class="col-sm-4 text-sm-right" style="color: #6c757d; font-weight: 500; padding-top: 0.3rem;">Còn lại:</dt>
                    <dd class="col-sm-8" style="font-weight: 500; margin-bottom: 0.75rem;">
                        <?= number_format($stock_quantity) ?> sản phẩm
                    </dd>
                </dl>

                <hr style="margin-top: 1rem; margin-bottom: 1rem;">

                <h6 class="text-muted mb-3">Thông tin giao dịch</h6>
                <dl class="row align-items-center" style="font-size: 0.9rem;">
                     <dt class="col-sm-4 text-sm-right" style="color: #6c757d; font-weight: 500; padding-top: 0.3rem;">Mã đơn hàng:</dt>
                     <dd class="col-sm-8" style="font-weight: 500; margin-bottom: 0.75rem;">
                         <strong>#<?= $next_order_id ?></strong>
                     </dd>

                    <?php if ($is_logged_in): ?>
                    <dt class="col-sm-4 text-sm-right" style="color: #6c757d; font-weight: 500; padding-top: 0.3rem;">Số dư của bạn:</dt>
                    <dd class="col-sm-8" style="font-weight: 500; margin-bottom: 1rem;">
                        <span class="badge badge-info" style="font-size: 0.9rem; padding: 0.4em 0.6em;">
                            <?= number_format($user_balance, 0, ',', '.') ?> đ
                        </span>
                         <a href="/nap-tien" class="ml-2 small" style="font-size: 85%;">(Nạp thêm?)</a>
                    </dd>
                    <?php endif; ?>

                    <dt class="col-sm-4 text-sm-right pt-1" style="color: #6c757d; font-weight: 500; padding-top: 0.3rem;">Số lượng mua:</dt>
                    <dd class="col-sm-8 mb-3" style="font-weight: 500; margin-bottom: 1rem !important;">
                        <div class="d-flex align-items-center">
                            <?php // Truyền dữ liệu vào data attributes ?>
                            <input type="number" class="form-control form-control-sm" id="soluong" name="soluong"
                                   min="1"
                                   max="<?= $stock_quantity ?>"
                                   value="1" <?php /* Luôn bắt đầu là 1 nếu còn hàng */ ?>
                                   style="width: 75px; text-align: center; font-weight: bold; min-height: calc(1.5em + .5rem + 2px); padding: .25rem .5rem; font-size: .875rem; line-height: 1.5;"
                                   <?php if ($stock_quantity <= 0) echo 'disabled'; ?>
                                   data-price="<?= (float)$product['rate'] ?>"
                                   data-stock="<?= $stock_quantity ?>"
                                   data-balance="<?= $is_logged_in ? $user_balance : 0 ?>"
                                   data-keyid="<?= htmlspecialchars($key_id_unsafe) ?>"
                                   aria-label="Số lượng mua">
                            <small class="text-muted ml-3" style="margin-left: 1rem !important;">(Tối đa: <?= number_format($stock_quantity) ?>)</small>
                        </div>
                    </dd>

                    <?php if ($is_logged_in): ?>
                    <dt class="col-sm-4 text-sm-right" style="color: #6c757d; font-weight: 500; padding-top: 0.3rem;">Thành tiền:</dt>
                    <dd class="col-sm-8 mb-3" style="font-weight: 500; margin-bottom: 1rem !important;">
                        <span id="tongthanhtoan" style="font-size: 1.4rem; font-weight: bold; color: #28a745;">0</span>
                        <span style="font-size: 1.4rem; font-weight: bold; color: #28a745;"> đ</span>
                    </dd>
                    <?php endif; ?>
                </dl>

                <hr style="margin-top: 1.5rem; margin-bottom: 1.5rem;">

                <div style="text-align: center;">
                     <?php if ($is_logged_in): ?>
                        <?php if ($stock_quantity > 0): ?>
                            <button id="mua" type="button" class="btn btn-success btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem; box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);">
                                <i class="fa fa-check-circle mr-2"></i> XÁC NHẬN MUA
                            </button>
                            <div id="purchase-error" style="color: #dc3545; margin-top: 0.75rem; font-size: 85%;"></div>
                        <?php else: ?>
                            <button type="button" class="btn btn-secondary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" disabled>
                                <i class="fa fa-ban mr-2"></i> ĐÃ HẾT HÀNG
                            </button>
                        <?php endif; ?>
                    <?php else: ?>
                         <?php $redirectUrl = '/login?redirect=' . urlencode($_SERVER['REQUEST_URI']); ?>
                         <a href="<?= $redirectUrl ?>" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem; box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);">
                             <i class="fa fa-sign-in mr-2"></i> Đăng Nhập Để Mua Hàng
                         </a>
                         <p style="margin-top: 1rem; color: #6c757d; font-size: 85%;">Bạn cần đăng nhập để tiếp tục thanh toán.</p>
                    <?php endif; ?>
                </div>
            </div> <?php /* Kết thúc card-body */ ?>
        </div> <?php /* Kết thúc card */ ?>
    </div>

    <div class="col-lg-5">
        <div class="card border-warning mb-4" style="border-color: #ffc107 !important;">
            <div class="card-header" style="background-color: #ffc107; color: #212529; border-color: #ffc107;">
                <h6 class="mb-0 d-flex align-items-center">
                    <i class="fa fa-info-circle mr-2"></i> Xin Lưu Ý
                </h6>
            </div>
            <div class="card-body" style="font-size: 85%;"> <?php /* Chữ nhỏ hơn */ ?>
                <p><strong>Vui lòng đọc kỹ trước khi thanh toán:</strong></p>
                <ul style="padding-left: 20px; list-style-position: outside;">
                    <?php
                        // Tách message thành các dòng nếu có xuống dòng
                        $lines = preg_split('/\\r\\n|\\r|\\n/', $alert_payment_message);
                        foreach ($lines as $line) {
                            if (!empty(trim($line))) {
                                echo '<li style="margin-bottom: 0.5rem;">' . htmlspecialchars(trim($line)) . '</li>';
                            }
                        }
                        // Thêm các lưu ý cố định
                        echo '<li style="margin-bottom: 0.5rem;">Sản phẩm đã mua không hỗ trợ hoàn tiền.</li>';
                        echo '<li style="margin-bottom: 0.5rem;">Nếu gặp lỗi trong quá trình thanh toán, vui lòng không thử lại nhiều lần và liên hệ bộ phận hỗ trợ ngay.</li>';
                        echo '<li style="margin-bottom: 0.5rem;">Số dư sẽ bị trừ ngay sau khi bạn nhấn "XÁC NHẬN MUA".</li>';
                        echo '<li style="margin-bottom: 0.5rem;">Xem lại <a href="/lich-su-mua">lịch sử giao dịch</a> để kiểm tra đơn hàng sau khi mua.</li>';
                    ?>
                </ul>
            </div>
        </div>

         <div class="card border-info" style="border-color: #17a2b8 !important;">
             <div class="card-header" style="background-color: #17a2b8; color: #fff; border-color: #17a2b8;">
                  <h6 class="mb-0 d-flex align-items-center">
                      <i class="fa fa-life-ring mr-2"></i> Cần Hỗ Trợ?
                  </h6>
             </div>
             <div class="card-body" style="font-size: 85%;">
                 <p>Liên hệ chúng tôi qua:</p>
                 <ul style="padding-left: 20px; list-style: none;">
                     <li style="margin-bottom: 0.5rem;"><i class="fa fa-ticket mr-2" style="color: #007bff;"></i> Gửi <a href="/ticket">ticket hỗ trợ</a> (phản hồi trong giờ hành chính).</li>
                     <li style="margin-bottom: 0.5rem;"><i class="fa fa-facebook-square mr-2" style="color: #007bff;"></i> <a href="https://www.facebook.com/123vps" target="_blank">Fanpage Facebook</a> (trả lời nhanh).</li>
                     <li style="margin-bottom: 0.5rem;"><i class="fa fa-phone mr-2" style="color: #007bff;"></i> Hotline: <a href="tel:0123456789">0858.533.566</a> (giờ hành chính).</li>
                 </ul>
             </div>
         </div>
    </div>
</div><?php
// --- Phần SCRIPT JS ---
if ($is_logged_in): // Chỉ include JS xử lý mua hàng khi đã đăng nhập
?>
<script type="text/javascript">
$(document).ready(function() {

    // Hàm định dạng số tiền
    function formatNumber(num) {
        if (typeof num !== 'number') return '0';
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'); // Dùng dấu chấm
    }

    // Hàm cập nhật tổng tiền và kiểm tra nút Mua
    function updatePayment() {
        toastr.remove(); // Xóa toastr cũ
        var $soluongInput = $('#soluong');
        var soluong = parseInt($soluongInput.val()) || 0; // Lấy số lượng, mặc định là 0 nếu không hợp lệ
        var price = parseFloat($soluongInput.data('price')) || 0;
        var stock = parseInt($soluongInput.data('stock')) || 0;
        var balance = parseFloat($soluongInput.data('balance')) || 0;
        var $tongthanhtoan = $('#tongthanhtoan');
        var $muaButton = $('#mua');
        var $errorDiv = $('#purchase-error');
        var isValid = true;
        var errorMessage = '';

        var total = soluong * price;
        $tongthanhtoan.html(formatNumber(total));
        $errorDiv.html(''); // Xóa lỗi cũ

        if (soluong <= 0) {
            errorMessage = 'Vui lòng nhập số lượng hợp lệ (lớn hơn 0).';
            isValid = false;
        } else if (soluong > stock) {
            errorMessage = 'Số lượng mua không được lớn hơn số lượng kho (' + stock + ').';
            isValid = false;
        } else if (total > balance) {
            errorMessage = 'Số dư không đủ để thực hiện giao dịch này.';
            isValid = false;
        }

        if (!isValid) {
            $errorDiv.html(errorMessage);
            toastr.error(errorMessage, 'Thông Báo Lỗi');
            $muaButton.prop('disabled', true);
        } else {
            $muaButton.prop('disabled', false);
        }
    }

    // Gọi hàm cập nhật khi trang tải xong (để tính tiền cho giá trị mặc định)
    updatePayment();

    // Xử lý khi thay đổi số lượng (keyup và change)
    $('#soluong').on('keyup change', function() {
        updatePayment();
    });

    // Xử lý khi nhấn nút Mua
    $('#mua').click(function() {
        // Chạy lại kiểm tra lần cuối trước khi gửi
        updatePayment();
        var $soluongInput = $('#soluong');
        var $muaButton = $(this);
        var $errorDiv = $('#purchase-error');

        if ($muaButton.prop('disabled')) {
            // Nếu nút bị vô hiệu hóa do updatePayment, không làm gì cả
            return false;
        }

        var soluong = parseInt($soluongInput.val());
        var loai = $soluongInput.data('keyid'); // Lấy từ data attribute

        // Hiển thị trạng thái đang xử lý
        $muaButton.addClass('btn-info').removeClass('btn-success').html('<i class="fa fa-spinner fa-spin mr-2"></i> Đang xử lý...').prop('disabled', true);
        toastr.remove();
        toastr.info('Đang gửi yêu cầu mua hàng...', 'Thông báo', { timeOut: 0, extendedTimeOut: 0 });
        $errorDiv.html(''); // Xóa lỗi cũ

        // Gửi AJAX
        $.ajax({
            url: '/Query/Order.html', // Đường dẫn xử lý đơn hàng
            type: 'POST',
            dataType: 'json',
            data: {
                soluong: soluong,
                loai: loai // Tên key phải khớp với bên nhận /Query/Order.html
            },
            success: function(data) {
                toastr.remove(); // Xóa toastr "đang xử lý"
                if (data && data.code == 1) { // Kiểm tra data tồn tại và code = 1
                    toastr.success(data.msg || "Mua hàng thành công!", "Thành công");
                    swal(data.msg || "Mua hàng thành công!", "success");
                    setTimeout(function() {
                        // Chuyển hướng đến lịch sử mua hàng với mã đơn hàng
                        window.location.href = '/lich-su-mua.html?code=' + (data.key || ''); // data.key là mã đơn hàng trả về
                    }, 1300);
                } else {
                    // Xử lý lỗi trả về từ server
                    var errorMsg = (data && data.msg) ? data.msg : "Có lỗi xảy ra, vui lòng thử lại.";
                    $errorDiv.html(errorMsg); // Hiển thị lỗi dưới nút mua
                    toastr.error(errorMsg, 'Lỗi');
                    swal(errorMsg, 'error');
                    // Khôi phục nút Mua
                    $muaButton.removeClass('btn-info').addClass('btn-success').html('<i class="fa fa-check-circle mr-2"></i> XÁC NHẬN MUA').prop('disabled', false);
                    // Có thể cần cập nhật lại số dư/số lượng nếu server báo lỗi do thay đổi
                    // Ví dụ: window.location.reload(); hoặc gọi lại updatePayment() nếu có thông tin mới
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Xử lý lỗi AJAX (mất kết nối, server 500...)
                toastr.remove();
                var errorMsg = "Lỗi kết nối hoặc máy chủ. Vui lòng thử lại sau.";
                $errorDiv.html(errorMsg);
                toastr.error(errorMsg, 'Lỗi Hệ Thống');
                swal('Lỗi Hệ Thống', errorMsg, 'error');
                // Khôi phục nút Mua
                $muaButton.removeClass('btn-info').addClass('btn-success').html('<i class="fa fa-check-circle mr-2"></i> XÁC NHẬN MUA').prop('disabled', false);
            }
        });
    });

}); // Kết thúc document ready
</script>
<?php
endif; // Kết thúc kiểm tra is_logged_in cho JS

// --- Include Footer/Scripts chung ---
require $_SERVER['DOCUMENT_ROOT'] . "/layout/script.php";
?>