</div>
<!-- Div Container -->

<footer class="py-5" style="background-color:#008B8B; bottom: 0; margin-top:auto;">
    <div class="container">
        <!-- Container 2 -->


        <div class="row alert alert-success text-left">
            <div class="col-md-8">
                <?php echo ''.$setup['description'].''; ?>
            </div>
            <div class="col-md-4">
                Liện Hệ:</br>
                - Facebook: <a href="https://www.facebook.com/123vps/">Facebook Admin</a> (@123vps)
                </br>
                - Telegram: <a href="https://t.me/nthnth123">Telegram Admin</a> (@nthnth123)
                </br>
                - Zalo: <a href="http://zaloapp.com/qr/p/tlub8tbbwxwq">Nguyễn Tiến Hùng</a> (0858.533.566)
            </div>
            Copyright &copy; <?php echo $setup['brand-name']; ?>
            <?php echo date( 'Y'); ?>
        </div>
        <div class="text-center">
            <a class="text-white" href="/sitemap/sitemap.xml">Sitemap Chỉ Mục</a> |
                <a class="text-white" href="/sitemap/sitemap_product.xml">Sitemap Sản Phẩm</a>
        </div>
        <div class="text-center">
                <?php
                ////Code thoi gian tai trang
                $my_timer = microtime();
                $time_parts = explode(' ', $my_timer);
                $time_right_now = $time_parts[1] + $time_parts[0];
                $finishing_time = $time_right_now;
                $total_time_in_secs = round(($finishing_time - $starting_time), 4);
                    echo '<i class="fa fa-spinner fa-pulse"></i> Thời gian tải trang '.$total_time_in_secs.' giây.';
                ////Het code thoi gian tai trang
                ?>
        </div>
    </div>
</footer>
    <div class="messenger_chat">
        <a target="_blank" href="https://www.facebook.com/123vps" rel="noopener noreferrer" alt="Messenger Chat" title="Zalo Chat"><img src="/assets/images/logo/logo-messenger-100px.png" width="48" height="48"></a>
    </div>
    
    <div class="zalo_chat">
        <a target="_blank" href="http://zaloapp.com/qr/p/tlub8tbbwxwq" rel="noopener noreferrer" alt="Zalo Chat" title="Zalo Chat"><img src="/assets/images/logo/logo-zalo-100px.png" width="48" height="48"></a>
    </div>
    
    <div class="telegram_chat">
        <a target="_blank" href="https://t.me/nthnth123" rel="noopener noreferrer" alt="Telegram Chat" title="Telegram Chat"><img src="/assets/images/logo/logo-telegram-100px.png" width="48" height="48"></a>
    </div>
    
    <div id="top-up">
    <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
    </div>
    
    <!-- /.container 2 -->

<!-- Plugins Bootstrap -->
<script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/bootstrap-4.6.1/js/bootstrap.min.js?ver=<?= time(); ?>"></script>
<!-- Plugins Offcanvas -->
<script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/js/offcanvas.js?ver=<?= time(); ?>"></script>

<!-- Function -->
<script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/themes/js/swap.js?ver=<?= time(); ?>"></script>
<!-- Plugins Toastr -->
<script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/toastr/toastr.min.js?ver=<?= time(); ?>"></script>

<!-- Plugins DataTables -->
<script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/datatable/jquery.dataTables.min.js?ver=<?= time(); ?>"></script>
<script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/datatable/dataTables.bootstrap4.min.js?ver=<?= time(); ?>"></script>

<script>
    $('#zero-config').DataTable({
        "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Xem thêm _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Tìm kiếm",
            "sLengthMenu": "Hiển thị :  _MENU_ mục",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7
    });
    // Cache selectors
</script>
<?php if($setup['model-active'] == '1') { ?>
<script>
$(document).ready(function () {
    var closeTime = localStorage.getItem('modalCloseTime');
    var timeoutModel = 21600000;

    function checkAndHandleModal() {
        var elapsedTime = new Date().getTime() - closeTime;
        if(!elapsedTime) {
            elapsedTime = timeoutModel;
        } else
        if (elapsedTime >= timeoutModel || closeTime == null) {
            $('#myModal').modal('show');
        } else {
            $('#myModal').modal('hide');
        }
        /*console.log('closeTime: ' + closeTime + ' milliseconds');
        console.log('elapsedTime: ' + elapsedTime + ' milliseconds');
        console.log('elapsedTime: ' + timeoutModel + ' milliseconds');*/
    }
    checkAndHandleModal();
    
    $('.closeModel').on('click', function () {
        if ($('#hideModalCheckbox').prop('checked')) {
            localStorage.setItem('modalCloseTime', new Date().getTime());
        }
        checkAndHandleModal();
    });
});
</script>
<?php } ?>
<script>
$(document).ready(function () {
    $('.showModel').on('click', function () {
        $('#myModal').modal('show');
        localStorage.removeItem('modalCloseTime');
        checkAndHandleModal();
    });
});
</script>
</body>

</html>