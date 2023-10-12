<?php

class JadwalPerkuliahanModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getTotalData() {
		$hasil=$this->db->count_all('master_periode');
		return $hasil;
	}

    public function getListJadwalPerkuliahan($params) {
        $limit=(int)$params['limit'];
		$start=(int)$params['start'];

        $sql = "with pmk as (
            select 
                pmk.id,
                pmk.id_periode,
                pmk.id_prodi,
                mpr.nama as prodi
            from penawaran_mata_kuliah pmk
            left join master_prodi mpr on pmk.id_prodi = mpr.id
        )
        select 
            p.id,
            p.tahun_akademik,
            p.semester,
            json_arrayagg(pmk.id_prodi) as list_id_prodi,
            json_arrayagg(pmk.prodi) as list_prodi
        from master_periode p
        left join pmk on p.id = pmk.id_periode
        group by p.id, p.tahun_akademik, p.semester
        order by p.tahun_akademik desc, semester desc
        LIMIT $limit OFFSET $start ";
        
        $query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
    }

    public function getListJadwalPerkuliahanCount($params) {
		$sql="with pmk as (
            select 
                pmk.id,
                pmk.id_periode,
                pmk.id_prodi,
                mpr.nama as prodi
            from penawaran_mata_kuliah pmk
            left join master_prodi mpr on pmk.id_prodi = mpr.id
        )
        select 
            p.id,
            p.tahun_akademik,
            p.semester,
            json_arrayagg(pmk.id_prodi) as list_id_prodi,
            json_arrayagg(pmk.prodi) as list_prodi
        from master_periode p
        left join pmk on p.id = pmk.id_periode
        group by p.id, p.tahun_akademik, p.semester";
        
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

}