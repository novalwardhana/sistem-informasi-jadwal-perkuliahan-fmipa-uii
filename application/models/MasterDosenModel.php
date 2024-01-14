<?php

class MasterDosenModel extends CI_Model {

    public function __construct() {
		parent::__construct();
	}

    public function getTotalData() {
		$hasil=$this->db->count_all('master_dosen');
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
			FROM master_dosen a
            inner join master_prodi mp on a.id_prodi = mp.id, 
			(SELECT @rownum := 0) r
			WHERE 
                mp.nama LIKE '%".$search."%' OR
                a.nik LIKE '%".$search."%' OR
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
			FROM master_dosen a
            inner join master_prodi mp on a.id_prodi = mp.id, 
			(SELECT @rownum := 0) r
			WHERE 
                mp.nama LIKE '%".$search."%' OR
                a.nik LIKE '%".$search."%' OR
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
			$this->db->escape_like_str($params['nik']), 
			$this->db->escape_like_str($params['nama'])
		];
        $sql = "insert into master_dosen (id_prodi, nik, nama) values(?, ?, ?)";
        $query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
    }

	public function getProgramStudiByKode($kodeProdi) {
        $sql = "SELECT 
                id,
                kode,
				nama
            from master_prodi
            where kode = '$kodeProdi' ";
        $query=$this->db->query($sql);
        $result=$query->row();
        return $result;
    }

	public function insertMultiple($params) {
		$this->db->trans_begin();
		for ($i = 0; $i < count($params); $i++) {
			$param = [
				$params[$i]['id_program_studi'],
				$params[$i]['nik'], 
				$params[$i]['nama']
			];
			$sql = "insert into master_dosen (id_prodi, nik, nama) values(?, ?, ?)";
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
        $sql = "delete from master_dosen where id = ?";
		$query=$this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

    public function getMasterDosenByID($id) {
        $this->db->where('id', $id);
		$query=$this->db->get('master_dosen');
		$row=$query->row();
		return $row;
    }

    public function update($params) {
		$data = [
            $params['id_prodi'],
			$this->db->escape_like_str($params['nik']), 
			$this->db->escape_like_str($params['nama']), 
			$params['id']
		];
		$sql = "update master_dosen set id_prodi = ?, nik = ?, nama = ? where id = ?";
		$query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}


}