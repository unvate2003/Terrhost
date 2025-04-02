<?php
session_start();
// *** QUAN TRỌNG: Đảm bảo đường dẫn này chính xác ***
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";

// Đặt header để client biết đây là JSON
header('Content-Type: application/json; charset=utf-8');

// --- Kiểm tra kết nối CSDL ---
if (!$conn) {
    // Trả về cấu trúc JSON lỗi nếu không kết nối được
    echo json_encode([
        "draw" => isset($_REQUEST['draw']) ? intval($_REQUEST['draw']) : 0,
        "iTotalRecords" => 0,
        "iTotalDisplayRecords" => 0,
        "aaData" => [],
        "error" => "Lỗi kết nối cơ sở dữ liệu." // Thông báo lỗi chung chung
    ]);
    exit; // Dừng script
}

// --- Đọc và Validate các tham số đầu vào (chấp nhận GET/POST) ---
// Sử dụng toán tử Null Coalescing (??) của PHP 7+ để đặt giá trị mặc định
$draw = intval($_REQUEST['draw'] ?? 1);
$row = intval($_REQUEST['start'] ?? 0); // Vị trí bắt đầu (offset)
$rowperpage = intval($_REQUEST['length'] ?? 10); // Số dòng mỗi trang

// Đảm bảo giá trị hợp lệ (không âm, length > 0)
$row = max(0, $row);
$rowperpage = max(1, $rowperpage); // Ít nhất 1 dòng/trang

// Tham số sắp xếp
$columnIndex = intval($_REQUEST['order'][0]['column'] ?? 0); // Index cột sắp xếp
$columnSortOrder = strtolower($_REQUEST['order'][0]['dir'] ?? 'desc'); // Hướng sắp xếp (asc/desc)

// Tham số tìm kiếm
$searchValue = $_REQUEST['search']['value'] ?? ''; // Giá trị tìm kiếm

// --- Xác định cột sắp xếp một cách an toàn ---
$columnName = 'id'; // Cột sắp xếp mặc định
// *** QUAN TRỌNG: Cập nhật danh sách này với tên các cột bạn cho phép sắp xếp ***
$allowedSortColumns = ['id', 'text', 'cate', 'subcate', 'time']; // Ví dụ

if (isset($_REQUEST['columns'][$columnIndex]['data'])) {
    $potentialColumnName = $_REQUEST['columns'][$columnIndex]['data'];
    // Chỉ chấp nhận tên cột nếu nó nằm trong danh sách cho phép
    if (in_array($potentialColumnName, $allowedSortColumns)) {
        $columnName = $potentialColumnName;
    }
}

// Validate hướng sắp xếp
if (!in_array($columnSortOrder, ['asc', 'desc'])) {
    $columnSortOrder = 'desc'; // Mặc định 'desc' nếu không hợp lệ
}

// --- Xây dựng điều kiện tìm kiếm một cách an toàn ---
$searchQuery = ""; // Khởi tạo
if($searchValue != ''){
    $escapedSearchValue = mysqli_real_escape_string($conn, $searchValue); // Chống SQL Injection
    // Điều chỉnh các cột bạn muốn tìm kiếm
    $searchQuery = " AND (text LIKE '%".$escapedSearchValue."%' OR
        id LIKE '%".$escapedSearchValue."%' OR
        key_id LIKE '%".$escapedSearchValue."%') ";
}

// --- Lấy tổng số bản ghi (không lọc) ---
$totalRecords = 0; // Giá trị mặc định
$sqlTotal = "SELECT count(*) AS allcount FROM `san-pham-chua-ban`";
$resultTotal = mysqli_query($conn, $sqlTotal);
if ($resultTotal) {
    $recordsTotal = mysqli_fetch_assoc($resultTotal);
    $totalRecords = $recordsTotal['allcount'] ?? 0;
    mysqli_free_result($resultTotal); // Giải phóng bộ nhớ
} else {
    // Ghi log lỗi SQL nếu cần
    // error_log("SQL Error (TotalRecords): " . mysqli_error($conn));
}

