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
                LPAD(cast(jp.id_ruang as char(50)), 2, '0') as resourceId,
                concat(jp.angkatan, '. ', mk.nama, ', ', k.kode, ' (', d.nama, ')') as title,
                jp.jadwal_mulai as start,
                jp.jadwal_selesai as end,
                'blue' as color
            from jadwal_perkuliahan jp 
            inner join master_mata_kuliah mk on jp.id_mata_kuliah = mk.id 
            inner join master_dosen d on jp.id_dosen  = d.id 
            inner join master_kelas k on jp.id_kelas = k.id";

        $query=$this->db->query($sql);
		$result=$query->result();
        return $result;
    }

}