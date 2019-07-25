<?php

class JadwalPerkuliahanExportModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getListDosenPengampuById($id) {
		$sql="SELECT
				a.id AS id_dosen_pengampu_mata_kuliah,
				a.id_dosen,
				a.id_mata_kuliah,
				a.id_kelas,
				d.nik,
				d.nama AS dosen,
				b.kode as kode_mata_kuliah,
				b.nama as mata_kuliah,
				c.kode as kelas,
				a.jam_mulai,
				a.jam_selesai,
				a.ruang,
				a.maks_peserta,
				a.cpmk_1_kode,
				COALESCE(a.cpmk_1_persentase, 0) AS cpmk_1_persentase,
				a.cpmk_1_keterangan,
				a.cpmk_2_kode,
				COALESCE(a.cpmk_2_persentase, 0) AS cpmk_2_persentase,
				a.cpmk_2_keterangan,
				a.cpmk_3_kode,
				COALESCE(a.cpmk_3_persentase, 0) AS cpmk_3_persentase,
				a.cpmk_3_keterangan,
				a.cpmk_4_kode,
				COALESCE(a.cpmk_4_persentase, 0) AS cpmk_4_persentase,
				a.cpmk_4_keterangan,
				a.cpmk_5_kode,
				COALESCE(a.cpmk_5_persentase, 0) AS cpmk_5_persentase,
				a.cpmk_5_keterangan,
				a.cpmk_6_kode,
				COALESCE(a.cpmk_6_persentase, 0) AS cpmk_6_persentase,
				a.cpmk_6_keterangan
			FROM dosen_pengampu_mata_kuliah a
			LEFT join mata_kuliah b on a.id_mata_kuliah=b.id
			LEFT join kelas c on a.id_kelas=c.id
			LEFT join dosen d ON a.id_dosen=d.id
			WHERE a.id=$id
			";
		$query=$this->db->query($sql);
		$row=$query->first_row();
		return $row;
	}

	public function getListPeserta($id) {
		$id_dosen_pengampu_mata_kuliah = (int)$id;

		$sql="SELECT 
				a.id,
				a.id_dosen_pengampu_mata_kuliah,
				a.id_mahasiswa,
				a.cpmk_1_nilai,a.cpmk_2_nilai,a.cpmk_3_nilai,a.cpmk_4_nilai,a.cpmk_5_nilai,a.cpmk_6_nilai,
				b.nama AS mahasiswa,
				b.nim, 
				b.semester
			FROM mahasiswa_peserta_mata_kuliah a
			LEFT join mahasiswa b on a.id_mahasiswa=b.id
			WHERE 
				a.id_dosen_pengampu_mata_kuliah=$id_dosen_pengampu_mata_kuliah    
			ORDER BY b.nim ASC, b.nama ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result_array();
		
		return $hasil;
	}

	public function getListHarkat() {
		$sql="SELECT batas_bawah, batas_atas, huruf from harkat order by batas_bawah asc";
		$query = $this->db->query($sql);

		return $query->result_array();
	}

}
