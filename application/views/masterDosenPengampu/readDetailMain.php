<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Agenda Perkuliahan</li>
				<li class="active">Pengampu Mata Kuliah</li>
				<li class="active">Detail</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">
					Detail Informasi Pengampu Mata Kuliah
					<br><br>
					<a href="<?php echo base_url('DosenPengampu') ?>"><button class="btn btn-sm btn-success"><i class="fa fa-reply"></i> Kembali</button></a>
					</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" value="<?php echo $dataDosen->id ?>" name="id" class="form-control" required>
							<div class="form-group">
								<label>NIK</label>
								<input type="number" value="<?php echo $dataDosen->nik ?>" name="nik" class="form-control" placeholder="Nomor induk pegawai" readonly>
							</div>
							<div class="form-group">
								<label>Nama</label>
								<input type="text" value="<?php echo $dataDosen->nama ?>" name="nama" class="form-control" placeholder="Nama lengkap Dosen" readonly>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-success" data-toggle="modal" data-target="#modalCreate"><i class="fa fa-plus"></i> Mata Kuliah yang Diampu</button>
							<br><br>
								<table id="listDosen" class="table table-bordered table-striped" style="width: 100%">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">Aksi</th>
											<th>Kode Mata Kuliah</th>
											<th>Mata Kuliah</th>
											<th>Kelas</th>
											<th>Jam Mulai</th>
											<th>Jam Selesai</th>
											<th>Ruang</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		$this->load->view('masterDosenPengampu/modalCreate');
		$this->load->view('masterDosenPengampu/modalUpdate');
	?>
</section>
