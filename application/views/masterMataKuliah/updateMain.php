<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Mata Kuliah</li>
				<li class="active">Edit</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Mata Kuliah</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('MataKuliah/update') ?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" value="<?php echo $dataMataKuliah->id ?>" name="id" class="form-control" required>
								<div class="form-group">
									<label>Kode</label>
									<input type="text" value="<?php echo $dataMataKuliah->kode ?>" name="kode" class="form-control" placeholder="Kode mata kuliah" required>
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" value="<?php echo $dataMataKuliah->nama ?>" name="nama" class="form-control" placeholder="Nama mata kuliah" required>
								</div>
								<div class="form-group">
									<label>Semester</label>
									<input type="number" value="<?php echo $dataMataKuliah->semester ?>" name="semester" class="form-control" placeholder="Semester" required>
								</div>
								<div class="form-group">
									<label>Kontribusi</label>
									<input type="number" value="<?php echo $dataMataKuliah->kontribusi ?>" name="kontribusi" class="form-control" placeholder="Kontribusi" required>
								</div>
								<div class="form-group">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('MataKuliah') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
