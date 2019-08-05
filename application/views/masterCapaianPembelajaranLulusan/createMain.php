<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Capaian Pembelajaran Lulusan</li>
				<li class="active">Add</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Input CapaianPembelajaran Lulusan</h3>
				</div>
					<div class="box-body">

						<!-- Form header -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" placeholder="Nama CPL">
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi capaian pembelajaran lulusan"></textarea>
								</div>
							</div>
						</div>

						<!-- Form Detail -->
						<br>
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-success" onclick="addMataKuliah()"><i class="fa fa-plus"></i> Mata Kuliah</button>
								<div class="table-responsive">
									<table id="listMataKuliah" class="table table-bordered table-striped" style="width: 100%">
										<thead>
											<tr>
												<th>Nomor</th>
												<th>Aksi</th>
												<th>Kode</th>
												<th>Mata Kuliah</th>
												<th>SKS</th>
												<th>Kontribusi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<center>
									<button class="btn btn-success" onclick="save()"><i class="fa fa-floppy-o"></i> Simpan</button>
									<a href="<?php echo base_url('Dosen') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</center>
								
							</div>
						</div>

					</div>
			</div>
		</div>
	</div>

	<?php
		$this->load->view('masterCapaianPembelajaranLulusan/createMainModal');
	?>
</section>

