<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Harkat</h3>
				</div>
				<form role="form" method="post" action="<?php echo base_url('Harkat/update') ?>">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" value="<?php echo $dataHarkat->id ?>" name="id" class="form-control" required>
								<div class="form-group">
									<label>Harkat</label>
									<input type="number" step="0.01" value="<?php echo $dataHarkat->harkat ?>" name="harkat"  class="form-control" placeholder="Harkat" required>
								</div>
								<div class="form-group">
									<label>Batas Bawah</label>
									<input type="number" value="<?php echo $dataHarkat->batas_bawah ?>" name="batas_bawah" step="0.01" class="form-control" placeholder="Batas bawah rentang nilai" required>
								</div>
								<div class="form-group">
									<label>Batas Atas</label>
									<input type="number" value="<?php echo $dataHarkat->batas_atas ?>" name="batas_atas" step="0.01" class="form-control" placeholder="Batas atas rentang nilai" required>
								</div>
								<div class="form-group">
									<label>Keterangan</label>
									<input type="text" value="<?php echo $dataHarkat->huruf ?>" name="huruf" class="form-control" placeholder="Keterangan" required>
								</div>
								<div class="form-group">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('Harkat') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>