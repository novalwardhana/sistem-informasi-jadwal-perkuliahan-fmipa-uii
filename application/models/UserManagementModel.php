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

}
