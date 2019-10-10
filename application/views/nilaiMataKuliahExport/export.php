<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.tabel-mahasiswa {
			width: 100%
		}
		.tabel-mahasiswa thead th{
			padding: 10px 10px;
		}

		.tabel-mahasiswa-nilai {
			width: 100%;
			border: 1px solid #333;
		}

		.tabel-mahasiswa-nilai thead th {
			padding: 10px;
			background: #f2f2f2;
			border: 1px solid #333;
		}

		.tabel-mahasiswa-nilai tbody td {
			padding: 10px;
			
			border: 1px solid #333;
		}

		.text-center {
			text-align: center;
		}

		.text-right {
			text-align: right;
		}
	</style>
</head>
<body>
	<table class="tabel-mahasiswa">
		<thead>
			<tr>
				<th colspan="2" class="text-center">
					<h2>
						Laporan Nilai Mata Kuliah
					</h2>
				</th>
			</tr>
			<tr>
				<th style="width: 15%">Nama Mahasiswa</th>
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
	<table class="tabel-mahasiswa-nilai">
		<thead>
			<tr>
				<th width="30" class="text-center">No</th>
				<th width="50" class="text-center">Semester</th>
				<th width="100" class="text-center">Kode</th>
				<th>Mata Kuliah</th>
				<th width="100" class="text-center">Nilai</th>
				<th width="50" class="text-center">Huruf</th>
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
						<td class="text-center"><?php echo number_format($value['nilai'],2,",",".") ?></td>
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
</body>
</html>
