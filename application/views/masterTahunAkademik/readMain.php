<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Master</li>
				<li class="active">Tahun Akademik</li>
				<li class="active">List</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">List Tahun Akademik</h3>
				</div>
				<div class="box-body">
					<a href="<?php echo base_url('tahun-akademik/create') ?>"><button type="button" class="btn btn-sm btn-success"><i class='fa fa-plus'></i> Tambah</button></a>
					<br><br>
					<table id="listTahunAkademik" class="table table-bordered table-striped" style="width: 100%">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Aksi</th>
								<th class="text-center">Tahun Akademik</th>
								<th class="text-center">Semester</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>