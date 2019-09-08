<?php

class JadwalPerkuliahanUploadNilaiModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getIdMahasiswa($nim) {
		$sql = "SELECT id FROM mahasiswa WHERE nim='".$nim."' ";
		$query = $this->db->query($sql);
		if ($query->num_rows()==1) {
			$hasil = $query->first_row()->id;
		} else {
			$hasil = FALSE;
		}
		return $hasil;
	}

	public function addMahasiswaPeserta($params) {
		$query=$this->db->insert('mahasiswa_peserta_mata_kuliah', $params);
		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
