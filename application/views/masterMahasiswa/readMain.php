<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">List Mahasiswa</h3>
				</div>
				<div class="box-body">
					<a href="<?php echo base_url('Mahasiswa/create') ?>"><button type="button" class="btn btn-sm btn-success"><i class='fa fa-plus'></i> Tambah</button></a>
					<br><br>
					<table id="listMahasiswa" class="table table-bordered table-striped" style="width: 100%">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Aksi</th>
								<th>NIM</th>
								<th>Nama</th>
								<th>Semester</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
