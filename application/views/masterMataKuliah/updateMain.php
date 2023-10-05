<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Master Mata Kuliah</li>
				<li class="active">Edit</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Mata Kuliah</h3>
				</div>
				<form role="form" name="formData">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								
                                <input type="hidden" value="<?php echo $dataMataKuliah->id ?>" name="id" class="form-control" required>
                                <div class="form-group">
									<label>Program Studi *</label>
									<select class="selectProgramStudi form-control" value="<?php echo $dataMataKuliah->id_prodi ?>" style="width: 100%;" name="id_prodi" required>
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
									<label>Kode *</label>
                                    <input type="text" name="kode" value="<?php echo $dataMataKuliah->kode ?>" class="form-control" placeholder="Kode mata kuliah" required>
                                </div>

                                <div class="form-group">
									<label>Nama *</label>
                                    <input type="text" name="nama" value="<?php echo $dataMataKuliah->nama ?>" class="form-control" placeholder="Nama mata kuliah" required>
                                </div>

                                <div class="form-group">
									<label>Semester *</label>
									<select class="selectSemester form-control" style="width: 100%;" name="semester" value="<?php echo $dataMataKuliah->semester ?>" required>
										<option></option>
										<?php
										foreach($listSemester as $key => $value) {
										?>
											<option value="<?php echo $value ?>"><?php echo $value ?></option>
										<?php
										}
										?>
									</select>
								</div>

                                <div class="form-group">
									<label>Kontribusi SKS *</label>
                                    <input type="number" min=0 name="kontribusi_sks" value="<?php echo $dataMataKuliah->kontribusi_sks ?>" class="form-control" placeholder="Kontribusi SKS" required>
                                </div>

								<div class="form-group">
									<button type="submit" id="simpanData" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('master-mata-kuliah') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
