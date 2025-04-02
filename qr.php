<?php
// Tạo văn bản bạn muốn chuyển thành mã QR
$text = "Hello, world!";

// Kích thước của mã QR (150x150)
$size = 150;

// Tạo một hình ảnh mới
$image = imagecreatetruecolor($size, $size);

// Tạo một màu nền trắng
$bgColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bgColor);

// Tạo một màu đen cho mã QR
$fgColor = imagecolorallocate($image, 0, 0, 0);

// Tạo mã QR
QRcode::png($text, false, 'H', $size, 2);

// Hiển thị hình ảnh hoặc lưu vào tệp
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
