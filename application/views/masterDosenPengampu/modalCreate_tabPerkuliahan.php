<div class="form-group">
    <label>NIK Dosen *</label>
    <input type="hidden" value="<?php echo $dataDosen->id ?>" name="id_dosen" class="form-control" placeholder="Nomor induk pegawai" readonly>
    <input type="number" value="<?php echo $dataDosen->nik ?>" class="form-control" placeholder="Nomor induk pegawai" readonly>
</div>
<div class="form-group">
    <label>Nama Dosen *</label>
    <input type="text" value="<?php echo $dataDosen->nama ?>" class="form-control" placeholder="Nomor induk pegawai" readonly>
</div>
<div class="form-group">
    <label>Mata Kuliah *</label>
    <select class="selectMataKuliah form-control" style="width: 100%;" name="id_mata_kuliah" required>
    <option></option>
    <?php
        for($i=1; $i<=6; $i++) {
    ?>
        <optgroup label="Semester <?php echo $i ?>">
            <?php
            foreach($dataMataKuliah as $key => $value) {
            ?>
                <?php
                if ($i==$value['semester']) {
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['kode'].' - '.$value['nama'] ?></option>
                <?php
                }
                ?>
            <?php
            }
            ?>
        </optgroup>
    <?php
        }
    ?>
    </select>
</div>
<div class="form-group">
    
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            <label>Kelas *</label>
            <select class="selectKelas form-control" style="width: 100%;" name="id_kelas" required>
                <option></option>
                <?php
                foreach($dataKelas as $key => $value) {
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['kode'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <label>Jam Mulai *</label>
            <input type="text" class="form-control timepicker" name="jam_mulai" required/>
        </div>
        <div class="col-md-3">
            <label>Jam Selesai *</label>
            <input type="text" class="form-control timepicker" name="jam_selesai" required/>
        </div>
        <div class="col-md-3">
            <label>Maks Peserta *</label>
            <input type="number" min="1" max="100" class="form-control" name="maks_peserta" required/>
        </div>
    </div>
</div>
<div class="form-group">
    <label>Ruang *</label>
    <input type="text" class="form-control" placeholder="Ruang" name="ruang" required/>
</div>
