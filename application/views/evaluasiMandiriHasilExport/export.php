<!DOCTYPE html>
<html>
<head>
	<title>Laporan Hasil Evaluasi Mandiri</title>
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

	<table class="tabel-cpl-detail" cellspacing="0">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th width="50%">Kompetensi</th>
				<th class="text-right">Skor<br>Mahasiswa</th>
				<th class="text-right">Skor<br>Maksimum</th>
				<th class="text-right">Capaian<br>Kompetensi</th>
				<th class="text-center">Keterangan</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$nomor = 1;
			for($i=0; $i<count($data_laporan); $i++) {
				$data_laporan_detail = $data_laporan[$i];
				$cpl_nama = (isset($data_laporan_detail[0]['nama_cpl'])) ? $data_laporan_detail[0]['nama_cpl'] : ' ';
				$cpl_deskripsi = (isset($data_laporan_detail[0]['deskripsi'])) ? $data_laporan_detail[0]['deskripsi'] : ' ';
				
				$cpl_nama_low = 'skor_maks_'.str_replace(' ','_',strtolower($cpl_nama));
				$skor_maks = (isset($data_skor_maks[$cpl_nama_low])) ? $data_skor_maks[$cpl_nama_low] : 0;
		?>
				<tr>
					<?php
						$total_harkat = 0;
						$total_sks = 0;
						for($j=0; $j<count($data_laporan_detail); $j++) {

							$nilai = '';
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
							
							$subtotal_harkat = $data_laporan_detail[$j]['mk_sks'] * $harkat*$data_laporan_detail[$j]['cpld_kontribusi'];
							$total_harkat += $subtotal_harkat;
							$total_sks += $data_laporan_detail[$j]['mk_sks'];
						}
						$skor_mahasiswa = ($total_sks!=0) ? round(($total_harkat/$total_sks), 2) : 0;
						$capaian = ($skor_maks!=0) ? round((($skor_mahasiswa/$skor_maks)*100),2) : 0;
						
						$capaian_keterangan = '';
						for($l=0; $l<count($data_klasifikasi); $l++) {
							$batas_bawah = $data_klasifikasi[$l]['batas_bawah'];
							$batas_atas = $data_klasifikasi[$l]['batas_atas'];
							if ($capaian>=$batas_bawah 
								&& 
								$capaian<=$batas_atas
							) {
								$capaian_keterangan = $data_klasifikasi[$l]['predikat'];
							}
						}
					?>
					<td class="text-center"><?php echo $nomor; ?></td>
					<td><?php echo $cpl_deskripsi; ?></td>
					<td class="text-right"><?php echo number_format($skor_mahasiswa,2,".",","); ?></td>
					<td class="text-right"><?php echo number_format($skor_maks,2,".",","); ?></td>
					<td class="text-right"><?php echo number_format($capaian,2,".",","); ?></td>
					<td class="text-center"><b><?php echo $capaian_keterangan; ?></b></td>
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
				<th style="width: 50%;"><?php echo $data_mahasiswa->nama ?></th>
			</tr>
			<tr>
				<th style="width: 50%;">..................................................</th>
				<th style="width: 50%;"><?php echo $data_mahasiswa->nim ?></th>
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

