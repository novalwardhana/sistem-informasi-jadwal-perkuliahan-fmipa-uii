<!DOCTYPE html>
<html>
<head>
	<title>Laporan Rekap Evaluasi Mandiri</title>
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

		.tabel-footer { width: 100% }
		.tabel-footer thead th{ padding: 3px 6px; font-size: 12px; vertical-align: top; text-align: center; }
		
		.text-center {
			text-align: center;
		}

		.text-justify {
			text-align: justify;
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
					Laporan Rekap Evaluasi Mandiri Pengukuran Capaian Pembelajaran
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

	<table class="tabel-cpl-detail" cellspacing="0">
		<thead>
			<tr>
				<th width="8%" class="text-center">No</th>
				<th class="text-center">NIM</th>
				<th width="40%">Nama</th>
				<th class="text-center">Semester</th>
				<th class="text-right">Rata-rata CPL</th>
				<th class="text-left">Keterangan</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$nomor = $start + 1;
				for($i=0; $i<count($data_rekap); $i++) {
			?>
				<tr>
					<td class="text-center"><?php echo $nomor; ?></td>
					<td class="text-center"><?php echo $data_rekap[$i]['nim']; ?></td>
					<td><?php echo $data_rekap[$i]['nama']; ?></td>
					<td class="text-center"><?php echo $data_rekap[$i]['semester']; ?></td>
					<td class="text-right"><?php echo $data_rekap[$i]['cpl_rata_rata']; ?></td>
					<td><b><?php echo $data_rekap[$i]['keterangan']; ?></b></td>
				</tr>
			<?php
					$nomor++;
				}
			?>
		</tbody>
	</table>
</body>
</html>

