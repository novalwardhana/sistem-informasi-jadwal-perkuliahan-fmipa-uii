<?php

class CapaianPembelajaranLulusanModel extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	/*
		Used in function Controlller getListCapaianPembelajaranLulusan
	*/
	public function getTotalData() {
		$hasil=$this->db->count_all('capaian_pembelajaran_lulusan');
		return $hasil;
	}

	public function getListCpl($params) {
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

	public function getListCplCount($params) {
		$sql="SELECT 
				a.id
			FROM capaian_pembelajaran_lulusan a
			WHERE a.nama LIKE '%".$params['search']."%' OR
					a.deskripsi LIKE '%".$params['search']."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	/*
		Used in function Controlller delete
	*/
	public function deleteCplDetail($params) {
		$this->db->where('id_capaian_pembelajaran_lulusan', $params['id']);
		$query=$this->db->delete('capaian_pembelajaran_lulusan_detail');
		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function deleteCpl($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('capaian_pembelajaran_lulusan');
		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
