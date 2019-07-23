<!-- Modal -->
<div id="modalCreate" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Mata Kuliah yang Diampu</h4>
      </div>
      <form action="<?php echo base_url('dosenPengampu/create') ?>" method="post">
      <div class="modal-body" >
        <div class="row">
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#modalNavCreateDataPerkuliahan" data-toggle="tab">Data Perkuliahan</a></li>
                  <li><a href="#modalNavCreateCPMK1" data-toggle="tab">CPMK 1</a></li>
                  <li><a href="#modalNavCreateCPMK2" data-toggle="tab">CPMK 2</a></li>
                  <li><a href="#modalNavCreateCPMK3" data-toggle="tab">CPMK 3</a></li>
                  <li><a href="#modalNavCreateCPMK4" data-toggle="tab">CPMK 4</a></li>
                  <li><a href="#modalNavCreateCPMK5" data-toggle="tab">CPMK 5</a></li>
                  <li><a href="#modalNavCreateCPMK6" data-toggle="tab">CPMK 6</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="modalNavCreateDataPerkuliahan">
                    <?php
                      $this->load->view('masterDosenPengampu/modalCreate_tabPerkuliahan');
                    ?>
                  </div>
                  <div class="tab-pane" id="modalNavCreateCPMK1">
                    <?php
                      $this->load->view('masterDosenPengampu/modalCreate_tabCPMK_1');
                    ?>
                  </div>
                  <div class="tab-pane" id="modalNavCreateCPMK2">
                    <?php
                      $this->load->view('masterDosenPengampu/modalCreate_tabCPMK_2');
                    ?>
                  </div>
                  <div class="tab-pane" id="modalNavCreateCPMK3">
                    <?php
                      $this->load->view('masterDosenPengampu/modalCreate_tabCPMK_3');
                    ?>
                  </div>
                  <div class="tab-pane" id="modalNavCreateCPMK4">
                    <?php
                      $this->load->view('masterDosenPengampu/modalCreate_tabCPMK_4');
                    ?>
                  </div>
                  <div class="tab-pane" id="modalNavCreateCPMK5">
                    <?php
                      $this->load->view('masterDosenPengampu/modalCreate_tabCPMK_5');
                    ?>
                  </div>
                  <div class="tab-pane" id="modalNavCreateCPMK6">
                    <?php
                      $this->load->view('masterDosenPengampu/modalCreate_tabCPMK_6');
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
            <button type="submit" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit</button>                             
            <button type="button" class="btn btn-default closeApproveForm" data-dismiss="modal">Cancel</button>
            </center>
        </div>
      </div>
      </form>
    </div>

  </div>
</div>