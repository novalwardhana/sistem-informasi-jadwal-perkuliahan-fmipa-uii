<section class="content">
	<div class="row">

        <!-- Breadcrumbs -->
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Penawaran Mata Kuliah</li>
                <li class="active">List</li>
                <li class="active">Detail</li>
            </ol>
        </div>

        <!-- Header -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Penawaran Mata Kuliah</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Periode</label>
                                <input type="text" name="id_periode" value="<?php echo $penawaranMataKuliah->periode." - ".$penawaranMataKuliah->semester ?>" class="form-control" placeholder="Periode" readonly>
                            </div>
                            <div class="form-group">
                                <label>Prodi</label>
                                <input type="text" name="id_prodi" value="<?php echo $penawaranMataKuliah->kode_prodi." - ".$penawaranMataKuliah->prodi ?>" class="form-control" placeholder="Program Studi" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button type="button" class="btn btn-sm btn-success" data-toggle='modal' data-target='#add-mata-kuliah'><i class='fa fa-plus'></i> Tambah Kontrak Penawaran Mata Kuliah</button>
					<br><br>
                    <div class="table-responsive">
                        <table id="listDataTable" class="table table-bordered table-striped display nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Aksi</th>
                                    <th>Kode</th>
                                    <th>Mata Kuliah</th>
                                    <th>Dosen Utama</th>
                                    <th>Dosen Tim 1</th>
                                    <th>Dosen Tim 2</th>
                                    <th>Dosen Tim 3</th>
                                    <th>Kelas</th>
                                    <th>Kuota Kelas</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>