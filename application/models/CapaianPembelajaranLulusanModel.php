<?php

class CapaianPembelajaranLulusanModel extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function getTotalData() {
		$hasil=$this->db->count_all('capaian_pembelajaran_lulusan');
		return $hasil;
	}

	public function getListCapaianPembelajaranLulusan($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		
		$sql="SELECT 
				a.*
			FROM capaian_pembelajaran_lulusan a
			WHERE a.nama LIKE '%".$params['search']."%' OR
					a.deskripsi LIKE '%".$params['search']."%'
			ORDER BY id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getTotalDataMataKuliah() {
		$hasil=$this->db->count_all('mata_kuliah');
		return $hasil;
	}

	public function getListMataKuliah($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
			
		$sql="SELECT 
				a.*
			FROM mata_kuliah a
			WHERE a.nama LIKE '%".$params['search']."%' OR
				a.kode LIKE '%".$params['search']."%'
			ORDER BY a.semester ASC, a.nama ASC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListMataKuliahCount($params) {
		$sql="SELECT
				a.*
			FROM mata_kuliah a
			WHERE a.nama LIKE '%".$params['search']."%' OR
				a.kode LIKE '%".$params['search']."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function addMataKuliah($params) {
		$query=$this->db->insert('capaian_pembelajaran_lulusan_temp', $params);
		return $query;
	}

}
