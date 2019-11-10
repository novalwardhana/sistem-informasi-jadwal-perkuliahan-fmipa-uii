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
		$hasil1 = $this->db->where('id_mahasiswa',$id_mahasiswa)->from("mahasiswa_peserta_mata_kuliah")->count_all_results();
		$hasil2 = $this->db->where('id_mahasiswa',$id_mahasiswa)->from("khs_kumulatif")->count_all_results();
		$hasil = $hasil1 + $hasil2;
		return $hasil;
	}

	public function getListNilai($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
    $id_mahasiswa = (int)$params['id_mahasiswa'];
    
		$sql="SELECT nilai_matkul.semester, nilai_matkul.kode_mata_kuliah, nilai_matkul.mata_kuliah, max(nilai_matkul.nilai) AS nilai FROM (
			SELECT 
				d.semester,
				d.kode AS kode_mata_kuliah,
				d.nama AS mata_kuliah,
				max(COALESCE(a.nilai, 0)) as nilai
			FROM khs_kumulatif a
			LEFT join mahasiswa b on a.id_mahasiswa=b.id
			LEFT join mata_kuliah d ON a.id_mata_kuliah=d.id
			WHERE 
				a.id_mahasiswa=$id_mahasiswa AND 
				(
					d.nama like '%".$params['search']."%' OR
					d.kode like '%".$params['search']."%' OR
					b.semester like '%".$params['search']."%'
				)
			group by d.semester, d.kode, d.nama
		
			UNION
		
			SELECT 
				d.semester,
				d.kode AS kode_mata_kuliah,
				d.nama AS mata_kuliah,
				max(
					(COALESCE(a.cpmk_1_nilai, 0)*COALESCE(c.cpmk_1_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_2_nilai, 0)*COALESCE(c.cpmk_2_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_3_nilai, 0)*COALESCE(c.cpmk_3_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_4_nilai, 0)*COALESCE(c.cpmk_4_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_5_nilai, 0)*COALESCE(c.cpmk_5_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_6_nilai, 0)*COALESCE(c.cpmk_6_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_7_nilai, 0)*COALESCE(c.cpmk_7_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_8_nilai, 0)*COALESCE(c.cpmk_8_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_9_nilai, 0)*COALESCE(c.cpmk_9_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_10_nilai, 0)*COALESCE(c.cpmk_10_persentase, 0)/100)
				) AS nilai
			FROM mahasiswa_peserta_mata_kuliah a
			LEFT join mahasiswa b on a.id_mahasiswa=b.id
			LEFT join dosen_pengampu_mata_kuliah c ON a.id_dosen_pengampu_mata_kuliah=c.id
			LEFT join mata_kuliah d ON c.id_mata_kuliah=d.id
			WHERE 
				a.id_mahasiswa=$id_mahasiswa AND 
				(
					d.nama like '%".$params['search']."%' OR
					d.kode like '%".$params['search']."%' OR
					b.semester like '%".$params['search']."%'
				)
			group by d.semester, d.kode, d.nama
		) AS nilai_matkul
		group by nilai_matkul.semester, nilai_matkul.kode_mata_kuliah, nilai_matkul.mata_kuliah
		order by nilai_matkul.semester ASC, nilai_matkul.mata_kuliah ASC";

		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListNilaiCount($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		$id_mahasiswa = (int)$params['id_mahasiswa'];

		$sql="SELECT nilai_matkul.* FROM (
			SELECT 
				d.kode
			FROM khs_kumulatif a
			LEFT join mahasiswa b on a.id_mahasiswa=b.id
			LEFT join mata_kuliah d ON a.id_mata_kuliah=d.id
			WHERE 
				a.id_mahasiswa=$id_mahasiswa AND 
				(
					d.nama like '%".$params['search']."%' OR
					d.kode like '%".$params['search']."%' OR
					b.semester like '%".$params['search']."%'
				)
			group by d.semester, d.kode, d.nama
		
			UNION
		
			SELECT 
				d.kode
			FROM mahasiswa_peserta_mata_kuliah a
			LEFT join mahasiswa b on a.id_mahasiswa=b.id
			LEFT join dosen_pengampu_mata_kuliah c ON a.id_dosen_pengampu_mata_kuliah=c.id
			LEFT join mata_kuliah d ON c.id_mata_kuliah=d.id
			WHERE 
				a.id_mahasiswa=$id_mahasiswa AND 
				(
					d.nama like '%".$params['search']."%' OR
					d.kode like '%".$params['search']."%' OR
					b.semester like '%".$params['search']."%'
				)
			group by d.semester, d.kode, d.nama
		) AS nilai_matkul";

		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function getListHarkat() {
		$sql="SELECT batas_bawah, batas_atas, huruf from harkat order by batas_bawah asc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function cekDetailNilai($params) {
		$sql ="SELECT detail_nilai.* FROM
			(SELECT
				a.id,
				sum(
					(COALESCE(a.cpmk_1_nilai, 0)*COALESCE(b.cpmk_1_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_2_nilai, 0)*COALESCE(b.cpmk_2_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_3_nilai, 0)*COALESCE(b.cpmk_3_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_4_nilai, 0)*COALESCE(b.cpmk_4_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_5_nilai, 0)*COALESCE(b.cpmk_5_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_6_nilai, 0)*COALESCE(b.cpmk_6_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_7_nilai, 0)*COALESCE(b.cpmk_7_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_8_nilai, 0)*COALESCE(b.cpmk_8_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_9_nilai, 0)*COALESCE(b.cpmk_9_persentase, 0)/100)
					+
					(COALESCE(a.cpmk_10_nilai, 0)*COALESCE(b.cpmk_10_persentase, 0)/100)
				) as nilai
			FROM mahasiswa_peserta_mata_kuliah a
			INNER JOIN dosen_pengampu_mata_kuliah b ON a.id_dosen_pengampu_mata_kuliah = b.id
			INNER JOIN mata_kuliah c ON b.id_mata_kuliah = c.id
			WHERE a.id_mahasiswa = '".$params['id_mahasiswa']."' AND c.kode='".$params['kode_mata_kuliah']."'
			GROUP BY a.id
		) AS detail_nilai
		ORDER BY detail_nilai.nilai DESC ";
		$query=$this->db->query($sql);
		$row=$query->row();
		return $row;
	}

	public function detailNilai($id_mahasiswa_peserta_mata_kuliah) {
		$sql="SELECT
				a.id_mahasiswa,
				c.nama as mahasiswa_nama,
				c.nim  as mahasiswa_nim,
				c.semester as mahasiswa_semester,
				d.nama as mata_kuliah_nama,
				d.kode as mata_kuliah_kode,
				d.semester as mata_kuliah_semester,
				d.kontribusi as mata_kuliah_kontribusi,
				e.nik as dosen_nik,
				e.nama as dosen_nama,
				a.cpmk_1_nilai, b.cpmk_1_kode, b.cpmk_1_keterangan, b.cpmk_1_persentase,
				a.cpmk_2_nilai, b.cpmk_2_kode, b.cpmk_2_keterangan, b.cpmk_2_persentase,
				a.cpmk_3_nilai, b.cpmk_3_kode, b.cpmk_3_keterangan, b.cpmk_3_persentase,
				a.cpmk_4_nilai, b.cpmk_4_kode, b.cpmk_4_keterangan, b.cpmk_4_persentase,
				a.cpmk_5_nilai, b.cpmk_5_kode, b.cpmk_5_keterangan, b.cpmk_5_persentase,
				a.cpmk_6_nilai, b.cpmk_6_kode, b.cpmk_6_keterangan, b.cpmk_6_persentase,
				a.cpmk_7_nilai, b.cpmk_7_kode, b.cpmk_7_keterangan, b.cpmk_7_persentase,
				a.cpmk_8_nilai, b.cpmk_8_kode, b.cpmk_8_keterangan, b.cpmk_8_persentase,
				a.cpmk_9_nilai, b.cpmk_9_kode, b.cpmk_9_keterangan, b.cpmk_9_persentase,
				a.cpmk_10_nilai, b.cpmk_10_kode, b.cpmk_10_keterangan, b.cpmk_10_persentase
			FROM mahasiswa_peserta_mata_kuliah a
			LEFT JOIN dosen_pengampu_mata_kuliah b ON a.id_dosen_pengampu_mata_kuliah=b.id
			LEFT JOIN mahasiswa c ON a.id_mahasiswa=c.id
			LEFT JOIN mata_kuliah d ON b.id_mata_kuliah=d.id
			LEFT JOIN dosen e ON b.id_dosen=e.id
			WHERE a.id='".$id_mahasiswa_peserta_mata_kuliah."'
			";
		$query=$this->db->query($sql);
		$row=$query->row();
		return $row;
	}

	public function detailNilaiNonSB($params) {
		$sql="SELECT
				a.id_mahasiswa,
				b.nama as mahasiswa_nama,
				b.nim  as mahasiswa_nim,
				b.semester as mahasiswa_semester,
				c.nama as mata_kuliah_nama,
				c.kode as mata_kuliah_kode,
				c.semester as mata_kuliah_semester,
				c.kontribusi as mata_kuliah_kontribusi,
				a.nilai as nilai
			FROM khs_kumulatif a
			LEFT JOIN mahasiswa b ON a.id_mahasiswa=b.id
			LEFT JOIN mata_kuliah c ON a.id_mata_kuliah=c.id
			WHERE a.id_mahasiswa='".$params['id_mahasiswa']."' AND c.kode='".$params['kode_mata_kuliah']."'
			ORDER BY a.nilai DESC";
		$query=$this->db->query($sql);
		$row=$query->row();
		return $row;
	}

}
