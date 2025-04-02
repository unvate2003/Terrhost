<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    @header('Location: /');exit;
}else{
require_once 'header.php';
if($data['admin'] == 1){
if(isset($_POST['submit'])) {
$title = $_POST['title'];
$keywords = $_POST['keywords'];
$description = $_POST['description'];
$notification = $_POST['notification'];
$noticepayproduct = $_POST['noticepayproduct'];
$brandname = $_POST['brand-name'];
$cuphap = $_POST['cuphap'];
$icon = $_POST['icon'];
$logo = $_POST['logo'];
$namefooter = $_POST['namefooter'];
$comingsoon = $_POST['comingsoon'];
$create = mysqli_query($conn, "UPDATE setting SET 
        `title` = '".mysqli_real_escape_string($conn, $title).
     "',`keywords` = '".mysqli_real_escape_string($conn, $keywords).
     "',`description` = '".mysqli_real_escape_string($conn, $description).
     "',`notification` = '".mysqli_real_escape_string($conn, $notification).
     "',`alert-payment` = '".mysqli_real_escape_string($conn, $noticepayproduct).
     "',`brand-name` = '".mysqli_real_escape_string($conn, $brandname).
     "',`cuphap` = '".mysqli_real_escape_string($conn, $cuphap).
     "',`link-icon` = '".mysqli_real_escape_string($conn, $icon).
     "',`link-logo` = '".mysqli_real_escape_string($conn, $logo).
     "',`name-footer` = '".mysqli_real_escape_string($conn, $namefooter).
     "',`coming-soon` = '".mysqli_real_escape_string($conn, $comingsoon).
     "'  WHERE `id`='1'");
if($create) {
echo '<script> swal("Cập Nhật Thông Tin Thành Công","success"); setTimeout(function(){ location.href = "" },1300);</script>'; 
}
}
if(isset($_POST['update'])) {
$name = $_POST['nameadmin'];
$email = $_POST['emailadmin'];
$phone = $_POST['phoneadmin'];
$zalo = $_POST['zaloadmin'];
$facebook = $_POST['fbadmin'];

$create = mysqli_query($conn, "UPDATE setting SET 
        `name-admin` = '".mysqli_real_escape_string($conn, $name).
     "',`email-admin` = '".mysqli_real_escape_string($conn, $email).
     "',`phone-admin` = '".mysqli_real_escape_string($conn, $phone).
     "',`zalo-admin` = '".mysqli_real_escape_string($conn, $zalo).
     "',`fb-admin` = '".mysqli_real_escape_string($conn, $facebook).
     "' WHERE `id`='1'");
if($create) {
echo '<script> swal("Cập Nhật Thông Tin Thành Công","success"); setTimeout(function(){ location.href = "" },1300);</script>'; 
}
}

if(isset($_POST['updatemodel'])) {
$modeltext = $_POST['modeltext'];
$modelactive = $_POST['modelactive'];

$create = mysqli_query($conn, "UPDATE setting SET 
       `model-text` = '".mysqli_real_escape_string($conn, $modeltext).
     "',`model-active` = '".mysqli_real_escape_string($conn, $modelactive).
     "' WHERE `id`='1'");
if($create) {
echo '<script> swal("Cập Nhật Model Thành Công","success"); setTimeout(function(){ location.href = "" },1300);</script>'; 
}
}


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      

        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thông Tin Website</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
                <div class="card-body">
                
                  <div class="form-group">
                    <label for="title">Tiêu Đề Website</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?= $setup['title']; ?>" placeholder="Tiêu Đề Website">
                  </div>
                  <div class="form-group">
                    <label for="keywords">Keywords</label>
                    <textarea class="form-control" rows="3" id="keywords" name="keywords" placeholder="Nhập Keywords"><?= $setup['keywords']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Nhập Description"><?= $setup['description']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="notification">Thông Báo Website</label>
                    <textarea class="form-control" rows="3" id="notification" name="notification" placeholder="Nhập Thông Báo"><?= $setup['notification']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="noticepayproduct">Brand Name</label>
                    <textarea class="form-control" rows="3" id="brand-name" name="brand-name" placeholder="Nhập Tên Thương Hiệu"><?= $setup['brand-name']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="noticepayproduct">Cú pháp nạp tiền</label>
                    <textarea class="form-control" rows="3" id="cuphap" name="cuphap" placeholder="Nhập Cú Pháp"><?= $setup['cuphap']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="noticepayproduct">Thông Báo Mua Sản Phẩm</label>
                    <textarea class="form-control" rows="3" id="noticepayproduct" name="noticepayproduct" placeholder="Nhập Thông Báo"><?= $setup['alert-payment']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="icon">Link Shortcut Icon Website</label>
                    <input type="text" class="form-control" name="icon" id="icon" value="<?= $setup['link-icon']; ?>" placeholder="Nhập Link Shortcut Icon Website">
                  </div>
                  <div class="form-group">
                    <label for="title">Link Logo Website</label>
                    <input type="text" class="form-control" name="logo" id="logo" value="<?= $setup['link-logo']; ?>" placeholder="Nhập Link Logo Website">
                  </div>
                      <div class="form-group">
                    <label for="namefooter">Tên Footer Website</label>
                    <input type="text" class="form-control" value="<?= $setup['name-footer']; ?>" name="namefooter" id="namefooter" placeholder="Tên Footer Website">
                  </div>
                  <!--<div class="form-group">
                  <label for="comingsoon">Bảo Trì Website ON/OFF:</label>
                    <select class="form-control select2bs4" name="comingsoon" id="comingsoon" style="width: 100%;">
                      <option value="<?= $setup['coming-soon'];?>"><?=$setup['coming-soon'];?></option>
                      <option value="ON">ON</option>
                      <option value="OFF">OFF</option>
                    </select>
                  </div>-->
                  
                  
                  <div class="form-group">
                      <table>
                          <tr>
                              <td>
                                  <label for="comingsoon">Bảo Trì Website:</label>
                              </td>
                              <td>
                                <input type="radio" id="comingsoonOn" name="comingsoon" value="ON" <?php if ($setup['coming-soon'] == 'ON') echo 'checked="checked"'; ?>>
                                <label for="comingsoonOn">Bật</label>
                                <br/>
                                <input type="radio" id="comingsoonOff" name="comingsoon" value="OFF" <?php if ($setup['coming-soon'] == 'OFF') echo 'checked="checked"'; ?>>
                                    <label for="comingsoonOff">Tắt</label>
                              </td>
                          </tr>
                      </table>
                  </div>
                </div>
                
                
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-dark">Cập Nhật</button>
                </div>
              </form>
            </div>
            </div>
            <!-- /.card -->
            <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thông Tin Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
                <div class="card-body">
                
                  
                  <div class="form-group">
                    <label for="nameadmin">Tên Admin</label>
                    <input type="text" class="form-control" name="nameadmin" id="nameadmin" value="<?=$setup['name-admin']; ?>" placeholder="Tên Admin">
                  </div>
                  <div class="form-group">
                    <label for="title">Email Admin</label>
                    <input type="email" class="form-control" name="emailadmin" id="emailadmin" value="<?=$setup['email-admin']; ?>" placeholder="Email Admin" required>
                  </div>
                  <div class="form-group">
                    <label for="title">Số Điện Thoại Admin</label>
                    <input type="number" class="form-control" name="phoneadmin" id="phoneadmin" value="<?=$setup['phone-admin']; ?>" placeholder="Số Điện Thoại Admin">
                  </div>
                  <div class="form-group">
                    <label for="title">Zalo Admin</label>
                    <input type="text" class="form-control" name="zaloadmin" id="zaloadmin" value="<?=$setup['zalo-admin']; ?>" placeholder="Zalo Admin">
                  </div>
                  <div class="form-group">
                    <label for="title">Facebook Admin</label>
                    <input type="text" class="form-control" name="fbadmin" id="fbadmin" value="<?=$setup['fb-admin']; ?>" placeholder="Facebook Admin">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="update" class="btn btn-dark">Cập Nhật</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            
            
            
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thông Báo Model</h3>
              </div>
             
              <form action="" method="POST">
                <div class="card-body">
                
                  
                    <div class="form-group">
                        <label for="modeltext">Thông báo Model</label>
                        <textarea class="form-control" rows="5" id="modeltext" name="modeltext" placeholder="Nhập Văn bản model"><?= $setup['model-text']; ?></textarea>
                        <!--
                        <label for="">Hiển thị Model:</label>
                        <select class="form-control" id="modelactive" name="modelactive">
                            <option value="1" <?php if ($setup['model-active'] == '1') echo 'selected="selected"'; ?>>Bật</option>
                            <option value="0" <?php if ($setup['model-active'] == '0') echo 'selected="selected"'; ?>>Tắt</option>
                        </select>
                        -->
                    
                    </div>
                    <div class="form-group">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <label for="">Hiển thị Model:</label>
                                    </td>
                                    <td>
                                        <input type="radio" id="modelactiveOn" name="modelactive" value="1" <?php if ($setup['model-active'] == '1') echo 'checked="checked"'; ?>>
                                        <label for="modelactiveOn">Bật</label>
                                        <br/>
                                        <input type="radio" id="modelactiveOff" name="modelactive" value="0" <?php if ($setup['model-active'] == '0') echo 'checked="checked"'; ?>>
                                        <label for="modelactiveOff">Tắt</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="updatemodel" class="btn btn-dark">Cập Nhật Model</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          
        </div>
        <!-- /.row -->
     

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<?php
require_once 'script.php';
}
else{
    require_once '../pages/404.php';
    
}
}

?>







