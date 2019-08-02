<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">User Management</li>
				<li class="active">User</li>
				<li class="active">Edit</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Input User</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('UserManagement/update') ?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
							<input type="hidden" name="id" value="<?php echo $dataUser->id ?>" class="form-control" placeholder="Nama lengkap pengguna" required>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" value="<?php echo $dataUser->nama ?>" class="form-control" placeholder="Nama lengkap pengguna" required>
								</div>
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" value="<?php echo $dataUser->username ?>" class="form-control" placeholder="Username" required>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" value="<?php echo $dataUser->password ?>" class="form-control" placeholder="Password" required>
								</div>
								<div class="form-group">
									<label>Role</label>
									<select class="selectUserRole form-control" style="width: 100%;" name="id_role" required>
										<option></option>
										<?php
										foreach($dataUserRole as $key => $value) {
										?>
												<option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('UserManagement') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
