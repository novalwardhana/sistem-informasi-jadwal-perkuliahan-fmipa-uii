<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <link rel="icon" href="<?php echo base_url("assets/logo_uii_favicon.png") ?>" type="image/png">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/font-awesome/css/font-awesome.min.css"') ?>>
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/select2/dist/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/css/AdminLTE.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/css/skins/_all-skins.min.css') ?>">
  <!-- Skin UII -->
  <link rel="stylesheet" href="<?php echo base_url('assets/skin-uii-light.css') ?>">

  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/timepicker/bootstrap-timepicker.min.css') ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- daterange picker -->
  <!-- <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') ?>">
  <!-- bootstrap datepicker -->
  <!-- <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
</head>
<body class="hold-transition skin-uii-light sidebar-mini">
<div class="wrapper">
  <?php
    $this->load->view('layout/header');
  ?>

  <?php
		$this->load->view('layout/sidebar');
  ?>
  <div class="content-wrapper">
    <?php
      $this->load->view('masterProdi/updateMain');
    ?>
  </div>
	<?php
		$this->load->view('layout/footer');
  ?>

</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery/dist/jquery.min.js')?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/raphael/raphael.min.js')?>"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/morris.js/morris.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/')?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/')?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/')?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/fastclick/lib/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/js/demo.js')?>"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>

<!-- date-range-picker -->
<!-- <script src="../../bower_components/moment/min/moment.min.js"></script> -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/moment/min/moment.min.js') ?>"></script>
<!-- <script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<!-- bootstrap datepicker -->
<!-- <script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>

<script src="<?php echo base_url('assets/toast/jquery.toaster.js') ?>"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$(".menu-sidebar-master").addClass('active');
		$(".menu-sidebar-master-prodi").addClass('active');

        document.forms["formData"].addEventListener("submit", (event) => {
            event.preventDefault()
            if (isNaN(document.forms["formData"]["id"].value)) {
                $.toaster({ message : 'Gagal update data, parameter tidak valid', title : 'Warning', priority : 'warning' });
                return
            }
            let id = parseInt(document.forms["formData"]["id"].value) 
            let kode = document.forms["formData"]["kode"].value
            let nama = document.forms["formData"]["nama"].value
            let kodeWarnaBagan = document.forms["formData"]["kode_warna_bagan"].value
            const dataBody = {
                "id": id,
                "kode": kode,
                "nama": nama,
                "kode_warna_bagan": kodeWarnaBagan,
                "simpan": true
            }

            let url = "<?php echo base_url('master-prodi/update') ?>"
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify(dataBody),
                async: false,
                success: function(result) {
                    if (result.code === 200) {
                        $.toaster({ message : 'Berhasil update data', title : 'Success', priority : 'success' });
                                setTimeout(function(){
                            let redirectURL = "<?php echo base_url('master-prodi') ?>"
                            window.location.assign(redirectURL);
                        }, 3000);
                        return
                    } else {
                        $.toaster({ message : 'Gagal update data', title : 'Warning', priority : 'warning' });
                    }
                },
                error: function() {
                $.toaster({ message : 'Gagal update data', title : 'Failed', priority : 'danger' });
                }
            });
        })

	});

</script>
</body>
</html>
