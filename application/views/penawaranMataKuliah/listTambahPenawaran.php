<div class="modal fade" id="add-penawaran-mata-kuliah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<b>Tambah Penawaran Mata Kuliah</b>
			</div>
			<div class="modal-body">
                <form role="form" name="formDataPenawaranMataKuliah">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
								<label>Periode *</label>
								<select class="selectPeriode2 form-control" style="width: 100%;" name="id_periode" required>
									<option></option>
									<?php
									foreach($listPeriode as $key => $value) {
									?>
										<option value="<?php echo $value->id ?>"><?php echo $value->periode ?></option>
									<?php
									}
									?>
								</select>
							</div>
                            <div class="form-group">
								<label>Program Studi *</label>
								<select class="selectProdi form-control" style="width: 100%;" name="id_prodi" required>
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
                            <button type="submit" id="addPenawaranMataKuliah" name="addPenawaranMataKuliah" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
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