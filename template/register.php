<?php
session_start();
if(isset($_SESSION['username'])){
  header('location: /home');
  die();
}
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
$title = 'Đăng Ký | ';
require $_SERVER['DOCUMENT_ROOT']."/layout/head.php";

?>

<div class="card">
    <div class="card-body">
        <center>
            <img class="mb-4" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/images/favicon/favicon-rounded.png" alt="" width="72" height="72">
        </center>
        <h1 class="h3 mb-3 font-weight-normal text-center">Đăng Ký <?php echo $setup['brand-name']; ?></h1>
        <p class="text-muted mb-1">Điền thông tin tài khoản của bạn vào bên dưới.</p>


        <div class="row">
            <div class="col-lg-12">
                <!-- <label for="username" class="sr-only">Tài khoản</label> -->
                <div class="form-group">
                    <label for="username" class="text-secondary">Tài khoản:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Nhập tên tài khoản (Username)" required autofocus>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email" class="text-secondary">Email:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope fa-fw"></i>
                            </span>
                        </div>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email (Email)" required autofocus>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label for="password" class="text-secondary">Mật khẩu:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu (Password)" required autofocus>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="text-secondary">Nhập lại mật khẩu:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Nhập lại mật khẩu (RePassword)" required autofocus>
                    </div>
                </div>
                <!--
                <label for="password" class="text-secondary">Mã xác nhận:</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-9" style="padding-left: 0px;"> 
                            <input id="captcha" name="captcha" class="form-control" type="text" placeholder="Nhập mã xác nhận (Captcha Code)"  required>
                        </div>
                        <div class="col-md-2">
                            <img src="/Secure/Captcha/CaptchaImage.png" class="SecureCaptcha" />
                        </div>
                        <div class="col-md-1">
                            <img src="assets/themes/images/refresh.png" alt="reload" class="refresh" />
                        </div>
                    </div>
                </div>
                -->
                <div class="form-group">
            	    <label for="password" class="text-secondary refresh">Mã xác nhận:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-check fa-fw"></i>
                            </span>
                        </div>
                        <? //$checkipcount1['time'] ?>
                            
                        <input id="captcha" name="captcha" class="form-control" type="text" placeholder="Nhập mã xác nhận (Captcha Code)" required>
                    
                        
                        <img src="/Secure/Captcha/CaptchaImage.png" class="SecureCaptcha" />
                        <button class="btn btn-info">
                            <i class="fa fa-refresh refresh"></i>
                        </button>
                        <!--
                        <img src="assets/themes/images/refresh.png" alt="reload" class="refresh" />
                        -->

                            

                        </div>
                </div>
            </div>
        </div>
        
        
        <hr>
        <button class="btn btn-lg btn-primary btn-block" id="submit" onclick="submit();" type="button">Đăng Ký</button>
        <div class="m-3 text-center text-muted">
            <p class="">Bạn đã có tài khoản? <a href="/login" class="text-primary ml-2">Vui lòng Đăng Nhập ngay</a> </br> <a href="resetpassword">Quên mật khẩu?</a>
            </p>
        </div>
        <p class="mt-5 mb-3 text-muted">Copyright ©
            <?php echo date( 'Y'); ?>
            <?php echo $setup[ 'name-footer']; ?>
        </p>
    </div>
</div>
        <script type="text/javascript">
        $(".refresh").click(function () {
            $(".SecureCaptcha").attr("src","/Secure/Captcha/CaptchaImage.png?_="+((new Date()).getTime()));
        });        
         $('#submit').click(function(){
              var email = $('#email').val();
              var username = $('#username').val();
              var password = $('#password').val();
              var repassword = $('#repassword').val();
              var captcha = $('#captcha').val();
        if (  !email || !username || !password || !repassword) {
          swal("Vui Lòng Điền Thông Tin Yêu Cầu","error");
          return false;
        }
        $('#submit').prop('disabled', true)
        $.post('<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/Signup.html', {      
        repassword: repassword,
        email: email,
        username: username,
        password: password,
        captcha: captcha
        }, function(data, status) {
        $("#trave").html(data);
        $('#submit').prop('disabled', false);
        });
      });
</script>

<div id="trave" style="display: none;">
</div>


<?php
require $_SERVER['DOCUMENT_ROOT']."/layout/script.php";

?>