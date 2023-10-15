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
                concat(DATE_FORMAT(now(), '%Y-%m-%d '), pmkd.jadwal_mulai) as start,
                concat(DATE_FORMAT(now(), '%Y-%m-%d ') ,pmkd.jadwal_selesai) as end,
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

    public function getTotalDataJadwalPerkuliahan($listIDPenawaranMataKuliah) {
        $sql = "SELECT 
                count(*) as total
            from penawaran_mata_kuliah_detail pmkd 
            inner join master_mata_kuliah mk on pmkd.id_mata_kuliah = mk.id 
            inner join master_dosen d on pmkd.id_dosen  = d.id 
            left join master_dosen md on pmkd.id_dosen = md.id 
            left join master_dosen md_tim_1 on pmkd.id_dosen_tim_1 = md_tim_1.id
            left join master_dosen md_tim_2 on pmkd.id_dosen_tim_2 = md_tim_2.id 
            inner join master_kelas k on pmkd.id_kelas = k.id
            inner join master_ruang mr on pmkd.id_ruang = mr.id
            where 
                pmkd.id_penawaran_mata_kuliah in (".implode(",", $listIDPenawaranMataKuliah).")";
        $query=$this->db->query($sql);
        $result=$query->row();
        return $result->total;
    }

    public function getListDataJadwalPerkuliahan($listIDPenawaranMataKuliah) {
        $sql = "SELECT 
                pmkd.id,
                pmkd.id_penawaran_mata_kuliah,
                mk.kode as kode_mata_kuliah,
	            mk.nama as mata_kuliah,
                pmkd.id_dosen,
                md.nik as nik_dosen,
                md.nama as dosen,
                pmkd.id_dosen_tim_1,
                md_tim_1.nik as nik_dosen_tim_1,
                md_tim_1.nama as dosen_tim_1,
                pmkd.id_dosen_tim_2,
                md_tim_2.nik as nik_dosen_tim_2,
                md_tim_2.nama as dosen_tim_2,
                pmkd.jadwal_mulai,
                pmkd.jadwal_selesai,
                pmkd.id_kelas,
                mk.kode as kelas,
                pmkd.id_ruang,
                mr.kode as kode_ruang,
                mr.nama as ruang,
                pmkd.kapasitas
            from penawaran_mata_kuliah_detail pmkd 
            inner join master_mata_kuliah mk on pmkd.id_mata_kuliah = mk.id 
            inner join master_dosen d on pmkd.id_dosen  = d.id 
            left join master_dosen md on pmkd.id_dosen = md.id 
            left join master_dosen md_tim_1 on pmkd.id_dosen_tim_1 = md_tim_1.id
            left join master_dosen md_tim_2 on pmkd.id_dosen_tim_2 = md_tim_2.id 
            inner join master_kelas k on pmkd.id_kelas = k.id
            inner join master_ruang mr on pmkd.id_ruang = mr.id
            where 
                pmkd.id_penawaran_mata_kuliah in (".implode(",", $listIDPenawaranMataKuliah).")";
        $query=$this->db->query($sql);
        $result=$query->result();
        return $result;
    } 

}