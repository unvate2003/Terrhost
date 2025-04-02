<!DOCTYPE html>
<html>
<head>
	<title>Thay đổi định dạng giá tiền</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#price').on('input', function() {
				// Chuyển đổi giá trị đầu vào thành một số nguyên
				var num = parseInt($(this).val().replace(/\D/g, ''));

				// Định dạng chuỗi thành giá tiền
				var formattedNum = num.toLocaleString('en-US');

				// Cập nhật giá trị đầu vào với giá trị đã định dạng
				$(this).val(formattedNum);
			});
		});
	</script>
</head>
<body>
	<label for="price">Nhập giá tiền:</label>
	<input type="text" id="price" />

</body>
</html>