<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <link rel="icon" href="<?php echo base_url("assets/logo_uii_favicon.png") ?>" type="image/png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jvectormap/jquery-jvectormap.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/css/skins/_all-skins.min.css') ?>">
  <!-- Skin UII -->
  <link rel="stylesheet" href="<?php echo base_url('assets/skin-uii-light.css') ?>">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-uii-light sidebar-mini fixed">

<div class="wrapper">
  <?php
    $this->load->view('layout/header');
  ?>

  <?php
    $this->load->view('layout/sidebar');
  ?>

  <div class="content-wrapper">
    <?php
        $this->load->view('dashboard/homeMain');
    ?>
  </div>

  <?php
		$this->load->view('layout/footer');
  ?>
</div>


<!-- jQuery 3 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js') ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') ?>"></script>
<!-- jvectormap  -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/chart.js/Chart.js') ?>"></script>

<script src="<?php echo base_url('assets/toast/jquery.toaster.js') ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".menu-sidebar-dashboard").addClass('active');

    let responseModule="";
    let responseModuleBackground="";
    let responseModuleMsg="";
    let responseModuleTitle="";
    <?php
        if ($this->session->flashdata('responseModule')) {
    ?>
        responseModule="<?php echo $this->session->flashdata('responseModule') ?>";
        responseModuleBackground="<?php echo $this->session->flashdata('responseModuleBackground') ?>";
        responseModuleMsg="<?php echo $this->session->flashdata('responseModuleMsg') ?>";
        responseModuleTitle="<?php echo $this->session->flashdata('responseModuleTitle') ?>";
    <?php
        }
    ?>
    if (responseModule!="") {
      $.toaster({ 
        priority : responseModuleBackground, 
        title : responseModuleTitle, 
        message : responseModuleMsg,
      });
    }
	});
</script>
</body>
</html>
