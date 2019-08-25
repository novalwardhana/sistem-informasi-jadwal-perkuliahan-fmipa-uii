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
    <style type="text/css">
    td.cell-nowrap {
        white-space:nowrap;
    }
    .tooltip-inner {
        max-width: 500px;
        /* If max-width does not work, try using width instead */
        max-width: 500px; 
        background: #f2f2f2;
        color: #333;
        padding: 5px 15px;
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
						<div class="col-md-12">
							<ol class="breadcrumb">
								<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
								<li class="active">Agenda Perkuliahan</li>
								<li class="active">Jadwal Perkuliahan</li>
								<li class="active">Detail</li>
							</ol>
						</div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Detail Informasi Perkuliahan
                            <br><br>
                            <a href="<?php echo base_url('jadwal-perkuliahan') ?>"><button class="btn btn-sm btn-success"><i class="fa fa-reply"></i> Kembali</button></a>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" value="<?php echo $dataPengampu->dosen ?>" name="nama" class="form-control" placeholder="Nama lengkap Dosen" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Mata Kuliah</label>
                                    <input type="text" value="<?php echo $dataPengampu->mata_kuliah ?>" name="nama" class="form-control" placeholder="Nama lengkap Dosen" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Jam Mulai</label>
                                    <input type="text" value="<?php echo $dataPengampu->jam_mulai ?>" name="nama" class="form-control" placeholder="Nama lengkap Dosen" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="number" value="<?php echo $dataPengampu->nik ?>" name="nik" class="form-control" placeholder="Nomor induk pegawai" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <input type="text" value="<?php echo $dataPengampu->kelas ?>" name="nik" class="form-control" placeholder="Nomor induk pegawai" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input type="text" value="<?php echo $dataPengampu->jam_selesai ?>" name="nama" class="form-control" placeholder="Nama lengkap Dosen" readonly>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success" onclick="addMahasiswa()"><i class="fa fa-plus"></i> Mahasiswa Peserta Perkuliahan</button>
                                <a href="<?php echo base_url('JadwalPerkuliahanExport/export?id=').$dataPengampu->id_dosen_pengampu_mata_kuliah ?>"><button class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</button></a>
                                <br><br>
                                <div class="table-responsive">
                                <table id="listPeserta" class="table table-bordered table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">No</th>
                                            <th rowspan="2" class="text-center">Aksi</th>
                                            <th rowspan="2" >ID</th>
                                            <th rowspan="2" >NIM</th>
                                            <th rowspan="2" nowrap>Nama</th>
                                            <th rowspan="2" nowrap>Semester</th>
                                            <th colspan="6" class="text-center">Penilaian</th>
                                            <th rowspan="2" nowrap>Nilai Akhir</th>
                                            <th rowspan="2" nowrap class="text-center">Harkat</th>
                                        </tr>
                                        <tr>
                                            <th nowrap class="text-center">
                                                <a href="#" data-toggle="tooltip" title="<?php echo $dataPengampu->cpmk_1_keterangan ?>">
                                                    <?php echo $dataPengampu->cpmk_1_kode ?>
                                                </a>
                                                <br>
                                                [<?php echo $dataPengampu->cpmk_1_persentase ?> %] 
                                                <br>
                                                <b>Rentang: </b>1 - 100
                                            </th>
                                            <th nowrap class="text-center">
                                                <a href="#" data-toggle="tooltip" title="<?php echo $dataPengampu->cpmk_2_keterangan ?>">
                                                    <?php echo $dataPengampu->cpmk_2_kode ?>
                                                </a>
                                                <br>
                                                [<?php echo $dataPengampu->cpmk_2_persentase ?> %]
                                                <br>
                                                <b>Rentang: </b>1 - 100
                                            </th>
                                            <th nowrap class="text-center">
                                                <a href="#" data-toggle="tooltip" title="<?php echo $dataPengampu->cpmk_3_keterangan ?>">
                                                    <?php echo $dataPengampu->cpmk_3_kode ?>
                                                </a>
                                                <br>
                                                [<?php echo $dataPengampu->cpmk_3_persentase ?> %]
                                                <br>
                                                <b>Rentang: </b>1 - 100
                                            </th>
                                            <th nowrap class="text-center">
                                                <a href="#" data-toggle="tooltip" title="<?php echo $dataPengampu->cpmk_4_keterangan ?>">
                                                    <?php echo $dataPengampu->cpmk_4_kode ?>
                                                </a>
                                                <br>
                                                [<?php echo $dataPengampu->cpmk_4_persentase ?> %]
                                                <br>
                                                <b>Rentang: </b>1 - 100
                                            </th>
                                            <th nowrap class="text-center">
                                                <a href="#" data-toggle="tooltip" title="<?php echo $dataPengampu->cpmk_5_keterangan ?>">
                                                    <?php echo $dataPengampu->cpmk_5_kode ?>
                                                </a>
                                                <br>
                                                [<?php echo $dataPengampu->cpmk_5_persentase ?> %]
                                                <br>
                                                <b>Rentang: </b>1 - 100
                                            </th>
                                            <th nowrap class="text-center">
                                                <a href="#" data-toggle="tooltip" title="<?php echo $dataPengampu->cpmk_6_keterangan ?>">
                                                    <?php echo $dataPengampu->cpmk_6_kode ?>
                                                </a>
                                                <br>
                                                [<?php echo $dataPengampu->cpmk_6_persentase ?> %]
                                                <br>
                                                <b>Rentang: </b>1 - 100
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                </div>
                                <br>
																<center>
																	<button id="updateNilai" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
																	<a href="<?php echo base_url('jadwal-perkuliahan') ?>"><button class="btn btn-default"><i class="fa fa-reply"></i> Kembali</button></a>
																</center>
                               
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php
          $this->load->view('jadwalPerkuliahan/modalCreate');
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
    $this->load->view('jadwalPerkuliahan/readDetailDeleteModal');
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
    function deletePeserta(id) {
        $('#confirm-delete').modal('show');
        $('#confirm-delete-ok').val(id);
    }
    $("#confirm-delete-ok").click(function() {
        var value_delete = parseInt($(this).val());
        var data = {
            id_mahasiswa_peserta_mata_kuliah: value_delete,
        }
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "<?php echo base_url(); ?>JadwalPerkuliahan/deleteMahasiswaPeserta",
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
                        priority : 'warning', 
                        title : '<i class="fa fa-check"></i> Info', 
                        message : '<br>'+result.message,
                    });
                }
                // $('#modalCreate').modal('hide');
                $('#listPeserta').DataTable().ajax.reload();
                $('#listMahasiswa').DataTable().ajax.reload();
                $('#confirm-delete').modal('hide');
                $('#confirm-delete-ok').val(empty);
            }
        });
    });
    var arrayAddMahasiswa=[];
    function addMahasiswa() {
        $('#modalCreate').modal('show');
    }
    function addMahasiswaProcess() {
        arrayAddMahasiswa=[];
        $('#listMahasiswa tbody tr input:checkbox').each(function() {
            if (this.checked) {
                arrayAddMahasiswa.push(parseInt(this.value));
            }
        });
        if (arrayAddMahasiswa.length==0) {
            $.toaster({ 
                priority : 'warning', 
                title : '<i class="fa fa-exclamation"></i> Info', 
                message : '<br>Mahasiswa harus dipilih',
            });
            return false;
        }
        var id_dosen_pengampu_mata_kuliah_pre="<?php echo $dataPengampu->id_dosen_pengampu_mata_kuliah ?>";
        var id_dosen_pengampu_mata_kuliah = parseInt(id_dosen_pengampu_mata_kuliah_pre);
        var data = {
            id_dosen_pengampu_mata_kuliah: id_dosen_pengampu_mata_kuliah,
            array_id_mahasiswa: arrayAddMahasiswa
        }
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "<?php echo base_url(); ?>JadwalPerkuliahan/addMahasiswaPeserta",
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
                $('#listPeserta').DataTable().ajax.reload();
                $('#listMahasiswa').DataTable().ajax.reload();
            }
        });
    }
    var editor;
    $(document).ready(function () {
			$(".menu-sidebar-agenda-perkuliahan").addClass('active');
			$(".menu-sidebar-agenda-perkuliahan-jadwal").addClass('active');

        $('[data-toggle="tooltip"]').tooltip(); 

        var urlGetListMahasiswa = "<?php echo base_url('JadwalPerkuliahan/getListMahasiswa') ?>";
        $('#listMahasiswa').DataTable({
            "ordering": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax":{
                    //"url": "getListMahasiswa",
                    "url": urlGetListMahasiswa,
                    "dataType": "json",
                    "type": "POST",
                    "data":{
                        "id_dosen_pengampu_mata_kuliah": "<?php echo $dataPengampu->id_dosen_pengampu_mata_kuliah; ?>"
                    }
                },
            "columns": [
                { "data": "checkbox", "className": "text-center" },
                { "data": "nomor", "className": "text-center",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { "data": "nim" },
                { "data": "nama" },
                { "data": "semester"}
            ]  
        });

        var urlGetListPeserta = "<?php echo base_url('JadwalPerkuliahan/getListPeserta') ?>";
        var listPeserta = $('#listPeserta').DataTable({
            "ordering": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "columnDefs" : [
                {
                    "targets" : [2],
                    "visible" : false,
                    "searchable" : false
                }
            ],
            "ajax":{
                    //"url": "getListMahasiswa",
                    "url": urlGetListPeserta,
                    "dataType": "json",
                    "type": "POST",
                    "data":{
                        "id_dosen_pengampu_mata_kuliah": "<?php echo $dataPengampu->id_dosen_pengampu_mata_kuliah; ?>"
                    }
                },
            "columns": [
                { "data": "nomor", "className": "text-center",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { "data": "aksi", "className": "text-center, cell-nowrap" },
                { "data": "id_peserta" },
                { "data": "nim", className: 'cell-nowrap' },
                { "data": "nama", className: 'cell-nowrap' },
                { "data": "semester", className: 'text-center'},
                { "data": "kp_komponen_penilaian_1", className: 'cell-nowrap' },
                { "data": "kp_komponen_penilaian_2", className: 'cell-nowrap' },
                { "data": "kp_komponen_penilaian_3", className: 'cell-nowrap' },
                { "data": "kp_komponen_penilaian_4", className: 'cell-nowrap' },
                { "data": "kp_komponen_penilaian_5", className: 'cell-nowrap' },
                { "data": "kp_komponen_penilaian_6", className: 'cell-nowrap' },
                { "data": "nilai_akhir", 
                    "className": 'cell-nowrap, text-right',
                    render: function (data, type, row, meta) {
                        let cpmk_1_persentase=<?php echo $dataPengampu->cpmk_1_persentase/100 ?>;
                        let cpmk_2_persentase=<?php echo $dataPengampu->cpmk_2_persentase/100 ?>;
                        let cpmk_3_persentase=<?php echo $dataPengampu->cpmk_3_persentase/100 ?>;
                        let cpmk_4_persentase=<?php echo $dataPengampu->cpmk_4_persentase/100 ?>;
                        let cpmk_5_persentase=<?php echo $dataPengampu->cpmk_5_persentase/100 ?>;
                        let cpmk_6_persentase=<?php echo $dataPengampu->cpmk_6_persentase/100 ?>;

                        let cpmk_1_nilai = (row.nilai_akhir[0] != null) ? parseFloat(row.nilai_akhir[0]) : null;
                        let cpmk_2_nilai = (row.nilai_akhir[1] != null) ? parseFloat(row.nilai_akhir[1]) : null;
                        let cpmk_3_nilai = (row.nilai_akhir[2] != null) ? parseFloat(row.nilai_akhir[2]) : null;
                        let cpmk_4_nilai = (row.nilai_akhir[3] != null) ? parseFloat(row.nilai_akhir[3]) : null;
                        let cpmk_5_nilai = (row.nilai_akhir[4] != null) ? parseFloat(row.nilai_akhir[4]) : null;
                        let cpmk_6_nilai = (row.nilai_akhir[5] != null) ? parseFloat(row.nilai_akhir[5]) : null;

                        let nilai_akhir = (cpmk_1_persentase*cpmk_1_nilai) + (cpmk_2_persentase*cpmk_2_nilai) + (cpmk_3_persentase*cpmk_3_nilai) + (cpmk_4_persentase*cpmk_4_nilai) + (cpmk_5_persentase*cpmk_5_nilai) + (cpmk_6_persentase*cpmk_6_nilai);
                        let nilai_akhir_f = nilai_akhir.toFixed(2);
                        let nilai_akhir_dec = nilai_akhir_f.replace(".",",");
                        return nilai_akhir_dec;
                    }
                },
                { "data": "harkat",
                    "className": 'cell-nowrap, text-center',
                    render: function (data, type, row, meta) {

                        let cpmk_1_persentase=<?php echo $dataPengampu->cpmk_1_persentase/100 ?>;
                        let cpmk_2_persentase=<?php echo $dataPengampu->cpmk_2_persentase/100 ?>;
                        let cpmk_3_persentase=<?php echo $dataPengampu->cpmk_3_persentase/100 ?>;
                        let cpmk_4_persentase=<?php echo $dataPengampu->cpmk_4_persentase/100 ?>;
                        let cpmk_5_persentase=<?php echo $dataPengampu->cpmk_5_persentase/100 ?>;
                        let cpmk_6_persentase=<?php echo $dataPengampu->cpmk_6_persentase/100 ?>;

                        let cpmk_1_nilai = (row.nilai_akhir[0] != null) ? parseFloat(row.nilai_akhir[0]) : null;
                        let cpmk_2_nilai = (row.nilai_akhir[1] != null) ? parseFloat(row.nilai_akhir[1]) : null;
                        let cpmk_3_nilai = (row.nilai_akhir[2] != null) ? parseFloat(row.nilai_akhir[2]) : null;
                        let cpmk_4_nilai = (row.nilai_akhir[3] != null) ? parseFloat(row.nilai_akhir[3]) : null;
                        let cpmk_5_nilai = (row.nilai_akhir[4] != null) ? parseFloat(row.nilai_akhir[4]) : null;
                        let cpmk_6_nilai = (row.nilai_akhir[5] != null) ? parseFloat(row.nilai_akhir[5]) : null;
                        
                        let nilai_akhir = (cpmk_1_persentase*cpmk_1_nilai) + (cpmk_2_persentase*cpmk_2_nilai) + (cpmk_3_persentase*cpmk_3_nilai) + (cpmk_4_persentase*cpmk_4_nilai) + (cpmk_5_persentase*cpmk_5_nilai) + (cpmk_6_persentase*cpmk_6_nilai);
                        
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

        $('#updateNilai').click( function() {
            let data = listPeserta.column(2).data();

            let data_peserta = [];
            for(i=0; i<data.length; i++) {
                let cpmk_1 = ($("#input-penilaian-cpmk1-"+data[i]).val() != "") ? parseFloat($("#input-penilaian-cpmk1-"+data[i]).val()) : null;
                let cpmk_2 = ($("#input-penilaian-cpmk2-"+data[i]).val() != "") ? parseFloat($("#input-penilaian-cpmk2-"+data[i]).val()) : null;
                let cpmk_3 = ($("#input-penilaian-cpmk3-"+data[i]).val() != "") ? parseFloat($("#input-penilaian-cpmk3-"+data[i]).val()) : null;
                let cpmk_4 = ($("#input-penilaian-cpmk4-"+data[i]).val() != "") ? parseFloat($("#input-penilaian-cpmk4-"+data[i]).val()) : null;
                let cpmk_5 = ($("#input-penilaian-cpmk5-"+data[i]).val() != "") ? parseFloat($("#input-penilaian-cpmk5-"+data[i]).val()) : null;
                let cpmk_6 = ($("#input-penilaian-cpmk6-"+data[i]).val() != "") ? parseFloat($("#input-penilaian-cpmk6-"+data[i]).val()) : null;

								if (
									(cpmk_1<0 || cpmk_1>100) ||
									(cpmk_2<0 || cpmk_2>100) ||
									(cpmk_3<0 || cpmk_3>100) ||
									(cpmk_4<0 || cpmk_4>100) ||
									(cpmk_5<0 || cpmk_5>100) ||
									(cpmk_6<0 || cpmk_6>100)
								) {
									$.toaster({ 
										priority : 'warning', 
										title : '<i class="fa fa-times"></i> Info', 
										message : '<br>'+'Rentang nilai cpmk 0 - 100',
									});
									return false;
								}

                data_peserta[i]={
                    "id_peserta" : parseInt(data[i]),
                    "cpmk_1" : cpmk_1,
                    "cpmk_2" : cpmk_2,
                    "cpmk_3" : cpmk_3,
                    "cpmk_4" : cpmk_4,
                    "cpmk_5" : cpmk_5,
                    "cpmk_6" : cpmk_6,
                };
            }

            let data_params = {
                data_peserta: JSON.stringify(data_peserta)
            }

            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "<?php echo base_url(); ?>JadwalPerkuliahan/updateNilai",
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
                    } else {
                        $.toaster({ 
                            priority : 'danger', 
                            title : '<i class="fa fa-times"></i> Info', 
                            message : '<br>'+result.message,
                        });
                    }
                    $('#listPeserta').DataTable().ajax.reload();
                }
            });
        });

  });
</script>
</body>
</html>
