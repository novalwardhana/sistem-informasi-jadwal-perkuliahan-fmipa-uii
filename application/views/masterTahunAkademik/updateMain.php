<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Tahun Akademik</li>
				<li class="active">Edit</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Tahun Akademik</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('tahun-akademik/update') ?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">

								<input type="hidden" value="<?php echo $dataTahunAkademik->id ?>" name="id" class="form-control" placeholder="ID" required>

								<div class="form-group">
									<label>Tahun Mulai</label>
									<input type="number" value="<?php echo $dataTahunAkademik->tahun_mulai ?>" min="0" name="tahun_mulai" class="form-control" placeholder="Tahun mulai" required>
								</div>

								<div class="form-group">
									<label>Tahun Selesai</label>
									<input type="number" value="<?php echo $dataTahunAkademik->tahun_selesai ?>" min="0" name="tahun_selesai" class="form-control" placeholder="Tahun selesai" required>
								</div>

								<div class="form-group">
									<label>Semester</label>
									<div class="form-group">
										<label>
											<input type="radio" <?php echo ($dataTahunAkademik->semester=='ganjil')?'checked':'' ?> value="ganjil" name="semester" class="minimal" required>
											Ganjil
										</label>
										&nbsp;&nbsp;
										<label>
											<input type="radio" <?php echo ($dataTahunAkademik->semester=='genap')?'checked':'' ?> value="genap" name="semester" class="minimal" required>
											Genap
										</label>
									</div>
								</div>

								<div class="form-group">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('tahun-akademik') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>