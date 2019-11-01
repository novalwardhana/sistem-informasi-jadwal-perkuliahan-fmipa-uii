<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">User Management</li>
				<li class="active">Pengaturan Sistem</li>
				<li class="active">Update</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Pengaturan Sistem</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('pengaturan-sistem/update') ?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">

								<div class="form-group">
									<label>Role *</label>
									<input type="text" value="<?php echo $data_pengaturan->role  ?>" name="role" class="form-control" placeholder="Role" required readonly>
								</div>

								<div class="form-group">
									<label>Nama Kaprodi *</label>
									<input type="text" value="<?php echo $data_pengaturan->nama_kaprodi  ?>" name="nama_kaprodi" class="form-control" placeholder="Nama kaprodi" required>
								</div>

								<div class="form-group">
									<label>NIK Kaprodi *</label>
									<input type="text" value="<?php echo $data_pengaturan->nik_kaprodi  ?>" name="nik_kaprodi" class="form-control" placeholder="NIK kaprodi" required>
								</div>

								<div class="form-group">
									<label>Nama Pembimbing Akademik *</label>
									<input type="text" value="<?php echo $data_pengaturan->nama_pembimbing_akademik  ?>" name="nama_pembimbing_akademik" class="form-control" placeholder="Nama pembimbing akademik" required>
								</div>

								<div class="form-group">
									<label>NIK Pembimbing Akademik *</label>
									<input type="text" value="<?php echo $data_pengaturan->nik_pembimbing_akademik  ?>" name="nik_pembimbing_akademik" class="form-control" placeholder="NIK pembimbing akademik" required>
								</div>

								<div class="form-group">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

