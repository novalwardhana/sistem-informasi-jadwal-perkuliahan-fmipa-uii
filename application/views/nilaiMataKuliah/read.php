<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Mahasiswa</title>

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
    <?php
			$this->load->view('nilaiMataKuliah/readMain');
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
<script>
		$(document).ready(function () {
			$("#exportButton").attr("disabled", true);
		});
		var id_mahasiswa=null;
		var nama_mahasiswa=null;

		var urlGetListNilai = "<?php echo base_url('NilaiMataKuliah/getListNilai') ?>";
		$('#listNilaiMahasiswa').DataTable({
			"ordering": false,
			"autoWidth": false,
			"processing": true,
			"serverSide": true,
			"paging": false,
			"ajax":{
					"url": urlGetListNilai,
					"dataType": "json",
					"type": "POST",
					"data": function(d){
						d.id_mahasiswa = id_mahasiswa
					}
			},
			"columns": [
				{ "data": "nomor", "className": "text-center", "width": "8%",
						render: function (data, type, row, meta) {
							return meta.row + meta.settings._iDisplayStart + 1;
						}
				},
				{ "data": "semester", "className": "text-center" },
				{ "data": "kode_mata_kuliah" },
				{ "data": "mata_kuliah" },
				{ "data": "nilai", "className": "cell-nowrap, text-right",
					render: function (data, type, row, meta) {
						let nilai = parseFloat(row.nilai);
						return nilai.toFixed(2).replace(".",",");
					}
				},
				{ "data": "harkat", "className": "cell-nowrap, text-center",
					render: function (data, type, row, meta) {
						
						let nilai_akhir = parseFloat(row.nilai);
						for(j=0; j<row.harkat.length; j++) {
							let batas_bawah = parseFloat(row.harkat[j]['batas_bawah']);
							let batas_atas = parseFloat(row.harkat[j]['batas_atas']);
							if (nilai_akhir>=batas_bawah && nilai_akhir<batas_atas) {
								return row.harkat[j]['huruf'];
							}
						}

						if (nilai_akhir>=100) {
								return 'A';
						}
						return "--";
					}
				}
			]
		});

    $('.mahasiswaselect').select2({
      placeholder: 'Select an item',
      width: 'resolve',
      ajax: {
        url: "<?php echo base_url(); ?>NilaiMataKuliah/comboMahasiswa",
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

		$('#proses').click(function(){
			id_mahasiswa = $(".mahasiswaselect").val();
      nama_mahasiswa = $('.mahasiswaselect :selected').text();
			if (id_mahasiswa==null) {
				alert('Anda belum memilih data mahasiswa');
				return false;
			}
			getMahasiswaData();
			$('#listNilaiMahasiswa').DataTable().ajax.reload();
			$("#exportButton").attr("disabled", false);
		});

		function getMahasiswaData() {
			let id = id_mahasiswa;
			let data = {
				id: parseInt(id)
			}
			$.ajax({
				headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "<?php echo base_url(); ?>NilaiMataKuliah/getListMahasiswaById",
				method: 'GET',
				dataType: "json",
				data: data,
				success: function(response) {
					$('#tabel-informasi-nama-mahasiswa').text(response.nama);
					$('#tabel-informasi-nim-mahasiswa').text(response.nim);
					$('#tabel-informasi-semester-mahasiswa').text(response.semester);
				}
			});
			
		}

</script>
</body>
</html>
