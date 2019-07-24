<?php
class KlasifikasiModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getTotalData() {
		$hasil=$this->db->count_all('klasifikasi');
		return $hasil;
	}

	public function getListKlasifikasi($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*,
				CONCAT(FORMAT(COALESCE(a.batas_bawah, 0),2,'de_DE'),' sd ',FORMAT(COALESCE(a.batas_atas, 0),2,'de_DE')) AS rentang 
			FROM klasifikasi a, 
			(SELECT @rownum := 0) r
			WHERE 
					a.keterangan LIKE '%".$params['search']."%' OR
					a.predikat LIKE '%".$params['search']."%'
			ORDER BY a.id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListKlasifikasiCount($params) {
		$sql="SELECT 
			@rownum := @rownum + 1 AS nomor,
			a.*,
			CONCAT(FORMAT(COALESCE(a.batas_bawah, 0),2,'de_DE'),' sd ',FORMAT(COALESCE(a.batas_atas, 0),2,'de_DE')) AS rentang 
		FROM klasifikasi a, 
		(SELECT @rownum := 0) r
		WHERE 
				a.keterangan LIKE '%".$params['search']."%' OR
				a.predikat LIKE '%".$params['search']."%'
				";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function create($params) {
		$query=$this->db->insert('klasifikasi', $params);
		return $query;
	}


	public function getListKlasifikasiById($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('klasifikasi');
		$row=$query->row();
		return $row;
	}

	public function update($params) {
		$data = [
			'batas_bawah' => $params['batas_bawah'],
			'batas_atas' => $params['batas_atas'],
			'keterangan' => $params['keterangan'],
			'predikat' => $params['predikat']
		];
			
		$this->db->where('id', $params['id']);
		$query=$this->db->update('klasifikasi', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('klasifikasi');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}
