<!-- Modal -->
<div id="modalCreate" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Mata Kuliah</h4>
      </div>
      <div class="modal-body" >
        <div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table id="listMataKuliahModal" class="table table-bordered table-striped" style="width: 100%">
								<thead>
									<tr>
										<th>#</th>
										<th class="text-center">No</th>
										<th>Kode</th>
										<th>Nama</th>
										<th>semester</th>
										<th>Kontribusi SKS</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
        </div>
      </div>
      <div class="modal-footer" style="border-top:none">
        <div class="row">
					<center>
					<button type="button" onclick="addMataKuliahProcess()" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit</button>                             
					<button type="button" class="btn btn-default closeApproveForm" data-dismiss="modal">Cancel</button>
					</center>
        </div>
      </div>
    </div>
  </div>
</div>
