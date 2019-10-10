<section class="content">
	<div class="row">

		<!-- Breadcrumbs -->
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Laporan</li>
				<li class="active">Hasil Evaluasi Mandiri</li>
				<li class="active">List</li>
			</ol>
		</div>

		<!-- Data Mahasiswa -->
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border text-center">
					<h3 class="box-title"">
						<b>Hasil Capaian Pembelajaran</b>
					</h3>
					<br>
					<h3 class="box-title">
						<b>Program Studi DIII Analisis Kimia – FMIPA UII</b>
					</h3>
				</div>
				<div class="box-body">
					<table class="tabel-informasi">
						<tr>
							<th>Nama</th>
							<th>:</th>
							<th><span><?php echo $data_mahasiswa->nama ?></span></th>
						</tr>
						<tr>
							<th>NIM</th>
							<th>:</th>
							<th><span><?php echo $data_mahasiswa->nim ?></span></th>
						</tr>
						<tr>
							<th>Semester</th>
							<th>:</th>
							<th><span><?php echo $data_mahasiswa->semester ?></span></th>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<!-- Tabel nilai CPL -->
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body">
					<table class="table table-striped table-bordered table-condensed display nowrap" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th width="50%">Kompetensi</th>
								<th class="text-center">Skor<br>Mahasiswa</th>
								<th class="text-center">Skor<br>Maksimum</th>
								<th class="text-center">Capaian<br>Kompetensi</th>
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
									<td class="text-center"><?php echo $skor_mahasiswa; ?></td>
									<td class="text-center"><?php echo $skor_maks; ?></td>
									<td class="text-center"><?php echo $capaian; ?></td>
									<td class="text-center"><b><?php echo $capaian_keterangan; ?></b></td>
								</tr>
						<?php
								$nomor++;
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</section>
