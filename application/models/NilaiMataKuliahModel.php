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

	public function getListNilai($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		$id_mahasiswa = (int)$params['id_mahasiswa'];

		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.id,
				d.semester,
				d.kode AS kode_mata_kuliah,
				d.nama AS mata_kuliah
			FROM mahasiswa_peserta_mata_kuliah a
			LEFT join mahasiswa b on a.id_mahasiswa=b.id
			LEFT join dosen_pengampu_mata_kuliah c ON a.id_dosen_pengampu_mata_kuliah=c.id
			LEFT join mata_kuliah d ON c.id_mata_kuliah=d.id,
			(SELECT @rownum := 0) r
			WHERE 
				a.id_mahasiswa=$id_mahasiswa AND 
				(
					d.nama like '%".$params['search']."%' OR
					d.kode like '%".$params['search']."%' OR
					b.semester like '%".$params['search']."%'
				)
			ORDER BY d.semester ASC, d.nama ASC";

		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListNilaiCount($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		$id_mahasiswa = (int)$params['id_mahasiswa'];

		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.id,
				d.semester,
				d.kode AS kode_mata_kuliah,
				d.nama AS mata_kuliah
			FROM mahasiswa_peserta_mata_kuliah a
			LEFT join mahasiswa b on a.id_mahasiswa=b.id
			LEFT join dosen_pengampu_mata_kuliah c ON a.id_dosen_pengampu_mata_kuliah=c.id
			LEFT join mata_kuliah d ON c.id_mata_kuliah=d.id,
			(SELECT @rownum := 0) r
			WHERE 
				a.id_mahasiswa=$id_mahasiswa AND 
				(
					d.nama like '%".$params['search']."%' OR
					d.kode like '%".$params['search']."%' OR
					b.semester like '%".$params['search']."%'
				)
			ORDER BY d.semester ASC, d.nama ASC";

		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

}
