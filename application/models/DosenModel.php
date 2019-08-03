<?php
class DosenModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getTotalData() {
		$hasil=$this->db->count_all('dosen');
		return $hasil;
	}

	public function getListDosen($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM dosen a, 
			(SELECT @rownum := 0) r
			WHERE a.nama LIKE '%".$params['search']."%' OR
					a.nik LIKE '%".$params['search']."%'
			ORDER BY id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListDosenCount($params) {
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM dosen a, 
			(SELECT @rownum := 0) r
			WHERE a.nama LIKE '%".$params['search']."%' OR
					a.nik LIKE '%".$params['search']."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function validationNIK($nik, $id) {
		if ($id==0) {
			$hasil = $this->db->where('nik',$nik)->from("dosen")->count_all_results();
		} else {

			$id = (int) $id;
			$sql = "SELECT a.* FROM dosen a WHERE a.id!=$id AND a.nik='".$nik."' ";
			$hasil = $this->db->query($sql)->num_rows();
			
		}
		return $hasil;
	}

	public function validationUsername($nik, $id) {
		if ($id==0) {

			$hasil = $this->db->where('username',$nik)->from("user")->count_all_results();

		} else {

			$id = (int) $id;
			$sql = "SELECT a.* FROM user a WHERE a.id_dosen!=$id AND a.username='".$nik."' ";
			$hasil = $this->db->query($sql)->num_rows();

		}
		return $hasil;
	}

	public function create($params, $id_role) {
		$query=$this->db->insert('dosen', $params);
		$id_dosen = $this->db->insert_id();
		$this->createUser($id_dosen, $params, $id_role);
		return $query;
	}

	private function createUser($id_dosen, $data, $id_role) {
		$params=array(
			'nama' => $data['nama'],
			'username' => $data['nik'],
			'password' => $data['nik'],
			'id_role' => $id_role,
			'id_dosen' => $id_dosen
		);
		$query=$this->db->insert('user', $params);
	}

	public function getRoleId() {
		$sql="SELECT id from user_role WHERE nama='Dosen' ";
		$query=$this->db->query($sql);
		$row=$query->first_row('array');
		return $row;
	}

	public function getListDosenById($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('dosen');
		$row=$query->row();
		return $row;
	}

	public function update($params) {
		$data = [
			'nik' => $params['nik'],
			'nama' => $params['nama']
		];
			
		$this->db->where('id', $params['id']);
		$query=$this->db->update('dosen', $data);

		$this->updateUser($params);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	private function updateUser($params) {
		$data = [
			'username' => $params['nik'],
			'password' => $params['nik']
		];
		
		$id = (int) $params['id'];

		$this->db->where('id_dosen', $id);
		$query=$this->db->update('user', $data);
	}

	public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('dosen');

		$this->deleteUser($params['id']);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	private function deleteUser($id_dosen) {
		$this->db->where('id_dosen', $id_dosen);
		$query=$this->db->delete('user');
	}
}
