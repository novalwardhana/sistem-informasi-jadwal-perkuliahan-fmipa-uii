<?php

class MasterRuangModel extends CI_Model {

    public function __construct() {
		parent::__construct();
	}

    public function getTotalData() {
		$hasil=$this->db->count_all('master_ruang');
		return $hasil;
	}

    public function getListData($params) {
		$search = $this->db->escape_like_str($params['search']);
		$limit = (int)$params['limit'];
		$start = (int)$params['start'];

		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM master_ruang a, 
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
			FROM master_ruang a, 
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
			$this->db->escape_like_str($params['kapasitas']), 
		];
        $sql = "insert into master_ruang (kode, nama, kapasitas) values(?, ?, ?)";
        $query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function insertMultiple($params) {
		$this->db->trans_begin();


		for ($i = 0; $i < count($params); $i++) {
			$param = [
				$params[$i]['kode'],
				$params[$i]['nama'], 
				$params[$i]['kapasitas']
			];
			$sql = "insert into master_ruang (kode, nama, kapasitas) values(?, ?, ?)";
        	$this->db->query($sql, $param);
		}

		if ($this->db->trans_status() === FALSE) {
        	$this->db->trans_rollback();
			return false;
		}
		$this->db->trans_commit();

		return true;
	}

    public function delete($params) {
        $data = [
            $params['id']
        ];
        $sql = "delete from master_ruang where id = ?";
		$query=$this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

    public function getMasterRuangByID($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('master_ruang');
		$row=$query->row();
		return $row;
	}

    public function update($params) {
		$data = [
			$this->db->escape_like_str($params['kode']), 
			$this->db->escape_like_str($params['nama']), 
            $params['kapasitas'],
			$params['id']
		];
		$sql = "update master_ruang set kode = ?, nama = ?, kapasitas = ? where id = ?";
		$query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}
