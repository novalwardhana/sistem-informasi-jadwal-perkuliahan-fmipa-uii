<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Master Dosen</li>
				<li class="active">Add</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Input Dosen</h3>
				</div>
				<form role="form" name="formData">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								
                                <div class="form-group">
									<label>Program Studi *</label>
									<select class="selectProgramStudi form-control" style="width: 100%;" name="id_prodi" required>
										<option></option>
										<?php
										foreach($listProdi as $key => $value) {
										?>
											<option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
										<?php
										}
										?>
									</select>
								</div>

                                <div class="form-group">
									<label>NIK *</label>
                                    <input type="text" name="nik" class="form-control" placeholder="NIK dosen" required>
                                </div>

                                <div class="form-group">
									<label>Nama *</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama dosen" required>
                                </div>

								<div class="form-group">
									<button type="submit" id="simpanData" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('master-dosen') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
