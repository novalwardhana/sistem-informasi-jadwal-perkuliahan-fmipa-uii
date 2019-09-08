<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Agenda Perkuliahan</li>
				<li class="active">Jadwal Perkuliahan</li>
				<li class="active">Upload Nilai</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Upload Nilai Mahasiswa</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('jadwal-perkuliahan/upload-nilai-process') ?>" enctype="multipart/form-data">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama Dosen</label>
                  <input type="hidden" value="<?php echo $dataPengampu->id_dosen_pengampu_mata_kuliah ?>" name="id_dosen_pengampu_mata_kuliah" class="form-control" placeholder="Dosen pengampu mata kuliah" readonly>
									<input type="text" value="<?php echo $dataPengampu->dosen ?>" class="form-control" placeholder="Nama lengkap Dosen" readonly>
								</div>
								<div class="form-group">
									<label>NIK</label>
									<input type="text" value="<?php echo $dataPengampu->nik ?>" class="form-control" placeholder="Nama lengkap Dosen" readonly>
								</div>
								<div class="form-group">
									<label>Mata Kuliah</label>
									<input type="text" value="<?php echo $dataPengampu->mata_kuliah ?>" class="form-control" placeholder="Nama lengkap Dosen" readonly>
								</div>
								<div class="form-group">
									<label>Kelas</label>
									<input type="text" value="<?php echo $dataPengampu->kelas ?>" class="form-control" placeholder="Nama lengkap Dosen" readonly>
								</div>
								<div class="form-group">
									<label>File *</label>
									<input type="file" name="file" required>
								</div>
									<div class="form-group">
										<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
										<a href="<?php echo base_url('jadwal-perkuliahan/detail?id=').$dataPengampu->id_dosen_pengampu_mata_kuliah ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
										<a href="<?php echo base_url('assets/template/template_upload_nilai.xlsx') ?>"><button type="button" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i> Template</button></a>
									</div>
								</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

