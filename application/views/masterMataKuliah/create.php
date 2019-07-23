<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Input Mata Kuliah</h3>
                </div>
                <form role="form" method="post" action="<?php echo base_url('matakuliah/create') ?>">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode</label>
                                    <input type="text" name="kode" class="form-control" placeholder="Kode mata kuliah" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama mata kuliah" required>
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <input type="number" name="semester" class="form-control" placeholder="Nama mata kuliah" required>
                                </div>
                                <div class="form-group">
                                    <label>Kontribusi</label>
                                    <input type="number" name="kontribusi" class="form-control" placeholder="Kontribusi mata kuliah dalam SKS" required>
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
