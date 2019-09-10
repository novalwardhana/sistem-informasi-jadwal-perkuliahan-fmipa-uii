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
				<div class="box-header with-border">
					<h3 class="box-title">Data Mahasiswa</h3>
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
		<?php
			for($i=0; $i<count($data_laporan); $i++) {
        $data_laporan_detail = $data_laporan[$i];
        $cpl_nama = (isset($data_laporan_detail[0]['nama_cpl'])) ? $data_laporan_detail[0]['nama_cpl'] : ' ';
        $cpl_deskripsi = (isset($data_laporan_detail[0]['deskripsi'])) ? $data_laporan_detail[0]['deskripsi'] : ' ';
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
                    <th>No</th>
                    <th>Kode</th>
										<th>Mata Kuliah</th>
										<th class="text-right">SKS</th>
										<th>Keterangan</th>
										<th class="text-right">Nilai (Angka)</th>
										<th class="text-center">Nilai</th>
										<th class="text-right">Harkat</th>
										<th class="text-right">Kontribusi</th>
										<th class="text-right">Earned</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $nomor = 1;
                  for($j=0; $j<count($data_laporan_detail); $j++) {
										 //print_r($data_laporan_detail[$j]);
										
										$nilai='';
										$harkat=0;
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
                  ?>
                    <tr>
                      <td><?php echo $nomor ?></td>
                      <td><?php echo $data_laporan_detail[$j]['mk_kode'] ?></td>
											<td><?php echo $data_laporan_detail[$j]['mk_nama'] ?></td>
											<td class="text-right"><?php echo $data_laporan_detail[$j]['mk_sks'] ?></td>
											<td></td>
											<td class="text-right"><?php echo $data_laporan_detail[$j]['capaian_nilai_max'] ?></td>
											<td class="text-center"><?php echo $nilai; ?></td>
											<td class="text-right"><?php echo $harkat; ?></td>
											<td class="text-right"><?php echo $data_laporan_detail[$j]['cpld_kontribusi'] ?></td>
											<td class="text-right"><?php echo $harkat*$data_laporan_detail[$j]['cpld_kontribusi'] ?></td>
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
    <?php
			}
		?>


	</div>
</section>
