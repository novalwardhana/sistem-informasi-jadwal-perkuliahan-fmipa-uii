<section class="content">
    <div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Jadwal Perkuliahan</li>
				<li class="active">Matriks</li>
				<li class="active">List</li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Matriks Jadwal Perkuliahan</h3>
				</div>
				<div class="box-body">

                    <!-- card -->
                    <div class="card">

                        <!-- card-header -->
                        <div class="card-header">
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item listJadwalPerkuliahan"><a class="nav-link active" href="#listJadwalPerkuliahan" data-toggle="tab">List Jadwal Perkuliahan</a></li>
                                    <li class="nav-item jadwalPerkuliahanSenin"><a class="nav-link" href="#jadwalPerkuliahanSenin" data-toggle="tab">Senin</a></li>
                                    <li class="nav-item jadwalPerkuliahanSelasa"><a class="nav-link" href="#jadwalPerkuliahanSelasa" data-toggle="tab">Selasa</a></li>
                                    <li class="nav-item jadwalPerkuliahanRabu"><a class="nav-link" href="#jadwalPerkuliahanRabu" data-toggle="tab">Rabu</a></li>
                                    <li class="nav-item jadwalPerkuliahanKamis"><a class="nav-link" href="#jadwalPerkuliahanKamis" data-toggle="tab">kamis</a></li>
                                    <li class="nav-item jadwalPerkuliahanJumat"><a class="nav-link" href="#jadwalPerkuliahanJumat" data-toggle="tab">Jumat</a></li>
                                    <li class="nav-item jadwalPerkuliahanSabtu"><a class="nav-link" href="#jadwalPerkuliahanSabtu" data-toggle="tab">Sabtu</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- card-body -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="listJadwalPerkuliahan">
                                    <table id="listDataTable" class="table table-bordered table-striped" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Aksi</th>
                                                <th>Mata Kuliah</th>
                                                <th>Dosen Utama</th>
                                                <th>Dosen Tim 1</th>
                                                <th>Dosen Tim 2</th>
                                                <th>Jam Mulai</th>
                                                <th>Jam Selesai</th>
                                                <th>Kelas</th>
                                                <th>Ruang</th>
                                                <th>Kapasitas</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanSenin">
                                    <div id='matriksSenin'></div>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanSelasa">
                                    <div id='matriksSelasa'></div>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanRabu">
                                    <div id='matriksRabu'></div>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanKamis">
                                    <div id='matriksKamis'></div>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanJumat">
                                    <div id='matriksJumat'></div>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanSabtu">
                                    <div id='matriksSabtu'></div>
                                </div>
                            </div>
                        </div>

                    </div>
				</div>
			</div>
		</div>
	</div>
</section>