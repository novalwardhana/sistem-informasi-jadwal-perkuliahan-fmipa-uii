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
			$this->load->view('masterDosenPengampu/readDetailMain');
		?>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2019 <a href="#">WardhanaCode</a>.</strong> All rights
    reserved.
  </footer>

  <?php
    $this->load->view('masterDosenPengampu/readDetailDeleteModal');
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
<!-- bootstrap time picker -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/timepicker/bootstrap-timepicker.min.js') ?>"></script>

<script type="text/javascript">
  $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });
  function editRow(id) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "<?php echo base_url(); ?>dosenPengampu/getDosenPengampuById",
      type: 'GET',
      data: {
        id: id
      },
      async: false,
      success: function(result) {
        var data = JSON.parse(result);
        $('#modalUpdateId').val(data.id);
        $('#modalUpdateNik').val(data.nik);
        $('#modalUpdateIdDosen').val(data.id_dosen);
        $('#modalUpdateDosen').val(data.dosen);
        //$('#modalUpdateMataKuliah').val(parseInt(data.id_mata_kuliah));
        //$("#modalUpdateMataKuliah").select2("val", data.id_mata_kuliah);
        $("#modalUpdateMataKuliah").val(data.id_mata_kuliah).trigger("change");
        $("#modalUpdateKelas").val(data.id_kelas).trigger("change");
        $('#modalUpdateJamMulai').val(data.jam_mulai);
        $('#modalUpdateJamSelesai').val(data.jam_selesai);
        $('#modalUpdateRuang').val(data.ruang);
        $('#modalUpdateMaksPeserta').val(data.maks_peserta);

        $("#modalUpdateCPMK1Kode").val(data.cpmk_1_kode);
        $("#modalUpdateCPMK1Persentase").val(data.cpmk_1_persentase);
        $("#modalUpdateCPMK1Keterangan").val(data.cpmk_1_keterangan);

        $("#modalUpdateCPMK2Kode").val(data.cpmk_2_kode);
        $("#modalUpdateCPMK2Persentase").val(data.cpmk_2_persentase);
        $("#modalUpdateCPMK2Keterangan").val(data.cpmk_2_keterangan);

        $("#modalUpdateCPMK3Kode").val(data.cpmk_3_kode);
        $("#modalUpdateCPMK3Persentase").val(data.cpmk_3_persentase);
        $("#modalUpdateCPMK3Keterangan").val(data.cpmk_3_keterangan);

        $("#modalUpdateCPMK4Kode").val(data.cpmk_4_kode);
        $("#modalUpdateCPMK4Persentase").val(data.cpmk_4_persentase);
        $("#modalUpdateCPMK4Keterangan").val(data.cpmk_4_keterangan);

        $("#modalUpdateCPMK5Kode").val(data.cpmk_5_kode);
        $("#modalUpdateCPMK5Persentase").val(data.cpmk_5_persentase);
        $("#modalUpdateCPMK5Keterangan").val(data.cpmk_5_keterangan);

        $("#modalUpdateCPMK6Kode").val(data.cpmk_6_kode);
        $("#modalUpdateCPMK6Persentase").val(data.cpmk_6_persentase);
        $("#modalUpdateCPMK6Keterangan").val(data.cpmk_6_keterangan);

				$("#modalUpdateCPMK7Kode").val(data.cpmk_7_kode);
        $("#modalUpdateCPMK7Persentase").val(data.cpmk_7_persentase);
        $("#modalUpdateCPMK7Keterangan").val(data.cpmk_7_keterangan);

				$("#modalUpdateCPMK8Kode").val(data.cpmk_8_kode);
        $("#modalUpdateCPMK8Persentase").val(data.cpmk_8_persentase);
        $("#modalUpdateCPMK8Keterangan").val(data.cpmk_8_keterangan);

				$("#modalUpdateCPMK9Kode").val(data.cpmk_9_kode);
        $("#modalUpdateCPMK9Persentase").val(data.cpmk_9_persentase);
        $("#modalUpdateCPMK9Keterangan").val(data.cpmk_9_keterangan);

				$("#modalUpdateCPMK10Kode").val(data.cpmk_10_kode);
        $("#modalUpdateCPMK10Persentase").val(data.cpmk_10_persentase);
        $("#modalUpdateCPMK10Keterangan").val(data.cpmk_10_keterangan);
    
        $('#modalUpdate').modal('show');
      },
    });
  } 
  $(document).ready(function () {
		$(".menu-sidebar-agenda-perkuliahan").addClass('active');
		$(".menu-sidebar-agenda-perkuliahan-pengampu").addClass('active');

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

    var urlGetListDosen = "<?php echo base_url('dosenPengampu/getListDosenPengampu') ?>";
    $('#listDosen').DataTable({
      "ordering": false,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "ajax":{
              "url": urlGetListDosen,
              "dataType": "json",
              "type": "POST",
              "data":{
                  "id_dosen": "<?php echo $dataDosen->id; ?>"
              }
          },
      "columns": [
          { "data": "nomor", "className": "text-center", "width": "5%",
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          { "data": "aksi", "className": "text-center", "width": "10%"},
          { "data": "kode_mata_kuliah", "width": "15%" },
          { "data": "mata_kuliah", "width": "25%" },
          { "data": "kelas" },
      ]  
    });
  });
  $(function() {
    $('.selectMataKuliah').select2({
      placeholder: 'Pilih mata kuliah',
      allowClear: true
      // width: 'resolve',
      // theme: "bootstrap",
    });
    $('.selectKelas').select2({
      placeholder: 'Pilih mata kuliah',
      allowClear: true
      // width: 'resolve',
      // theme: "bootstrap",
    });
    $('.timepicker').timepicker({
      showInputs: false
    })
  });
</script>
</body>
</html>