// --- Lấy tổng số bản ghi (có lọc) ---
$totalRecordwithFilter = 0; // Giá trị mặc định
$sqlFilter = "SELECT count(*) AS allcount FROM `san-pham-chua-ban` WHERE 1 ".$searchQuery;
$resultFilter = mysqli_query($conn, $sqlFilter);
if ($resultFilter) {
    $recordsFilter = mysqli_fetch_assoc($resultFilter);
    $totalRecordwithFilter = $recordsFilter['allcount'] ?? 0;
    mysqli_free_result($resultFilter); // Giải phóng bộ nhớ
} else {
    // Ghi log lỗi SQL nếu cần
    // error_log("SQL Error (FilterCount): " . mysqli_error($conn));
}

// --- Truy vấn lấy dữ liệu chính ---
$data = array(); // Khởi tạo mảng dữ liệu
// Sử dụng tên cột và hướng sắp xếp đã được validate, thêm LIMIT
$empQuery = "SELECT * FROM `san-pham-chua-ban` WHERE 1 ".$searchQuery."
             ORDER BY `".$columnName."` ".$columnSortOrder."
             LIMIT ".$row.",".$rowperpage;

$empRecords = mysqli_query($conn, $empQuery);

// --- Xử lý kết quả ---
if ($empRecords) {
    while ($row_data = mysqli_fetch_assoc($empRecords)) { // Đổi tên biến $row để tránh trùng
        // --- Lấy dữ liệu thô từ dòng hiện tại ---
        $product_id = $row_data['id'];
        $keyid = $row_data['key_id'];
        $product_text = $row_data['text'];
        $cate_id = $row_data['cate'];          // ID của category
        $subcate_id = $row_data['subcate'];      // ID của subcategory (giả định)
        $time_stamp = $row_data['time'];       // Timestamp
        $active_status = $row_data['active'];     // Trạng thái (0 hoặc 1)
        // Lấy thêm các cột thô khác nếu cần, ví dụ: $subcatekey = $row_data['subcatekey'];

        // --- Tra cứu thông tin phụ (Category, Subcategory) ---
        // Category Name
        $categoryName = 'N/A'; // Mặc định nếu không tìm thấy
        // Thêm dấu nháy quanh biến chuỗi/số trong SQL và xử lý lỗi/không tìm thấy
        $catSql = "SELECT CategoryName FROM tscategory WHERE id = '$cate_id'";
        $catQuery = mysqli_query($conn, $catSql);
        if ($catQuery && $categories = mysqli_fetch_assoc($catQuery)) {
            $categoryName = $categories['CategoryName'];
            mysqli_free_result($catQuery);
        }

        // Subcategory Name and Rate
        $subcategoryName = 'N/A'; // Mặc định
        $subcategoryRate = 0;    // Mặc định
        // *** QUAN TRỌNG: Kiểm tra lại tên bảng, cột khóa chính/phụ cho subcategories ***
        // Giả sử 'subcate' trong 'san-pham-chua-ban' liên kết với 'subcateid' trong 'subcategories'
        $subcatSql = "SELECT subcate, rate FROM `subcategories` WHERE subcateid = '$subcate_id'";
        $subcatQuery = mysqli_query($conn, $subcatSql);
        if ($subcatQuery && $subcategories = mysqli_fetch_assoc($subcatQuery)) {
            $subcategoryName = $subcategories['subcate']; // Cột chứa tên subcategory
            $subcategoryRate = $subcategories['rate'];   // Cột chứa giá
            mysqli_free_result($subcatQuery);
        }

        // --- Định dạng HTML cho các cột hiển thị (Giữ nguyên theo code gốc) ---
        $active_html = '';
        // Logic trạng thái: 0 = Công Khai (info), 1 = Chờ Duyệt (danger) - Kiểm tra lại nếu cần!
        if($active_status == '0'){
             // Giữ nguyên name, id, class nếu JS có sử dụng
            $active_html = '<a name="catestthide" class="btn label label-info catestthide" id="'.$keyid.'" alt="'.$keyid.'">Công Khai</a>';
        } else if($active_status == '1'){
            $active_html = '<a name="catesttpost" class="btn label label-danger catesttpost" id="'.$keyid.'" alt=" ">Chờ Duyệt</a>';
        }

        $giatien_formatted = number_format($subcategoryRate); // Định dạng số tiền
        // Nút xóa - Thêm xác nhận JS đơn giản
        $delete_href = '?xoa=' . htmlspecialchars($keyid); // Trỏ về trang hiện tại với param 'xoa'
        $xoa_html = '<a name="delete" class="btn btn-danger btn-sm delete" id="'.$product_id.'" alt=" " href="'.$delete_href.'" onclick="return confirm(\'Bạn chắc chắn muốn xóa sản phẩm ID '.$product_id.'?\');"><i class="fa fa-trash"></i></a>';

        // --- Thêm dữ liệu vào mảng $data (bao gồm cả thô và đã định dạng) ---
        $data[] = array(
            // --- Dữ liệu ĐÃ ĐỊNH DẠNG HTML (để khớp với JS DataTables config) ---
            "id"            =>'<small>'.$product_id.'</small>',
            "sanpham"       =>'<small>'.htmlspecialchars($product_text).'</small>', // Thêm htmlspecialchars
            "categories"    =>'<small class="label label-success">'.htmlspecialchars($categoryName).'</small>', // Thêm htmlspecialchars
            "subcategories" =>'<small class="label label-primary">'.htmlspecialchars($subcategoryName).'</small>', // Thêm htmlspecialchars
            "time"          =>'<small class="label label-warning">'.date('d/m/Y H:i', $time_stamp).'</small>', // Dùng H:i cho 24h
            "giatien"       =>'<small class="label label-warning">'.$giatien_formatted.' đ</small>',
            "trangthai"     =>'<small>'.$active_html.'</small>', // Bọc trong <small> như code gốc
            "xoa"           =>$xoa_html,

            // --- Dữ liệu THÔ (Thêm vào để có đầy đủ nội dung) ---
            "raw_id"                => intval($product_id), // ID dạng số
            "raw_key_id"            => $keyid,
            "raw_text"              => $product_text,
            "raw_cate_id"           => intval($cate_id),
            "raw_subcate_id"        => intval($subcate_id),
            "raw_timestamp"         => intval($time_stamp), // Timestamp dạng số
            "raw_active_status"     => intval($active_status), // Trạng thái gốc (0 hoặc 1)
            "raw_category_name"     => $categoryName,       // Tên category gốc
            "raw_subcategory_name"  => $subcategoryName,    // Tên subcategory gốc
            "raw_subcategory_rate"  => floatval($subcategoryRate) // Giá dạng số
            // Thêm các trường thô khác nếu cần, ví dụ:
            // "raw_subcatekey" => $row_data['subcatekey'] ?? null
        );
    }
    mysqli_free_result($empRecords); // Giải phóng bộ nhớ sau vòng lặp
} else {
    // Ghi log lỗi SQL nếu cần
    // error_log("SQL Error (FetchRecords): " . mysqli_error($conn));
}

// --- Đóng gói và Xuất phản hồi JSON cuối cùng ---
$response = array(
    "draw"            => $draw,
    "iTotalRecords"     => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter, // Quan trọng cho phân trang DataTables
    "aaData"          => $data                   // Mảng chứa dữ liệu các hàng
);

// In ra chuỗi JSON
echo json_encode($response);

// Không bắt buộc đóng kết nối nếu PHP tự quản lý
// mysqli_close($conn);

exit; // Kết thúc script

?>