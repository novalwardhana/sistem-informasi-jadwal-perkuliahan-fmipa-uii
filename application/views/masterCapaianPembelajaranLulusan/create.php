AAA
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Mahasiswa</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
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

  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/timepicker/bootstrap-timepicker.min.css') ?>">
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
      $this->load->view('masterCapaianPembelajaranLulusan/createMain');
    ?>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2019 <a href="#">WardhanaCode</a>.</strong> All rights
    reserved.
  </footer>

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
<!-- bootstrap time picker -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/timepicker/bootstrap-timepicker.min.js') ?>"></script>

<script type="text/javascript">
	function addMataKuliah() {
		$('#modalCreate').modal('show');
	}

	function addMataKuliahProcess() {
		let dataMatkul=[];
		$('#listMataKuliahModal tbody tr input:checkbox').each(function() {
			if (this.checked) {
				dataMatkul.push(parseInt(this.value));
			}
		});
		if (dataMatkul.length==0) {
			$.toaster({ 
				priority : 'warning', 
				title : '<i class="fa fa-exclamation"></i> Info', 
				message : '<br>Mata kuliah harus dipilih',
			});
			return false;
		}
		let data = {
			array_id_mata_kuliah: dataMatkul
		}
		$.ajax({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "<?php echo base_url(); ?>CapaianPembelajaranLulusan/addMataKuliahTemp",
			type: 'POST',
			data: data,
			async: false,
			success: function(result) {
				var result = JSON.parse(result);
				if (result.success) {
					$.toaster({ 
						priority : 'success', 
						title : '<i class="fa fa-check"></i> Info', 
						message : '<br>'+result.message,
					});
				} else {
					$.toaster({ 
						priority : 'danger', 
						title : '<i class="fa fa-times"></i> Info', 
						message : '<br>'+result.message,
					});
				}
				$('#modalCreate').modal('hide');
				$('#listMataKuliahModal').DataTable().ajax.reload();
			}
		});
	}

	$(document).ready(function () {
		var urlGetListMataKuliah = "<?php echo base_url('CapaianPembelajaranLulusan/getListMataKuliah') ?>";
		$('#listMataKuliahModal').DataTable({
			"ordering": false,
			"autoWidth": false,
			"processing": true,
			"serverSide": true,
			"ajax":{
				//"url": "getListMahasiswa",
				"url": urlGetListMataKuliah,
				"dataType": "json",
				"type": "POST",
				"data":{
						
				}
			},
			"columns": [
				{ "data": "checkbox", "className": "text-center", "width": "5%" },
				{ "data": "nomor", "className": "text-center", "width": "5%",
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{ "data": "kode", "width": "15%" },
				{ "data": "nama", "width": "25%" },
				{ "data": "semester", "width": "15%" },
				{ "data": "kontribusi", "width": "15%" }
			]  
		});
	});
</script>
</body>
</html>
