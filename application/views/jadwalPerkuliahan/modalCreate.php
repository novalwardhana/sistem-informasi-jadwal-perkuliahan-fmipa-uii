<!-- Modal -->
<div id="modalCreate" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Mahasiswa Peserta Perkuliahan</h4>
      </div>
      <div class="modal-body" >
        <div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table id="listMahasiswa" class="table table-bordered table-striped" style="width: 100%">
								<thead>
									<tr>
										<th width="3%" class="text-center">&nbsp;</th>
										<th width="3%" class="text-center">No</th>
										<th width="15%">NIM</th>
										<th>Nama</th>
										<th width="10%" class="text-center">Semester</th>
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
					<button type="button" onclick="addMahasiswaProcess()" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit</button>                             
					<button type="button" class="btn btn-default closeApproveForm" data-dismiss="modal"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button>
					</center>
        </div>
      </div>
    </div>
  </div>
</div>
