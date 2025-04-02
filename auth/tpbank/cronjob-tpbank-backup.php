<?php
require $_SERVER["DOCUMENT_ROOT"] . "/core/database.php";
// Yêu cầu file json.php
require 'fix-6-1-2024.php';


// Gọi hàm get_history2 và nhận dữ liệu JSON
$jsonData = get_history2($token, $stk_tpbank);

// Chuyển đổi JSON thành một đối tượng PHP
$data = json_decode($jsonData);

// Kiểm tra xem dữ liệu có hợp lệ không
if (is_null($data)) {
    echo "Lỗi khi phân tích JSON.";
} else {
    // Duyệt qua từng phần tử trong mảng
    foreach ($data->transactionInfos as $transaction) {
        // Hiển thị thông tin chi tiết của mỗi giao dịch
        echo "<br><br>ID: " . $transaction->id . "<br>";
        echo "Reference: " . $transaction->reference . "<br>";
        echo "Mô tả: " . $transaction->description . "<br>";
        echo "Ngày giao dịch: " . $transaction->bookingDate . "<br>";
        echo "Số tiền: " . $transaction->amount . "<br>";
        echo "Loại tiền tệ: " . $transaction->currency . "<br>";
        echo "Số dư hiện tại: " . $transaction->runningBalance . "<br>";
        
        
        $query = mysqli_query($conn,"SELECT * FROM `users` ORDER BY id DESC");
        
        
        $cuphap = strtolower($transaction->description);
        $amount = $transaction->amount;
        $reference = $transaction->reference;
        echo 'stringlower: '.$cuphap.'<br>';
        
        //echo'<br>';
        while($row = mysqli_fetch_array($query)){
            $username = strtolower($row['username']);
            //echo ''.$charusername.' <br>';
            $position = strpos($cuphap, $username);
            
            if ($position !== false) {
                echo "Tìm thấy username '$username' trong chuỗi '$cuphap' tại vị trí $position<br>";
                $queryhistory = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `history_naptien` WHERE `tranid` = '$reference'"));
                
                if (!$queryhistory) {
                    $time = gettime();
                    //$updatehistory = mysqli_query($conn,"INSERT INTO `history_naptien` SET `type`='TPBANK AUTO',  `username`='$username', `menhgia`='$amount', `thucnhan`='$amount', `tranid` = '$reference', `date` = '$time', `trangthai`='1'");
                    //$updatemoney = mysqli_query($conn,"UPDATE `users` SET `cash`= `cash` + $amount WHERE `username` = '$username'");
                    if ($updatemoney && $updatemoney) {
                        echo '<font color="blue">Đã update</font>';
                    }
                } else {
                    echo '<font color="green">Đã thực hiện cộng</font><br>';
                }

            }
            
            
        }
        
    }
}

?>
