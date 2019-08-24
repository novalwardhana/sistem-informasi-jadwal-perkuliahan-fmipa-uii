<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Klasifikasi</li>
				<li class="active">Edit</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Klasifikasi</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('Klasifikasi/update') ?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" value="<?php echo $dataKlasifikasi->id ?>" name="id" class="form-control" required>
								<div class="form-group">
									<label>Batas Bawah *</label>
									<input type="number" value="<?php echo $dataKlasifikasi->batas_bawah ?>" name="batas_bawah" step="0.01" class="form-control" placeholder="Batas bawah rentang nilai" required>
								</div>
								<div class="form-group">
									<label>Batas Atas *</label>
									<input type="number" value="<?php echo $dataKlasifikasi->batas_atas ?>" name="batas_atas" step="0.01" class="form-control" placeholder="Batas atas rentang nilai" required>
								</div>
								<div class="form-group">
									<label>Keterangan *</label>
									<input type="text" value="<?php echo $dataKlasifikasi->keterangan ?>" name="keterangan" class="form-control" placeholder="Keterangan nilai" required>
								</div>
								<div class="form-group">
									<label>Predikat *</label>
									<input type="text" value="<?php echo $dataKlasifikasi->predikat ?>" name="predikat" step="0.01" class="form-control" placeholder="Predikat nilai" required>
								</div>
								<div class="form-group">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('klasifikasi') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
