<?php
class EvaluasiMandiriRekapModel extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function getTotalData() {
		$hasil=$this->db->count_all('mahasiswa');
		return $hasil;
	}

	public function getListMahasiswa($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM mahasiswa a, 
			(SELECT @rownum := 0) r
			WHERE a.nama LIKE '%".$params['search']."%' OR
				a.nim LIKE '%".$params['search']."%'
			ORDER BY a.id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListMahasiswaCount($params) {
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM mahasiswa a, 
			(SELECT @rownum := 0) r
			WHERE a.nama LIKE '%".$params['search']."%' OR
				a.nim LIKE '%".$params['search']."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

}
