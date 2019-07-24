<?php
class MahasiswaModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function create($params) {
		$query=$this->db->insert('mahasiswa', $params);
		return $query;
	}

	public function getTotalData() {
		$hasil=$this->db->count_all('mahasiswa');
		return $hasil;
	}

	public function getListMahasiswa($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM mahasiswa a, 
			(SELECT @rownum := 0) r
			WHERE a.nama LIKE '%".$params['search']."%' OR
				a.nim LIKE '%".$params['search']."%'
			ORDER BY a.id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListMahasiswaCount($params) {
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM mahasiswa a, 
			(SELECT @rownum := 0) r
			WHERE a.nama LIKE '%".$params['search']."%' OR
				a.nim LIKE '%".$params['search']."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function getListMahasiswaById($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('mahasiswa');
		$row=$query->row();
		return $row;
	}

	public function update($params) {
		$data = [
			'nama' => $params['nama'],
			'nim' => $params['nim'],
			'semester' => $params['semester']
		];
			
		$this->db->where('id', $params['id']);
		$query=$this->db->update('mahasiswa', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('mahasiswa');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}
