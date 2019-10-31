<?php

class TahunAkademikModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getTotalData() {
		$hasil=$this->db->count_all('tahun_akademik');
		return $hasil;
	}

	public function getListTahunAkademik($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
			
		$sql="SELECT 
				a.*
			FROM tahun_akademik a
			WHERE a.tahun_mulai LIKE '%".$params['search']."%' OR
			a.tahun_selesai LIKE '%".$params['search']."%'
			ORDER BY a.id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListTahunAkademikCount($params) {

		$limit=(int)$params['limit'];
		$start=(int)$params['start'];

		$sql="SELECT 
				a.*
			FROM tahun_akademik a
			WHERE a.tahun_mulai LIKE '%".$params['search']."%' OR
			a.tahun_selesai LIKE '%".$params['search']."%'
			ORDER BY a.id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function create($params) {
		$query=$this->db->insert('tahun_akademik', $params);
		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function getListTahunAkademikById($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('tahun_akademik');
		$row=$query->row();
		return $row;
	}

	public function update($params) {
		$data = [
			'tahun_mulai' => $params['tahun_mulai'],
			'tahun_selesai' => $params['tahun_selesai'],
			'semester' => $params['semester'],
		];

		$this->db->where('id', $params['id']);
		$query=$this->db->update('tahun_akademik', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('tahun_akademik');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}
