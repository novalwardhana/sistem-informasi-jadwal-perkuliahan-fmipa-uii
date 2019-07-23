<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Mahasiswa</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/bower_components/font-awesome/css/font-awesome.min.css"') ?>>
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/dist/css/skins/_all-skins.min.css') ?>">

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
                        <h3 class="box-title">List Klasifikasi</h3>
                    </div>
                    <div class="box-body">
                        <a href="<?php echo base_url('klasifikasi/create') ?>"><button type="button" class="btn btn-sm btn-success"><i class='fa fa-plus'></i> Tambah</button></a>
                        <br><br>
                        <table id="listKlasifikasi" class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Aksi</th>
                                    <th>Rentang</th>
                                    <th>Keterangan</th>
                                    <th>Predikat</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2019 <a href="#">WardhanaCode</a>.</strong> All rights
    reserved.
  </footer>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <b>Konfirmasi</b>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus data ini?
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-danger btn-ok"><i class='fa fa-trash'></i> Hapus</a>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-times'></i> Batal</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/adminLTE/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/adminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/adminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/adminLTE/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/adminLTE/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/adminLTE/dist/js/demo.js') ?>"></script>
<!-- page script -->

<script src="<?php echo base_url('assets/toast/jquery.toaster.js') ?>"></script>
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

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

        var urlGetListKlasifikasi = "<?php echo base_url('klasifikasi/getListKlasifikasi') ?>";
        $('#listKlasifikasi').DataTable({
            "ordering": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax":{
                    //"url": "getListMahasiswa",
                    "url": urlGetListKlasifikasi,
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
                { "data": "rentang", "width": "15%" },
                { "data": "keterangan", "width": "25%" },
                { "data": "predikat", "width": "25%" }
            ]  

        });
    });
</script>
</body>
</html>
