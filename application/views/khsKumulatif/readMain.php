<section class="content">
	<div class="row">

		<!-- Breadcrumbs -->
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">KHS Kumulatif</li>
				<li class="active">KHS Kumulatif</li>
				<li class="active">List</li>
			</ol>
		</div>

		<!-- Form pencarian -->
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">List KHS Kumulatif Mahasiswa</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Pencarian</label>
								<select class="mahasiswaselect form-control" name="mahasiswa" style="width: 100%;"></select>
							</div>
							<div class="form-group">
								<button type="button" id="proses" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
								<a href="<?php echo base_url('NilaiMataKuliah') ?>"><button type="button" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>
