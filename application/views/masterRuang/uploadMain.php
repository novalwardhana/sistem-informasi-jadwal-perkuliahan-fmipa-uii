<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Master Ruang</li>
				<li class="active">Upload</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Upload Ruang</h3>
				</div>
				<form role="form" name="formData" id="uploadForm" enctype="multipart/form-data">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
                                <div class="form-group">
									<label>File *</label>
									<input type="file" name="file" accept=".xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
								</div>
                                <div class="form-group">
                                    <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
                                    <a href="<?php echo base_url('master-ruang') ?>"><button type="button" class="btn btn-default"><i class="fa fa-reply" aria-hidden="true"></i> Kembali</button></a>
                                </div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
