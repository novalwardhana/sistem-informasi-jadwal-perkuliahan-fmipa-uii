<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">User Management</li>
				<li class="active">Role</li>
				<li class="active">Edit</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Role</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('UserRole/update') ?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
							<input type="hidden" name="id" value="<?php echo $dataRole->id; ?>" class="form-control" placeholder="Role user" required>
								<div class="form-group">
									<label>Nama *</label>
									<input type="text" name="nama" value="<?php echo $dataRole->nama; ?>" class="form-control" placeholder="Role user" required>
								</div>
								<div class="form-group">
									<label>Permission</label>
									<div class="row">
										<?php
											foreach($checkboxPermission AS $value) {
										?>
											<div class="col-md-12">
												<label>
													<input type="checkbox" id="<?php echo $value['module']; ?>" name="role_has_permission[]" value="<?php echo $value['id']; ?>">
													<?php
														echo $value['nama']." (".$value['module'].")";
													?>
												</label>
											</div>
										<?php
											}
										?>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('user-role') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
