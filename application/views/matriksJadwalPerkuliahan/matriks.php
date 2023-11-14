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
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/dist/css/skins/_all-skins.min.css') ?>">
  <!-- Skin UII -->
  <link rel="stylesheet" href="<?php echo base_url('assets/skin-uii-light.css') ?>">
  <!-- Select 2 -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/select2/dist/css/select2.min.css') ?>">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
			$this->load->view('matriksjadwalPerkuliahan/matriksMain');
		?>
    </div>

    <?php
        $this->load->view('matriksjadwalPerkuliahan/matriksMainEdit');
    ?>

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
<!-- Select 2 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
<!-- fullcalendar timeline -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.8/index.global.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.info("add event")
    });
</script>

<script src="<?php echo base_url('assets/toast/jquery.toaster.js') ?>"></script>
<script>

    $('#dit-jadwal-perkuliahan').on('show.bs.modal', function(e) {});
    const editJadwalPerkuliahan = function(mataKuliah, dosen, dosenTambahan1, dosenTambahan2, kelas, kapasitas, idRuang, hari, jadwalMulai, jadwalSelesai, id, idPeriode) {
        document.forms["formEditJadwalPerkuliahan"]["mata_kuliah"].value = mataKuliah
        document.forms["formEditJadwalPerkuliahan"]["dosen"].value = dosen
        document.forms["formEditJadwalPerkuliahan"]["dosen_tambahan_1"].value = dosenTambahan1
        document.forms["formEditJadwalPerkuliahan"]["dosen_tambahan_2"].value = dosenTambahan2
        document.forms["formEditJadwalPerkuliahan"]["kelas"].value = kelas
        document.forms["formEditJadwalPerkuliahan"]["kapasitas"].value = kapasitas
        $(".selectRuang").val(idRuang).trigger("change")
        $(".selectHari").val(hari).trigger("change")
        document.forms["formEditJadwalPerkuliahan"]["jadwal_mulai"].value = jadwalMulai
        document.forms["formEditJadwalPerkuliahan"]["jadwal_selesai"].value = jadwalSelesai
        document.forms["formEditJadwalPerkuliahan"]["id"].value = parseInt(id)
        document.forms["formEditJadwalPerkuliahan"]["id_periode"].value = parseInt(idPeriode)
    }

    $(document).ready(function () {
        $(".menu-sidebar-jadwal-perkuliahan").addClass('active');
        $(".menu-sidebar-matriks-jadwal-perkuliahan").addClass('active');

        /* Get list matriks */
        let urlGetListMatriks = "<?php echo base_url('matriks-jadwal-perkuliahan/get-list-matriks')."?id=".$id ?>";
        $('#listDataTable').DataTable({
            "ordering": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": urlGetListMatriks,
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
                { "data": "aksi", "className": "text-center", "width": "5%"},
                { "data": "prodi", "width": "10%" },
                { "data": "mata_kuliah", "width": "10%" },
                { "data": "kelas", "width": "7%" },
                { "data": "dosen", "width": "15%" },
                { "data": "dosen_tim_1", "width": "15%" },
                { "data": "dosen_tim_2", "width": "15%" },
                { "data": "hari", "width": "7%" },
                { "data": "jadwal_mulai", "width": "7%" },
                { "data": "jadwal_selesai", "width": "7%" },
                { "data": "ruang", "width": "7%" },
                { "data": "kapasitas", "width": "8%" },
            ]  
        });


        /* Get data matriks */
        let listRuang = []
        let listJadwalKuliahSenin = []
        let listJadwalKuliahSelasa = []
        let listJadwalKuliahRabu = []
        let listJadwalKuliahKamis = []
        let listJadwalKuliahJumat = []
        let listJadwalKuliahSabtu = []
        let urlGetDataMatriks = "<?php echo base_url('matriks-jadwal-perkuliahan/get-data-matriks')."?id=".$id ?>";
        let getDataMatriks = function() {
            $.ajax({
                url: urlGetDataMatriks,
                type: 'GET',
                success: function(respString) {
                    let resp = JSON.parse(respString);
                    if (resp.code === 200) {
                        listRuang = resp.data.list_ruang
                        listJadwalKuliahSenin = resp.data.jadwal_perkuliahan_senin
                        listJadwalKuliahSelasa = resp.data.jadwal_perkuliahan_selasa
                        listJadwalKuliahRabu = resp.data.jadwal_perkuliahan_rabu
                        listJadwalKuliahKamis = resp.data.jadwal_perkuliahan_kamis
                        listJadwalKuliahJumat = resp.data.jadwal_perkuliahan_jumat
                        listJadwalKuliahSabtu = resp.data.jadwal_perkuliahan_sabtu
                        /*
                            renderMatriks(listRuang, listJadwalKuliahSenin, "matriksSenin")
                            renderMatriks(listRuang, listJadwalKuliahSelasa, "matriksSelasa")
                            renderMatriks(listRuang, listJadwalKuliahRabu, "matriksRabu")
                            renderMatriks(listRuang, listJadwalKuliahKamis, "matriksKamis")
                            renderMatriks(listRuang, listJadwalKuliahJumat, "matriksJumat")
                            renderMatriks(listRuang, listJadwalKuliahSabtu, "matriksSabtu")
                        */
                    } else {

                    }
                }
            });
        }
        getDataMatriks()

        /* Render matriks function */
        let renderMatriks = function(listRuang, listJadwalKuliah, domID) {
            var calendarEl = document.getElementById(domID);
            var calendar = new FullCalendar.Calendar(calendarEl, {
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                initialView: 'resourceTimeline',
                resourceAreaWidth: "15%",
                eventMinWidth: 170,
                height: 670,
                contentHeight: 600,
                slotMinTime: "07:00:00",
                slotMaxTime: "18:30:00",
                slotMinWidth: 50,
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    omitZeroMinute: false,
                    meridiem: 'short',
                    hour12: false
                },
                titleFormat: {
                    hour12: false,
                },
                slotDuration: "00:15:00",
                slotLabelInterval: "00:30",
                aspectRatio: 5, 
                editable: true,
                headerToolbar: {
                    left: '',
                    center: '',
                    right: ''
                },
                resourceAreaColumns: [
                    {
                        field: 'title',
                        headerContent: 'Ruang'
                    },
                    {
                        field: 'occupancy',
                        headerContent: 'Kapasitas'
                    }
                ],
                timeZone: 'Asia/Jakarta',
                resources: listRuang,
                events: listJadwalKuliah,
            });
            calendar.render();
        }

        /* Render tab matriks jadwal perkuliahan */
        $('.jadwalPerkuliahanSenin').click(function(){
            setTimeout(function(){
                renderMatriks(listRuang, listJadwalKuliahSenin, "matriksSenin")
            }, 500);
        });
        $('.jadwalPerkuliahanSelasa').click(function(){
            setTimeout(function(){
                renderMatriks(listRuang, listJadwalKuliahSelasa, "matriksSelasa")
            }, 500);
        });
        $('.jadwalPerkuliahanRabu').click(function(){
            setTimeout(function(){
                renderMatriks(listRuang, listJadwalKuliahRabu, "matriksRabu")
            }, 500);
        });
        $('.jadwalPerkuliahanKamis').click(function(){
            setTimeout(function(){
                renderMatriks(listRuang, listJadwalKuliahKamis, "matriksKamis")
            }, 500);
        });
        $('.jadwalPerkuliahanJumat').click(function(){
            setTimeout(function(){
                renderMatriks(listRuang, listJadwalKuliahJumat, "matriksJumat")
            }, 500);
        });
        $('.jadwalPerkuliahanSabtu').click(function(){
            setTimeout(function(){
                renderMatriks(listRuang, listJadwalKuliahSabtu, "matriksSabtu")
            }, 500);
        });

        $('.selectHari').select2({
            placeholder: 'Pilih hari',
            allowClear: true,
            dropdownParent: $('#edit-jadwal-perkuliahan')
        });
        $('.selectRuang').select2({
            placeholder: 'Pilih ruang',
            allowClear: true,
            dropdownParent: $('#edit-jadwal-perkuliahan')
        });
        $('.jadwalMulai').timepicker({
            timeFormat: 'HH:mm:ss',
            interval: 30,
            minTime: '10',
            maxTime: '6:00pm',
            defaultTime: '11',
            startTime: '09:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('.jadwalSelesai').timepicker({
            timeFormat: 'HH:mm:ss',
            interval: 30,
            minTime: '10',
            maxTime: '6:00pm',
            defaultTime: '11',
            startTime: '09:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true,
        });

        /* Simpan perubahan jadwal perkuliahan */
        document.forms["formEditJadwalPerkuliahan"].addEventListener("submit", (event) => {
            event.preventDefault()
            const id = parseInt(document.forms["formEditJadwalPerkuliahan"]["id"].value)
            const idPeriode = parseInt(document.forms["formEditJadwalPerkuliahan"]["id_periode"].value)
            const hari = document.forms["formEditJadwalPerkuliahan"]["hari"].value
            const jadwalMulai = document.forms["formEditJadwalPerkuliahan"]["jadwal_mulai"].value
            const jadwalSelesai = document.forms["formEditJadwalPerkuliahan"]["jadwal_selesai"].value
            const idRuang = parseInt(document.forms["formEditJadwalPerkuliahan"]["id_ruang"].value)
            const dataBody = {
                "id": id,
                "id_periode":idPeriode,
                "hari": hari,
                "jadwal_mulai": jadwalMulai,
                "jadwal_selesai": jadwalSelesai,
                "id_ruang": idRuang,
            }
            
            const url = "<?php echo base_url('matriks-jadwal-perkuliahan/set-jadwal') ?>";
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
                        $.toaster({ message : 'Berhasil set jadwal perkuliahan', title : 'Success', priority : 'success' });
                        setTimeout(function(){
                            const redirectURL = "<?php echo base_url('matriks-jadwal-perkuliahan?id=') ?>" +idPeriode
                            window.location.assign(redirectURL);
                        }, 1000);
                        return
                    } else {
                        $.toaster({ message : result.message, title : 'Warning', priority : 'warning' });
                    }
                },
                error: function() {
                    $.toaster({ message : 'Gagal set jadwal perkuliahan', title : 'Failed', priority : 'danger' });
                }
            });
        })

    });
</script>
</body>
</html>
