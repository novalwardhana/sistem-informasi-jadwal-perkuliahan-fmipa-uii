<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Jadwal Perkuliahan</li>
				<li class="active">Jadwal</li>
				<li class="active">Add</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Input Jadwal Perkuliahan</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('jadwal-perkuliahan/create') ?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">

                                <div class="form-group">
									<label>Ruang *</label>
									<select class="selectRuang form-control" style="width: 100%;" name="id_ruang" required>
										<option></option>
										<?php
										foreach($listRuang as $key => $value) {
										?>
											<option value="<?php echo $value['id'] ?>"><?php echo $value['kode'] ?></option>
										<?php
										}
										?>
									</select>
								</div>

                                <div class="form-group">
									<label>Mata Kuliah *</label>
									<select class="selectMataKuliah form-control" style="width: 100%;" name="id_mata_kuliah" required>
										<option></option>
										<?php
										foreach($listMataKuliah as $key => $value) {
										?>
											<option value="<?php echo $value['id'] ?>"><?php echo $value['label'] ?></option>
										<?php
										}
										?>
									</select>
								</div>

                                <div class="form-group">
									<label>Dosen *</label>
									<select class="selectDosen form-control" style="width: 100%;" name="id_dosen" required>
										<option></option>
										<?php
										foreach($listDosen as $key => $value) {
										?>
											<option value="<?php echo $value['id'] ?>"><?php echo $value['label'] ?></option>
										<?php
										}
										?>
									</select>
								</div>

                                <div class="form-group">
									<label>Kelas *</label>
									<select class="selectKelas form-control" style="width: 100%;" name="id_kelas" required>
										<option></option>
										<?php
										foreach($listKelas as $key => $value) {
										?>
											<option value="<?php echo $value['id'] ?>"><?php echo $value['kode'] ?></option>
										<?php
										}
										?>
									</select>
								</div>

                                <div class="form-group">
									<label>Angkatan *</label>
									<input type="number" min="0" max="14" name="angkatan" class="form-control" placeholder="Angkatan" required>
								</div>

                                <div class="form-group">
									<label>Jadwal *</label>
                                    <input type="text" class="form-control pull-right" id="selectJadwal" required>
								</div><br><br>

                                <div class="form-group">
                                    <label>Kode Warna *</label>
                                </div>

								<div class="form-group">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('jadwal-perkuliahan') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
