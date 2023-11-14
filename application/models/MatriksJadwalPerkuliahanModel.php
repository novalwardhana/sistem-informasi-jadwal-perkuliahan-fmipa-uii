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

    public function getDataRuangForCombobox() {
        $sql = "SELECT 
            id,
            nama,
            kapasitas
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
                coalesce(mp.kode_warna_bagan, 'blue') as color
            from penawaran_mata_kuliah_detail pmkd 
            inner join master_mata_kuliah mk on pmkd.id_mata_kuliah = mk.id 
            inner join master_dosen d on pmkd.id_dosen  = d.id 
            inner join master_kelas k on pmkd.id_kelas = k.id
            inner join master_prodi mp on mk.id_prodi = mp.id
            where 
                pmkd.id_penawaran_mata_kuliah in (".implode(",", $listIDPenawaranMataKuliah).") and
                pmkd.hari = '$day'
            ";

        $query=$this->db->query($sql);
		$result=$query->result();
        return $result;
    }

    public function getMasterPeriodeByID($id) {
        $sql = "SELECT 
                tahun_akademik,
                semester
            from master_periode
            where id = $id";
        $query=$this->db->query($sql);
        $result=$query->row();
        return $result;
    }

    public function getProdiPenawaranMataKuliah($id) {
        $sql = "select 
                mp.nama as prodi
            from penawaran_mata_kuliah pmk 
            inner join master_prodi mp on pmk.id_prodi = mp.id 
            where pmk.id_periode  = $id";
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
            left join master_mata_kuliah mk on pmkd.id_mata_kuliah = mk.id 
            left join master_dosen d on pmkd.id_dosen  = d.id 
            left join master_dosen md on pmkd.id_dosen = md.id 
            left join master_dosen md_tim_1 on pmkd.id_dosen_tim_1 = md_tim_1.id
            left join master_dosen md_tim_2 on pmkd.id_dosen_tim_2 = md_tim_2.id 
            left join master_kelas k on pmkd.id_kelas = k.id
            left join master_ruang mr on pmkd.id_ruang = mr.id
            where 
                pmkd.id_penawaran_mata_kuliah in (".implode(",", $listIDPenawaranMataKuliah).")";
        $query=$this->db->query($sql);
        $result=$query->row();
        return $result->total;
    }

    public function getListDataJadwalPerkuliahan($listIDPenawaranMataKuliah) {
        $sql = "SELECT 
                coalesce(pmkd.id, 0) as id,
                coalesce(pmkd.id_penawaran_mata_kuliah, 0) as id_penawaran_mata_kuliah,
                coalesce(mk.kode, '') as kode_mata_kuliah,
                coalesce(mk.nama, '') as mata_kuliah,
                coalesce(pmkd.id_dosen, 0) as id_dosen,
                coalesce(md.nik, '') as nik_dosen,
                coalesce(md.nama, '') as dosen,
                pmkd.id_dosen_tim_1,
                md_tim_1.nik as nik_dosen_tim_1,
                coalesce(md_tim_1.nama, '') as dosen_tim_1,
                pmkd.id_dosen_tim_2,
                md_tim_2.nik as nik_dosen_tim_2,
                coalesce(md_tim_2.nama, '') as dosen_tim_2,
                pmkd.hari, 
                pmkd.jadwal_mulai,
                pmkd.jadwal_selesai,
                pmkd.id_kelas,
                coalesce(k.kode, '') as kelas,
                coalesce(pmkd.id_ruang, 0) as id_ruang,
                mr.kode as kode_ruang,
                mr.nama as ruang,
                coalesce(pmkd.kapasitas, 0) as kapasitas
            from penawaran_mata_kuliah_detail pmkd 
            left join master_mata_kuliah mk on pmkd.id_mata_kuliah = mk.id 
            left join master_dosen d on pmkd.id_dosen  = d.id 
            left join master_dosen md on pmkd.id_dosen = md.id 
            left join master_dosen md_tim_1 on pmkd.id_dosen_tim_1 = md_tim_1.id
            left join master_dosen md_tim_2 on pmkd.id_dosen_tim_2 = md_tim_2.id 
            left join master_kelas k on pmkd.id_kelas = k.id
            left join master_ruang mr on pmkd.id_ruang = mr.id
            where 
                pmkd.id_penawaran_mata_kuliah in (".implode(",", $listIDPenawaranMataKuliah).")";
        $query=$this->db->query($sql);
        $result=$query->result();
        return $result;
    } 

    public function checkJadwal($params) {

        $data = [
            $params["id_periode"],
            $params["hari"],
            $params["id_ruang"],
            $params["jadwal_selesai"],
            $params["jadwal_mulai"],
            $params["id"]
        ];

        $sql = "select 
               pmkd.*
            from penawaran_mata_kuliah_detail pmkd 
            inner join penawaran_mata_kuliah pmk on pmkd.id_penawaran_mata_kuliah = pmk.id 
            where pmk.id_periode = ?
            and pmkd.hari = ?
            and pmkd.id_ruang = ?
            and pmkd.jadwal_mulai < ? and pmkd.jadwal_selesai > ?
            and pmkd.id != ?";

        $query=$this->db->query($sql, $data);
        $result=$query->result();
        return $result;
    }

    public function setJadwal($params) {
        $data = [
            $params['hari'],
            $params['jadwal_mulai'],
            $params['jadwal_selesai'],
            $params['id_ruang'],
            $params['id']
        ];
        
        $sql = "update penawaran_mata_kuliah_detail set hari = ?, jadwal_mulai = ?, jadwal_selesai = ?, id_ruang = ? where id = ?";
		$query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
    }

}