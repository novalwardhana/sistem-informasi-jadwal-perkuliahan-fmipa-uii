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
									<label>Semester *</label>
									<input type="number" min="0" max="8" value="<?php echo $dataSkorMaks->semester ?>" name="semester" class="form-control" placeholder="Semester" required>
								</div>

								<div class="form-group">
									<label>CPL 1 *</label>
									<input type="number" min="0" max="100" value="<?php echo $dataSkorMaks->skor_maks_cpl_1 ?>" step="0.01" name="skor_maks_cpl_1" class="form-control" placeholder="Skor maksimum CPL 1" required>
								</div>

								<div class="form-group">
									<label>CPL 2 *</label>
									<input type="number" min="0" max="100" value="<?php echo $dataSkorMaks->skor_maks_cpl_2 ?>" step="0.01" name="skor_maks_cpl_2" class="form-control" placeholder="Skor maksimum CPL 2" required>
								</div>

								<div class="form-group">
									<label>CPL 3 *</label>
									<input type="number" min="0" max="100" value="<?php echo $dataSkorMaks->skor_maks_cpl_3 ?>" step="0.01" name="skor_maks_cpl_3" class="form-control" placeholder="Skor maksimum CPL 3" required>
								</div>

								<div class="form-group">
									<label>CPL 4 *</label>
									<input type="number" min="0" max="100" value="<?php echo $dataSkorMaks->skor_maks_cpl_4 ?>" step="0.01" name="skor_maks_cpl_4" class="form-control" placeholder="Skor maksimum CPL 4" required>
								</div>

								<div class="form-group">
									<label>CPL 5 *</label>
									<input type="number" min="0" max="100" value="<?php echo $dataSkorMaks->skor_maks_cpl_5 ?>" step="0.01" name="skor_maks_cpl_5" class="form-control" placeholder="Skor maksimum CPL 5" required>
								</div>

								<div class="form-group">
									<label>CPL 6 *</label>
									<input type="number" min="0" max="100" value="<?php echo $dataSkorMaks->skor_maks_cpl_6 ?>" step="0.01" name="skor_maks_cpl_6" class="form-control" placeholder="Skor maksimum CPL 6" required>
								</div>

								<div class="form-group">
									<label>CPL 7 *</label>
									<input type="number" min="0" max="100" value="<?php echo $dataSkorMaks->skor_maks_cpl_7 ?>" step="0.01" name="skor_maks_cpl_7" class="form-control" placeholder="Skor maksimum CPL 7" required>
								</div>

								<div class="form-group">
									<label>CPL 8 *</label>
									<input type="number" min="0" max="100" value="<?php echo $dataSkorMaks->skor_maks_cpl_8 ?>" step="0.01" name="skor_maks_cpl_8" class="form-control" placeholder="Skor maksimum CPL 8" required>
								</div>

								<div class="form-group">
									<label>CPL 9 *</label>
									<input type="number" min="0" max="100" value="<?php echo $dataSkorMaks->skor_maks_cpl_9 ?>" step="0.01" name="skor_maks_cpl_9" class="form-control" placeholder="Skor maksimum CPL 9" required>
								</div>


								<div class="form-group">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('skor-maks') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
