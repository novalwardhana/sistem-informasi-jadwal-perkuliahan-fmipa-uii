<?php
class DosenPengampuModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getListMataKuliah() {
		$sql="SELECT 
				a.id, a.kode, a.nama, a.semester
			FROM mata_kuliah a
			ORDER BY a.semester ASC, a.nama ASC, a.id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result_array();
		return $hasil;
	}

	public function getListKelas() {
		$sql="SELECT 
				a.id, a.kode
			FROM kelas a
			ORDER BY a.kode ASC, a.id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result_array();
		return $hasil;
	}

	public function create($params) {
		$query=$this->db->insert('dosen_pengampu_mata_kuliah', $params);
		return $query;
	}

	public function getTotalData($id_dosen) {
		$hasil = $this->db->where('id_dosen',$id_dosen)->from("dosen_pengampu_mata_kuliah")->count_all_results();
		return $hasil;
	}

	public function getListDosen($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
			
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*,
				(SELECT COUNT(*) FROM dosen_pengampu_mata_kuliah b WHERE b.id_dosen=a.id) AS jumlah_mata_kuliah
			FROM dosen a, 
			(SELECT @rownum := 0) r
			WHERE a.nama LIKE '%".$params['search']."%' OR
				a.nik LIKE '%".$params['search']."%'
			ORDER BY id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListDosenCount($params) {
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.*,
				(SELECT COUNT(*) FROM dosen_pengampu_mata_kuliah b WHERE b.id_dosen=a.id) AS jumlah_mata_kuliah
			FROM dosen a, 
			(SELECT @rownum := 0) r
			WHERE a.nama LIKE '%".$params['search']."%' OR
				a.nik LIKE '%".$params['search']."%' ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function getListDosenPengampu($params) {
		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
		$id_dosen=(int)$params['id_dosen'];

		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.id,
				a.id_dosen,
				a.id_kelas,
				d.nik,
				d.nama AS dosen,
				b.kode as kode_mata_kuliah,
				b.nama as mata_kuliah,
				c.kode as kelas,
				a.jam_mulai,
				a.jam_selesai,
				a.ruang
			FROM dosen_pengampu_mata_kuliah a
			LEFT join mata_kuliah b on a.id_mata_kuliah=b.id
			LEFT join kelas c on a.id_kelas=c.id 
			LEFT join dosen d ON a.id_dosen=d.id,
			(SELECT @rownum := 0) r
			WHERE (a.id_dosen=$id_dosen) AND
			(b.kode like '%".$params['search']."%' OR
			b.nama like '%".$params['search']."%' OR
			c.kode like '%".$params['search']."%' OR
			a.jam_mulai like '%".$params['search']."%' OR
			a.jam_selesai like '%".$params['search']."%' OR
			a.ruang like '%".$params['search']."%'
			)
			ORDER BY id DESC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListDosenPengampuCount($params) {
		$id_dosen=(int)$params['id_dosen'];
		$sql="SELECT 
				@rownum := @rownum + 1 AS nomor,
				a.id,
				a.id_dosen,
				a.id_kelas,
				d.nik,
				d.nama AS dosen,
				b.kode as kode_mata_kuliah,
				b.nama as mata_kuliah,
				c.kode as kelas,
				a.jam_mulai,
				a.jam_selesai,
				a.ruang
			FROM dosen_pengampu_mata_kuliah a
			LEFT join mata_kuliah b on a.id_mata_kuliah=b.id
			LEFT join kelas c on a.id_kelas=c.id
			LEFT join dosen d ON a.id_dosen=d.id,
			(SELECT @rownum := 0) r
			WHERE (a.id_dosen=$id_dosen) AND
				(b.kode like '%".$params['search']."%' OR
				b.nama like '%".$params['search']."%' OR
				c.kode like '%".$params['search']."%' OR
				a.jam_mulai like '%".$params['search']."%' OR
				a.jam_selesai like '%".$params['search']."%' OR
				a.ruang like '%".$params['search']."%'
			)
			";

		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function delete($params) {
		$this->db->where('id', $params['id']);
		$query=$this->db->delete('dosen_pengampu_mata_kuliah');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function getDosenId($id) {
		$this->db->where('id', $id);
		$query=$this->db->get('dosen_pengampu_mata_kuliah');
		$row=$query->row();
		return $row;
	}

	public function getDosenPengampuById($id) {
		$sql="SELECT
				a.id,
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
				COALESCE(a.maks_peserta, 0) AS maks_peserta,
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
		$row=$query->first_row('array');
		return $row;
	}

	public function update($params) {
			$data = [
				'id_dosen' => $params['id_dosen'],
				'id_mata_kuliah' => $params['id_mata_kuliah'],
				'id_kelas' => $params['id_kelas'],
				'jam_mulai' => $params['jam_mulai'],
				'jam_selesai' => $params['jam_selesai'],
				'ruang' => $params['ruang'],
				'maks_peserta' => $params['maks_peserta'],
				'cpmk_1_kode' => $params['cpmk_1_kode'],
				'cpmk_1_persentase' => $params['cpmk_1_persentase'],
				'cpmk_1_keterangan' => $params['cpmk_1_keterangan'],
				'cpmk_2_kode' => $params['cpmk_2_kode'],
				'cpmk_2_persentase' => $params['cpmk_2_persentase'],
				'cpmk_2_keterangan' => $params['cpmk_2_keterangan'],
				'cpmk_3_kode' => $params['cpmk_3_kode'],
				'cpmk_3_persentase' => $params['cpmk_3_persentase'],
				'cpmk_3_keterangan' => $params['cpmk_3_keterangan'],
				'cpmk_4_kode' => $params['cpmk_4_kode'],
				'cpmk_4_persentase' => $params['cpmk_4_persentase'],
				'cpmk_4_keterangan' => $params['cpmk_4_keterangan'],
				'cpmk_5_kode' => $params['cpmk_5_kode'],
				'cpmk_5_persentase' => $params['cpmk_5_persentase'],
				'cpmk_5_keterangan' => $params['cpmk_5_keterangan'],
				'cpmk_6_kode' => $params['cpmk_6_kode'],
				'cpmk_6_persentase' => $params['cpmk_6_persentase'],
				'cpmk_6_keterangan' => $params['cpmk_6_keterangan'],
			];
		$this->db->where('id', $params['id']);
		$query=$this->db->update('dosen_pengampu_mata_kuliah', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}
