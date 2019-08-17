<?php
class SkorMaksModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getTotalData() {
		$hasil=$this->db->count_all('skor_maks_per_semester');
		return $hasil;
	}

	public function getListSkorMaks($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
			
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM skor_maks_per_semester a, 
			(SELECT @rownum := 0) r
			WHERE a.semester LIKE '%".$params['search']."%'
			ORDER BY a.id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListSkorMaksCount($params) {
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*
			FROM skor_maks_per_semester a, 
			(SELECT @rownum := 0) r
			WHERE a.semester LIKE '%".$params['search']."%'
			";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function create($params) {
		//$query=$this->db->insert('skor_maks_per_semester', $params);
		$sql ="INSERT INTO skor_maks_per_semester (semester, skor_maks_cpl_1, skor_maks_cpl_2, skor_maks_cpl_3, skor_maks_cpl_4, skor_maks_cpl_5, skor_maks_cpl_6, skor_maks_cpl_7, skor_maks_cpl_8, skor_maks_cpl_9) VALUES(
			'".$params['semester']."',
			'".$params['skor_maks_cpl_1']."',
			'".$params['skor_maks_cpl_2']."',
			'".$params['skor_maks_cpl_3']."',
			'".$params['skor_maks_cpl_4']."',
			'".$params['skor_maks_cpl_5']."',
			'".$params['skor_maks_cpl_6']."',
			'".$params['skor_maks_cpl_7']."',
			'".$params['skor_maks_cpl_8']."',
			'".$params['skor_maks_cpl_9']."'
			)";
		$query = $this->db->query($sql);
		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function getListSkorMaksById($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('skor_maks_per_semester');
		$row=$query->row();
		return $row;
	}

	public function update($params) {
		$data = [
			'semester' => $params['semester'],
			'skor_maks_cpl_1' => $params['skor_maks_cpl_1'],
			'skor_maks_cpl_2' => $params['skor_maks_cpl_2'],
			'skor_maks_cpl_3' => $params['skor_maks_cpl_3'],
			'skor_maks_cpl_4' => $params['skor_maks_cpl_4'],
			'skor_maks_cpl_5' => $params['skor_maks_cpl_5'],
			'skor_maks_cpl_6' => $params['skor_maks_cpl_6'],
			'skor_maks_cpl_7' => $params['skor_maks_cpl_7'],
			'skor_maks_cpl_8' => $params['skor_maks_cpl_8'],
			'skor_maks_cpl_9' => $params['skor_maks_cpl_9'],
		];
			
		$this->db->where('id', $params['id']);
		$query=$this->db->update('skor_maks_per_semester', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('skor_maks_per_semester');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}
