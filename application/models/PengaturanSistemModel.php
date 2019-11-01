<?php

class PengaturanSistemModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getPengaturanSistemData($role) {
		$this->db->where('id', $role);
		$query=$this->db->get('pengaturan_sistem');
		$row=$query->row();
		return $row;
	}

	public function getListTahunAkademik() {
		$sql="SELECT 
				a.id,
				CONCAT('TA: ', a.tahun_mulai, ' - ', a.tahun_selesai, ' | Semester: ', a.semester) AS nama
			FROM tahun_akademik a
			ORDER BY a.id DESC";
		$query=$this->db->query($sql);
		$hasil=$query->result_array();
		return $hasil;
	}

}
