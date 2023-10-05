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
      $this->load->view('penawaranMataKuliah/listMain');
    ?>
  </div>
	<?php
		$this->load->view('layout/footer');
  ?>

<?php
	$this->load->view('penawaranMataKuliah/deleteModal');
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
    $('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
    
	$(document).ready(function () {
		$(".menu-sidebar-penawaran-mata-kuliah").addClass('active');

        const showAddDataButton = () => {
            const elements =document.querySelectorAll(".addDataButton")
            elements.forEach(elem => {
                elem.style.display = 'inline-block'
            })
        }
        const addDataButtons = document.getElementsByClassName("addDataButton")
        const addDataButton =addDataButtons[0]
        addDataButton.addEventListener("click", (event) => {
            const elements =document.querySelectorAll(".formPenawaranMataKuliah")
            elements.forEach(elem => {
                elem.style.display = 'block'
            })
        })

        /* Hapus data penawaran mata kuliah */
        const deleteDatas = document.getElementsByClassName("deletePenawaranMataKuliah")
        const deleteData = deleteDatas[0]
        deleteData.addEventListener("click", (event) => {
            event.preventDefault()
            const id_periode = parseInt(document.forms["formData"]["id_periode"].value);
            const deleteURLArr = event.srcElement.href.split("=");
            if (deleteURLArr.length != 2) {
                return false
            }
            const idPenawaranMataKuliah = parseInt(deleteURLArr[1]);
            const url = "<?php echo base_url('penawaran-mata-kuliah/delete?id=') ?>" + idPenawaranMataKuliah;
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "DELETE",
                contentType: "application/json",
                async: false,
                success: function(result) {
                    let resultParse = JSON.parse(result)
                    if (resultParse.code === 200) {
                        $.toaster({ message : 'Berhasil hapus data', title : 'Success', priority : 'success' });
                        $(".selectProdi").val([]).trigger("change");
                        document.getElementById("cancelDeletePenawaranMataKuliah").click()
                        loadDataTable(id_periode)
                        return
                    } else {
                        $.toaster({ message : 'Gagal hapus data', title : 'Warning', priority : 'warning' });
                    }
                },
                error: function() {
                    $.toaster({ message : 'Gagal hapus data', title : 'Failed', priority : 'danger' });
                }
            });
            
        });

        /* Datatables list penawaran mata kuliah */
        const hideDataTable = function() {
            const elemListPenawaranMataKuliah = document.querySelectorAll(".listPenawaranMataKuliah")
            elemListPenawaranMataKuliah.forEach(elem => {
                elem.style.display = 'none'
            })
        }
        const showDataTable = function() {
            const elemListPenawaranMataKuliah = document.querySelectorAll(".listPenawaranMataKuliah")
            elemListPenawaranMataKuliah.forEach(elem => {
                elem.style.display = 'block'
            })
        }
        hideDataTable()
        let urlGetListData = "<?php echo base_url('penawaran-mata-kuliah/get-data') ?>"
        const loadDataTable = (idPeriode) => {
            $('#listDataTable').DataTable({
                "ordering": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "bDestroy": true,
                "searching": false,
                "paging": false,
                "ajax":{
                    "url": urlGetListData,
                    "dataType": "json",
                    "type": "POST",
                    "data":{   
                        "id_periode": idPeriode
                    }
                },
                "columns": [
                    { "data": "nomor", "className": "text-center", "width": "2%",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { "data": "aksi", "className": "text-center", "width": "5%"},
                    { "data": "periode", "width": "7%" },
                    { "data": "semester", "width": "7%" },
                    { "data": "kode_prodi", "width": "7%" },
                    { "data": "prodi", "width": "15%" },
                ]  
            });
        }

        /* Form action filter penawaran mata kuliah by periode */
        document.forms["formData"].addEventListener("submit", (event) => {
            event.preventDefault();
            if (isNaN(document.forms["formData"]["id_periode"].value) || isNaN(document.forms["formData"]["id_periode"].value)) {
                $.toaster({ message : 'Parameter periode tidak valid', title : 'Warning', priority : 'warning' });
                return
            }
            let id_periode = parseInt(document.forms["formData"]["id_periode"].value)
            $(".selectPeriode2").val(id_periode).trigger("change")
            showDataTable()
            showAddDataButton()
            loadDataTable(id_periode)
        });

        /* Form action add penawaran mata kuliah */
        document.forms["formDataPenawaranMataKuliah"].addEventListener("submit", (event) => {
            event.preventDefault();
            if (isNaN(document.forms["formDataPenawaranMataKuliah"]["id_periode"].value) || isNaN(document.forms["formDataPenawaranMataKuliah"]["id_periode"].value)) {
                $.toaster({ message : 'Parameter periode tidak valid', title : 'Warning', priority : 'warning' });
                return
            }
            const id_periode = parseInt(document.forms["formDataPenawaranMataKuliah"]["id_periode"].value)
            if (isNaN(document.forms["formDataPenawaranMataKuliah"]["id_prodi"].value) || isNaN(document.forms["formDataPenawaranMataKuliah"]["id_prodi"].value)) {
                $.toaster({ message : 'Parameter prodi tidak valid', title : 'Warning', priority : 'warning' });
                return
            }
            const id_prodi = parseInt(document.forms["formDataPenawaranMataKuliah"]["id_prodi"].value)
            const dataBody = {
                "id_periode": id_periode,
                "id_prodi": id_prodi
            }
            let url = "<?php echo base_url('penawaran-mata-kuliah/create') ?>"
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
                        $(".selectProdi").val([]).trigger("change");
                        loadDataTable(id_periode)
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

        /* Combobox */
        $('.selectPeriode').select2({
            placeholder: 'Pilih periode',
            allowClear: true
        });
        $('.selectPeriode2').select2({
            placeholder: 'Pilih periode',
            allowClear: true,
            disabled: true,
        });
        $('.selectProdi').select2({
            placeholder: 'Pilih mata kuliah',
            allowClear: true
        });
        
	});

</script>
</body>
</html>
