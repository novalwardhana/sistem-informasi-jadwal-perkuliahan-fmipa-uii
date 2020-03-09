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
							<label>From Page</label>
							<input type="text" class="form-control" placeholder="From page">
						</div>

						<div class="form-group">
							<label>To Page</label>
							<input type="text" class="form-control" placeholder="From page">
						</div>
						
					</div>
				</div>
      </div>
      <div class="modal-footer" style="border-top:none">
        <div class="row">
					<center>
					<button type="button" onclick="exportRekap()" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
					<button type="button" onclick="exportRekap()" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Current Page</button>                             
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-minus-circle" aria-hidden="true"></i> Cancel</button>
					</center>
        </div>
      </div>
    </div>
  </div>
</div>
