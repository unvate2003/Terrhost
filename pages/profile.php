<?php
session_start();
if(empty($_SESSION['username'])){
	session_destroy();
	header('location: /');
	die();
}
include('../core/database.php');
$title = 'Thông Tin Tài Khoản | ';
include('../layout/head.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");
?>
<div id="content" class="main-content" style="padding: 20px;">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                        <div class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                         <center>   <h4>Cập nhật thông tin</h4></center>
                                        
                                    </div>
                                </div>
                                <div class="widget-content animated-underline-content">
                                  
                                    <ul class="nav nav-tabs mb-2" id="animateLine" role="tablist">
                                   
                                        <li class="nav-item">
                                            <a class="nav-link active" id="animated-underline-profile-tab" data-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Thông Tin</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab" href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Đổi Mật Khẩu</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="animateLineContent-4">
                               
                                        <div class="tab-pane fader show active" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                                        <form>
                                        <div class="form-group">
                  <label for="">Tên tài khoản</label>
                  <input type="text" title="Tên Tài Khoản" class="form-control bs-tooltip" value="<?= $data['username']; ?>" readonly>
                </div> 
                   <div class="form-group">
                  <label for="">Số dư</label>
                  <input type="text" title="Số Dư Hiện Có" class="form-control bs-tooltip" value="<?= number_format($data['cash']); ?> đ" readonly>
                </div>
                                          <div class="form-group">
		  <label for="">Email</label>
		  <input type="email" id="email" class="form-control bs-tooltip" title="Email" placeholder="Email" value="<?= $data['email']; ?>" readonly>
		</div>
		<div class="form-group">
                  <label for="">Thời gian tham gia:</label>
                  <input type="text" title="Thời Gian Tham Gia" class="form-control bs-tooltip" value="<?= $data['time']; ?>" readonly>
                </div> 
                <div class="form-group">
                  <label for="">User Agent</label>
                  <input type="text" title="User Agent" class="form-control bs-tooltip" value="<?= $data['useragent']; ?>" readonly>
                </div> 
        </form>
                                        </div>
                                        <div class="tab-pane fade" id="animated-underline-contact" role="tabpanel" aria-labelledby="animated-underline-contact-tab">
                                              <form>
                                          <div class="form-group">
		  <label for="">Mật khẩu cũ</label>
		  <input type="password" id="passold" class="form-control bs-tooltip" title="Mật Khẩu Cũ" placeholder="Mật Khẩu Cũ">
		</div>
		                                          <div class="form-group">
		  <label for="">Mật khẩu mới</label>
		  <input type="password" id="password" class="form-control bs-tooltip" title="Mật Khẩu Mới" placeholder="Mật Khẩu Mới">
		         </div> 
		           <div class="form-group">
	  <label for="">Nhập lại mật khẩu mới</label>
		   <input type="password" id="repassword" class="form-control bs-tooltip" title="Nhập lại mật Khẩu Mới" placeholder="Nhập lại mật Khẩu Mới" >
	
	</div> 
		<div class="form-group text-center">
		    <button type="button" class="btn btn-dark" id="change"><i class="fa fa-save"></i> Cập nhật</button>
        </div>  
        </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        </div>
                            </div>
                        </div>
                        
<script type="text/javascript">

           function _0x3dc9(_0x1f2763,_0x2f5f7b){var _0xba6468=_0xba64();return _0x3dc9=function(_0x3dc983,_0x310ed0){_0x3dc983=_0x3dc983-0xe6;var _0x4e5a49=_0xba6468[_0x3dc983];return _0x4e5a49;},_0x3dc9(_0x1f2763,_0x2f5f7b);}function _0xba64(){var _0x4227fb=['/Query/ChangePassWord.html','Vui\x20Lòng\x20Nhập\x20Mật\x20Khẩu\x20Mới','#change','591271WzApaY','val','disabled','15qMHUhV','error','#passold','765846wzOkAj','<i\x20class=\x22fa\x20fa-refresh\x20fa-spin\x22></i>\x20Đang\x20Xử\x20Lý','215694bVmuUM','18345250pBpdmS','post','44XNsIpz','793655FbehRB','Vui\x20Lòng\x20Nhập\x20Lại\x20Mật\x20Khẩu\x20Mới','Vui\x20Lòng\x20Nhập\x20Mật\x20Khẩu\x20Cũ','#repassword','56MXOlIm','13362208qyEVxG','prop','click','2068011DMolkY','html'];_0xba64=function(){return _0x4227fb;};return _0xba64();}var _0x5afd3f=_0x3dc9;(function(_0x9460ba,_0x1660cb){var _0x1b6f43=_0x3dc9,_0x9cf008=_0x9460ba();while(!![]){try{var _0x52668a=-parseInt(_0x1b6f43(0xfc))/0x1+parseInt(_0x1b6f43(0xeb))/0x2*(parseInt(_0x1b6f43(0xe6))/0x3)+-parseInt(_0x1b6f43(0xee))/0x4*(parseInt(_0x1b6f43(0xef))/0x5)+-parseInt(_0x1b6f43(0xe9))/0x6*(parseInt(_0x1b6f43(0xf3))/0x7)+parseInt(_0x1b6f43(0xf4))/0x8+parseInt(_0x1b6f43(0xf7))/0x9+parseInt(_0x1b6f43(0xec))/0xa;if(_0x52668a===_0x1660cb)break;else _0x9cf008['push'](_0x9cf008['shift']());}catch(_0x189fc9){_0x9cf008['push'](_0x9cf008['shift']());}}}(_0xba64,0xdf7af),$(_0x5afd3f(0xfb))[_0x5afd3f(0xf6)](function(){var _0x39fbff=_0x5afd3f,_0x3147ab=$('#password')[_0x39fbff(0xfd)](),_0x126d7c=$(_0x39fbff(0xe8))[_0x39fbff(0xfd)](),_0x19ee5e=$(_0x39fbff(0xf2))['val']();if(!_0x126d7c)return swal(_0x39fbff(0xf1),_0x39fbff(0xe7)),![];else{if(!_0x3147ab)return swal(_0x39fbff(0xfa),'error'),![];else{if(!_0x19ee5e)return swal(_0x39fbff(0xf0),_0x39fbff(0xe7)),![];}}$(_0x39fbff(0xfb))['prop'](_0x39fbff(0xfe),!![])['html'](_0x39fbff(0xea)),$[_0x39fbff(0xed)](_0x39fbff(0xf9),{'password':_0x3147ab,'passold':_0x126d7c,'repassword':_0x19ee5e},function(_0xdebc46,_0x16602a){var _0x113747=_0x39fbff;$('#trave')[_0x113747(0xf8)](_0xdebc46),$(_0x113747(0xfb))[_0x113747(0xf5)](_0x113747(0xfe),![])[_0x113747(0xf8)]('<i\x20class=\x22fa\x20fa-save\x22></i>\x20Cập\x20nhật');});}));

</script>
<div id="trave" style="display: none;">
	</div>
		<script type="text/javascript">
            function toarst(status, msg, title) {
         Command: toastr[status](msg, title)
            toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "4000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "slideDown",
            "hideMethod": "slideUp"
        }
    }
</script>
<?php
require_once '../layout/script.php';
?>