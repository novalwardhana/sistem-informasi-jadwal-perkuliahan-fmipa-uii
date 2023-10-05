<section class="content">
	<div class="row">

		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Penawaran Mata Kuliah</li>
				<li class="active">List</li>
			</ol>
		</div>

		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Filter Penawaran Mata Kuliah</h3>
				</div>
				<form role="form" name="formData">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								
                                <div class="form-group">
									<label>Periode *</label>
									<select class="selectPeriode form-control" style="width: 100%;" name="id_periode" required>
										<option></option>
										<?php
										foreach($listPeriode as $key => $value) {
										?>
											<option value="<?php echo $value->id ?>"><?php echo $value->periode ?></option>
										<?php
										}
										?>
									</select>
								</div>

								<div class="form-group">
									<button type="submit" id="cariData" name="cari" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
									<a href="<?php echo base_url('penawaran-mata-kuliah') ?>"><button type="button" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="col-md-12 formPenawaranMataKuliah" style="display: none;">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Input Detail Penawaran Mata Kuliah</h3>
				</div>
				<form role="form" name="formDataPenawaranMataKuliah">
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Periode *</label>
								<select class="selectPeriode2 form-control" style="width: 100%;" name="id_periode" required>
									<option></option>
									<?php
									foreach($listPeriode as $key => $value) {
									?>
										<option value="<?php echo $value->id ?>"><?php echo $value->periode ?></option>
									<?php
									}
									?>
								</select>
							</div>	

							<div class="form-group">
								<label>Program Studi *</label>
								<select class="selectProdi form-control" style="width: 100%;" name="id_prodi" required>
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
								<button type="submit" id="addPenawaranMataKuliah" name="addPenawaranMataKuliah" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>

        <div class="col-md-12 listPenawaranMataKuliah" style="display: none;">
            <div class="box box-primary">
                <div class="box-body">
					<button type="button" class="btn btn-sm btn-success" data-toggle='modal' data-target='#add-penawaran-mata-kuliah'><i class='fa fa-plus'></i>Tambah Penawaran Mata Kuliah</button>
					<br><br>
                    <table id="listDataTable" class="table table-bordered table-striped" style="width: 100%">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Aksi</th>
								<th>Periode</th>
                                <th>Semester</th>
                                <th>Kode Program Studi</th>
								<th>Program Studi</th>
							</tr>
						</thead>
					</table>
                </div>
            </div>
        </div>
	</div>
</section>
