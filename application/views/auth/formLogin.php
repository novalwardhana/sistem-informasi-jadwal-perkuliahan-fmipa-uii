<!DOCTYPE html>
<html>
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
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/css/AdminLTE.min.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/iCheck/square/blue.css') ?>">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
	.login-header-custom {
		text-align: center;
		background: #1d3892;
		padding-top: 25px;
    padding-bottom: 15px;
		color: #fff;
    border-bottom: 10px solid #f1c817;
	}
  .logo-uii {
    padding-bottom: 10px;
  }
  .login-header-custom-text {
    margin-top: 20px;
  }
  </style>
</head>
<body class="hold-transition login-page" style="background: #f7f7f7;">
<div class="login-box">
  <div class="login-logo">
   
  </div>
  <div class="login-header-custom">
      <img src="<?php echo base_url('assets/logo_uii.png') ?>" width="75" height="100">
      <h4 class="login-header-custom-text"><b>Test Noval</b></h4>
		  <h4><b style="text-align: center">FMIPA UII</b><h4>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
	<form action="<?php echo base_url('auth/proses-login') ?>" method="post">
		<p class="login-box-msg">Sign in to start your session</p>
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
        <span class="glyphicon glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-success btn-block btn-flat">Masuk</button>
        </div>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/iCheck/icheck.min.js') ?>"></script>
<script src="<?php echo base_url('assets/toast/jquery.toaster.js') ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

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
