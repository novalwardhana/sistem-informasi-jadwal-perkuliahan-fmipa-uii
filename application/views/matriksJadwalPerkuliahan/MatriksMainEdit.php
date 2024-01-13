<div class="modal fade" id="edit-jadwal-perkuliahan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<b>Edit Jadwal Perkuliahan</b>
			</div>
			<div class="modal-body">
                <form role="form" name="formEditJadwalPerkuliahan">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" min=0 name="id" class="form-control" required>
                            <input type="hidden" min=0 name="id_periode" class="form-control" required>
                            
                            <div class="form-group">
                                <label>Mata Kuliah *</label>
                                <input type="text" name="mata_kuliah" class="form-control" placeholder="Mata kuliah" readonly>
                            </div>
                            <div class="form-group">
                                <label>Dosen Utama *</label>
                                <input type="text" name="dosen" class="form-control" placeholder="Dosen" readonly> 
                            </div>
                            <div class="form-group">
                                <label>Dosen Tim 1</label>
                                <input type="text" name="dosen_tambahan_1" class="form-control" placeholder="-" readonly> 
                            </div>
                            <div class="form-group">
                                <label>Dosen Tim 2</label>
                                <input type="text" name="dosen_tambahan_2" class="form-control" placeholder="-" readonly> 
                            </div>
                            <div class="form-group">
                                <label>Dosen Tim 3</label>
                                <input type="text" name="dosen_tambahan_3" class="form-control" placeholder="-" readonly> 
                            </div>

                           
                            <div class="form-group">
                                <label>Hari</label>
                                <select class="selectHari form-control" style="width: 100%;" name="hari" required>
                                    <option></option>
                                    <?php
										foreach($dataHariCombobox as $key => $value) {
									?>
											<option value="<?php echo $value["id"] ?>"><?php echo $value["text"] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
    
                            <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label>Jadwal Mulai</label>
                                <div class="input-group">
                                    <input type="text" name="jadwal_mulai" class="form-control jadwalMulai">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label>Jadwal Selesai</label>
                                <div class="input-group">
                                    <input type="text" name="jadwal_selesai" class="form-control jadwalSelesai">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" name="kelas" class="form-control" placeholder="Kelas" readonly> 
                            </div>

                            <div class="form-group">
                                <label>Ruang</label>
                                <select class="selectRuang form-control" style="width: 100%;" name="id_ruang" required>
                                    <option></option>
                                    <?php
										foreach($data_ruang_combobox as $key => $value) {
									?>
											<option value="<?php echo $value->id ?>"><?php echo $value->ruang ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Kapasitas</label>
                                <input type="number" min=0 name="kapasitas" class="form-control" placeholder="Kapasitas" readonly> 
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