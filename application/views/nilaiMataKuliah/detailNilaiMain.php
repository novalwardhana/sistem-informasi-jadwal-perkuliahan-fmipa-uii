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
					<table class="tabel-informasi" style="width: 100%">
						<tr>
							<th style="width: 12%">Dosen Pengampu</th>
							<th style="width: 2%">:</th>
							<th><span><?php echo $detail_nilai->dosen_nama ?></span></th>
						</tr>
						<tr>
							<th>NIK</th>
							<th>:</th>
							<th><span><?php echo $detail_nilai->dosen_nik ?></span></th>
						</tr>
					</table>
					<br>
					<?php
						$nilai_akhir = 0 + ($detail_nilai->cpmk_1_nilai * $detail_nilai->cpmk_1_persentase / 100) +
													($detail_nilai->cpmk_2_nilai * $detail_nilai->cpmk_2_persentase / 100) +
													($detail_nilai->cpmk_3_nilai * $detail_nilai->cpmk_3_persentase / 100) +
													($detail_nilai->cpmk_4_nilai * $detail_nilai->cpmk_4_persentase / 100) +
													($detail_nilai->cpmk_5_nilai * $detail_nilai->cpmk_5_persentase / 100) +
													($detail_nilai->cpmk_6_nilai * $detail_nilai->cpmk_6_persentase / 100) +
													($detail_nilai->cpmk_7_nilai * $detail_nilai->cpmk_7_persentase / 100) +
													($detail_nilai->cpmk_8_nilai * $detail_nilai->cpmk_8_persentase / 100) +
													($detail_nilai->cpmk_9_nilai * $detail_nilai->cpmk_9_persentase / 100) +
													($detail_nilai->cpmk_10_nilai * $detail_nilai->cpmk_10_persentase / 100);

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
							<th><span class="label label-primary">Nilai berasal dari semester berjalan</span></th>
						</tr>
					</table>
					<hr>
					<table class="tabel-informasi" style="width: 100%">
						<tr>
							<th style="width: 12%">Rincian Akhir</th>
							<th style="width: 2%">:</th>
							<th><span>&nbsp;</span></th>
						</tr>
					</table>
					<div class="table-responsive">
					<table id="listPeserta" class="table table-bordered table-striped" style="width: 100%">
						<thead>
							<tr>
								<th nowrap class="text-center">
									<a href="#" data-toggle="tooltip" title="<?php echo $detail_nilai->cpmk_1_keterangan ?>">
										<?php echo $detail_nilai->cpmk_1_kode ?>
									</a>
									<br>
									[<?php echo $detail_nilai->cpmk_1_persentase ?> %] 
									<br>
									<b>Rentang: </b>1 - 100
								</th>
								<th nowrap class="text-center">
									<a href="#" data-toggle="tooltip" title="<?php echo $detail_nilai->cpmk_2_keterangan ?>">
										<?php echo $detail_nilai->cpmk_2_kode ?>
									</a>
									<br>
									[<?php echo $detail_nilai->cpmk_2_persentase ?> %] 
									<br>
									<b>Rentang: </b>1 - 100
								</th>
								<th nowrap class="text-center">
									<a href="#" data-toggle="tooltip" title="<?php echo $detail_nilai->cpmk_3_keterangan ?>">
										<?php echo $detail_nilai->cpmk_3_kode ?>
									</a>
									<br>
									[<?php echo $detail_nilai->cpmk_3_persentase ?> %] 
									<br>
									<b>Rentang: </b>1 - 100
								</th>
								<th nowrap class="text-center">
									<a href="#" data-toggle="tooltip" title="<?php echo $detail_nilai->cpmk_4_keterangan ?>">
										<?php echo $detail_nilai->cpmk_4_kode ?>
									</a>
									<br>
									[<?php echo $detail_nilai->cpmk_4_persentase ?> %] 
									<br>
									<b>Rentang: </b>1 - 100
								</th>
								<th nowrap class="text-center">
									<a href="#" data-toggle="tooltip" title="<?php echo $detail_nilai->cpmk_5_keterangan ?>">
										<?php echo $detail_nilai->cpmk_5_kode ?>
									</a>
									<br>
									[<?php echo $detail_nilai->cpmk_5_persentase ?> %] 
									<br>
									<b>Rentang: </b>1 - 100
								</th>
								<th nowrap class="text-center">
									<a href="#" data-toggle="tooltip" title="<?php echo $detail_nilai->cpmk_6_keterangan ?>">
										<?php echo $detail_nilai->cpmk_6_kode ?>
									</a>
									<br>
									[<?php echo $detail_nilai->cpmk_6_persentase ?> %] 
									<br>
									<b>Rentang: </b>1 - 100
								</th>
								<th nowrap class="text-center">
									<a href="#" data-toggle="tooltip" title="<?php echo $detail_nilai->cpmk_7_keterangan ?>">
										<?php echo $detail_nilai->cpmk_7_kode ?>
									</a>
									<br>
									[<?php echo $detail_nilai->cpmk_7_persentase ?> %] 
									<br>
									<b>Rentang: </b>1 - 100
								</th>
								<th nowrap class="text-center">
									<a href="#" data-toggle="tooltip" title="<?php echo $detail_nilai->cpmk_8_keterangan ?>">
										<?php echo $detail_nilai->cpmk_8_kode ?>
									</a>
									<br>
									[<?php echo $detail_nilai->cpmk_8_persentase ?> %] 
									<br>
									<b>Rentang: </b>1 - 100
								</th>
								<th nowrap class="text-center">
									<a href="#" data-toggle="tooltip" title="<?php echo $detail_nilai->cpmk_9_keterangan ?>">
										<?php echo $detail_nilai->cpmk_9_kode ?>
									</a>
									<br>
									[<?php echo $detail_nilai->cpmk_9_persentase ?> %] 
									<br>
									<b>Rentang: </b>1 - 100
								</th>
								<th nowrap class="text-center">
									<a href="#" data-toggle="tooltip" title="<?php echo $detail_nilai->cpmk_10_keterangan ?>">
										<?php echo $detail_nilai->cpmk_10_kode ?>
									</a>
									<br>
									[<?php echo $detail_nilai->cpmk_10_persentase ?> %] 
									<br>
									<b>Rentang: </b>1 - 100
								</th>
								<th nowrap class="text-center">
									Nilai Akhir
								</th>
								<th nowrap class="text-center">
									Harkat
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center"><?php echo (!is_null($detail_nilai->cpmk_1_nilai)) ? number_format($detail_nilai->cpmk_1_nilai,2,".",",") : '-' ; ?></td>
								<td class="text-center"><?php echo (!is_null($detail_nilai->cpmk_2_nilai)) ? number_format($detail_nilai->cpmk_2_nilai,2,".",",") : '-' ; ?></td>
								<td class="text-center"><?php echo (!is_null($detail_nilai->cpmk_3_nilai)) ? number_format($detail_nilai->cpmk_3_nilai,2,".",",") : '-' ; ?></td>
								<td class="text-center"><?php echo (!is_null($detail_nilai->cpmk_4_nilai)) ? number_format($detail_nilai->cpmk_4_nilai,2,".",",") : '-' ; ?></td>
								<td class="text-center"><?php echo (!is_null($detail_nilai->cpmk_5_nilai)) ? number_format($detail_nilai->cpmk_5_nilai,2,".",",") : '-' ; ?></td>
								<td class="text-center"><?php echo (!is_null($detail_nilai->cpmk_6_nilai)) ? number_format($detail_nilai->cpmk_6_nilai,2,".",",") : '-' ; ?></td>
								<td class="text-center"><?php echo (!is_null($detail_nilai->cpmk_7_nilai)) ? number_format($detail_nilai->cpmk_7_nilai,2,".",",") : '-' ; ?></td>
								<td class="text-center"><?php echo (!is_null($detail_nilai->cpmk_8_nilai)) ? number_format($detail_nilai->cpmk_8_nilai,2,".",",") : '-' ; ?></td>
								<td class="text-center"><?php echo (!is_null($detail_nilai->cpmk_9_nilai)) ? number_format($detail_nilai->cpmk_9_nilai,2,".",",") : '-' ; ?></td>
								<td class="text-center"><?php echo (!is_null($detail_nilai->cpmk_10_nilai)) ? number_format($detail_nilai->cpmk_10_nilai,2,".",",") : '-' ; ?></td>
								<td class="text-center"><?php echo (!is_null($nilai_akhir)) ? number_format($nilai_akhir,2,".",",") : '-' ; ?></td>
								<td class="text-center"><?php echo $nilai_harkat; ?></td>
							</tr>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>
