<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Mahasiswa</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css"') ?>>
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/select2/dist/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/dist/css/AdminLTE.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/dist/css/skins/_all-skins.min.css') ?>">

  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css') ?>">
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
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                        Detail Informasi Pengampu Mata Kuliah
                        <br><br>
                        <a href="<?php echo base_url('dosenPengampu') ?>"><button class="btn btn-sm btn-success"><i class="fa fa-reply"></i> Kembali</button></a>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" value="<?php echo $dataDosen->id ?>" name="id" class="form-control" required>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="number" value="<?php echo $dataDosen->nik ?>" name="nik" class="form-control" placeholder="Nomor induk pegawai" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" value="<?php echo $dataDosen->nama ?>" name="nama" class="form-control" placeholder="Nama lengkap Dosen" readonly>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                              <button class="btn btn-success" data-toggle="modal" data-target="#modalCreate"><i class="fa fa-plus"></i> Mata Kuliah yang Diampu</button>
                              <br><br>
                              <table id="listDosen" class="table table-bordered table-striped" style="width: 100%">
                              <thead>
                                  <tr>
                                      <th class="text-center">No</th>
                                      <th class="text-center">Aksi</th>
                                      <th>Kode Mata Kuliah</th>
                                      <th>Mata Kuliah</th>
                                      <th>Kelas</th>
                                      <th>Jam Mulai</th>
                                      <th>Jam Selesai</th>
                                      <th>Ruang</th>
                                  </tr>
                              </thead>
                          </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php
          $this->load->view('masterDosenPengampu/modalCreate');
          $this->load->view('masterDosenPengampu/modalUpdate');
        ?>
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2019 <a href="#">WardhanaCode</a>.</strong> All rights
    reserved.
  </footer>

  <?php
    $this->load->view('masterDosenPengampu/readConfirmDelete');
  ?>
</div>
<script src="<?php echo base_url('assets/AdminLTE/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

<script src="<?php echo base_url('assets/AdminLTE/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/AdminLTE/dist/js/demo.js') ?>"></script>
<!-- page script -->
<script src="<?php echo base_url('assets/toast/jquery.toaster.js') ?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js') ?>"></script>

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
    
        $('#modalUpdate').modal('show');
      },
    });
  } 
  $(document).ready(function () {
    var imageMsg="";
    <?php
        if ($this->session->flashdata('imageMsg')) {
    ?>
            imageMsg="<?php echo $this->session->flashdata('imageMsg') ?>";
    <?php
        }
    ?>
    if (imageMsg=='update_success') {
        $.toaster({ 
            priority : 'success', 
            title : '<i class="fa fa-check"></i> Info', 
            message : '<br>Data berhasil diupdate',
        });
    } else if (imageMsg=='update_failed') {
        $.toaster({ 
            priority : 'danger', 
            title : '<i class="fa fa-check"></i> Info', 
            message : '<br>Data gagal diupdate',
        });
    } else if (imageMsg=='create_success') {
        $.toaster({ 
            priority : 'success', 
            title : '<i class="fa fa-check"></i> Info', 
            message : '<br>Data berhasil diinput',
        });
    } else if (imageMsg=='create_failed') {
        $.toaster({ 
            priority : 'danger', 
            title : '<i class="fa fa-check"></i> Info', 
            message : '<br>Data gagal di input',
        });
    } else if (imageMsg=='delete_success') {
        $.toaster({ 
            priority : 'success', 
            title : '<i class="fa fa-trash"></i> Info', 
            message : '<br>Data berhasil dihapus',
        });
    } else if (imageMsg=='delete_failed') {
        $.toaster({ 
            priority : 'danger', 
            title : '<i class="fa fa-trash"></i> Info', 
            message : '<br>Data gagal dihapus',
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
          { "data": "jam_mulai" },
          { "data": "jam_selesai" },
          { "data": "ruang" },
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
