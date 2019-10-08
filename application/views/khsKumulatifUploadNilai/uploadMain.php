<section class="content">
	<div class="row">
		<!-- Breadcrumbs -->
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">KHS Kumulatif</li>
				<li class="active">Upload Nilai</li>
				<li class="active">Upload</li>
			</ol>
		</div>

		<!-- Form pencarian -->
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Upload Nilai KHS Mahasiswa</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('khs-kumulatif-upload-nilai/process') ?>" enctype="multipart/form-data">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Mahasiswa *</label>
									<select class="mahasiswaselect form-control" name="id_mahasiswa" style="width: 100%;" required></select>
								</div>
								<div class="form-group">
									<label>File *</label>
									<input type="file" name="file" required>
								</div>
								<div class="form-group">
									<button type="submit" id="proses" class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
									<a href="<?php echo base_url('khs-kumulatif') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
									<a href="<?php echo base_url('assets/template/template_upload_khs_mahasiswa.xlsx') ?>"><button type="button" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i> Template</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>


	</div>
</section>
