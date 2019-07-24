<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Dosen</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('Dosen/update') ?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" value="<?php echo $dataDosen->id ?>" name="id" class="form-control" required>
								<div class="form-group">
									<label>NIK</label>
									<input type="number" value="<?php echo $dataDosen->nik ?>" name="nik" class="form-control" placeholder="Nomor induk pegawai" required>
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" value="<?php echo $dataDosen->nama ?>" name="nama" class="form-control" placeholder="Nama lengkap Dosen" required>
								</div>
								<div class="form-group">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('Dosen') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
