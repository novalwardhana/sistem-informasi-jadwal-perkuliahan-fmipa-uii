<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Master Periode</li>
				<li class="active">Add</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Input Periode</h3>
				</div>
				<form role="form" name="formData">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								
                                <div class="form-group">
									<label>Tahun Akademik *</label>
									<select class="selectTahunAkademik form-control" style="width: 100%;" name="tahun_akademik" required>
										<option></option>
										<?php
										foreach($listTahunAkademik as $key => $value) {
										?>
											<option value="<?php echo $value ?>"><?php echo $value ?></option>
										<?php
										}
										?>
									</select>
								</div>

                                <div class="form-group">
									<label>Semester *</label>
									<select class="selectSemester form-control" style="width: 100%;" name="semester" required>
										<option></option>
										<?php
										foreach($listSemester as $key => $value) {
										?>
											<option value="<?php echo $value["kode"] ?>"><?php echo $value["label"] ?></option>
										<?php
										}
										?>
									</select>
								</div>

								<div class="form-group">
									<button type="submit" id="simpanData" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('master-periode') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
