<?php

class KhsKumulatifUploadNilaiModel extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function comboMahasiswa($search) {
		$sql="SELECT 
				a.id,
				CONCAT(a.nim,' - ',a.nama) AS name
			FROM mahasiswa a
			WHERE a.nama LIKE '%".$search."%' OR
				a.nim LIKE '%".$search."%'
			ORDER BY a.nama ASC, a.nim ASC
			LIMIT 10
			";
		$query=$this->db->query($sql);
		$hasil=$query->result_array();
		return $hasil;
	}

	public function addKhsMahasiswa($params) {
		$query=$this->db->insert('khs_kumulatif', $params);
		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
