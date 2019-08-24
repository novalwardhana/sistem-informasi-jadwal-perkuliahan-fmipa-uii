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

	function addCplDetail() {
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
			url: "<?php echo base_url(); ?>CplAdd/addCplDetail",
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
				$('#ListCplDetail').DataTable().ajax.reload();
			}
		});
	}

	$(document).ready(function () {
		$(".menu-sidebar-master").addClass('active');
		$(".menu-sidebar-master-cpl").addClass('active');

		var urlgetMataKuliahCreateCPL = "<?php echo base_url('CplAdd/getListCplDetail') ?>";
		var cplDetail = $('#ListCplDetail').DataTable({
			"ordering": false,
			"autoWidth": false,
			"processing": true,
			"serverSide": true,
			"paging": false,
			"columnDefs" : [
				{
					"targets" : [7, 8],
					"visible" : false,
					"searchable" : false
				}
			],
			"ajax":{
				//"url": "getListMahasiswa",
				"url": urlgetMataKuliahCreateCPL,
				"dataType": "json",
				"type": "POST",
				"data":{
						
				},
			},
			"columns": [
				{ "data": "nomor", "className": "text-center", "width": "5%",
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{ "data": "aksi", "width": "5%", "className": "text-center" },
				{ "data": "kode", "width": "8%", "className": "text-center" },
				{ "data": "nama", "width": "40%" },
				{ "data": "semester", "width": "8%", "className": "text-center" },
				{ "data": "sks", "width": "15%", "className": "text-center" },
				{ "data": "kontribusi", "width": "15%" },
				{ "data": "id" },
				{ "data": "id_mata_kuliah" },
			]  
		});

		var urlGetListMatkul = "<?php echo base_url('CplAdd/getListMataKuliah') ?>";
		$('#listMataKuliahModal').DataTable({
			"ordering": false,
			"autoWidth": false,
			"processing": true,
			"serverSide": true,
			"ajax":{
				"url": urlGetListMatkul,
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

		$('#saveCpl').click( function() {
			let nama_cpl = $("#nama-cpl").val();
			if (nama_cpl==null || nama_cpl=='') {
				$.toaster({ 
					priority : 'warning', 
					title : '<i class="fa fa-times"></i> Info', 
					message : '<br>'+'Nama CPL harus diisi',
				});
				return false;
			}

			let deskripsi_cpl = $("#deskripsi-cpl").val();
			if (deskripsi_cpl==null || deskripsi_cpl=='') {
				$.toaster({ 
					priority : 'warning', 
					title : '<i class="fa fa-times"></i> Info', 
					message : '<br>'+'Deskripsi CPL harus diisi',
				});
				return false;
			}

			let data = cplDetail.column(7).data();
			let data_mata_kuliah = cplDetail.column(8).data();
	
			let cpl_detail = [];

			if (data.length==0) {
				$.toaster({ 
					priority : 'warning', 
					title : '<i class="fa fa-times"></i> Info', 
					message : '<br>'+'Detail Cpl harus diisi',
				});
				return false;
			}

			for(i=0; i<data.length; i++) {
				let kontribusi = ($("#kontribusi-"+data[i]).val() != "") ? parseFloat($("#kontribusi-"+data[i]).val()) : null;
				if (kontribusi==null || kontribusi=='') {
					$.toaster({ 
						priority : 'warning', 
						title : '<i class="fa fa-times"></i> Info', 
						message : '<br>'+'Kolom kontribusi harus di isi',
					});
					return false;
				}

				if (kontribusi<=0 || kontribusi>100) {
					$.toaster({ 
						priority : 'warning', 
						title : '<i class="fa fa-times"></i> Info', 
						message : '<br>'+'Rentang kontribusi 0 - 100',
					});
					return false;
				}

				cpl_detail[i] = {
					'id_mata_kuliah': parseInt(data_mata_kuliah[i]),
					'kontribusi': kontribusi,
				}
			}

			let data_params = {
				'nama_cpl' : nama_cpl,
				'deskripsi_cpl' : deskripsi_cpl,
				'cpl_detail': JSON.stringify(cpl_detail)
			}

			$.ajax({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "<?php echo base_url(); ?>CplAdd/simpanCpl",
				method: 'POST',
				data: data_params,
				dataType: "json",
				success: function(result) {
					if (result.success) {
						$.toaster({ 
							priority : 'success', 
							title : '<i class="fa fa-check"></i> Info', 
							message : '<br>'+result.message,
						});
						setTimeout(() => {
							location.replace("<?php echo base_url(); ?>capaian-pembelajaran-lulusan");
						}, 1000);
					} else {
						$.toaster({ 
							priority : 'danger', 
							title : '<i class="fa fa-times"></i> Info', 
							message : '<br>'+result.message,
						});
					}
					$('#listMataKuliahModal').DataTable().ajax.reload();
					$('#ListCplDetail').DataTable().ajax.reload();
				}
			});
		});
	});

	function deleteCplDetail(id) {
		let data = {
			id: id
		}

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "<?php echo base_url(); ?>CplAdd/deleteCplDetail",
			method: 'POST',
			data: data,
			dataType: "json",
			success: function(result) {
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
				$('#listMataKuliahModal').DataTable().ajax.reload();
				$('#ListCplDetail').DataTable().ajax.reload();
			}
		});
	}
</script>
</body>
</html>
