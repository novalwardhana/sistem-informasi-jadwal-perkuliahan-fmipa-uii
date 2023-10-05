<?php

class RuangModel extends CI_Model {

    public function __construct() {
		parent::__construct();
	}

    public function getTotalData() {
		$hasil=$this->db->count_all('ruang');
		return $hasil;
	}

    public function getListRuang($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM ruang a, 
			(SELECT @rownum := 0) r
			WHERE 
                a.kode LIKE '%".$params['search']."%' OR
				a.nama LIKE '%".$params['search']."%'
			ORDER BY id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

    public function getListRuangCount($params) {
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM ruang a, 
			(SELECT @rownum := 0) r
			WHERE 
                a.kode LIKE '%".$params['search']."%' OR
				a.nama LIKE '%".$params['search']."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

    public function create($params) {
		$query=$this->db->insert('ruang', $params);
		return $query;
	}

    public function update($params) {
		$data = [
			'kode' => $params['kode'],
			'nama' => $params['nama'],
            'kapasitas' => $params['kapasitas'],
		];
			
		$this->db->where('id', $params['id']);
		$query=$this->db->update('ruang', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

    public function getListRuangByID($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('ruang');
		$row=$query->row();
		return $row;
	}

    public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('ruang');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}