<?php

class PengaturanSistemModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getPengaturanSistemData($role) {
		$this->db->where('role', $role);
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

	public function cekData($role) {
		$hasil = $this->db->where('role',$role)->from("pengaturan_sistem")->count_all_results();
		return $hasil;
	}

	public function create($params) {
		$query=$this->db->insert('pengaturan_sistem', $params);
		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function update($params) {
		$data = [
			'id_tahun_akademik' => $params['id_tahun_akademik'],
			'nama_kaprodi' => $params['nama_kaprodi'],
			'nik_kaprodi' => $params['nik_kaprodi'],
		];
		$this->db->where('role', $params['role']);
		$query=$this->db->update('pengaturan_sistem', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}
