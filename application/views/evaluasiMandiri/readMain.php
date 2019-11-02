<section class="content">
	<div class="row">
		<!-- Breadcrumbs -->
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Laporan</li>
				<li class="active">Evaluasi Mandiri</li>
				<li class="active">List</li>
			</ol>
		</div>

		<!-- Data Mahasiswa -->
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border text-center">
					<h5>
						<b>Laporan Evaluasi Mandiri Pengukuran Capaian Pembelajaran</b>
					</h5>
					<h5>
						<b>Program Studi DIII Analisis Kimia</b>
					</h5>
					<h5>
						<b>Universitas Islam Indonesia</b>
					</h5>
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

		<!-- Export PDF -->
		<div class="col-md-12">
			<button id="exportButtonPDF" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export PDF</button>
			<br><br>
		</div>

		<!-- Tabel nilai CPL -->
		<?php
			for($i=0; $i<count($data_laporan); $i++) {
        $data_laporan_detail = $data_laporan[$i];
        $cpl_nama = (isset($data_laporan_detail[0]['nama_cpl'])) ? $data_laporan_detail[0]['nama_cpl'] : ' ';
        $cpl_deskripsi = (isset($data_laporan_detail[0]['deskripsi'])) ? $data_laporan_detail[0]['deskripsi'] : ' ';
				
				$cpl_nama_low = 'skor_maks_'.str_replace(' ','_',strtolower($cpl_nama));
				$skor_maks = (isset($data_skor_maks[$cpl_nama_low])) ? $data_skor_maks[$cpl_nama_low] : 0;
		?>
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body">
              <table class="tabel-informasi">
                <tr>
                  <th>Nama</th>
                  <th>:</th>
                  <th><span><?php echo $cpl_nama ?></span></th>
                </tr>
                <tr>
                  <th>Deskripsi</th>
                  <th>:</th>
                  <th><span><?php echo $cpl_deskripsi ?></span></th>
                </tr>
              </table>
              <table class="table table-striped table-bordered table-condensed display nowrap" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 5%">No</th>
                    <th class="text-center" style="width: 10%">Kode</th>
										<th style="width: 20%">Mata Kuliah</th>
										<th class="text-right" style="width: 5%">SKS</th>
										<th  style="width: 8%">Ket</th>
										<th class="text-right" style="width: 6%">Nilai<br>(Angka)</th>
										<th class="text-center" style="width: 6%">Nilai</th>
										<th class="text-right" style="width: 6%">Harkat</th>
										<th class="text-right" style="width: 8%">Kontribusi</th>
										<th class="text-right" style="width: 8%">Earned</th>
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
                      <td class="text-center"><?php echo $nomor ?></td>
                      <td class="text-center"><?php echo $data_laporan_detail[$j]['mk_kode'] ?></td>
											<td><?php echo $data_laporan_detail[$j]['mk_nama'] ?></td>
											<td class="text-right"><?php echo $data_laporan_detail[$j]['mk_sks'] ?></td>
											<td></td>
											<td class="text-right"><?php echo $data_laporan_detail[$j]['capaian_nilai_max'] ?></td>
											<td class="text-center"><?php echo $nilai; ?></td>
											<td class="text-right"><?php echo $harkat; ?></td>
											<td class="text-right"><?php echo $data_laporan_detail[$j]['cpld_kontribusi'] ?></td>
											<td class="text-right"><?php echo number_format($subtotal_harkat,2,".",","); ?></td>
                    </tr>
                  <?php
                    $nomor++;
                  }
                  ?>
                  <tr>
                    <td colspan="3"></td>
                    <td class="text-right"><?php echo number_format($total_sks,2,".",","); ?></td>
                    <td colspan="5" class="text-right"><b>Jumlah</b></td>
                    <td class="text-right"><?php echo number_format($total_harkat,2,".",","); ?></td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td class="text-right"></td>
                    <td colspan="5" class="text-right"><b>Skor Mahasiswa</b></td>
										<?php
											$skor_mahasiswa = ($total_sks!=0) ? round(($total_harkat/$total_sks), 2) : 0;
										?>
                    <td class="text-right"><?php echo number_format($skor_mahasiswa,2,".",","); ?></td>
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
          </div>
        </div>
    <?php
			}
		?>


	</div>
</section>
