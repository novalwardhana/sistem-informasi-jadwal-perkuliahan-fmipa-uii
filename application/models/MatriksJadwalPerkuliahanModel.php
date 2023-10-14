<?php

class MatriksJadwalPerkuliahanModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getDataRuang() {
        $sql = "SELECT 
            LPAD(cast(id as char(50)), 2, '0') as id,
            nama as title,
            kapasitas as occupancy
        FROM master_ruang
        where id in (91, 92, 93)
        order by id asc";

        $query=$this->db->query($sql);
		$result=$query->result();
        return $result;
    }

    public function getDataJadwalPerkuliahan() {
        $sql = "SELECT 
                LPAD(cast(pmkd.id_ruang as char(50)), 2, '0') as resourceId,
                concat(mk.semester, ' - ', mk.nama, ' - ', mk.kode, ' (', d.nama, ')') as title,
                pmkd.jadwal_mulai as start,
                pmkd.jadwal_selesai as end,
                'blue' as color
            from penawaran_mata_kuliah_detail pmkd 
            inner join master_mata_kuliah mk on pmkd.id_mata_kuliah = mk.id 
            inner join master_dosen d on pmkd.id_dosen  = d.id 
            inner join master_kelas k on pmkd.id_kelas = k.id";

        $query=$this->db->query($sql);
		$result=$query->result();
        return $result;
    }

    public function getDataJadwalPerkuliahanByID($listIDPenawaranMataKuliah, $day) {
        $sql = "SELECT 
                LPAD(cast(pmkd.id_ruang as char(50)), 2, '0') as resourceId,
                concat(mk.semester, ' - ', mk.nama, ' - ', mk.kode, ' (', d.nama, ')') as title,
                pmkd.jadwal_mulai as start,
                pmkd.jadwal_selesai as end,
                'blue' as color
            from penawaran_mata_kuliah_detail pmkd 
            inner join master_mata_kuliah mk on pmkd.id_mata_kuliah = mk.id 
            inner join master_dosen d on pmkd.id_dosen  = d.id 
            inner join master_kelas k on pmkd.id_kelas = k.id
            where 
                pmkd.id_penawaran_mata_kuliah in (".implode(",", $listIDPenawaranMataKuliah).") and
                pmkd.hari = '$day'
            ";

        $query=$this->db->query($sql);
		$result=$query->result();
        return $result;
    }

    public function getIDPenawaranMataKuliah($id) {
        $sql = "SELECT id FROM penawaran_mata_kuliah where id_periode = $id order by id asc";
        $query=$this->db->query($sql);
		$result=$query->result();
        return $result;
    }

}