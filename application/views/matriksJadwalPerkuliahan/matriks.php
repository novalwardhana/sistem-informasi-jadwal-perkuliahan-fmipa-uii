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

<!-- fullcalendar timeline -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.8/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.info("add event")
    });
</script>

<script src="<?php echo base_url('assets/toast/jquery.toaster.js') ?>"></script>
<script>
    $(document).ready(function () {
        $(".menu-sidebar-jadwal-perkuliahan").addClass('active');
        $(".menu-sidebar-matriks-jadwal-perkuliahan").addClass('active');

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

        let renderMatriks = function(listRuang, listJadwalKuliah, domID) {
            var calendarEl = document.getElementById(domID);
            var calendar = new FullCalendar.Calendar(calendarEl, {
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                initialView: 'resourceTimeline',
                resourceAreaWidth: "20%",
                eventMinWidth: 170,
                height: 650,
                contentHeight: 600,
                slotMinTime: "06:00:00",
                slotMaxTime: "21:00:00",
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
                slotDuration: "00:10:00",
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

    });
</script>
</body>
</html>
