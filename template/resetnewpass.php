<?php
session_start();
if(isset($_SESSION['username'])){
  header('location: /index.php');
  die();
}

if (!isset($_GET["key"]) || !isset($_GET["email"]) || !isset($_GET["action"])){
  header('location: /index.php');
  die();
}
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
require $_SERVER['DOCUMENT_ROOT']."/layout/head.php";

?>
<div class="card">
    <div class="card-body">
        <center>
            <img class="mb-4" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/images/favicon/favicon-rounded.png" alt="" width="72" height="72">
        </center>
        <h1 class="h3 mb-3 font-weight-normal text-center">Đổi Mật Khẩu <?php echo $setup['brand-name']; ?></h1>
<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
<?php
if (isset($_GET["key"]) && isset($_GET["email"])
&& isset($_GET["action"]) && ($_GET["action"]=="resetpassword")
&& !isset($_POST["action"])){
$key = $_GET["key"];
$email = $_GET["email"];
$curDate = date("Y-m-d H:i:s");
$query = mysqli_query($conn,"
SELECT * FROM `password_reset` WHERE `key`='".$key."' and `email`='".$email."';");
$row = mysqli_num_rows($query);
$error ='';
if ($row==""){
$error .= '<h2>Liên kết không hợp lệ</h2>
<p>Liên kết không hợp lệ / hết hạn. Hoặc bạn đã không sao chép đúng liên kết từ email,
hoặc bạn đã sử dụng khóa trong trường hợp đó nó sẽ bị vô hiệu hóa.</p>
<p><a href="https://'.$_SERVER['HTTP_HOST'].'/resetpassword">Bấm vào đây</a> để đặt lại mật khẩu.</p>';
    }else{
    $row = mysqli_fetch_assoc($query);
    $expDate = $row['expDate'];
    if ($expDate >= $curDate){
    ?>
    <br />
    <form method="post" action="" name="update">
    <input type="hidden" name="action" value="update" />
    
    <div class="form-group">
         <label><strong>Nhập mật khẩu mới:</strong></label>
        <input class="form-control" type="password" name="pass1" id="pass1" maxlength="15" required />
    </div>
    <div class="form-group">
         <label><strong>Nhập lại mật khẩu mới:</strong></label>
    <input class="form-control" type="password" name="pass2" id="pass2" maxlength="15" required/>
    </div>
    <div class="form-group">
    <input type="hidden" name="email" value="<?php echo $email;?>"/>
    <input class="form-control btn btn-lg btn-primary btn-block" type="submit" id="reset" value="Đặt lại mật khẩu" />
    </div>
    </form>
<?php
}else{
    $error .= "<h2>Liên kết đã hết hạn</h2>
    <p>Liên kết đã hết hạn. Bạn đang cố gắng sử dụng liên kết đã hết hạn chỉ có giá trị trong 24 giờ (1 ngày sau khi yêu cầu).<br /><br /></p>";
    }
}

if($error!=''){
    echo "<div class='error'>".$error."</div><br />";
    }           
} // isset email key validate end


if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_real_escape_string($conn,$_POST["pass1"]);
$pass2 = mysqli_real_escape_string($conn,$_POST["pass2"]);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
        $error .= "<p>Mật khẩu không khớp, cả hai mật khẩu phải giống nhau.<br /><br /></p>";
        }
    if($error!=""){
        echo "<div class='error'>".$error."</div><br />";
        }else{

$pass1 = md5($pass1);
mysqli_query($conn,
"UPDATE `users` SET `password`='".$pass1."', `trn_date`='".$curDate."' WHERE `email`='".$email."';");   

mysqli_query($conn,"DELETE FROM `password_reset` WHERE `email`='".$email."';");      
    
echo '<div class="error"><p>Xin chúc mừng! Mật khẩu của bạn đã được cập nhật thành công.</p>
<p><a href="https://'.$_SERVER['HTTP_HOST'].'/login">Bấm vào đây</a> để đăng nhập.</p></div><br />';
        }       
}
?>
            </div>
        </div>
    </div>
</div></div>
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

