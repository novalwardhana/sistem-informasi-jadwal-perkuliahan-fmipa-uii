<?php

class MahasiswaUploadModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function validationNIM($nim) {
		$hasil = $this->db->where('nim',$nim)->from("mahasiswa")->count_all_results();
		return $hasil;
	}

	public function validationUsername($nim) {
		$hasil = $this->db->where('username',$nim)->from("user")->count_all_results();
		return $hasil;
	}

	public function getRoleId() {
		$sql="SELECT id from user_role WHERE nama='Mahasiswa' ";
		$query=$this->db->query($sql);
		$row=$query->first_row('array');
		return $row;
	}

	public function create($params, $id_role) {
		$query=$this->db->insert('mahasiswa', $params);
		$id_mahasiswa = $this->db->insert_id();
		$this->createUser($id_mahasiswa, $params, $id_role);
		return $query;
	}

	private function createUser($id_mahasiswa, $data, $id_role) {
		$params=array(
			'nama' => $data['nama'],
			'username' => $data['nim'],
			'password' => $data['nim'],
			'id_role' => $id_role,
			'id_mahasiswa' => $id_mahasiswa
		);
		$query=$this->db->insert('user', $params);
	}

}
