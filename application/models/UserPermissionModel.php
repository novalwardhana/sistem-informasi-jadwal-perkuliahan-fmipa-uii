<?php

class UserPermissionModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getTotalData() {
		$hasil=$this->db->count_all('user_permission');
		return $hasil;
	}

	public function getListUserPermission($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		
		$sql="SELECT 
				a.*
			FROM user_permission a
			WHERE a.nama LIKE '%".$params['search']."%'
			ORDER BY id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListUserPermissionCount($params) {
		$sql="SELECT 
				a.*
			FROM user_permission a
			WHERE a.nama LIKE '%".$params['search']."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function create($params) {
		$query=$this->db->insert('user_permission', $params);
		return $query;
	}

	public function getListPermissionById($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('user_permission');
		$row=$query->row();
		return $row;
	}

	public function update($params) {
		$data = [
			'nama' => $params['nama'],
			'module' => $params['module']
		];
		$this->db->where('id', $params['id']);
		$query=$this->db->update('user_permission', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('user_permission');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}
