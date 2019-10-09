<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>

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
	<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/select2/dist/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/css/skins/_all-skins.min.css') ?>">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style type="text/css">
		.tabel-informasi th {
			padding: 7px 10px 7px 5px;
		}
	</style>
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">
   <?php
    $this->load->view('layout/header');
  ?>

  <?php
    $this->load->view('layout/sidebar');
  ?>

  <div class="content-wrapper">
		<section class="content">
			<div class="row">
				<!-- Breadcrumbs -->
				<div class="col-md-12">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Laporan</li>
						<li class="active">Evaluasi Mandiri</li>
						<li class="active">Form</li>
					</ol>
				</div>

				<!-- Form -->
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Form Evaluasi Mandiri</h3>
						</div>
						<form role="form" method="post" action="<?php echo base_url('evaluasi-mandiri/laporan') ?>">
							<div class="box-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Pencarian</label>
											<select class="mahasiswaselect form-control" name="id_mahasiswa" style="width: 100%;" required></select>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
											<a href="<?php echo base_url('evaluasi-mandiri') ?>"><button type="button" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button></a>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

			</div>
		</section>
  </div>
	<?php
		$this->load->view('layout/footer');
  ?>
</div>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/js/demo.js') ?>"></script>
<!-- page script -->

<script src="<?php echo base_url('assets/toast/jquery.toaster.js') ?>"></script>
<script>
		$(document).ready(function () {
			$(".menu-sidebar-laporan").addClass('active');
			$(".menu-sidebar-laporan-evaluasi-mandiri").addClass('active');
		});

    $('.mahasiswaselect').select2({
      placeholder: 'Select an item',
      width: 'resolve',
      ajax: {
        url: "<?php echo base_url(); ?>EvaluasiMandiri/comboMahasiswa",
        dataType: 'json',
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
                return {
                  text: item.name,
                  id: item.id
                }
            })
          };
        },
        cache: true
      }
    });
</script>
</body>
</html>
