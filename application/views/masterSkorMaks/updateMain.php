<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Skor Maksimal per Semester</li>
				<li class="active">Edit</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Skor Maks per Semester</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('SkorMaks/update') ?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" value="<?php echo $dataSkorMaks->id ?>" name="id" class="form-control" required>
								<div class="form-group">
									<label>Semester</label>
									<input type="number" value="<?php echo $dataSkorMaks->semester ?>" name="semester" class="form-control" placeholder="Semester" required>
								</div>
								<div class="form-group">
									<label>CPL</label>
									<input type="number" value="<?php echo $dataSkorMaks->cpl ?>" name="cpl" class="form-control" placeholder="Capaian Pembelajaran Per Semester" required>
								</div>
								<div class="form-group">
									<label>Skor Maksimum</label>
									<input type="number" value="<?php echo $dataSkorMaks->skor_maks ?>" step="0.01" name="skor_maks" class="form-control" placeholder="Skor Maksimum" required>
								</div>
								<div class="form-group">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('SkorMaks') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
