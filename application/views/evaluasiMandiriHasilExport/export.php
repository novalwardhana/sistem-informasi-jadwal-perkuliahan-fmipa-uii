<!DOCTYPE html>
<html>
<head>
	<title>Hasil Evaluasi Mandiri</title>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	<style type="text/css">
		body { font-family: Times !important; color: #222; }
		.bagan-cpl { border: 1px solid #789; padding: 10px;margin-top: 5px; margin-bottom: 20px;width: 100% }
		
    .tabel-header { width: 100% }
		.tabel-header thead th{ padding: 8px 6px; font-size: 15px; vertical-align: top; text-align: center; }

    .tabel-mahasiswa { width: 100% }
		.tabel-mahasiswa thead th{ padding: 8px 6px; font-size: 12px; vertical-align: top; line-height: 1.8; text-align: justify; }
   	.tabel-mahasiswa tbody td{ padding: 8px 6px; font-size: 11px; vertical-align: top; line-height: 1.8; text-align: justify; }

		.tabel-cpl-detail { width: 100%; border: 1px solid #789 }
		.tabel-cpl-detail thead { display: table-row-group; }
		.tabel-cpl-detail thead th{ border: 0.5px solid #789; padding: 8px 6px; font-size: 12px; vertical-align: top; background: #d2d6de; line-height: 1.8; }
   	.tabel-cpl-detail tbody td{ border: 0.5px solid #789; padding: 8px 6px; font-size: 11px; vertical-align: top; line-height: 1.8; }

		.text-center {
			text-align: center;
		}

		.text-right {
			text-align: right;
		}

		.page-break { page-break-before: always; }
	</style>
</head>
<body>
  
  <!-- Header evaluasi mahasiswa -->
  <table class="tabel-header">
    <thead>
      <tr>
        <th rowspan="3" style="width: 15%">
          <img src="./application/views/evaluasiMandiriExport/logo_uii.png" alt="">
        </th>
				<th class="text-center" style="width: 70%">
					Laporan Hasil Evaluasi Mandiri Pengukuran Capaian Pembelajaran
				</th>
        <th rowspan="3" style="width: 15%">&nbsp;</th>
			</tr>
      <tr>
				<th class="text-center">
          Program Studi DIII Analisis Kimia
				</th>
			</tr>
      <tr>
				<th class="text-center">
          Universitas Islam Indonesia
				</th>
			</tr>
    </thead>
  </table>

	<hr>

	<table class="tabel-mahasiswa">
		<thead>
			<tr>
				<th style="width: 12%">Nama</th>
				<th>: <?php echo $data_mahasiswa->nama ?></th>
			</tr>
			<tr>
				<th>NIM</th>
				<th>: <?php echo $data_mahasiswa->nim ?></th>
			</tr>
			<tr>
				<th>Semester</th>
				<th>: <?php echo $data_mahasiswa->semester ?></th>
			</tr>
		</thead>
	</table>
	<br>
</body>
</html>

