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
        $similarityold=0;
        $i=0;
        while($row = mysqli_fetch_array($query)){
            $username = strtolower($row['username']);
            $position = strpos($cuphap, $username);
            similar_text($cuphap, $username, $similarity);
            
            $similarratio = 9 * strlen($username); 
            if ($position !== false) {
                $queryhistory = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `history_naptien` WHERE `tranid` = '$reference'"));
                if($similarity >= $similarityold) {
                    if (!$queryhistory) {
                        $time = gettime();
                        //$updatehistory = mysqli_query($conn,"INSERT INTO `history_naptien` SET `type`='TPBANK AUTO',  `username`='$username', `menhgia`='$amount', `thucnhan`='$amount', `tranid` = '$reference', `date` = '$time', `trangthai`='1'");
                        //$updatemoney = mysqli_query($conn,"UPDATE `users` SET `cash`= `cash` + $amount WHERE `username` = '$username'");
                        if ($updatemoney && $updatemoney) {
                            echo '<font color="blue">Đã update</font>';
                        }
                        
                    }
                    echo '<font color="red">Lấy giá trị: <b>'.$username.'</b></font><br>';
                }
                
                echo 'Giá trị thứ: '.$i.'</br>';
                echo "Tìm thấy username '$username' trong chuỗi '$cuphap' tại vị trí $position<br>";
                echo '<font color="green">Giá trị hiện tại là: '.$similarity.' và giá trị cũ là '.$similarityold.'</font><br></br>';
                
                $similarityold = $similarity;
                $i++;
            }
            
            
        }
        
    }
}

?>
