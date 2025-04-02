<?php
session_start();
if(empty($_SESSION['username'])){
	session_destroy();
	header('location: /');
	die();
}
include('../core/database.php');
include('../layout/head.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");
?>
<div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                 
                        
                 
                 <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Loại Chuyển Khoản</th>
                                            <th>Họ Và Tên</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Nội Dung</th>
                                            <th>Logo</th>
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                 
                                                                          <?php
                      $query = mysqli_query($conn,"SELECT * FROM `setting` ORDER BY id DESC");
                      $stt = 0;
                      while($row = mysqli_fetch_array($query)){
						
                      ?>
                      <tr>
                           <td><?= ++$stt; ?></td>
						   <td>Thẻ Siêu Rẻ</td>
						   <td><?= $row['name-tsr'] ;?></td>
                           <td><?= $row['phone-tsr']; ?></td>
                           
                           <td><?= $_SESSION['username'];?> </td>
                           <td><img src="https://n4x.co/assets/images/tsr.png"> </td>
                           
                      </tr>
                       <tr>
                           <td><?= ++$stt; ?></td>
						   <td>Thẻ Cào Siêu Rẻ</td>
						   <td><?= $row['name-tcsr'] ;?></td>
                           <td><?= $row['phone-tcsr']; ?></td>
                           <td><?= $_SESSION['username'];?> </td>
                           <td></td>
                           
                      </tr>
                      <?php
                      }
                      ?>             
                                    </tbody>
                                     
                                </table>
                            </div>
                        </div>
                  
            
            
        </div>    
                 </div>
                 
                 </div>
                 </div>
                 
                 </div>
                 
                 </div>
                 </div>

<?php
require_once '../layout/script.php';
?>