<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
/*
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
    */
require $_SERVER['DOCUMENT_ROOT']."/layout/head.php";
if(!empty($_SESSION['username'])){
$username = $_SESSION['username'];
$user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users` WHERE `username` = '$username'"));
}

?>
<div class="card" style="padding: 20px;">
    <div class="card mb-4">
        <div class="card-body">
            Ae vào <a href="https://zalo.me/g/pizbek864">Box Chat Zalo</a> để giao lưu, nhận Ưu đãi, Tut, nghiệm MMO, reg Azure nhé!
        </div>
    </div>
    
    
<?php if(empty($_SESSION['username'])){ ?>
    <div class="card mb-4">
        <div class="card-body bg-info">
            Bạn vui lòng thực hiện <a href="/login" class="btn btn-success"><i class="fa fa-user"></i> Đăng Nhập</a> để thực hiện mua hàng. Nếu bạn chưa có tài khoản, hãy <a href="/signup" class="btn btn-warning"><i class="fa fa-user-plus"></i> Đăng Kí Ngay!</a>
        </div>
    </div>
<?php } else { ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="avatar avatar-xl mb-3 text-center">
                        <img src="<?php echo 'https://'.$_SERVER['HTTP_HOST'].''; ?>/assets/themes/images/users.png" width="75" height="75" class="rounded-circle" alt="avatar">
                    </div>
                    <div class="mb-9">
                        <div class="profile-name">
                            <div class="text-center"><b><?= $_SESSION['username']; ?></b>
                            </div>
                            </br>
                            <span style="text align: left; font-size: 16px"><strong><i class="fa fa-star-half-o"></i> Cấp Bậc: </strong></span>
                            <span>
                                <?php if($data['admin'] == '1'){
                                    echo 'Quản Trị Viên';
                                }else if($data['admin'] == '0') {
                                    echo 'Thành Viên';  
                                }else if($data['admin'] == '2') {
                                    echo 'Cộng Tác Viên'; }
        
                                ?></span>
                            </br>
                            <span style="text align: left; font-size: 16px"><strong><i class="fa fa-envelope"></i> Email: </strong></span>
                            <span><?= $data['email'] ?></span>
                            </br>
                            <span style="font-size: 16px"><strong><i class="fa fa-money"></i> Số Dư: </strong></span>
                            <span> <?= number_format($data['cash']) ?> đ</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-8">

            <!--<div class="card sticky-top mb-4 md-0">-->
            <div class="card mb-4 md-0">
                <div class="card-body">
                    <!--
        <ul class="nav nav-pills flex-column gap-2" id="myTab" role="tablist">
        -->
                    <a href="#" class="showModel" rel="nofollow">
                        <i class="fa fa-bell text-warning" aria-hidden="true"></i> Thông báo</a>
                    <br/>
                    <a href="/lich-su-mua" rel="nofollow"><i class="fa fa-shopping-bag text-success"></i> Lịch sử mua hàng</a>
                    </br>
                    <a href="/profile"><i class="fa fa-address-book-o text-dark"></i> Thông tin tài khoản</a>
                    <!--
        </ul>
        -->
                </div>
            </div>

            <!--<div class="card sticky-top mb-md-0">-->
            <div class="card mb-md-0">
                <div class="card-body text-center">
                    <!--
        <ul class="nav nav-pills flex-column gap-2" id="myTab" role="tablist">
        -->
                    <a class="btn btn-warning waves-effect waves-light" href="nap-tien.html" target="_blank" rel="nofollow"><i class="fa fa-university"></i> Nạp tiền</a>
                    <a class="btn btn-danger waves-effect waves-light" href="ticket" target="_blank" rel="nofollow"><i class="fa fa-life-ring"></i> Hỗ trợ</a>
                    <!--
        </ul>
        -->
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div>
                     
<div class="panel-group" style="padding: 20px;">
    <div class="panel panel-info">
        <div class="panel-heading">Danh mục sản phẩm</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class="danger" style="white-space: nowrap; width: 1%;">
                           
                            <th class="text-center">SẢN PHẨM</th>
                            <th class="text-center">MÔ TẢ</th>
                            <th class="text-center">GIÁ BÁN</th>
                            <th class="text-center">ĐANG CÓ</th>
                            <th>
                                <center><i class="fa fa-shopping-cart"></i>
                                </center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                       $query = mysqli_query($conn,"SELECT * FROM `tscategory` WHERE Is_Active ='1' ORDER BY priority DESC, CategoryName ASC");
                        $rowcount=mysqli_num_rows($query);
                        if($rowcount==0)
                        {
                        ?>
                        <tr>

                        <td colspan="7" align="center"><h3 style="color:red">Không có dữ liệu để hiển thị</h3></td>
                        </tr>
                        <?php 
                        } else {
                      while($row = mysqli_fetch_array($query)){
                        $rowid = $row['id'];
                        ?>
                        <tr>
                            <td colspan="5" class="warning"><b><i class="fa fa-check-square-o" aria-hidden="true"></i> <?= $row['CategoryName']; ?></b>
                            </td>
                        </tr>
                        <?php 
                        //$query3=mysqli_query($conn, "SELECT * FROM `san-pham-chua-ban` WHERE active ='1' AND cate = '$rowid' ORDER BY id DESC");
                        $query3=mysqli_query($conn, "SELECT * FROM `subcategories` WHERE active ='1' AND cateid = '$rowid' ORDER BY priority DESC, subcate ASC, rate ASC");
                        $rowcount2=mysqli_num_rows($query3);
                        if($rowcount2==0)
                        {
                        ?>
                        <tr>

                        <td colspan="7" align="center"><h3 style="color:red">Không có dữ liệu để hiển thị</h3></td>
                        </tr>
                        
                        
                        <?php
                        //// Lay va check du lieu san pham
                        } else {
                        while($getrow = mysqli_fetch_array($query3)){
                          $getquery4 = $getrow['subcate'];
                          $gettt = $getrow['key_id'];
                          $query5 = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-chua-ban` WHERE `subcatekey` = '".$gettt."' "));
                          if ($query5 == '0'){
                            $trangthai = '<label class="btn btn-danger" disabled="disabled">Hết hàng</label>';
                            $mua = '<a class="btn btn-danger" disabled="disabled">Mua Ngay</a>';
                          }
                          else
                          {
                            $trangthai = '<label class="btn btn-warning">'.$query5.'</label>';
                            if(isset($_SESSION['username'])){
                            $mua = '<a class="btn btn-success" href="/thanhtoan/'.htmlentities(create_slug($getrow['subcate'])).'-'.htmlentities($getrow['key_id']).'" role="button">Mua Ngay</a>';
                            } else {
                            //$mua = '<a class="btn btn-success" href="/login" role="button">Mua Ngay</a>';
                            $mua = '<a class="btn btn-success" href="/thanhtoan/'.htmlentities(create_slug($getrow['subcate'])).'-'.htmlentities($getrow['key_id']).'" role="button">Mua Ngay</a>';
                            }
                          }
                        ////////
                        ?>
                        
                        
                        <tr>
                            
                            <td style="white-space: nowrap; width: 1%;">
                                <a href="/thanhtoan/<?=  htmlentities(create_slug($getrow['subcate'])).'-'.htmlentities($getrow['key_id']) ?>"><?= @$getrow['subcate'] ?></a>
                            </td>
                            <td>
                               <?= @$getrow['mota'] ?> </td>
                            <td align="right" style="white-space: nowrap; width: 1%;">
                                <font color="red"><?= number_format($getrow['rate']) ?></font> đ
                            </td>
                            <td class="text-center">
                                <?= $trangthai; ?>
                            </td>   
                            <td align="center">
                                <?= $mua ?>
                            </td>
                        </tr>
                        <?php 
                      }
                      }
                      }
                      }
                      ?>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="" style="padding: 20px;">

        <div class="widget-content widget-content-area br-6">
                <div class="widget-content">
                    <h4 class="text-blue h4">50 GIAO DỊCH GẦN ĐÂY</h4>
                </div>
                <div class="pd-20 card-box">
                    <div class="table-responsive">
                        <table id="example1" class="table hover table-bordered table-striped nowrap">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Khách Hàng</th>
                                    <th>Giao Dịch</th>
                                    <th>Danh Mục</th>
                                    <th>Thời Gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
    			$i = 1;
    			$querryy = mysqli_query($conn, "SELECT * FROM `lich-su-mua` ORDER BY id desc limit 50 ");
    			while ($row = mysqli_fetch_array($querryy)) {
                $user = ''.$row['username'].'';
                $rutgon = rutgon($user,6);
                $key_id = $row['key_id'];
                $query4 = mysqli_query($conn, "SELECT * FROM `subcategories` WHERE active ='1' AND key_id = '$key_id' ");
                $query4 = mysqli_fetch_assoc($query4);
                
                $query5 = mysqli_query($conn, "SELECT * FROM `tscategory` WHERE Is_Active ='1' AND id = '".$query4['cateid']."' ");
                $query5 = mysqli_fetch_assoc($query5);
    			?>
                                <tr>
                                    <td><?=$row['id'];?></td>
                                    <td><?= substr($user, 0,3)."****" ?></td>
                                    <td>Vừa mua <b><?=$row['amount'];?></b> <?=$query4['subcate'];?> </td>
                                    
                                    <td><?=$query5['CategoryName'];?> </td>
                                    <td><span title="Thời gian">
                                        <?php echo 'Ngày <font color="red"><b>'.date('d-m-Y', $row['time']).'</font></b> vào lúc <b><font color="blue"> '.date('H:i:s', $row['time']).'</font></b>' ?></span></td>
                                </tr>
                                <?php $i++; }?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div> 

