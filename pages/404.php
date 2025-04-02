
<?php
require_once '../core/database.php';
$title = 'Không tìm thấy trang |';
require_once '../layout/head.php';
?>

        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="text-center">
                <h1 class="display-1 fw-bold">404</h1>
                <p class="fs-3"> <span class="text-danger">Lỗi!</span> Không tìm thấy trang.</p>
                <p class="lead">
                    Trang bạn đang tìm kiếm không tồn tại.
                  </p>
                <a href="/" class="btn btn-primary">Trang chủ</a>
            </div>
        </div>
 


<?php
require_once '../layout/script.php';
?>