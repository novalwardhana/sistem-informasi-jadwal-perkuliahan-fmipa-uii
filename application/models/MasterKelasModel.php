<?php

class MasterKelasModel extends CI_Model {

    public function __construct() {
		parent::__construct();
	}

    public function getTotalData() {
		$hasil=$this->db->count_all('master_kelas');
		return $hasil;
	}

    public function getListData($params) {
		$search = $this->db->escape_like_str($params['search']);
		$limit = (int)$params['limit'];
		$start = (int)$params['start'];

		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM master_kelas a, 
			(SELECT @rownum := 0) r
			WHERE 
                a.kode LIKE '%".$search."%'
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
			FROM master_kelas a, 
			(SELECT @rownum := 0) r
			WHERE 
                a.kode LIKE '%".$search."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

    public function create($params) {
        $data = [
			$this->db->escape_like_str($params['kode']),
		];
        $sql = "insert into master_kelas (kode) values(?)";
		$query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

    public function delete($params) {
        $data = [
            $params['id']
        ];
        $sql = "delete from master_kelas where id = ?";
		$query=$this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

    public function getMasterKelasByID($id) {
        $this->db->where('id', $id);
		$query=$this->db->get('master_kelas');
		$row=$query->row();
		return $row;
    }

    public function update($params) {
		$data = [
			$this->db->escape_like_str($params['kode']), 
			$params['id']
		];
		$sql = "update master_kelas set kode = ? where id = ?";
		$query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}