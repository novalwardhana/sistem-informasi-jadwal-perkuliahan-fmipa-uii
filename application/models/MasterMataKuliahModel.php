<?php

class MasterMataKuliahModel extends CI_Model {

    public function __construct() {
		parent::__construct();
	}

    public function getTotalData() {
		$hasil=$this->db->count_all('master_mata_kuliah');
		return $hasil;
	}

    public function getListData($params) {
		$search = $this->db->escape_like_str($params['search']);
		$limit = (int)$params['limit'];
		$start = (int)$params['start'];

		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*,
                mp.nama as prodi
			FROM master_mata_kuliah a
            inner join master_prodi mp on a.id_prodi = mp.id, 
			(SELECT @rownum := 0) r
			WHERE 
                mp.nama LIKE '%".$search."%' OR
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
				a.*,
                mp.nama as prodi
			FROM master_mata_kuliah a
            inner join master_prodi mp on a.id_prodi = mp.id, 
			(SELECT @rownum := 0) r
			WHERE 
                mp.nama LIKE '%".$search."%' OR
                a.kode LIKE '%".$search."%' OR
				a.nama LIKE '%".$search."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

    public function getListProdi() {
		$sql="SELECT 
				a.id,
                concat(a.kode, ' - ', a.nama) as nama
			FROM master_prodi a
			ORDER BY a.id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

    public function create($params) {
        $data = [
            $params['id_prodi'],
			$this->db->escape_like_str($params['kode']), 
			$this->db->escape_like_str($params['nama']), 
			$params['semester'],
            $params['kontribusi_sks'],
		];
        $sql = "insert into master_mata_kuliah (id_prodi, kode, nama, semester, kontribusi_sks) values(?, ?, ?, ?, ?)";
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
        $sql = "delete from master_mata_kuliah where id = ?";
		$query=$this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

    public function getMasterMataKuliahByID($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('master_mata_kuliah');
		$row=$query->row();
		return $row;
	}

    public function update($params) {
		$data = [
            $params['id_prodi'],
			$this->db->escape_like_str($params['kode']), 
			$this->db->escape_like_str($params['nama']), 
            $params['semester'],
			$params['kontribusi_sks'],
            $params['id']
		];
		$sql = "update master_mata_kuliah set id_prodi = ?, kode = ?, nama = ?, semester = ?, kontribusi_sks = ? where id = ?";
		$query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}