<section class="content">
	<div class="row">
		<!-- Breadcrumbs -->
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Laporan</li>
				<li class="active">Nilai Mahasiswa</li>
				<li class="active">Laporan</li>
			</ol>
		</div>

		<!-- Data Mahasiswa -->
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border text-center">
					<h5>
						<b>Detail Nilai Mata Kuliah Mahasiswa</b>
					</h5>
					<h5>
						<b>Program Studi DIII Analisis Kimia</b>
					</h5>
					<h5>
						<b>Universitas Islam Indonesia</b>
					</h5>
				</div>
				<div class="box-body">
					<table class="tabel-informasi" style="width: 100%">
						<tr>
							<th style="width: 12%">Nama</th>
							<th style="width: 2%">:</th>
							<th><span><?php echo $detail_nilai->mahasiswa_nama ?></span></th>
						</tr>
						<tr>
							<th>NIM</th>
							<th>:</th>
							<th><span><?php echo $detail_nilai->mahasiswa_nim ?></span></th>
						</tr>
						<tr>
							<th>Semester</th>
							<th>:</th>
							<th><span><?php echo $detail_nilai->mahasiswa_semester ?></span></th>
						</tr>
					</table>
					<br>
					<table class="tabel-informasi" style="width: 100%">
						<tr>
							<th style="width: 12%">Kode Mata Kuliah</th>
							<th style="width: 2%">:</th>
							<th><span><?php echo $detail_nilai->mata_kuliah_kode ?></span></th>
						</tr>
						<tr>
							<th>Mata Kuliah</th>
							<th>:</th>
							<th><span><?php echo $detail_nilai->mata_kuliah_nama ?></span></th>
						</tr>
						<tr>
							<th>Kontribusi</th>
							<th>:</th>
							<th><span><?php echo number_format($detail_nilai->mata_kuliah_kontribusi,0,".",","); ?> SKS</span></th>
						</tr>
					</table>
					<br>
					<?php
						$nilai_akhir = (float) $detail_nilai->nilai;

						$nilai_harkat = '';
						for($j=0; $j<count($harkat); $j++) {
							$batas_bawah = (float) $harkat[$j]['batas_bawah'];
							$batas_atas = (float) $harkat[$j]['batas_atas'];
							if ($nilai_akhir>=$batas_bawah && $nilai_akhir<$batas_atas) {
								$nilai_harkat = $harkat[$j]['huruf'];
							}
						}

						if ($nilai_akhir>=100) {
							$nilai_harkat = 'A';
						}
					?>
					<table class="tabel-informasi" style="width: 100%">
						<tr>
							<th style="width: 12%">Nilai Akhir</th>
							<th style="width: 2%">:</th>
							<th><span><?php echo $nilai_akhir ?></span></th>
						</tr>
						<tr>
							<th>Harkat</th>
							<th>:</th>
							<th><span><?php echo $nilai_harkat ?></span></th>
						</tr>
						<tr>
							<th>Keterangan Nilai</th>
							<th>:</th>
							<th><span class="label label-warning">Nilai berasal dari KHS Kumulatif</span></th>
						</tr>
					</table>
					<hr>
				</div>
			</div>
		</div>

	</div>
</section>
