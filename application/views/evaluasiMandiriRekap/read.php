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
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/css/skins/_all-skins.min.css') ?>">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
    <?php
			$this->load->view('evaluasiMandiriRekap/readMain');
		?>
  </div>
  
	<?php
		$this->load->view('layout/footer');
  ?>
</div>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
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
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});

  $(document).ready(function () {
		$(".menu-sidebar-laporan").addClass('active');
		$(".menu-sidebar-laporan-rekap-evaluasi-mandiri").addClass('active');

		var responseModule="";
		var responseModuleBackground="";
		var responseModuleMsg="";
		var responseModuleIcon="";
		<?php
		if ($this->session->flashdata('responseModule')) {
		?>
			responseModule="<?php echo $this->session->flashdata('responseModule') ?>";
			responseModuleBackground="<?php echo $this->session->flashdata('responseModuleBackground') ?>";
			responseModuleMsg="<?php echo $this->session->flashdata('responseModuleMsg') ?>";
			responseModuleIcon="<?php echo $this->session->flashdata('responseModuleIcon') ?>";
		<?php
		}
		?>
		if (responseModule!="") {
			$.toaster({ 
				priority : responseModuleBackground, 
				title : '<i class="'+responseModuleIcon+'"></i> Info', 
				message : responseModuleMsg,
			});
		}

    var urlGetListRekap = "<?php echo base_url('EvaluasiMandiriRekap/getListRekap') ?>";
		$('#listMahasiswa').DataTable({
			"ordering": false,
			"autoWidth": false,
			"processing": true,
			"serverSide": true,
			"lengthChange": false,
			"ajax":{
				//"url": "getListMahasiswa",
				"url": urlGetListRekap,
				"dataType": "json",
				"type": "POST",
				"data":{
						
				}
			},
			"columns": [
				{ "data": "nomor", "className": "text-center", "width": "5%",
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{ "data": "aksi", "className": "text-center", "width": "8%"},
				{ "data": "nim", "width": "10%" },
				{ "data": "nama", "width": "30%" },
				{ "data": "semester","width": "10%", "className": 'cell-nowrap, text-center'},
				{ "data": "cpl_rata_rata", "width": "10%", "className": 'cell-nowrap, text-right'},
				{ "data": "keterangan", "width": "20%", "className": 'cell-nowrap, text-bold'},
			]  
		});
  });
</script>
</body>
</html>