</div>

<div class="" style="padding: 20px;">
    <!-- Categories Widget -->
    <!---      --->
    <div class="accordion" id="accordionExample">
        <div class="card my-4">
            <h5 class="card-header">Các câu hỏi thường gặp</h5>
                <div class="card-body">
                    <!---      --->
                        
                        <div class="m-1">
                            <div class="card-box">
                                <a href="#" class="list-group-item" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
                                    Nick Vui cung cấp mặt hàng gì?
                                </a>
                            </div>
                        
                            <div id="collapse-1" class="collapse" aria-labelledby="heading-1" data-parent="#accordionExample">
                                <div class="list-group bg-secondary">
                                    <ul class="mb-0">
                                            <li class="m-1">
                                                <span class="list-group-item list-group-item-action" href="#">
                                                    Nick Vui chuyên cung cấp Email Outlook, Email Hotmail, Email Gmail; Acc Azure, Acc Digital Ocean, Acc AWS, Acc Oracle;  Clone-Via Facebook, ... và các loại mặt hàng phục vụ MMO khác!
                                                </span>
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="m-1">
                            <div class="card-box">
                                <a href="#" class="list-group-item" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-1">
                                    VPS là gì?
                                </a>
                            </div>
                        
                            <div id="collapse-2" class="collapse" aria-labelledby="heading-1" data-parent="#accordionExample">
                                <div class="list-group bg-secondary">
                                    <ul class="mb-0">
                                            <li class="m-1">
                                                <span class="list-group-item list-group-item-action" href="#">
                                                    VPS là viết tắt của Virtual Private Server (máy chủ riêng ảo), nó ảo hóa để có thể chạy 24/7 thực hiện các công việc mang tính liên tục. VPS có thể cài Windows, Linux, ... Có thể dùng PC, Laptop, Điện thoại để điều khiển VPS.
                                                </span>
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="m-1">
                            <div class="card-box">
                                <a href="#" class="list-group-item" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-1">
                                    Azure là gì?
                                </a>
                            </div>
                        
                            <div id="collapse-3" class="collapse" aria-labelledby="heading-1" data-parent="#accordionExample">
                                <div class="list-group bg-secondary">
                                    <ul class="mb-0">
                                            <li class="m-1">
                                                <span class="list-group-item list-group-item-action" href="#">
                                                    Azure (thuộc Microsoft) là nhà cung cấp các dịch vụ Cloud, ... Chắc chắn có cung cấp VPS. Giá VPS của Azure rất cao. Nhưng chúng ta có thể dùng lậu bằng việc sử dụng Mail Edu hoặc Visa/Master Card để tạo Azure.
                                                <br/>
                                                Có 3 loại Azure chính, chúng dược gọi tắt như sau:<br/>
                                                - Azure Students (Credit 100$): Loại này sau khi đăng kí sẽ có 100$ Credit để các bạn dùng. Chúng ta có thể dùng Mail Edu để tạo nó!<br/>
                                                - Azure Trial (Credit 200$): Loại này sau khi đăng kí sẽ có 200$ Credit để dùng dịch vụ. Chúng ta có thể dùng Visa/Master Card để tạo!<br/>
                                                - Azure Pay As You Go (Tín dụng Trả sau, Credit khoảng 1000$): Loại này Azure sẽ cho bạn xài trước rồi thanh toán sau. Hạn ngạch ghi nợ đa số khoảng 1000$. Sau đó các bạn có thể bỏ Acc, hoặc thanh toán số tiền đó thì tùy =)))<br/>
                                                </span>
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    <!---      --->
            </div>
        </div>
    </div>
</div>

               


<script>
      $(function () {
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "order": [[ 0, "desc" ]],
          "autoWidth": true
        });
      });
</script>

<?php
require $_SERVER['DOCUMENT_ROOT']."/layout/script.php";
?>