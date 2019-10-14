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

		.tabel-mahasiswa tbody td{
			font-size: 12px;
		}

		.tabel-mahasiswa thead th{
			font-size: 12px;
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
						Laporan Evaluasi Mandiri
					</h2>
				</th>
			</tr>
			<tr>
				<th style="width: 15%">Nama</th>
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
	<?php
		for($i=0; $i<count($data_laporan); $i++) {
			$data_laporan_detail = $data_laporan[$i];
			$cpl_nama = (isset($data_laporan_detail[0]['nama_cpl'])) ? $data_laporan_detail[0]['nama_cpl'] : ' ';
			$cpl_deskripsi = (isset($data_laporan_detail[0]['deskripsi'])) ? $data_laporan_detail[0]['deskripsi'] : ' ';
			
			$cpl_nama_low = 'skor_maks_'.str_replace(' ','_',strtolower($cpl_nama));
			$skor_maks = (isset($data_skor_maks[$cpl_nama_low])) ? $data_skor_maks[$cpl_nama_low] : 0;
	?>
			<div style="border: 2px solid #C7CFD4; padding: 10px;margin-top: 5px; margin-bottom: 20px;">
			<table class="tabel-mahasiswa">
				<thead>
					<tr>
						<th style="width: 15%">Nama</th>
						<th>: <span><?php echo $cpl_nama ?></span></th>
					</tr>
					<tr>
						<th>Deskripsi</th>
						<th>: <span><?php echo $cpl_deskripsi ?></span></th>
					</tr>
				</thead>
			</table>
			<table class="tabel-mahasiswa" cellspacing="0" border="1">
				<thead>
					<tr>
						<th class="text-right">No</th>
						<th class="text-right">Kode</th>
						<th>Mata Kuliah</th>
						<th class="text-right">SKS</th>
						<th>Keterangan</th>
						<th style="text-align: right">Nilai (Angka)</th>
						<th class="text-center">Nilai</th>
						<th style="text-align: right">Harkat</th>
						<th style="text-align: right">Kontribusi</th>
						<th style="text-align: right">Earned</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$nomor = 1;
						$total_harkat = 0;
						$total_sks = 0;
						for($j=0; $j<count($data_laporan_detail); $j++) {
							
							$nilai='';
							$harkat=0;
							
							if ($data_laporan_detail[$j]['capaian_nilai_max']>=100) {

								$nilai = 'A';
								$harkat = 100;

							} else {

								for($k=0; $k<count($data_harkat); $k++) {
									$batas_bawah = $data_harkat[$k]['batas_bawah'];
									$batas_atas = $data_harkat[$k]['batas_atas'];
									if ($data_laporan_detail[$j]['capaian_nilai_max']>=$batas_bawah 
										&& 
										$data_laporan_detail[$j]['capaian_nilai_max']<$batas_atas
									) {
										$nilai = $data_harkat[$k]['huruf'];
										$harkat = $data_harkat[$k]['harkat'];
									}
								}
								
							}
							
							$subtotal_harkat = $data_laporan_detail[$j]['mk_sks'] * $harkat * $data_laporan_detail[$j]['cpld_kontribusi'];
							$total_harkat += $subtotal_harkat;
							$total_sks += $data_laporan_detail[$j]['mk_sks'];
						?>
							<tr>
								<td style="text-align: center;"><?php echo $nomor ?></td>
								<td style="text-align: center;"><?php echo $data_laporan_detail[$j]['mk_kode'] ?></td>
								<td><?php echo $data_laporan_detail[$j]['mk_nama'] ?></td>
								<td style="text-align: center;"><?php echo $data_laporan_detail[$j]['mk_sks'] ?></td>
								<td></td>
								<td class="text-right"><?php echo $data_laporan_detail[$j]['capaian_nilai_max'] ?></td>
								<td class="text-center"><?php echo $nilai; ?></td>
								<td class="text-right"><?php echo $harkat; ?></td>
								<td class="text-right"><?php echo $data_laporan_detail[$j]['cpld_kontribusi'] ?></td>
								<td class="text-right"><?php echo $subtotal_harkat; ?></td>
							</tr>
					<?php
						$nomor++;
					}
					?>
					<tr>
						<td colspan="3"></td>
						<td class="text-right"><?php echo $total_sks; ?></td>
						<td colspan="5" class="text-right"><b>Jumlah</b></td>
						<td class="text-right"><?php echo $total_harkat; ?></td>
					</tr>
					<tr>
						<td colspan="3"></td>
						<td class="text-right"></td>
						<td colspan="5" class="text-right"><b>Skor Mahasiswa</b></td>
						<?php
							$skor_mahasiswa = ($total_sks!=0) ? round(($total_harkat/$total_sks), 2) : 0;
						?>
						<td class="text-right"><?php echo $skor_mahasiswa ?></td>
					</tr>
					<tr>
						<td colspan="3"></td>
						<td class="text-right"></td>
						<td colspan="5" class="text-right"><b>Skor Maksimum</b></td>
						<td class="text-right"><?php echo $skor_maks ?></td>
					</tr>
					<tr>
						<td colspan="3"></td>
						<td class="text-right"></td>
						<td colspan="5" class="text-right"><b>Capaian Kompetensi</b></td>
						<?php
							$capaian = ($skor_maks!=0) ? round((($skor_mahasiswa/$skor_maks)*100),2) : 0;
						?>
						<td class="text-right"><?php echo $capaian.'%' ?></td>
					</tr>
				</tbody>
			</table>
			</div>
	<?php
		}
	?>
</body>
</html>
