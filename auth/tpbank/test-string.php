<?php

$cuphap = "MBVCB.4922706184.090175.bonbon.CT tu 1028445873 NGUYEN TRONG TAN toi 33669955555 CAO VIET HOANG tai TPBANK";
$char = "bonbon";
$position = strpos($cuphap, $char);

if ($position !== false) {
    echo "Tìm thấy chuỗi '$char' tại vị trí $position";
} else {
    echo "Không tìm thấy chuỗi '$char'";
}
?>