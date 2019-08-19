<?php
class MahasiswaModel extends CI_Model {

	public function __construct() {
		parent::__construct();
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

	public function getListMahasiswaById($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('mahasiswa');
		$row=$query->row();
		return $row;
	}

	public function update($params) {
		$data = [
			'nama' => $params['nama'],
			'nim' => $params['nim'],
			'semester' => $params['semester']
		];	
		$this->db->where('id', $params['id']);
		$query=$this->db->update('mahasiswa', $data);

		$this->updateUser($params['id'], $params['nama']);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	private function updateUser($id_mahasiswa, $nama) {
		$data = [
			'nama' => $nama
		];
		$this->db->where('id_mahasiswa', $id_mahasiswa);
		$query=$this->db->update('user', $data);
	}

	public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('mahasiswa');

		$this->deleteUser($params['id']);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	private function deleteUser($id_mahasiswa) {
		$this->db->where('id_mahasiswa', $id_mahasiswa);
		$query=$this->db->delete('user');
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

}
