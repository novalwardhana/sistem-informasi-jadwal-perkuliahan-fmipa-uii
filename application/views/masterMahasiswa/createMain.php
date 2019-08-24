<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Mahasiswa</li>
				<li class="active">Add</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Input data mahasiswa</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('Mahasiswa/create') ?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
									<div class="form-group">
											<label>Nama *</label>
											<input type="text" name="nama" class="form-control" placeholder="Nama lengkap mahasiswa" required>
										</div>
										<div class="form-group">
											<label>NIM *</label>
											<input type="text" name="nim" class="form-control" placeholder="Nomor induk mahasiswa" required>
										</div>
										<div class="form-group">
											<label>Password *</label>
											<input type="password" name="password" class="form-control" placeholder="Password akun untuk mahasiswa" required>
										</div>
										<div class="form-group">
											<label>Semester *</label>
											<input type="number" name="semester" class="form-control" placeholder="Semester saat ini" required>
										</div>
										<div class="form-group">
											<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
											<a href="<?php echo base_url('mahasiswa') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
										</div>
								</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
