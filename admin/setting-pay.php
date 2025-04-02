<?php
session_start();
require_once '../core/database.php';
if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){
require_once 'header.php';  
$title = " Quản lí sản phẩm ";
if(@$_GET && @$_GET['xoa']){
    $id = @$_GET['xoa'];
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `san-pham-da-ban` WHERE `key_id` = '$id'"));
    if($check){
        $status = true;
        $msg = "Xóa sản phẩm thành công";
        mysqli_query($conn,"DELETE FROM `san-pham-da-ban` WHERE `key_id` = '$id'");
    }
}    
if(@$msg){
?>
<script>
        <?php if($status === true){?>
            swal('<?= $msg ?>',"success");
            setTimeout(() => {
                window.location.href = '/product-pay';
            }, 1300);
        <?php }else{ ?>
            swal('<?= $msg ?>',"error");
        <?php } ?>
</script>
<?php
}
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-md-12">
                         <div class="card card-primary">
    <div class="card-header"><h3>Quản Lý Sản Phẩm Đã Bán</h3>
    </div>
    <hr>
    <div class="box-body">
        <div class="table-responsive">
            <!--table id="example2" ui-jp="dataTable" class="table table-striped b-t b-b"-->
            <table id="example12" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nội dung</th>
                        <th>Danh mục chính</th>
                        <th>Danh mục phụ</th>
                        <th>Thời gian</th>
                        <th>Số tiền</th>
                        <th>Người mua</th>
                        <th>Xóa</th>
                       
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
            </div>
            <!-- /.card -->

        </div>


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

 <?php //require 'footer.php'; ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<script >
var _0x1635c6=_0x1f5b;function _0x5712(){var _0x57b673=['sanpham','subcategories','string','categories','test','search','bind','dataTable','../Query/Get-Product-Pay.html','toString','call','console','20713YvhsBn','constructor','prototype','desc','return\x20(function()\x20','(((.+)+)+)+$','10GFrXfm','POST','15htGMOh','error','info','function\x20*\x5c(\x20*\x5c)','1645835nInkSt','action','2623236bLBTbF','trangthai','1271421ZkWFJF','xoa','apply','ready','while\x20(true)\x20{}','chain','155308cvUzeU','table','debu','3669274CrKVxP','{}.constructor(\x22return\x20this\x22)(\x20)','__proto__','init','log','input','1238672GWSfre','\x5c+\x5c+\x20*(?:[a-zA-Z_$][0-9a-zA-Z_$]*)','6NKgUAw','gger','trace','giatien','24lGzYRf','time'];_0x5712=function(){return _0x57b673;};return _0x5712();}(function(_0x599fb0,_0x498f4c){var _0x537a99=_0x1f5b,_0x1e97d6=_0x599fb0();while(!![]){try{var _0x5b094b=-parseInt(_0x537a99(0x170))/0x1*(parseInt(_0x537a99(0x195))/0x2)+parseInt(_0x537a99(0x178))/0x3*(parseInt(_0x537a99(0x186))/0x4)+-parseInt(_0x537a99(0x17c))/0x5*(-parseInt(_0x537a99(0x191))/0x6)+parseInt(_0x537a99(0x189))/0x7+-parseInt(_0x537a99(0x18f))/0x8+parseInt(_0x537a99(0x180))/0x9*(-parseInt(_0x537a99(0x176))/0xa)+-parseInt(_0x537a99(0x17e))/0xb;if(_0x5b094b===_0x498f4c)break;else _0x1e97d6['push'](_0x1e97d6['shift']());}catch(_0x1f51a7){_0x1e97d6['push'](_0x1e97d6['shift']());}}}(_0x5712,0x4089d));var _0x2e8f15=(function(){var _0x18583e=!![];return function(_0x16dca1,_0x31e123){var _0x448626=_0x18583e?function(){var _0x307a22=_0x1f5b;if(_0x31e123){var _0x54fd50=_0x31e123[_0x307a22(0x182)](_0x16dca1,arguments);return _0x31e123=null,_0x54fd50;}}:function(){};return _0x18583e=![],_0x448626;};}()),_0xe59e50=_0x2e8f15(this,function(){var _0x52a146=_0x1f5b;return _0xe59e50[_0x52a146(0x16d)]()[_0x52a146(0x169)](_0x52a146(0x175))['toString']()[_0x52a146(0x171)](_0xe59e50)[_0x52a146(0x169)](_0x52a146(0x175));});_0xe59e50();function _0x1f5b(_0xc73df4,_0x5183e2){var _0x26d8fa=_0x5712();return _0x1f5b=function(_0x3c96c9,_0x15a11a){_0x3c96c9=_0x3c96c9-0x166;var _0x3fa611=_0x26d8fa[_0x3c96c9];return _0x3fa611;},_0x1f5b(_0xc73df4,_0x5183e2);}var _0x58826d=(function(){var _0x592d83=!![];return function(_0x3e9e27,_0x3ecac7){var _0x4a84ba=_0x592d83?function(){if(_0x3ecac7){var _0x2a7c50=_0x3ecac7['apply'](_0x3e9e27,arguments);return _0x3ecac7=null,_0x2a7c50;}}:function(){};return _0x592d83=![],_0x4a84ba;};}());(function(){_0x58826d(this,function(){var _0x2a6894=_0x1f5b,_0x1fe0c8=new RegExp(_0x2a6894(0x17b)),_0x572892=new RegExp(_0x2a6894(0x190),'i'),_0x5bc276=_0x5a5318(_0x2a6894(0x18c));!_0x1fe0c8[_0x2a6894(0x168)](_0x5bc276+_0x2a6894(0x185))||!_0x572892[_0x2a6894(0x168)](_0x5bc276+_0x2a6894(0x18e))?_0x5bc276('0'):_0x5a5318();})();}());var _0x15a11a=(function(){var _0x373bb4=!![];return function(_0x50daa1,_0x18c6fe){var _0x1c8cf7=_0x373bb4?function(){var _0x53bbe5=_0x1f5b;if(_0x18c6fe){var _0x1ddc01=_0x18c6fe[_0x53bbe5(0x182)](_0x50daa1,arguments);return _0x18c6fe=null,_0x1ddc01;}}:function(){};return _0x373bb4=![],_0x1c8cf7;};}()),_0x3c96c9=_0x15a11a(this,function(){var _0x301981=_0x1f5b,_0x1c63ff=function(){var _0x4d8d1b=_0x1f5b,_0x4f5781;try{_0x4f5781=Function(_0x4d8d1b(0x174)+_0x4d8d1b(0x18a)+');')();}catch(_0x39a347){_0x4f5781=window;}return _0x4f5781;},_0x283b19=_0x1c63ff(),_0x1fa019=_0x283b19['console']=_0x283b19[_0x301981(0x16f)]||{},_0x2a368a=[_0x301981(0x18d),'warn',_0x301981(0x17a),_0x301981(0x179),'exception',_0x301981(0x187),_0x301981(0x193)];for(var _0x301d14=0x0;_0x301d14<_0x2a368a['length'];_0x301d14++){var _0x1663ae=_0x15a11a['constructor'][_0x301981(0x172)]['bind'](_0x15a11a),_0x25c9a8=_0x2a368a[_0x301d14],_0x27dfd=_0x1fa019[_0x25c9a8]||_0x1663ae;_0x1663ae[_0x301981(0x18b)]=_0x15a11a['bind'](_0x15a11a),_0x1663ae[_0x301981(0x16d)]=_0x27dfd['toString'][_0x301981(0x16a)](_0x27dfd),_0x1fa019[_0x25c9a8]=_0x1663ae;}});_0x3c96c9(),$(document)[_0x1635c6(0x183)](function(){var _0x1881a2=_0x1635c6,_0x137e82=$('#example12')[_0x1881a2(0x16b)]({'columns':[{'data':'id'},{'data':_0x1881a2(0x197)},{'data':_0x1881a2(0x167)},{'data':_0x1881a2(0x198)},{'data':_0x1881a2(0x196)},{'data':_0x1881a2(0x194)},{'data':_0x1881a2(0x17f)},{'data':_0x1881a2(0x181)}],'processing':!![],'serverSide':!![],'orderCellsTop':!![],'fixedHeader':!![],'paging':!![],'lengthChange':!![],'searching':!![],'ordering':!![],'info':!![],'autoWidth':![],'responsive':!![],'order':[[0x0,_0x1881a2(0x173)]],'ajax':{'url':_0x1881a2(0x16c),'type':_0x1881a2(0x177)}});});function _0x5a5318(_0x5c43aa){function _0x13c08a(_0xaf6ca2){var _0x4a569a=_0x1f5b;if(typeof _0xaf6ca2===_0x4a569a(0x166))return function(_0xf426ac){}[_0x4a569a(0x171)](_0x4a569a(0x184))[_0x4a569a(0x182)]('counter');else(''+_0xaf6ca2/_0xaf6ca2)['length']!==0x1||_0xaf6ca2%0x14===0x0?function(){return!![];}['constructor'](_0x4a569a(0x188)+'gger')[_0x4a569a(0x16e)](_0x4a569a(0x17d)):function(){return![];}[_0x4a569a(0x171)](_0x4a569a(0x188)+_0x4a569a(0x192))['apply']('stateObject');_0x13c08a(++_0xaf6ca2);}try{if(_0x5c43aa)return _0x13c08a;else _0x13c08a(0x0);}catch(_0x328a58){}}

</script>
</body></html>
<?php
require_once 'script.php';
}
else{
    require_once '../pages/404.php';
    
}
}

?>







