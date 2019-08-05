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

}
