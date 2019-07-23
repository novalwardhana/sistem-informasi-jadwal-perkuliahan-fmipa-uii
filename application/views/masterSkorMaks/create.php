<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Input Skor Maks per Semester</h3>
                </div>
                <form role="form" method="post" action="<?php echo base_url('skormaks/create') ?>">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Semester</label>
                                    <input type="number" name="semester" class="form-control" placeholder="Semester" required>
                                </div>
                                <div class="form-group">
                                    <label>CPL</label>
                                    <input type="number" name="cpl" class="form-control" placeholder="Capaian Pembelajaran Per Semester" required>
                                </div>
                                <div class="form-group">
                                    <label>Skor Maksimum</label>
                                    <input type="number" step="0.01" name="skor_maks" class="form-control" placeholder="Skor Maksimum" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-minus-circle" aria-hidden="true"></i> Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
