<?php
class DashboardModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getTotalDosen() {
		$total = $this->db->query('SELECT * FROM master_dosen')->num_rows();
		return $total;
	}

	public function getTotalMataKuliah() {
		$total = $this->db->query('SELECT * FROM master_mata_kuliah')->num_rows();
		return $total;
	}

	public function getTotalRuang() {
		$total = $this->db->query('SELECT * FROM master_ruang')->num_rows();
		return $total;
	}

	public function getTotalKelas() {
		$total = $this->db->query('SELECT * FROM master_kelas')->num_rows();
		return $total;
	}

}
