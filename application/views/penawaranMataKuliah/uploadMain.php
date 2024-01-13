<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Penawaran Mata Kuliah</li>
				<li class="active">Upload</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Upload Penawaran Mata Kuliah</h3>
				</div>
				<form role="form" name="formData" id="uploadForm" enctype="multipart/form-data">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
                                <input type="hidden" name="id_periode" value="<?php echo $id_periode?>" class="form-control" placeholder="Periode" readonly>
                                <div class="form-group">
									<label>Periode *</label>
                                    <input type="text" name="tahun_akademik" value="<?php echo $periode->tahun_akademik ?>" class="form-control" placeholder="Tahun akademik" readonly>
                                </div>
                                <div class="form-group">
									<label>Semester *</label>
                                    <input type="text" name="semester" value="<?php echo $periode->semester ?>" class="form-control" placeholder="Semester" readonly>
                                </div>
                                <div class="form-group">
									<label>File *</label>
									<input type="file" name="file" accept=".xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
								</div>
                                <div class="form-group">
                                    <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
                                    <a href="<?php echo base_url('penawaran-mata-kuliah') ?>"><button type="button" class="btn btn-default"><i class="fa fa-reply" aria-hidden="true"></i> Kembali</button></a>
                                </div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
