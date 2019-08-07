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

	public function getMataKuliahCreateCPLTotalData() {
		$hasil=$this->db->count_all('capaian_pembelajaran_lulusan_temp');
		return $hasil;
	}

	public function getMataKuliahCreateCPL($params) {
		$sql="SELECT
				a.id,
				b.kode,
				b.nama,
				b.semester,
				b.kontribusi AS sks
			FROM capaian_pembelajaran_lulusan_temp a
			LEFT JOIN mata_kuliah b ON a.id_mata_kuliah=b.id
			WHERE b.kode like '%".$params['search']."%' OR
				b.nama like '%".$params['search']."%' OR
				b.semester like '%".$params['search']."%' OR
				b.kontribusi like '%".$params['search']."%'
			ORDER BY a.id DESC
		";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function deleteMataKuliahCreateCPL($id) {
		$this->db->where('id', $id);
		$query=$this->db->delete('capaian_pembelajaran_lulusan_temp');

		if ($query) {
			return true;
		} else {
			return false;
		}
	}


}
