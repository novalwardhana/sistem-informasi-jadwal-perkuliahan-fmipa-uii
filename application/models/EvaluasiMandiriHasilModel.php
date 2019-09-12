<?php

class EvaluasiMandiriHasilModel extends CI_Model {

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

	public function getListCpl($id_mahasiswa, $cpl) {

		$sql = "SELECT
					cpl.nama AS nama_cpl,
					cpl.deskripsi AS deskripsi,
					mk.kode AS mk_kode,
					mk.nama AS mk_nama,
					mk.kontribusi AS mk_sks,
					CAST(COALESCE(capaian.nilai_max, 0) AS DECIMAL(6,2)) as capaian_nilai_max,
					COALESCE(cpld.kontribusi, 0) AS cpld_kontribusi
				FROM capaian_pembelajaran_lulusan_detail AS cpld
				INNER JOIN capaian_pembelajaran_lulusan AS cpl ON cpld.id_capaian_pembelajaran_lulusan=cpl.id
				LEFT JOIN mata_kuliah AS mk ON cpld.id_mata_kuliah=mk.id
				LEFT JOIN (
					SELECT
						dpmk.id_mata_kuliah,
						max(
							(COALESCE(mpmk.cpmk_1_nilai, 0)*COALESCE(dpmk.cpmk_1_persentase, 0)/100)
							+
							(COALESCE(mpmk.cpmk_2_nilai, 0)*COALESCE(dpmk.cpmk_2_persentase, 0)/100)
							+
							(COALESCE(mpmk.cpmk_3_nilai, 0)*COALESCE(dpmk.cpmk_3_persentase, 0)/100)
							+
							(COALESCE(mpmk.cpmk_4_nilai, 0)*COALESCE(dpmk.cpmk_4_persentase, 0)/100)
							+
							(COALESCE(mpmk.cpmk_5_nilai, 0)*COALESCE(dpmk.cpmk_5_persentase, 0)/100)
							+
							(COALESCE(mpmk.cpmk_6_nilai, 0)*COALESCE(dpmk.cpmk_6_persentase, 0)/100)
							+
							(COALESCE(mpmk.cpmk_7_nilai, 0)*COALESCE(dpmk.cpmk_7_persentase, 0)/100)
							+
							(COALESCE(mpmk.cpmk_8_nilai, 0)*COALESCE(dpmk.cpmk_8_persentase, 0)/100)
							+
							(COALESCE(mpmk.cpmk_9_nilai, 0)*COALESCE(dpmk.cpmk_9_persentase, 0)/100)
							+
							(COALESCE(mpmk.cpmk_10_nilai, 0)*COALESCE(dpmk.cpmk_10_persentase, 0)/100)
						) AS nilai_max
					FROM mahasiswa_peserta_mata_kuliah mpmk
					INNER JOIN dosen_pengampu_mata_kuliah dpmk ON mpmk.id_dosen_pengampu_mata_kuliah=dpmk.id
					WHERE mpmk.id_mahasiswa=$id_mahasiswa
					GROUP BY dpmk.id_mata_kuliah
				) AS capaian ON cpld.id_mata_kuliah=capaian.id_mata_kuliah
				WHERE cpl.nama='".$cpl."'
			";

		$query = $this->db->query($sql);
		$hasil = $query->result_array();
		return $hasil;
	}

	public function getListHarkat() {
		$sql="SELECT batas_bawah, batas_atas, huruf, harkat from harkat order by batas_bawah asc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getSkorMaks($semester) {
		$sql="SELECT * from skor_maks_per_semester WHERE semester=$semester ";
		$query=$this->db->query($sql);
		$row=$query->first_row('array');
		return $row;
	}

}
