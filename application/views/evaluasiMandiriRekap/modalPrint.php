<!-- Modal -->
<div id="modalPrint" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Export Rekap Evaluasi Mandiri</h4>
      </div>
      <div class="modal-body" >
				<div class="row">
					<div class="col-md-12">

						<div class="form-group">
							<label>Halaman awal</label>
							<select id="fromPage" class="selectPage form-control" style="width: 100%;" name="from_page" required>
								<option></option>
								<?php
									for($i=1; $i<=$jumlah_halaman; $i++) {
								?>
										<option><?php echo $i; ?></option>
								<?php
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<label>Halaman akhir</label>
							<select id="toPage" class="selectPage form-control" style="width: 100%;" name="to_page" required>
								<option></option>
								<?php
									for($i=1; $i<=$jumlah_halaman; $i++) {
								?>
										<option><?php echo $i; ?></option>
								<?php
									}
								?>
							</select>
						</div>
						
					</div>
				</div>
      </div>
      <div class="modal-footer" style="border-top:none">
        <div class="row">
					<center>
					<button type="button" id="exportRekap" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>                         
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-minus-circle" aria-hidden="true"></i> Cancel</button>
					</center>
        </div>
      </div>
    </div>
  </div>
</div>
