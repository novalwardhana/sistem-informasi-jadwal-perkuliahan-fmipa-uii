
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Master Ruang</li>
				<li class="active">Edit</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Ruang</h3>
				</div>
				<form role="form" name="formData">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								
                                <input type="hidden" value="<?php echo $dataRuang->id ?>" name="id" class="form-control" required>
                                <div class="form-group">
									<label>Kode *</label>
									<input type="text" name="kode" value="<?php echo $dataRuang->kode; ?>" class="form-control" placeholder="Nama ruang" required>
								</div>

                                <div class="form-group">
									<label>Nama *</label>
									<input type="text" name="nama" value="<?php echo $dataRuang->nama; ?>" class="form-control" placeholder="Nama ruang" required>
								</div>

                                <div class="form-group">
									<label>Kapasitas *</label>
									<input type="number" min=0 name="kapasitas" value="<?php echo $dataRuang->kapasitas; ?>" class="form-control" placeholder="Nama ruang" required>
								</div>

								<div class="form-group">
									<button type="submit" id="simpanData" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
									<a href="<?php echo base_url('master-ruang') ?>"><button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>