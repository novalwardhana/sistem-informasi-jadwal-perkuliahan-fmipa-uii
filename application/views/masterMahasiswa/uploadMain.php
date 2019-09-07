<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Mahasiswa</li>
				<li class="active">Upload</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Upload data mahasiswa</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('mahasiswa/upload-process') ?>" enctype="multipart/form-data">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
									<div class="form-group">
											<label>File *</label>
											<input type="file" name="file" required>
										</div>
										<div class="form-group">
											<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
											<a href="<?php echo base_url('mahasiswa') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
											<a href="<?php echo base_url('assets/template/template_upload_mahasiswa.xlsx') ?>"><button type="button" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i> Template</button></a>
										</div>
								</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

