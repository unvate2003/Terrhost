<?php
session_start();
if(isset($_SESSION['username'])){
  header('location: /home');
  die();
}
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
require $_SERVER['DOCUMENT_ROOT']."/layout/head.php";
require $_SERVER['DOCUMENT_ROOT']."/auth/smtp/PHPMailer/PHPMailerAutoload.php";
?>
<div class="card">
    <div class="card-body">
        <center>
            <img class="mb-4" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/images/favicon/favicon-rounded.png" alt="" width="72" height="72">
        </center>
        <h1 class="h3 mb-3 font-weight-normal text-center">Quên Mật Khẩu <?php echo $setup['brand-name']; ?></h1>
        <!--
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4 form">
        -->
                <?php
                $key='';
                $email='';
                if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
$error ="";
if (!$email) {
    $error .="<p>Địa chỉ email không hợp lệ, vui lòng nhập một địa chỉ email hợp lệ!</p>";
    }else{
    $sel_query = "SELECT * FROM `users` WHERE email='".$email."'";
    $results = mysqli_query($conn,$sel_query);
    $row = mysqli_num_rows($results);
    if ($row==""){
        $error .= "<p style='color: red;'>Không có người dùng nào được đăng ký với địa chỉ email này!</p>";
        }
    }
    if($error!=""){
    echo "<div class='error'>".$error."</div>
    <br /><a href='javascript:history.go(-1)'><i class='fa fa-arrow-left'></i> Trở về</a>";
        } else {
    $expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
    $expDate = date("Y-m-d H:i:s",$expFormat);
    //$key = md5(2418*2+$email);
    $key = md5(rand(1,1000)*rand(1,1000));
    $addKey = substr(md5(uniqid(rand(),1)),3,10);
    $key = $key . $addKey;
mysqli_query($conn, "DELETE FROM `password_reset` WHERE `email` = '".$email."'");
mysqli_query($conn,
"INSERT INTO `password_reset` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");

$output='<p>Xin Chào,</p>';
$output.='<p>Vui lòng nhấp vào liên kết sau để đặt lại mật khẩu của bạn.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="https://'.$_SERVER['HTTP_HOST'].'/resetnewpass.php?key='.$key.'&email='.$email.'&action=resetpassword" target="_blank">https://'.$_SERVER['HTTP_HOST'].'/resetnewpass.php?key='.$key.'&email='.$email.'&action=resetpassword</a></p>';      
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Hãy đảm bảo sao chép toàn bộ liên kết vào trình duyệt của bạn.
Liên kết sẽ hết hạn sau 1 ngày vì lý do bảo mật.</p>';
$output.='<p>Nếu bạn không yêu cầu email quên mật khẩu này, không có hành động nào
là cần thiết, mật khẩu của bạn sẽ không được đặt lại. Tuy nhiên, bạn có thể muốn đăng nhập vào
tài khoản của bạn và thay đổi mật khẩu bảo mật của bạn vì ai đó có thể đã đoán ra nó.</p>';    
$output.='<p>Cảm ơn.</p>';
$output.='<p>NickVui.Com</p>';
$body = $output; 
$subject = "Password Reset Code - NickVui.Com";

$email_to = $email;
$fromserver = "support@nickvui.com"; 
//require("PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "host68.vietnix.vn"; // Enter your host here
$mail->SMTPAuth = true;
$mail->Username = "support@nickvui.com"; // Enter your email here
$mail->Password = "NickVui12345!@#"; //Enter your passwrod here
$mail->Port = 25;
$mail->IsHTML(true);
$mail->From = "support@nickvui.com";
$mail->FromName = "NickVui.Com";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}else{
echo '<div class="error">
<p style="color: red;">Một email khôi phục mật khẩu đã được gửi cho bạn. Lưu ý: Nhớ kiểm tra trong Hòm Thư Spam nha!</p>
</div><br /><br /><br />';
    }

        }   

}else{
?>
 <p class="text-muted mb-1">Điền thông tin tài khoản của bạn vào bên dưới.</p>
<form method="post" action="" name="reset">
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="Nhập Email Của Bạn" required value="<?php //echo $email ?>">
                            
                            
                        </div>
                        <div class="form-group">
                            <input class="btn btn-lg btn-primary btn-block" type="submit" name="check-email" value="Tiếp Tục">
                        </div>

                    </form>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <?php } ?>
                    <!--
                </div>
            </div>
        </div>
        -->
    </div>
</div>
            <script type="text/javascript">
        $('#submit').click(function(){
            var email = $('#email').val();
                if (!email) {
                    swal("Vui Lòng Nhập Email","error");
                    return false;
                }
                $('#submit').prop('disabled', true)
                $.post('Query/ResetPass.html', {
                    email: email
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

