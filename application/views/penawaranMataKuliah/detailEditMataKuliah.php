<div class="modal fade" id="edit-mata-kuliah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<b>Edit Kontrak Penawaran Mata Kuliah</b>
			</div>
			<div class="modal-body">
                <form role="form" name="formEditMataKuliah">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" min=0 name="id" class="form-control" required>
                            <input type="hidden" min=0 name="id_penawaran_mata_kuliah" class="form-control" required>
                            <div class="form-group">
                                <label>Mata Kuliah *</label>
                                <select class="selectMataKuliahEdit form-control" style="width: 100%;" name="id_mata_kuliah" required>
                                    <option></option>
                                    <?php
                                    foreach($listMataKuliah as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->kode." - ".$value->nama ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Dosen *</label>
                                <select class="selectDosenEdit form-control" style="width: 100%;" name="id_dosen" required>
                                    <option></option>
                                    <?php
                                    foreach($listDosen as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->nik." - ".$value->nama ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kelas *</label>
                                <select class="selectKelasEdit form-control" style="width: 100%;" name="id_kelas" required>
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
                                <label>Kapasitas</label>
                                <input type="number" min=0 name="kapasitas" class="form-control" placeholder="Kapasitas mahasiswa" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="simpanEditData" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
			<div class="modal-footer" style="text-align: center">
				
			</div>
		</div>
	</div>
</div>