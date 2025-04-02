<?php
session_start();
if(empty($_SESSION['username'])){
	session_destroy();
	header('location: /');
	die();
}
include('../core/database.php');
$title = 'Nạp Thẻ Cào | ';
include('../layout/head.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");
?>
<div class="main-container" style="padding: 20px;">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <!--
                        <div class="title">
                            <h4>Nạp Thẻ Cào</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Nạp Tiền</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Thẻ Cào</li>
                            </ol>
                        </nav>
                        -->
                    </div>
                </div>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">NẠP THẺ</h4>
                        <p class="mb-30">Nạp tiền qua thẻ cào tự động</p>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="btn btn-primary btn-sm scroll-click" rel="content-y" data-toggle="collapse" role="button">Auto</a>
                    </div>
                </div>

                <form action="" method="POST">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nhập seri:</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="number" name="serial" placeholder="Nhập Seri">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nhập mã thẻ:</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="number" name="code" placeholder="Nhập mã thẻ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Loại thẻ:</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="telco" required="">
                                <option value="">Chọn loại thẻ *</option>
                                <option value="VIETTEL">Viettel</option>
                                <option value="MOBIFONE">Mobifone</option>
                                <option value="VINAPHONE">Vinaphone</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Mệnh giá:</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="amount" id="menhgia">
                                <option value="">Chọn mệnh giá *</option>
                                <option value="10000">10,000đ </option>
                                <option value="20000">20,000đ</option>
                                <option value="30000">30,000đ</option>
                                <option value="50000">50,000đ</option>
                                <option value="100000">100,000đ</option>
                                <option value="200000">200,000đ</option>
                                <option value="300000">300,000đ</option>
                                <option value="500000">500,000đ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Chiết khấu:</label>
                        <div class="col-sm-12 col-md-10">
                            <b style="color:blue;"><?= $setup['cktsr'] ?>%</b>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Thực nhận:</label>
                        <div class="col-sm-12 col-md-10">
                            <b id="ketqua" style="color:red;">0</b>
                        </div>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-12 col-md-2 col-form-label"></label>
                        <div class="col-sm-12 col-md-10">
                        <button type="submit" id="napthe" class="btn btn-success btn-lg btn-block">Nạp Ngay
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card list"></div>
</div>

<!--
<link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
-->
<script type="text/javascript">
$('#menhgia').on('change', function() {
    var menhgia = $('#menhgia').val();
    var ck = <?=$setup['cktsr'];?>;
    var ketqua = menhgia - menhgia * ck / 100;
    $('#ketqua').html(ketqua.toString().replace(/(.)(?=(\d{3})+$)/g, '$1,'));


});
</script>
   <script type="text/javascript">
page = 1;
           function load_api_n_h(){
                $.post("/Query/LichSu.html", { page : page })
                .done(function(data) {
                    $(".list").html('');
                    $('.list').empty().append(data);
                    $(".list").show();   
                }); 
            }
            function search_tester(){
                id = $("#id").val();
                load_api_n_h();                                                                                                                                          
            }
load_api_n_h();
$(document).ready(function(){
		$('#napthe').click(function() {
		$('#napthe').html('Đang thực hiện...');
		$('#napthe').prop('disabled', true);
		var formData = {
		'type' : 'napthecao',
            'serial'              : $('input[name=serial]').val(),
            'code'              : $('input[name=code]').val(),
            'telco'              : $('select[name=telco]').val(),
            'amount'              : $('select[name=amount]').val()
		};
		$.post("/Query/NapThe.html", formData,
			function (data) {
			    if(data.status == '1'){
				swal( data.msg, 'error');
				$('#napthe').html('Nạp ngay');
			$('#napthe').prop('disabled', false);
			    }else{
			     //window.location="/";   
			     swal( data.msg, 'success');
			     	$('#napthe').html('Nạp ngay');
			$('#napthe').prop('disabled', false);
           load_api_n_h();
			    }
		}, "json");
	});
});
</script>

    <?php require_once '../layout/script.php'; ?>