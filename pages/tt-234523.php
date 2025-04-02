<!--                   
<div class="card card-box mb-30">
            <div class="pd-50">
                <h4 class="text-blue h4">50 GIAO DỊCH GẦN ĐÂY</h4>
                
                
            </div>
            <div class="pd-20 card-box height-100-p">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Khách Hàng</th>
                                <th>Giao Dịch</th>
                                <th>Thời Gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
			$i = 0;
			$querryy = mysqli_query($conn, "SELECT * FROM `san-pham-da-ban` ORDER BY id desc limit 50 ");
			while ($row = mysqli_fetch_array($querryy)) {
        $key_id = $row['subcatekey'];
        $query4 = mysqli_query($conn, "SELECT * FROM `subcategories` WHERE active ='1' AND key_id = '$key_id' ");
        $query4 = mysqli_fetch_assoc($query4);
			?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?=$row['username'];?></td>
                                <td>Vừa mua  <?=$row['text'];?></td>
                                <td><span data-toggle="tooltip" data-placement="top" title="Thời gian"
                                        class="badge badge-dark"><?php echo 'Đã mua ngày <font color="red"><b>'.date('d-m-Y', $row['time']).'</font></b> vào lúc <b><font color="blue"> '.date('h:i:s', $row['time']).'</font></b>' ?></span></td>
                            </tr>
                            <?php $i++; }?>
                        </tbody>
                    </table>
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
-->