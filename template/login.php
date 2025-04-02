<?php
session_start();
if(isset($_SESSION['username'])){
  header('location: /home');
  die();
}
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
$title = 'Đăng Nhập | ';
require $_SERVER['DOCUMENT_ROOT']."/layout/head.php";

?>

<div class="card">
    <div class="card-body">
        <center>
            <img class="mb-4" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/images/favicon/favicon-rounded.png" alt="" width="72" height="72">
        </center>
        <h1 class="h3 mb-3 font-weight-normal text-center">Đăng Nhập <?php echo $setup['brand-name']; ?></h1>
        <p class="text-muted mb-1">Điền thông tin tài khoản của bạn vào bên dưới.</p>
        
        <div class="row">
            <div class="col-lg-12">
                <!--<label for="Email" class="sr-only">Tài khoản:</label>-->
                <div class="form-group">
                    <label for="Email" class="text-secondary">Tài khoản:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="id" id="username" name="username" class="form-control" placeholder="Nhập tên tài khoản (Username)" required autofocus>
                    </div>
                </div>
                
                
                
                <div class="form-group">
                    <label for="Password" class="text-secondary">Mật khẩu:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu (Password)" required>
                    </div>
                </div>
                <?php
                $checkipcount1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `log` WHERE `ip` = '$ip' "));
                // Reset Check Captcha
                //echo ''.$checkipcount1['count'].'';
                if($checkipcount1 and $checkipcount1['count'] >= 5 and $checkipcount1['time']<=time()) {
                    mysqli_query($conn, "DELETE FROM `log` WHERE `ip` = '$ip'");
                    //unset($_SESSION['CaptchaCode']);
                echo '<script type="text/javascript">setTimeout(function(){ location.href = "/login" },0);</script>';
                } else 
        	    if($checkipcount1 and $checkipcount1['count'] >= 5) {
        	    ?>
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
            
                <?php
                } 
                ?>
        
            </div>
        </div>
        <hr>
        <button class="btn btn-lg btn-primary btn-block" id="submit" type="submit" name="submit" type="button">Đăng Nhập</button>
        <div class="m-3 text-center text-muted">
            <p class="">Bạn chưa có tài khoản? <a href="/signup" class="text-primary ml-2"> Vui lòng Đăng Ký ngay</a> </br> <a href="resetpassword">Quên mật khẩu?</a>
            </p>
        </div>

        <p class="mt-5 mb-3 text-muted">Copyright ©
            <?php echo date( 'Y'); ?>
            <?php echo $setup[ 'name-footer']; ?>
        </p>
    </div>
</div>

<?php
    $checkipcount2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `log` WHERE `ip`='$ip'"));
	if($checkipcount1 and $checkipcount2['count'] >= 5) {
?>
<script type="text/javascript">
        $(".refresh").click(function () {
            $(".SecureCaptcha").attr("src","/Secure/Captcha/CaptchaImage.png?_="+((new Date()).getTime()));
        });        
        $('#submit').click(function(){
            var username = $('#username').val();
            var password = $('#password').val();
            var captcha = $('#captcha').val();
                if (!username) {
                    swal("Vui Lòng Nhập Tài Khoản","error");
                    return false;
                }
                else if (!password) {
                swal("Vui Lòng Nhập Mật Khẩu","error");
                return false;
                }
                else if (!captcha) {
                swal("Vui Lòng Nhập Mã Xác Nhận","error");
                return false;
                }
                $('#submit').prop('disabled', true)
                $.post('Query/Login.html', {
                    username: username,
                    password: password,
                    captcha: captcha
                }, function(data, status) {
                    $("#trave").html(data);
                    $('#submit').prop('disabled', false);
                });
            });
         
</script>
<?php
	 } else {
?>
<script type="text/javascript">
        $(".refresh").click(function () {
            $(".SecureCaptcha").attr("src","/Secure/Captcha/CaptchaImage.png?_="+((new Date()).getTime()));
        });        
        $('#submit').click(function(){
            var username = $('#username').val();
            var password = $('#password').val();
            
                if (!username) {
                    swal("Vui Lòng Nhập Tài Khoản","error");
                    return false;
                }
                else if (!password) {
                swal("Vui Lòng Nhập Mật Khẩu","error");
                return false;
                }
                $('#submit').prop('disabled', true)
                $.post('Query/Login.html', {
                    username: username,
                    password: password,
                }, function(data, status) {
                    $("#trave").html(data);
                    $('#submit').prop('disabled', false);
                });
            });
         
</script>
<?php } ?>



<div id="trave" style="display: none;">
</div>


<?php
require $_SERVER['DOCUMENT_ROOT']."/layout/script.php";
?>

