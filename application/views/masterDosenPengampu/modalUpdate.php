<!-- Modal -->
<div id="modalUpdate" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ubah Mata Kuliah yang Diampu</h4>
      </div>
      <form action="<?php echo base_url('dosenPengampu/update') ?>" method="post">
      <div class="modal-body" >
        <div class="row">
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#modalNavUpdateDataPerkuliahan" data-toggle="tab">Data Perkuliahan *</a></li>
                  <li><a href="#modalNavUpdateCPMK1" data-toggle="tab">CPMK 1</a></li>
                  <li><a href="#modalNavUpdateCPMK2" data-toggle="tab">CPMK 2</a></li>
                  <li><a href="#modalNavUpdateCPMK3" data-toggle="tab">CPMK 3</a></li>
                  <li><a href="#modalNavUpdateCPMK4" data-toggle="tab">CPMK 4</a></li>
                  <li><a href="#modalNavUpdateCPMK5" data-toggle="tab">CPMK 5</a></li>
                  <li><a href="#modalNavUpdateCPMK6" data-toggle="tab">CPMK 6</a></li>
									<li><a href="#modalNavUpdateCPMK7" data-toggle="tab">CPMK 7</a></li>
									<li><a href="#modalNavUpdateCPMK8" data-toggle="tab">CPMK 8</a></li>
									<li><a href="#modalNavUpdateCPMK9" data-toggle="tab">CPMK 9</a></li>
									<li><a href="#modalNavUpdateCPMK10" data-toggle="tab">CPMK 10</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="modalNavUpdateDataPerkuliahan">
                    <?php
                      $this->load->view('masterDosenPengampu/modalUpdate_tabPerkuliahan');
                    ?>
                  </div>

                  <div class="tab-pane" id="modalNavUpdateCPMK1">
                    <?php
                      $this->load->view('masterDosenPengampu/modalUpdate_tabCPMK_1');
                    ?>
                  </div>

                  <div class="tab-pane" id="modalNavUpdateCPMK2">
                    <?php
                      $this->load->view('masterDosenPengampu/modalUpdate_tabCPMK_2');
                    ?>
                  </div>

                  <div class="tab-pane" id="modalNavUpdateCPMK3">
                    <?php
                      $this->load->view('masterDosenPengampu/modalUpdate_tabCPMK_3');
                    ?>
                  </div>

                  <div class="tab-pane" id="modalNavUpdateCPMK4">
                    <?php
                      $this->load->view('masterDosenPengampu/modalUpdate_tabCPMK_4');
                    ?>
                  </div>

                  <div class="tab-pane" id="modalNavUpdateCPMK5">
                    <?php
                      $this->load->view('masterDosenPengampu/modalUpdate_tabCPMK_5');
                    ?>
                  </div>

                  <div class="tab-pane" id="modalNavUpdateCPMK6">
                    <?php
                      $this->load->view('masterDosenPengampu/modalUpdate_tabCPMK_6');
                    ?>
                  </div>

									<div class="tab-pane" id="modalNavUpdateCPMK7">
                    <?php
                      $this->load->view('masterDosenPengampu/modalUpdate_tabCPMK_7');
                    ?>
                  </div>

									<div class="tab-pane" id="modalNavUpdateCPMK8">
                    <?php
                      $this->load->view('masterDosenPengampu/modalUpdate_tabCPMK_8');
                    ?>
                  </div>

									<div class="tab-pane" id="modalNavUpdateCPMK9">
                    <?php
                      $this->load->view('masterDosenPengampu/modalUpdate_tabCPMK_9');
                    ?>
                  </div>

									<div class="tab-pane" id="modalNavUpdateCPMK10">
                    <?php
                      $this->load->view('masterDosenPengampu/modalUpdate_tabCPMK_10');
                    ?>
                  </div>
                  
                </div>
              </div>
                
            </div>
        </div>
      </div>
      <div class="modal-footer" style="border-top:none">
        <div class="row">
            <center>
            <button type="submit" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Simpan</button>                             
            <button type="button" class="btn btn-default closeApproveForm" data-dismiss="modal"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button>
            </center>
        </div>
      </div>
      </form>
    </div>

  </div>
</div>
