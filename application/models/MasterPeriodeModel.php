<?php

class MasterPeriodeModel extends CI_Model {

    public function __construct() {
		parent::__construct();
	}

	public function getTotalData() {
		$hasil=$this->db->count_all('master_periode');
		return $hasil;
	}

	public function getListData($params) {
		$search = $this->db->escape_like_str($params['search']);
		$limit = (int)$params['limit'];
		$start = (int)$params['start'];

		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM master_periode a, 
			(SELECT @rownum := 0) r
			WHERE 
                a.tahun_akademik LIKE '%".$search."%' OR
				a.semester LIKE '%".$search."%'
			ORDER BY id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql, array($limit, $start));
		$hasil=$query->result();
		return $hasil;
	}

	public function getTotalFilteredData($params) {
		$search = $this->db->escape_like_str($params['search']);
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM master_periode a, 
			(SELECT @rownum := 0) r
			WHERE 
                a.tahun_akademik LIKE '%".$search."%' OR
				a.semester LIKE '%".$search."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function create($data) {
		$query=$this->db->insert('master_periode', $data);
		if (!$query) {
			return $this->db->error();
		}
		return $query;
	}

	public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('master_periode');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function getMasterPeriodeByID($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('master_periode');
		$row=$query->row();
		return $row;
	}

	public function update($params) {
		$data = [
			$this->db->escape_like_str($params['tahun_akademik']), 
			$this->db->escape_like_str($params['semester']), 
			$params['id']
		];
		$sql = "update master_periode set tahun_akademik = ?, semester = ? where id = ?";
		$query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}