<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
/*
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
    */
require $_SERVER['DOCUMENT_ROOT']."/layout/head.php"; // Assumes this includes Bootstrap CSS/JS, Font Awesome, jQuery

// --- Assume these functions are defined elsewhere ---
if (!function_exists('create_slug')) {
    function create_slug($string) {
        // Basic placeholder slug function
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
        return trim($slug, '-');
    }
}
if (!function_exists('rutgon')) {
     function rutgon($string, $length) {
         // Basic placeholder shorten function
         if (strlen($string) > $length) {
             return substr($string, 0, $length) . '...';
         }
         return $string;
     }
}
// --- End assumed functions ---


if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
} else {
    $user = null; // Ensure $user is defined even if not logged in
}

?>

<div style="padding: 25px; background-color: #f8f9fa;"> <div class="card mb-4" style="border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <div class="card-body" style="background-color: #e9f5ff; border-left: 5px solid #007bff; padding: 15px 20px;">
             Ae vào <a href="https://zalo.me/g/pizbek864" target="_blank" rel="noopener noreferrer" style="color: #0056b3; font-weight: bold; text-decoration: none;">Box Chat Zalo</a> để giao lưu, nhận Ưu đãi, Tut, nghiệm MMO, reg Azure nhé!
        </div>
    </div>

    <?php if(empty($_SESSION['username'])): ?>
        <div class="card mb-4" style="border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <div class="card-body bg-info" style="background-color: #d1ecf1 !important; border-left: 5px solid #17a2b8; color: #0c5460; padding: 20px;">
                Bạn vui lòng thực hiện <a href="/login" class="btn btn-success" style="color: white; background-color: #28a745; border-color: #28a745; padding: 8px 15px; font-size: 0.95em; text-decoration: none; display: inline-block; margin: 0 5px;"><i class="fa fa-user"></i> Đăng Nhập</a>
                để thực hiện mua hàng. Nếu bạn chưa có tài khoản, hãy <a href="/signup" class="btn btn-warning" style="color: #212529; background-color: #ffc107; border-color: #ffc107; padding: 8px 15px; font-size: 0.95em; text-decoration: none; display: inline-block; margin: 0 5px;"><i class="fa fa-user-plus"></i> Đăng Kí Ngay!</a>
            </div>
        </div>
    <?php else: ?>
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="card mb-4 mb-lg-0" style="border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1); height: 100%;">
                    <div class="card-body" style="padding: 25px; text-align: center;">
                        <div class="avatar avatar-xl mb-3">
                             <img src="<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>/assets/themes/images/users.png" width="90" height="90" class="rounded-circle" alt="avatar" style="border: 3px solid #dee2e6; padding: 3px;">
                        </div>
                        <h5 style="margin-bottom: 15px; font-weight: 600;"><?= htmlspecialchars($_SESSION['username']); ?></h5>
                        <div style="text-align: left; font-size: 0.95em; line-height: 1.8;">
                            <p style="margin-bottom: 8px;">
                                <strong style="color: #495057;"><i class="fa fa-star-half-o fa-fw" style="color: #ffc107; margin-right: 5px;"></i> Cấp Bậc:</strong>
                                <span style="background-color: #e9ecef; padding: 3px 8px; border-radius: 4px; font-size: 0.9em; margin-left: 5px;">
                                <?php
                                    if($user['admin'] == '1') { echo 'Quản Trị Viên'; }
                                    else if($user['admin'] == '0') { echo 'Thành Viên'; }
                                    else if($user['admin'] == '2') { echo 'Cộng Tác Viên'; }
                                    else { echo 'N/A'; } // Handle unexpected values
                                ?>
                                </span>
                            </p>
                            <p style="margin-bottom: 8px;">
                                <strong style="color: #495057;"><i class="fa fa-envelope fa-fw" style="color: #6c757d; margin-right: 5px;"></i> Email:</strong>
                                <?= htmlspecialchars($user['email']) ?>
                            </p>
                            <p style="margin-bottom: 0;">
                                <strong style="color: #495057;"><i class="fa fa-money fa-fw" style="color: #28a745; margin-right: 5px;"></i> Số Dư:</strong>
                                <span style="font-weight: bold; color: #28a745; font-size: 1.1em;"><?= number_format($user['cash'] ?? 0) ?> đ</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4" style="border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <div class="card-body" style="padding: 20px;">
                        <h6 style="margin-bottom: 15px; color: #007bff; font-weight: 600;">QUẢN LÝ TÀI KHOẢN</h6>
                        <a href="#" class="showModel" rel="nofollow" style="display: block; padding: 8px 0; text-decoration: none; color: #343a40;" onmouseover="this.style.color='#007bff'" onmouseout="this.style.color='#343a40'">
                            <i class="fa fa-bell fa-fw text-warning" aria-hidden="true" style="margin-right: 8px;"></i> Thông báo
                        </a>
                        <a href="/lich-su-mua" rel="nofollow" style="display: block; padding: 8px 0; text-decoration: none; color: #343a40;" onmouseover="this.style.color='#007bff'" onmouseout="this.style.color='#343a40'">
                            <i class="fa fa-shopping-bag fa-fw text-success" style="margin-right: 8px;"></i> Lịch sử mua hàng
                        </a>
                         <a href="/profile" style="display: block; padding: 8px 0; text-decoration: none; color: #343a40;" onmouseover="this.style.color='#007bff'" onmouseout="this.style.color='#343a40'">
                            <i class="fa fa-address-book-o fa-fw text-dark" style="margin-right: 8px;"></i> Thông tin tài khoản
                        </a>
                    </div>
                </div>
                 <div class="card" style="border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                     <div class="card-body text-center" style="padding: 20px;">
                        <a class="btn btn-warning waves-effect waves-light" href="nap-tien.html" target="_blank" rel="nofollow" style="color: #212529; background-color: #ffc107; border-color: #ffc107; padding: 10px 25px; font-size: 1em; text-decoration: none; margin: 5px;"><i class="fa fa-university fa-fw"></i> Nạp tiền</a>
                        <a class="btn btn-danger waves-effect waves-light" href="ticket" target="_blank" rel="nofollow" style="color: white; background-color: #dc3545; border-color: #dc3545; padding: 10px 25px; font-size: 1em; text-decoration: none; margin: 5px;"><i class="fa fa-life-ring fa-fw"></i> Hỗ trợ</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="card mb-4" style="border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
         <div class="card-header" style="background-color: #007bff; color: white; padding: 15px 20px; font-weight: 600; font-size: 1.1em;">
            <i class="fa fa-cubes fa-fw"></i> Danh mục sản phẩm
        </div>
        <div class="card-body" style="padding: 0;"> <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0" style="border: none;"> <thead style="background-color: #e9ecef; color: #495057;">
                        <tr style="white-space: nowrap;">
                             <th style="text-align: left; padding: 12px 15px; border-top: none; border-bottom-width: 1px;">SẢN PHẨM</th>
                             <th style="text-align: left; padding: 12px 15px; border-top: none; border-bottom-width: 1px;">MÔ TẢ</th>
                             <th style="text-align: center; padding: 12px 15px; border-top: none; border-bottom-width: 1px;">GIÁ BÁN</th>
                             <th style="text-align: center; padding: 12px 15px; border-top: none; border-bottom-width: 1px;">TRẠNG THÁI</th>
                             <th style="text-align: center; padding: 12px 15px; border-top: none; border-bottom-width: 1px;"><i class="fa fa-shopping-cart"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM `tscategory` WHERE Is_Active ='1' ORDER BY priority DESC, CategoryName ASC");
                        if (mysqli_num_rows($query) == 0):
                        ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 30px; color: #dc3545; font-weight: bold;">Không có danh mục nào để hiển thị</td>
                            </tr>
                        <?php else:
                            while ($row = mysqli_fetch_array($query)):
                                $rowid = $row['id'];
                        ?>
                                <tr style="background-color: #f8f9fa;">
                                    <td colspan="5" style="padding: 10px 15px; font-weight: bold; color: #343a40; border-top: 1px solid #dee2e6;">
                                        <i class="fa fa-folder-open-o fa-fw" aria-hidden="true" style="color: #007bff;"></i> <?= htmlspecialchars($row['CategoryName']); ?>
                                    </td>
                                </tr>
                                <?php
                                $query3 = mysqli_query($conn, "SELECT * FROM `subcategories` WHERE active ='1' AND cateid = '$rowid' ORDER BY priority DESC, subcate ASC, rate ASC");
                                if (mysqli_num_rows($query3) == 0):
                                ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 15px; font-style: italic; color: #6c757d;">Chưa có sản phẩm trong mục này.</td>
                                    </tr>
                                <?php else:
                                    while ($getrow = mysqli_fetch_array($query3)):
                                        $gettt = $getrow['key_id'];
                                        // Use prepared statement for counting
                                        $stmt_count = $conn->prepare("SELECT COUNT(*) as count FROM `san-pham-chua-ban` WHERE `subcatekey` = ?");
                                        $stmt_count->bind_param("s", $gettt);
                                        $stmt_count->execute();
                                        $result_count = $stmt_count->get_result();
                                        $count_row = $result_count->fetch_assoc();
                                        $product_count = $count_row['count'];
                                        $stmt_count->close();

                                        $trangthai = '';
                                        $mua = '';
                                        $product_slug = htmlspecialchars(create_slug($getrow['subcate']));
                                        $product_key_id = htmlspecialchars($getrow['key_id']);
                                        $buy_link = "/thanhtoan/{$product_slug}-{$product_key_id}";

                                        if ($product_count == 0) {
                                            $trangthai = '<span style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 4px; font-size: 0.85em; font-weight: 500;">Hết hàng</span>';
                                            $mua = '<span style="background-color: #6c757d; color: white; padding: 8px 15px; border-radius: 4px; font-size: 0.9em; cursor: not-allowed; text-decoration: none; display: inline-block;">Mua Ngay</span>';
                                        } else {
                                            $trangthai = '<span style="background-color: #ffc107; color: #333; padding: 5px 10px; border-radius: 4px; font-size: 0.85em; font-weight: 500;">Còn ' . $product_count . '</span>';
                                            // Always show buy button, login check happens on the thanhtoan page or via session check there
                                             $mua = '<a style="color: white; background-color: #28a745; border-color: #28a745; padding: 8px 15px; border-radius: 4px; font-size: 0.9em; text-decoration: none; display: inline-block;" href="' . $buy_link . '" role="button" onmouseover="this.style.backgroundColor=\'#218838\'" onmouseout="this.style.backgroundColor=\'#28a745\'">Mua Ngay</a>';
                                        }
                                        ?>
                                        <tr style="vertical-align: middle;">
                                            <td style="padding: 12px 15px; white-space: normal; font-weight: 500;">
                                                <a href="<?= $buy_link ?>" style="text-decoration: none; color: #0056b3;"><?= htmlspecialchars(@$getrow['subcate']) ?></a>
                                            </td>
                                            <td style="padding: 12px 15px; white-space: normal; font-size: 0.9em; color: #555;">
                                                <?= nl2br(htmlspecialchars(@$getrow['mota'])) // Use nl2br to respect newlines in description ?>
                                            </td>
                                            <td style="padding: 12px 15px; text-align: center; white-space: nowrap; color: #c82333; font-weight: bold; font-size: 1.05em;">
                                                <?= number_format($getrow['rate']) ?> đ
                                            </td>
                                            <td style="padding: 12px 15px; text-align: center;">
                                                <?= $trangthai; ?>
                                            </td>
                                            <td style="padding: 12px 15px; text-align: center;">
                                                <?= $mua ?>
                                            </td>
                                        </tr>
                                <?php
                                    endwhile; // End product loop
                                endif; // End check for products
                            endwhile; // End category loop
                        endif; // End check for categories
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4" style="border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <div class="card-header" style="background-color: #17a2b8; color: white; padding: 15px 20px; font-weight: 600; font-size: 1.1em;">
            <i class="fa fa-history fa-fw"></i> 50 GIAO DỊCH GẦN ĐÂY
        </div>
        <div class="card-body" style="padding: 0;">
             <div class="table-responsive">
                 <table id="example1" class="table table-hover table-striped nowrap mb-0" style="width:100%; border: none;">
                     <thead style="background-color: #e9ecef; color: #495057;">
                         <tr>
                             <th style="padding: 12px 15px; border-top: none; border-bottom-width: 1px;">ID</th>
                             <th style="padding: 12px 15px; border-top: none; border-bottom-width: 1px;">Khách Hàng</th>
                             <th style="padding: 12px 15px; border-top: none; border-bottom-width: 1px;">Giao Dịch</th>
                             <th style="padding: 12px 15px; border-top: none; border-bottom-width: 1px;">Danh Mục</th>
                             <th style="padding: 12px 15px; border-top: none; border-bottom-width: 1px;">Thời Gian</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                         $querryy = mysqli_query($conn, "SELECT ls.* FROM `lich-su-mua` ls ORDER BY ls.id DESC LIMIT 50");
                         while ($row = mysqli_fetch_array($querryy)):
                            $user_display = substr(htmlspecialchars($row['username']), 0, 3) . "****";
                            $key_id = $row['key_id'];

                            // Fetch subcategory and category info efficiently (consider JOIN in real application)
                            $subcat_info = null;
                            $cat_info = null;
                            $stmt_details = $conn->prepare("SELECT s.subcate, s.cateid, c.CategoryName FROM `subcategories` s LEFT JOIN `tscategory` c ON s.cateid = c.id WHERE s.key_id = ? LIMIT 1");
                            if ($stmt_details) {
                                $stmt_details->bind_param("s", $key_id);
                                $stmt_details->execute();
                                $result_details = $stmt_details->get_result();
                                $details = $result_details->fetch_assoc();
                                $stmt_details->close();
                                if ($details) {
                                    $subcat_info = $details['subcate'];
                                    $cat_info = $details['CategoryName'];
                                }
                            }
                            $subcat_display = $subcat_info ? htmlspecialchars($subcat_info) : 'N/A';
                            $cat_display = $cat_info ? htmlspecialchars($cat_info) : 'N/A';
                            ?>
                             <tr style="vertical-align: middle;">
                                 <td style="padding: 10px 15px;"><?= $row['id']; ?></td>
                                 <td style="padding: 10px 15px; font-weight: 500;"><?= $user_display ?></td>
                                 <td style="padding: 10px 15px;">Mua <b><?= htmlspecialchars($row['amount']); ?></b> <?= $subcat_display; ?></td>
                                 <td style="padding: 10px 15px; font-size: 0.9em; color: #555;"><?= $cat_display; ?></td>
                                 <td style="padding: 10px 15px; font-size: 0.9em; color: #555;">
                                     <?php echo 'Ngày <b style="color: #dc3545;">'.date('d-m-Y', $row['time']).'</b> lúc <b style="color: #007bff;">'.date('H:i:s', $row['time']).'</b>' ?>
                                 </td>
                             </tr>
                         <?php endwhile; ?>
                     </tbody>
                 </table>
             </div>
         </div>
    </div>

    <div class="card" style="border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
         <div class="card-header" style="background-color: #6c757d; color: white; padding: 15px 20px; font-weight: 600; font-size: 1.1em;">
            <i class="fa fa-question-circle fa-fw"></i> Các câu hỏi thường gặp (FAQ)
        </div>
        <div class="card-body" style="padding: 20px;">
            <div class="accordion" id="accordionExample">
                <div style="margin-bottom: 10px; border: 1px solid #dee2e6; border-radius: 5px; overflow: hidden;">
                    <div style="background-color: #f8f9fa; padding: 0;">
                        <a href="#" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1" style="display: block; padding: 12px 20px; text-decoration: none; color: #343a40; font-weight: 500;">
                            Nick Vui cung cấp mặt hàng gì? <i class="fa fa-chevron-down fa-fw" style="float: right; transition: transform 0.3s;"></i>
                        </a>
                    </div>
                    <div id="collapse-1" class="collapse" aria-labelledby="heading-1" data-parent="#accordionExample">
                        <div style="padding: 15px 20px; border-top: 1px solid #dee2e6; font-size: 0.95em; line-height: 1.6;">
                           Nick Vui chuyên cung cấp Email Outlook, Email Hotmail, Email Gmail; Acc Azure, Acc Digital Ocean, Acc AWS, Acc Oracle; Clone-Via Facebook, ... và các loại mặt hàng phục vụ MMO khác!
                        </div>
                    </div>
                </div>
                <div style="margin-bottom: 10px; border: 1px solid #dee2e6; border-radius: 5px; overflow: hidden;">
                    <div style="background-color: #f8f9fa; padding: 0;">
                         <a href="#" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2" style="display: block; padding: 12px 20px; text-decoration: none; color: #343a40; font-weight: 500;">
                            VPS là gì? <i class="fa fa-chevron-down fa-fw" style="float: right; transition: transform 0.3s;"></i>
                        </a>
                    </div>
                    <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordionExample">
                         <div style="padding: 15px 20px; border-top: 1px solid #dee2e6; font-size: 0.95em; line-height: 1.6;">
                            VPS là viết tắt của Virtual Private Server (máy chủ riêng ảo), nó ảo hóa để có thể chạy 24/7 thực hiện các công việc mang tính liên tục. VPS có thể cài Windows, Linux, ... Có thể dùng PC, Laptop, Điện thoại để điều khiển VPS.
                        </div>
                    </div>
                </div>
                 <div style="margin-bottom: 10px; border: 1px solid #dee2e6; border-radius: 5px; overflow: hidden;">
                    <div style="background-color: #f8f9fa; padding: 0;">
                         <a href="#" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3" style="display: block; padding: 12px 20px; text-decoration: none; color: #343a40; font-weight: 500;">
                            Azure là gì? <i class="fa fa-chevron-down fa-fw" style="float: right; transition: transform 0.3s;"></i>
                        </a>
                    </div>
                     <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordionExample">
                        <div style="padding: 15px 20px; border-top: 1px solid #dee2e6; font-size: 0.95em; line-height: 1.6;">
                            Azure (thuộc Microsoft) là nhà cung cấp các dịch vụ Cloud, ... Chắc chắn có cung cấp VPS. Giá VPS của Azure rất cao. Nhưng chúng ta có thể dùng lậu bằng việc sử dụng Mail Edu hoặc Visa/Master Card để tạo Azure.
                            <br/><br/>
                            Có 3 loại Azure chính, chúng dược gọi tắt như sau:<br/>
                            - <b>Azure Students (Credit 100$):</b> Loại này sau khi đăng kí sẽ có 100$ Credit để các bạn dùng. Chúng ta có thể dùng Mail Edu để tạo nó!<br/>
                            - <b>Azure Trial (Credit 200$):</b> Loại này sau khi đăng kí sẽ có 200$ Credit để dùng dịch vụ. Chúng ta có thể dùng Visa/Master Card để tạo!<br/>
                            - <b>Azure Pay As You Go (Tín dụng Trả sau, Credit khoảng 1000$):</b> Loại này Azure sẽ cho bạn xài trước rồi thanh toán sau. Hạn ngạch ghi nợ đa số khoảng 1000$. Sau đó các bạn có thể bỏ Acc, hoặc thanh toán số tiền đó thì tùy =)))<br/>
                        </div>
                    </div>
                </div>

            </div> </div> </div> </div> <script>
    $(function () {
        // Initialize DataTable for recent transactions
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false, // Hide length change
            "searching": false,    // Hide search box
            "ordering": true,
            "info": true,
            "order": [[ 0, "desc" ]], // Order by ID descending
            "autoWidth": false, // Prevent auto width calculation
            "responsive": true,  // Make table responsive
            "language": { // Optional: Vietnamese translation
                 "paginate": {
                     "previous": "Trước",
                     "next": "Sau"
                 },
                 "info": "Hiển thị _START_ đến _END_ của _TOTAL_ giao dịch",
                 "infoEmpty": "Không có giao dịch nào",
                 "infoFiltered": "(lọc từ _MAX_ tổng số giao dịch)"
             }
        });

        // Optional: Add icon rotation for accordion
        $('.collapse').on('show.bs.collapse', function () {
            $(this).prev().find('.fa-chevron-down').css('transform', 'rotate(180deg)');
        }).on('hide.bs.collapse', function () {
             $(this).prev().find('.fa-chevron-down').css('transform', 'rotate(0deg)');
        });
    });
</script>

<?php
require $_SERVER['DOCUMENT_ROOT']."/layout/script.php"; // Assumes this includes jQuery, Bootstrap JS, DataTables JS
?>