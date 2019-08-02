<?php

class UserRoleModel extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function getTotalData() {
		$hasil=$this->db->count_all('user_role');
		return $hasil;
	}

	public function getListUserRole($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		
		$sql="SELECT 
				a.*
			FROM user_role a
			WHERE a.nama LIKE '%".$params['search']."%'
			ORDER BY id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListUserRoleCount($params) {
		$sql="SELECT 
				a.*
			FROM user_role a
			WHERE a.nama LIKE '%".$params['search']."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function create($params) {
		$query=$this->db->insert('user_role', $params);
		return $query;
	}

	public function getListRoleById($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('user_role');
		$row=$query->row();
		return $row;
	}

	public function update($params) {
		$data = [
			'nama' => $params['nama']
		];
		$this->db->where('id', $params['id']);
		$query=$this->db->update('user_role', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('user_role');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}
