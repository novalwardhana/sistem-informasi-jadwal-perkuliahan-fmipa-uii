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

	<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/select2/dist/css/select2.min.css') ?>">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style type="text/css">
		.select2-container--default .select2-selection--single {
			background-color: #fff;
			border: 1px solid #aaa;
			border-radius: 1px;
			height: 34px;
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
    <?php
			$this->load->view('evaluasiMandiriRekap/readMain');
		?>
  </div>

	<?php
		$this->load->view('evaluasiMandiriRekap/modalPrint');
	?>
  
	<?php
		$this->load->view('layout/footer');
  ?>
</div>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>

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

	var exportRekap = function() {
		let fromPage = $("#fromPage").val();
		let toPage = $("#toPage").val();
		if (fromPage=="" || toPage=="") {
			alert("Halaman awal dan halaman akhir harus diisi !");
			return false;
		}
		let fromPageInt = parseInt(fromPage);
		let toPageInt = parseInt(toPage);
		if ((toPageInt - fromPageInt) < 0) {
			alert("Halaman awal dan halaman akhir harus diisi !");
			return false;
		}
		$("#modalPrint").modal("hide");
		let start = (fromPageInt - 1) * 10;
		let limit = ((toPageInt - fromPageInt) + 1) * 10;
		let search = document.getElementsByClassName("input-sm")[0].value;
		let url = "<?php echo base_url('rekap-evaluasi-mandiri/export-excel') ?>"+"?start="+start+"&limit="+limit+"&search="+search;
		window.open(url, '_blank');
	};

	$(function() {
		$('.selectPage').select2({
      placeholder: 'Pilih halaman',
      allowClear: true,
      // width: 'resolve',
      //theme: "bootstrap",
    });
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
		var tabelListMahasiswa = $('#listMahasiswa').DataTable({
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
						console.log("abcde", meta)
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

		$('#exportButtonExcel').click(function(){
			console.log("Info halaman", tabelListMahasiswa.page.info());
			$('#modalPrint').modal('show')
			return;
			let start = tabelListMahasiswa.page.info().start;
			let search = tabelListMahasiswa.search();
			let urlPrint = "<?php echo base_url('EvaluasiMandiriRekap/exportExcel') ?>";
			urlPrint = urlPrint+'?start='+start+'&search='+search;
			window.open(urlPrint, '_blank');
		});

  });
</script>
</body>
</html>

