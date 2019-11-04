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
						<b>Laporan Nilai Mata Kuliah Mahasiswa</b>
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
			<button id="exportButtonExcel" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</button>
			<br><br>
		</div>

		<!-- Tabel -->
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body">
					<div class="table-responsive">
						<table id="listNilaiMahasiswa" class="table table-bordered table-striped" style="width: 100%">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Aksi</th>
									<th class="text-center">Semester</th>
									<th class="text-center">Kode</th>
									<th>Mata Kuliah</th>
									<th>Nilai</th>
									<th>Huruf</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>
