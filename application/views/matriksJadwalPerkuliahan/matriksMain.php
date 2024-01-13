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
        
        <!-- Header -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Matriks Jadwal Perkuliahan</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Tahun Akademik</label>
                                <input type="text" name="tahun_akademik" value="<?php echo $periode->tahun_akademik; ?>" class="form-control" placeholder="Periode" readonly>
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <input type="text" name="periode" value="<?php echo ucfirst($periode->semester); ?>" class="form-control" placeholder="Program Studi" readonly>
                            </div>
                            <div class="form-group">
                                <label>Prodi yang dipilih:</label><br>
                                <?php echo $prodi; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter Data</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <form role="form" name="filterData">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Program Studi</label>
                                <select class="filterProgramStudi form-control" style="width: 100%;" name="id_prodi">
                                    <option></option>
                                    <?php
                                    foreach($listProdi as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mata Kuliah</label>
                                <select class="filterMataKuliah form-control" style="width: 100%;" name="id_mata_kuliah">
                                    <option></option>
                                    <?php
                                    foreach($listMataKuliah as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="filterKelas form-control" style="width: 100%;" name="id_kelas">
                                    <option></option>
                                    <?php
                                    foreach($listKelas as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->kode ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Dosen</label>
                                <select class="filterDosen form-control" style="width: 100%;" name="id_dosen">
                                    <option></option>
                                    <?php
                                    foreach($listDosen as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" id="filter" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> Filter</button>
								<!-- <a href="<?php echo base_url('khs-kumulatif') ?>"><button type="button" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button></a> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hari</label>
                                <select class="filterHari form-control" style="width: 100%;" name="hari">
                                    <option></option>
                                    <?php
                                    foreach($listHari as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value["id"] ?>"><?php echo $value["nama"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jam</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="jam_mulai" class="form-control" placeholder="Jam mulai">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="jam_selesai" class="form-control" placeholder="Jam selesai">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ruang</label>
                                <select class="filterRuang form-control" style="width: 100%;" name="id_ruang">
                                    <option></option>
                                    <?php
                                    foreach($listRuang as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kapasitas</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" name="kapasitas_awal" class="form-control" placeholder="Rentang awal">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="kapasitas_akhir" class="form-control" placeholder="Rentang akhir">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Matriks -->
		<div class="col-md-12">
			<div class="box box-primary">
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
                                    <br>
                                    <div class="table-responsive">
                                    <table id="listDataTable" class="table table-bordered table-striped display nowrap" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Aksi</th>
                                                <th>Program Studi</th>
                                                <th>Mata Kuliah</th>
                                                <th>Kelas</th>
                                                <th>Dosen Utama</th>
                                                <th>Dosen Tim 1</th>
                                                <th>Dosen Tim 2</th>
                                                <th>Dosen Tim 3</th>
                                                <th>Hari</th>
                                                <th>Jam Mulai</th>
                                                <th>Jam Selesai</th>
                                                <th>Ruang</th>
                                                <th>Kapasitas</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanSenin">
                                    <br>
                                    <button type="button" class="btn btn-sm btn-success" onclick="cetakMatriks('Senin', 'image')" style="margin-left: 20px;"><i class='fa fa-file-image-o'></i> Cetak Matriks</button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="cetakMatriks('Senin', 'pdf')" style="margin-left: 20px;"><i class='fa fa-file-pdf-o'></i> Cetak Matriks</button>
                                    <div id="canvasMatriksSenin" style="padding: 10px 20px 20px 20px;">
                                        <h3> Matriks Jadwal Perkuliahan FMIPA UII - Senin</h3>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Tahun Akademik</label><br>
                                                    <?php echo $periode->tahun_akademik; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Semester</label><br>
                                                    <?php echo ucfirst($periode->semester); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Prodi yang dipilih:</label><br>
                                                    <?php echo $prodi; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div id='matriksSenin'></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanSelasa">
                                    <br>
                                    <button type="button" class="btn btn-sm btn-success" onclick="cetakMatriks('Selasa', 'image')" style="margin-left: 20px;"><i class='fa fa-file-image-o'></i> Cetak Matriks</button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="cetakMatriks('Selasa', 'pdf')" style="margin-left: 20px;"><i class='fa fa-file-pdf-o'></i> Cetak Matriks</button>
                                    <div id="canvasMatriksSelasa" style="padding: 10px 20px 20px 20px;">
                                        <h3> Matriks Jadwal Perkuliahan FMIPA UII - Selasa</h3>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Tahun Akademik</label><br>
                                                    <?php echo $periode->tahun_akademik; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Semester</label><br>
                                                    <?php echo ucfirst($periode->semester); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Prodi yang dipilih:</label><br>
                                                    <?php echo $prodi; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div id='matriksSelasa'></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanRabu">
                                    <br>
                                    <button type="button" class="btn btn-sm btn-success" onclick="cetakMatriks('Rabu', 'image')" style="margin-left: 20px;"><i class='fa fa-file-image-o'></i> Cetak Matriks</button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="cetakMatriks('Rabu', 'pdf')" style="margin-left: 20px;"><i class='fa fa-file-pdf-o'></i> Cetak Matriks</button>
                                    <div id="canvasMatriksRabu" style="padding: 10px 20px 20px 20px;">  
                                        <h3> Matriks Jadwal Perkuliahan FMIPA UII - Rabu</h3> 
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Tahun Akademik</label><br>
                                                    <?php echo $periode->tahun_akademik; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Semester</label><br>
                                                    <?php echo ucfirst($periode->semester); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Prodi yang dipilih:</label><br>
                                                    <?php echo $prodi; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div id='matriksRabu'></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanKamis">
                                    <br>
                                    <button type="button" class="btn btn-sm btn-success" onclick="cetakMatriks('Kamis', 'image')" style="margin-left: 20px;"><i class='fa fa-file-image-o'></i> Cetak Matriks</button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="cetakMatriks('Kamis', 'pdf')" style="margin-left: 20px;"><i class='fa fa-file-pdf-o'></i> Cetak Matriks</button>
                                    <div id="canvasMatriksKamis" style="padding: 10px 20px 20px 20px;">  
                                        <h3> Matriks Jadwal Perkuliahan FMIPA UII - Kamis</h3> 
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Tahun Akademik</label><br>
                                                    <?php echo $periode->tahun_akademik; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Semester</label><br>
                                                    <?php echo ucfirst($periode->semester); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Prodi yang dipilih:</label><br>
                                                    <?php echo $prodi; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div id='matriksKamis'></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanJumat">
                                    <br>
                                    <button type="button" class="btn btn-sm btn-success" onclick="cetakMatriks('Jumat', 'image')" style="margin-left: 20px;"><i class='fa fa-file-image-o'></i> Cetak Matriks</button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="cetakMatriks('Jumat', 'pdf')" style="margin-left: 20px;"><i class='fa fa-file-pdf-o'></i> Cetak Matriks</button>
                                    <div id="canvasMatriksJumat" style="padding: 10px 20px 20px 20px;">
                                        <h3> Matriks Jadwal Perkuliahan FMIPA UII - Jumat</h3> 
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Tahun Akademik</label><br>
                                                    <?php echo $periode->tahun_akademik; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Semester</label><br>
                                                    <?php echo ucfirst($periode->semester); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Prodi yang dipilih:</label><br>
                                                    <?php echo $prodi; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div id='matriksJumat'></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="jadwalPerkuliahanSabtu">
                                    <br>
                                    <button type="button" class="btn btn-sm btn-success" onclick="cetakMatriks('Sabtu', 'image')" style="margin-left: 20px;"><i class='fa fa-file-image-o'></i> Cetak Matriks</button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="cetakMatriks('Sabtu', 'pdf')" style="margin-left: 20px;"><i class='fa fa-file-pdf-o'></i> Cetak Matriks</button>
                                    <div id="canvasMatriksSabtu" style="padding: 10px 20px 20px 20px;">
                                        <h3> Matriks Jadwal Perkuliahan FMIPA UII - Sabtu</h3> 
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Tahun Akademik</label><br>
                                                    <?php echo $periode->tahun_akademik; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Semester</label><br>
                                                    <?php echo ucfirst($periode->semester); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Prodi yang dipilih:</label><br>
                                                    <?php echo $prodi; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div id='matriksSabtu'></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
				</div>
			</div>
		</div>
	</div>
</section>