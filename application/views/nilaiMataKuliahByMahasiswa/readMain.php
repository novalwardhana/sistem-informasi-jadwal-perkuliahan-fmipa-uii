<section class="content">
	<div class="row">
		<!-- Breadcrumbs -->
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Laporan</li>
				<li class="active">Nilai Mahasiswa</li>
				<li class="active">List</li>
			</ol>
		</div>

		<!-- Tabel -->
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body">
					<table class="tabel-informasi">
						<tr>
							<th>Nama</th>
							<th>:</th>
							<th><span id="tabel-informasi-nama-mahasiswa"><?php echo $data_mahasiswa->nama ?></span></th>
						</tr>
						<tr>
							<th>NIM</th>
							<th>:</th>
							<th><span id="tabel-informasi-nim-mahasiswa"><?php echo $data_mahasiswa->nim ?></span></th>
						</tr>
						<tr>
							<th>Semester</th>
							<th>:</th>
							<th><span id="tabel-informasi-semester-mahasiswa"><?php echo $data_mahasiswa->semester ?></span></th>
						</tr>
						<tr>
							<th rowspan="3">
								<button id="exportButtonPDF" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export</button>
								<button id="exportButtonExcel" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</button>
							</th>
						</tr>
					</table>

					<div class="table-responsive">
						<table id="listNilaiMahasiswa" class="table table-bordered table-striped" style="width: 100%">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Semester</th>
									<th>Kode</th>
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
