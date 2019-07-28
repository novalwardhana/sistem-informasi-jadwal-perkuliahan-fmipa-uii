<?php
class NilaiMataKuliahModel extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function comboMahasiswa($search) {
		$sql="SELECT 
				a.id,
				CONCAT(a.nim,' - ',a.nama) AS name
			FROM mahasiswa a
			WHERE a.nama LIKE '%".$search."%' OR
				a.nim LIKE '%".$search."%'
			ORDER BY a.nama ASC, a.nim ASC
			LIMIT 20
			";
		$query=$this->db->query($sql);
		$hasil=$query->result_array();
		return $hasil;
	}

	public function getListMahasiswaById($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('mahasiswa');
		$row=$query->row();
		return $row;
	}

	public function getTotalData($id_mahasiswa) {
		$hasil = $this->db->where('id_mahasiswa',$id_mahasiswa)->from("mahasiswa_peserta_mata_kuliah")->count_all_results();
		return $hasil;
	}

}
