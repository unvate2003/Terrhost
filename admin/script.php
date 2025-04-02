<!-- jQuery -->
<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/jquery/jquery.min.js?ver=<?= time(); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/jquery-ui/jquery-ui.min.js?ver=<?= time(); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Plugins Bootstrap 4 -->
<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/bootstrap/js/bootstrap.bundle.min.js?ver=<?= time(); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/plugins/overlayscrollbars/js/jquery.overlayscrollbars.min.js?ver=<?= time(); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/admin/asset/dist/js/adminlte.js?ver=<?= time(); ?>"></script>




<!-- Plugins Offcanvas -->
<script type="text/javascript" src="https://nickvui.com/assets/themes/js/offcanvas.js?ver=1680367899"></script>

<!-- Function -->
<script type="text/javascript" src="https://nickvui.com/assets/themes/js/swap.js?ver=1680367899"></script>


<!-- Plugins Toastr -->
<script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/toastr/toastr.min.js?ver=<?= time(); ?>"></script>

<!-- Plugins DataTables -->
<script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/datatable/jquery.dataTables.min.js?ver=<?= time(); ?>"></script>
<script type="text/javascript" src="<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/assets/plugins/datatable/dataTables.bootstrap4.min.js?ver=<?= time(); ?>"></script>

<script>
      $(function () {
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "order": [[ 0, "desc" ]],
          "pageLength": 10,
          "autoWidth": true
        });
      });
    </script>

</body>
</html>