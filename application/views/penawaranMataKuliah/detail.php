<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <link rel="icon" href="<?php echo base_url("assets/logo_uii_favicon.png") ?>" type="image/png">
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
  <!-- Skin UII -->
  <link rel="stylesheet" href="<?php echo base_url('assets/skin-uii-light.css') ?>">

  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/timepicker/bootstrap-timepicker.min.css') ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- daterange picker -->
  <!-- <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') ?>">
  <!-- bootstrap datepicker -->
  <!-- <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
</head>
<body class="hold-transition skin-uii-light sidebar-mini">
<div class="wrapper">
    <?php
        $this->load->view('layout/header');
    ?>

    <?php
        $this->load->view('layout/sidebar');
    ?>
    <div class="content-wrapper">
        <?php
        $this->load->view('penawaranMataKuliah/detailMain');
        ?>
    </div>
    <?php
        $this->load->view('layout/footer');
    ?>

    <?php
        $this->load->view('penawaranMataKuliah/deleteModal');
    ?>

    <?php
        $this->load->view('penawaranMataKuliah/detailTambahMataKuliah');
    ?>

    <?php
        $this->load->view('penawaranMataKuliah/detailEditMataKuliah');
    ?>

</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery/dist/jquery.min.js')?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/raphael/raphael.min.js')?>"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/morris.js/morris.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/')?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/')?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/')?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/fastclick/lib/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/js/demo.js')?>"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>

