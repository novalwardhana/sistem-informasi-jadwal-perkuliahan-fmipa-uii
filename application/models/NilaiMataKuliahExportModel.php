<?php
class NilaiMataKuliahExportModel extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function getListMahasiswaById($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('mahasiswa');
		$row=$query->row();
		return $row;
	}


	public function getListNilai($id_mahasiswa) {
    $id_mahasiswa = (int)$id_mahasiswa;
    
    $sql="SELECT 
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
        ) AS nilai
      FROM mahasiswa_peserta_mata_kuliah a
      LEFT join mahasiswa b on a.id_mahasiswa=b.id
      LEFT join dosen_pengampu_mata_kuliah c ON a.id_dosen_pengampu_mata_kuliah=c.id
      LEFT join mata_kuliah d ON c.id_mata_kuliah=d.id
      WHERE 
        a.id_mahasiswa=$id_mahasiswa
      group by d.semester, d.kode, d.nama
      ORDER BY d.semester ASC, d.nama ASC
      ";

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