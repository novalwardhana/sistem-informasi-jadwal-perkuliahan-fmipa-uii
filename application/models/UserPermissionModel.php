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
		$hasil=$query->result();
		return $hasil;
	}

}