<!-- date-range-picker -->
<!-- <script src="../../bower_components/moment/min/moment.min.js"></script> -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/moment/min/moment.min.js') ?>"></script>
<!-- <script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<!-- bootstrap datepicker -->
<!-- <script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/toast/jquery.toaster.js') ?>"></script>
<script type="text/javascript">

    $('#add-mata-kuliah').on('show.bs.modal', function(e) {});
    $('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
    const editKontrakPenawaranMatkul = function(id, id_penawaran_mata_kuliah, id_mata_kuliah, id_dosen, id_kelas, kapasitas, id_dosen_tim_1, id_dosen_tim_2, id_dosen_tim_3) {  
        document.forms["formEditMataKuliah"]["id"].value = id
        document.forms["formEditMataKuliah"]["id_penawaran_mata_kuliah"].value = id_penawaran_mata_kuliah
        $(".selectMataKuliahEdit").val(id_mata_kuliah).trigger("change")
        $(".selectDosenEdit").val(id_dosen).trigger("change")
        if (id_dosen_tim_1 !== 0) {
            $(".selectDosenEditTim1").val(id_dosen_tim_1).trigger("change")
        } else {
            $(".selectDosenEditTim1").val(null).trigger("change")
        }
        if (id_dosen_tim_2 !== 0) {
            $(".selectDosenEditTim2").val(id_dosen_tim_2).trigger("change")
        } else {
            $(".selectDosenEditTim2").val(null).trigger("change")
        }
        if (id_dosen_tim_3 !== 0) {
            $(".selectDosenEditTim3").val(id_dosen_tim_3).trigger("change")
        } else {
            $(".selectDosenEditTim3").val(null).trigger("change")
        }
        $(".selectKelasEdit").val(id_kelas).trigger("change")
        document.forms["formEditMataKuliah"]["kapasitas"].value = kapasitas
    }
    
	$(document).ready(function () {
		$(".menu-sidebar-penawaran-mata-kuliah").addClass('active');

        /* Alert after update/ delete */
        let responseModule="";
        let responseModuleBackground="";
        let responseModuleMsg="";
        let responseModuleTitle="";
        <?php
            if ($this->session->flashdata('responseModule')) {
        ?>
            responseModule="<?php echo $this->session->flashdata('responseModule') ?>";
            responseModuleBackground="<?php echo $this->session->flashdata('responseModuleBackground') ?>";
            responseModuleMsg="<?php echo $this->session->flashdata('responseModuleMsg') ?>";
            responseModuleTitle="<?php echo $this->session->flashdata('responseModuleTitle') ?>";
        <?php
            }
        ?>
        if (responseModule!="") {
            $.toaster({ 
                priority : responseModuleBackground, 
                title : responseModuleTitle, 
                message : responseModuleMsg,
            });
        }

        /* Simpan tambah kontrak penawaran mata kuliah */
        document.forms["formAddMataKuliah"].addEventListener("submit", (event) => {
            event.preventDefault()
            console.info("asu")
            const idPenawaranMataKuliah = parseInt(document.forms["formAddMataKuliah"]["id_penawaran_mata_kuliah"].value)
            const idMataKuliah = parseInt(document.forms["formAddMataKuliah"]["id_mata_kuliah"].value)
            const idDosen = parseInt(document.forms["formAddMataKuliah"]["id_dosen"].value)
            let idDosenTim1 = parseInt(document.forms["formAddMataKuliah"]["id_dosen_tim_1"].value)
            let idDosenTim2 = parseInt(document.forms["formAddMataKuliah"]["id_dosen_tim_2"].value)
            let idDosenTim3 = parseInt(document.forms["formAddMataKuliah"]["id_dosen_tim_3"].value)
            if (idDosenTim1 === 0 || idDosenTim1 === null) {
                idDosenTim1 = null
            }
            if (idDosenTim2 === 0 || idDosenTim2 === null) {
                idDosenTim2 = null
            }
            if (idDosenTim3 === 0 || idDosenTim3 === null) {
                idDosenTim3 = null
            }
            if (idDosenTim1 !== null) {
                if (idDosen == idDosenTim1) {
                    $.toaster({ message : 'Dosen utama dengan dosen tim 1 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim1 ==  idDosenTim2) {
                    $.toaster({ message : 'Dosen tim 1 dengan dosen tim 2 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim1 ==  idDosenTim3) {
                    $.toaster({ message : 'Dosen tim 1 dengan dosen tim 3 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
            }
            if (idDosenTim2 !== null) {
                if (idDosen == idDosenTim2) {
                    $.toaster({ message : 'Dosen utama dengan dosen tim 2 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim1 ==  idDosenTim2) {
                    $.toaster({ message : 'Dosen tim 1 dengan dosen tim 2 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim2 ==  idDosenTim3) {
                    $.toaster({ message : 'Dosen tim 2 dengan dosen tim 3 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
            }
            if (idDosenTim3 !== null) {
                if (idDosen == idDosenTim3) {
                    $.toaster({ message : 'Dosen utama dengan dosen tim 3 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim1 ==  idDosenTim3) {
                    $.toaster({ message : 'Dosen tim 1 dengan dosen tim 3 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim2 ==  idDosenTim3) {
                    $.toaster({ message : 'Dosen tim 2 dengan dosen tim 3 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
            }
            const idKelas = parseInt(document.forms["formAddMataKuliah"]["id_kelas"].value)
            const kapasitas = parseInt(document.forms["formAddMataKuliah"]["kapasitas"].value)
            const dataBody = {
                "id_penawaran_mata_kuliah": idPenawaranMataKuliah,
                "id_mata_kuliah":idMataKuliah,
                "id_dosen": idDosen,
                "id_dosen_tim_1":idDosenTim1,
                "id_dosen_tim_2":idDosenTim2,
                "id_dosen_tim_3": idDosenTim3,
                "id_kelas":idKelas,
                "kapasitas":kapasitas
            }
            
            const url = "<?php echo base_url('penawaran-mata-kuliah/add-kontrak-penawaran-mata-kuliah') ?>"
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify(dataBody),
                async: false,
                success: function(result) {
                    if (result.code === 200) {
                        $.toaster({ message : 'Berhasil input data', title : 'Success', priority : 'success' });
                        setTimeout(function(){
                            const redirectURL = "<?php echo base_url('penawaran-mata-kuliah/detail?id=').$id_penawaran_mata_kuliah; ?>"
                            window.location.assign(redirectURL);
                        }, 1000);
                        return
                    } else {
                        $.toaster({ message : 'Gagal input data', title : 'Warning', priority : 'warning' });
                    }
                },
                error: function() {
                    $.toaster({ message : 'Gagal input data', title : 'Failed', priority : 'danger' });
                }
            });
        });

        /* Simpan edit kontrak penawaran mata kuliah */
        document.forms["formEditMataKuliah"].addEventListener("submit", (event) => {
            event.preventDefault()
            const id = parseInt(document.forms["formEditMataKuliah"]["id"].value)
            const idPenawaranMataKuliah = parseInt(document.forms["formEditMataKuliah"]["id_penawaran_mata_kuliah"].value)
            const idMataKuliah = parseInt(document.forms["formEditMataKuliah"]["id_mata_kuliah"].value)
            const idDosen = parseInt(document.forms["formEditMataKuliah"]["id_dosen"].value)
            let idDosenTim1 = parseInt(document.forms["formEditMataKuliah"]["id_dosen_tim_1"].value) ? parseInt(document.forms["formEditMataKuliah"]["id_dosen_tim_1"].value) : null
            let idDosenTim2 = parseInt(document.forms["formEditMataKuliah"]["id_dosen_tim_2"].value) ? parseInt(document.forms["formEditMataKuliah"]["id_dosen_tim_2"].value) : null
            let idDosenTim3 = parseInt(document.forms["formEditMataKuliah"]["id_dosen_tim_3"].value) ? parseInt(document.forms["formEditMataKuliah"]["id_dosen_tim_3"].value) : null
            if (idDosenTim1 === 0 || idDosenTim1 === null || idDosenTim1 === NaN) {
                idDosenTim1 = null
            }
            if (idDosenTim2 === 0 || idDosenTim2 === null || idDosenTim2 === NaN) {
                idDosenTim2 = null
            }
            if (idDosenTim3 === 0 || idDosenTim3 === null || idDosenTim3 === NaN) {
                idDosenTim3 = null
            }
            if (idDosenTim1 !== null) {
                if (idDosen == idDosenTim1) {
                    $.toaster({ message : 'Dosen utama dengan dosen tim 1 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim1 ==  idDosenTim2) {
                    $.toaster({ message : 'Dosen tim 1 dengan dosen tim 2 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim1 ==  idDosenTim3) {
                    $.toaster({ message : 'Dosen tim 1 dengan dosen tim 3 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
            }
            if (idDosenTim2 !== null) {
                if (idDosen == idDosenTim2) {
                    $.toaster({ message : 'Dosen utama dengan dosen tim 2 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim1 ==  idDosenTim2) {
                    $.toaster({ message : 'Dosen tim 1 dengan dosen tim 2 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim2 ==  idDosenTim3) {
                    $.toaster({ message : 'Dosen tim 2 dengan dosen tim 3 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
            }
            if (idDosenTim3 !== null) {
                if (idDosen == idDosenTim3) {
                    $.toaster({ message : 'Dosen utama dengan dosen tim 3 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim1 ==  idDosenTim3) {
                    $.toaster({ message : 'Dosen tim 1 dengan dosen tim 3 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
                if (idDosenTim2 ==  idDosenTim3) {
                    $.toaster({ message : 'Dosen tim 2 dengan dosen tim 3 tidak boleh sama', title : 'Warning', priority : 'warning' });
                    return
                }
            }
            const idKelas = parseInt(document.forms["formEditMataKuliah"]["id_kelas"].value)
            const kapasitas = parseInt(document.forms["formEditMataKuliah"]["kapasitas"].value)
            const dataBody = {
                "id"                        : id,
                "id_penawaran_mata_kuliah"  : idPenawaranMataKuliah,
                "id_mata_kuliah"            : idMataKuliah,
                "id_dosen"                  : idDosen,
                "id_dosen_tim_1"            : idDosenTim1,
                "id_dosen_tim_2"            : idDosenTim2,
                "id_dosen_tim_3"            : idDosenTim3,
                "id_kelas"                  : idKelas,
                "kapasitas"                 : kapasitas
            }
            const url = "<?php echo base_url('penawaran-mata-kuliah/edit-kontrak-penawaran-mata-kuliah') ?>"
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify(dataBody),
                async: false,
                success: function(result) {
                    if (result.code === 200) {
                        $.toaster({ message : 'Berhasil edit data', title : 'Success', priority : 'success' });
                        setTimeout(function(){
                            const redirectURL = "<?php echo base_url('penawaran-mata-kuliah/detail?id=').$id_penawaran_mata_kuliah; ?>"
                            window.location.assign(redirectURL);
                        }, 1000);
                        return
                    } else {
                        $.toaster({ message : 'Gagal edit data', title : 'Warning', priority : 'warning' });
                    }
                },
                error: function() {
                    $.toaster({ message : 'Gagal edit data', title : 'Failed', priority : 'danger' });
                }
            });
        });

        /* Data tables */
        const urlGetListDataDetail = "<?php echo base_url('penawaran-mata-kuliah/get-data-detail') ?>";
        const id_penawaran_mata_kuliah = parseInt("<?php echo $id_penawaran_mata_kuliah ?>")
        $('#listDataTable').DataTable({
            "ordering": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "bDestroy": true,
            "searching": false,
            "paging": false,
            "scrollX": true,
            "responsive": true,
            "ajax":{
                "url": urlGetListDataDetail,
                "dataType": "json",
                "type": "POST",
                "data":{   
                    "id_penawaran_mata_kuliah": id_penawaran_mata_kuliah
                }
            },
            "columns": [
                { "data": "nomor", "className": "text-center", "width": "2%",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { "data": "aksi", "className": "text-center", "width": "2%"},
                { "data": "kode_mata_kuliah", "width": "7%" },
                { "data": "mata_kuliah", "width": "15%" },
                { "data": "dosen", "width": "15%" },
                { "data": "dosen_tim_1", "width": "15%" },
                { "data": "dosen_tim_2", "width": "15%" },
                { "data": "dosen_tim_3", "width": "15%" },
                { "data": "kelas", "width": "4%" },
                { "data": "kapasitas", "width": "5%" },
            ],
            "initComplete": function(settings, json) {
                
            }
        });

        /* Combobox */
        $('.selectMataKuliah').select2({
            placeholder: 'Pilih mata kuliah',
            allowClear: true,
            dropdownParent: $('#add-mata-kuliah')
        });
        $('.selectMataKuliahEdit').select2({
            placeholder: 'Pilih mata kuliah',
            allowClear: true,
            disabled: true
        });
        $('.selectDosen').select2({
            placeholder: 'Pilih Dosen',
            allowClear: true,
            dropdownParent: $('#add-mata-kuliah')
        });
        $('.selectDosenEdit').select2({
            placeholder: 'Pilih Dosen',
            allowClear: true,
            disabled: true
        });
        $('.selectDosenEditTim1').select2({
            placeholder: 'Pilih Dosen',
            allowClear: true,
            disabled: true
        });
        $('.selectDosenEditTim2').select2({
            placeholder: 'Pilih Dosen',
            allowClear: true,
            disabled: true
        });
        $('.selectDosenEditTim3').select2({
            placeholder: 'Pilih Dosen',
            allowClear: true,
            disabled: true
        });
        $('.selectKelas').select2({
            placeholder: 'Pilih kelas',
            allowClear: true,
            dropdownParent: $('#add-mata-kuliah')
        });
        $('.selectKelasEdit').select2({
            placeholder: 'Pilih kelas',
            allowClear: true,
            dropdownParent: $('#edit-mata-kuliah')
        });
        
	});

</script>
</body>
</html>
