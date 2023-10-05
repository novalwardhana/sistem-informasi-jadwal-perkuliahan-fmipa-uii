<?php

class JadwalPerkuliahanModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getTotalData() {
		$hasil=$this->db->count_all('jadwal_perkuliahan');
		return $hasil;
	}

    public function getListJadwalPerkuliahan($params) {
        $limit=(int)$params['limit'];
		$start=(int)$params['start'];

        $sql = "SELECT 
                @rownum := @rownum + 1 AS nomor,
                jp.id as id,
                r.kode as ruang,
                CONCAT(mk.kode, ' - ', mk.nama) mata_kuliah,
                CONCAT(d.nik, ' - ', d.nama) as dosen,
                k.kode  as kelas,
                jp.jadwal_mulai,
                jp.jadwal_selesai,
                jp.kode_warna_bagan
            from jadwal_perkuliahan jp 
            inner join ruang r on jp.id_ruang = r.id
            inner join mata_kuliah mk on jp.id_mata_kuliah = mk.id 
            inner join dosen d on jp.id_dosen  = d.id 
            inner join kelas k on jp.id_kelas = k.id,
            (SELECT @rownum := 0) r
            ORDER BY id DESC
            LIMIT $limit OFFSET $start ";
        
        $query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
    }

    public function getListJadwalPerkuliahanCount($params) {
		$sql="SELECT 
                @rownum := @rownum + 1 AS nomor,
                jp.*
            from jadwal_perkuliahan jp
            inner join ruang r on jp.id_ruang = r.id
            inner join mata_kuliah mk on jp.id_mata_kuliah = mk.id 
            inner join dosen d on jp.id_dosen  = d.id 
            inner join kelas k on jp.id_kelas = k.id,
            (SELECT @rownum := 0) r";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

    public function getListRuang() {
		$sql = "SELECT 
                a.id,
                a.kode,
                a.nama,
                a.kapasitas
            FROM ruang a
            ORDER BY a.id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result_array();
		return $hasil;
	}

    public function getListMataKuliah() {
        $sql = "SELECT 
                mk.id,
                mk.kode,
                mk.nama,
                mk.semester,
                concat(mk.kode, ' - ', mk.nama) as label
            FROM mata_kuliah mk
            ORDER BY mk.id ASC";
        $query=$this->db->query($sql);
		$hasil=$query->result_array();
		return $hasil;
    }

    public function getListDosen() {
        $sql = "SELECT 
                d.id,
                d.nik,
                d.nama,
                concat(d.nik, ' - ', d.nama) as label
            FROM dosen d
            ORDER BY d.id ASC";
        $query=$this->db->query($sql);
		$hasil=$query->result_array();
		return $hasil;
    }

    public function getListKelas() {
        $sql = "SELECT 
                k.id,
                k.kode
            FROM kelas k
            ORDER BY k.id ASC";
         $query=$this->db->query($sql);
         $hasil=$query->result_array();
         return $hasil;
    }


}