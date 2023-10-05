<?php

class MasterProdiModel extends CI_Model {

    public function __construct() {
		parent::__construct();
	}

    public function getTotalData() {
		$hasil=$this->db->count_all('master_prodi');
		return $hasil;
	}

    public function getListData($params) {
		$search = $this->db->escape_like_str($params['search']);
		$limit = (int)$params['limit'];
		$start = (int)$params['start'];

		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM master_prodi a, 
			(SELECT @rownum := 0) r
			WHERE 
                a.kode LIKE '%".$search."%' OR
				a.nama LIKE '%".$search."%'
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
			FROM master_prodi a, 
			(SELECT @rownum := 0) r
			WHERE 
                a.kode LIKE '%".$search."%' OR
				a.nama LIKE '%".$search."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

    public function create($params) {
        $data = [
			$this->db->escape_like_str($params['kode']), 
			$this->db->escape_like_str($params['nama']), 
			$this->db->escape_like_str($params['kode_warna_bagan']), 
		];
        $sql = "insert into master_prodi (kode, nama, kode_warna_bagan) values(?, ?, ?)";
        $query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

    public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('master_prodi');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

    public function getMasterProdiByID($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('master_prodi');
		$row=$query->row();
		return $row;
	}

    public function update($params) {
		$data = [
			$this->db->escape_like_str($params['kode']), 
			$this->db->escape_like_str($params['nama']), 
            $this->db->escape_like_str($params['kode_warna_bagan']), 
			$params['id']
		];
		$sql = "update master_prodi set kode = ?, nama = ?, kode_warna_bagan = ? where id = ?";
		$query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}


}