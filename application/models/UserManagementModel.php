<?php

class UserManagementModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getTotalData() {
		$hasil=$this->db->count_all('user');
		return $hasil;
	}

	public function getListUserManagement($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		
		$sql="SELECT 
				a.*,
				b.nama AS role
			FROM user a
			LEFT JOIN user_role b ON a.id_role=b.id
			WHERE a.nama LIKE '%".$params['search']."%' OR
					a.username LIKE '%".$params['search']."%'
			ORDER BY id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListUserManagementCount($params) {
		$sql="SELECT 
				a.*,
				b.nama AS role
			FROM user a
			LEFT JOIN user_role b ON a.id_role=b.id
			WHERE a.nama LIKE '%".$params['search']."%' OR
				a.username LIKE '%".$params['search']."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function getListUserRole() {
		$sql="SELECT 
				a.*
			FROM user_role a
			ORDER BY a.id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result_array();
		return $hasil;
	}

	public function usernameValidation($username, $id) {
		if ($id==0) {
			$hasil = $this->db->where('username',$username)->from("user")->count_all_results();
		} else {
			$id = (int) $id;
			$sql = "SELECT a.* FROM user a WHERE a.id!=$id AND a.username='".$username."' ";
			$hasil = $this->db->query($sql)->num_rows();
		}
		
		return $hasil;
	}

	public function create($params) {
		$query=$this->db->insert('user', $params);
		return $query;
	}

	public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('user');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function getListUserById($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('user');
		$row=$query->row();
		return $row;
	}

	public function update($params) {
		$data = [
			'nama' => $params['nama'],
			'username' => $params['username'],
			'password' => $params['password'],
		];
		$this->db->where('id', $params['id']);
		$query=$this->db->update('user', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}
