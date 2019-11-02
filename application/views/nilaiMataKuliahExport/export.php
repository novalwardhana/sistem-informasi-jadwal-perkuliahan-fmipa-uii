<!DOCTYPE html>
<html>
<head>
	<title>Laporan Nilai Mata Kuliah</title>
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

	<!-- Header nilai mata kuliah -->
  <table class="tabel-header">
    <thead>
      <tr>
        <th rowspan="3" style="width: 15%">
          <img src="./application/views/nilaiMataKuliahExport/logo_uii.png" alt="">
        </th>
				<th class="text-center" style="width: 70%">
					Laporan Nilai Mata Kuliah
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
				<th>: <?php echo $data_mahasiswa['nama'] ?></th>
			</tr>
			<tr>
				<th>NIM</th>
				<th>: <?php echo $data_mahasiswa['nim'] ?></th>
			</tr>
			<tr>
				<th>Semester</th>
				<th>: <?php echo $data_mahasiswa['semester'] ?></th>
			</tr>
		</thead>
	</table>
	<br>

	<br>
	<table class="tabel-cpl-detail" cellspacing="0">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">Semester</th>
				<th class="text-center">Kode</th>
				<th style="width: 50%">Mata Kuliah</th>
				<th style="width: 12%" class="text-right">Nilai</th>
				<th style="width: 12%" class="text-center">Huruf</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$nomor=1;
				foreach($data_mahasiswa_nilai as $value) {
			?>
					<tr>
						<td class="text-center"><?php echo $nomor; ?></td>
						<td class="text-center"><?php echo $value['semester'] ?></td>
						<td class="text-center"><?php echo $value['kode_mata_kuliah'] ?></td>
						<td><?php echo $value['mata_kuliah'] ?></td>
						<td class="text-right"><?php echo number_format($value['nilai'],2,".",",") ?></td>
						<?php
							$nilai_akhir = (float) $value['nilai'];
							if ($nilai_akhir>=100) {
								$huruf="A";
							}
							foreach($data_harkat as $value_harkat) {
								$batas_bawah = (float) $value_harkat['batas_bawah'];
								$batas_atas = (float) $value_harkat['batas_atas'];
								if ($nilai_akhir>=$batas_bawah && $nilai_akhir<$batas_atas) {
									$huruf = $value_harkat['huruf'];
								}
							}
						?>
						<td class="text-center"><?php echo $huruf ?></td>
					</tr>
			<?php
					$nomor++;
				}
			?>
		</tbody>
	</table>

	<br><br><br>
	<table class="tabel-footer page-break">
		<thead>
			<tr>
				<th style="width: 50%;">Mengetahui</th>
				<th style="width: 50%">Yogyakarta, <?php echo $tanggal; ?> </th>
			</tr>
			<tr>
				<th style="width: 50%;">Dosen Pembimbing Akademik</th>
				<th style="width: 50%">Mahasiswa</th>
			</tr>
			<tr>
				<th style="width: 50%;">&nbsp;</th>
				<th style="width: 50%">&nbsp;</th>
			</tr>
			<tr>
				<th style="width: 50%;">&nbsp;</th>
				<th style="width: 50%">&nbsp;</th>
			</tr>
			<tr>
				<th style="width: 50%;">&nbsp;</th>
				<th style="width: 50%">&nbsp;</th>
			</tr>
			<tr>
				<th style="width: 50%;">&nbsp;</th>
				<th style="width: 50%">&nbsp;</th>
			</tr>
			<tr>
				<th style="width: 50%;">..................................................</th>
				<th style="width: 50%;"><?php echo $data_mahasiswa['nama'] ?></th>
			</tr>
			<tr>
				<th style="width: 50%;">..................................................</th>
				<th style="width: 50%;"><?php echo $data_mahasiswa['nim'] ?></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="2">Ketua Program Studi DIII Analisis Kimia UII</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="2"><?php echo $pengaturan_sistem['nama_kaprodi'] ?></th>
			</tr>
			<tr>
				<th colspan="2"><?php echo $pengaturan_sistem['nik_kaprodi'] ?></th>
			</tr>
		</thead>
	</table>
</body>
</html>
