<?php

class PenawaranMataKuliahModel extends CI_Model {

    public function __construct() {
		parent::__construct();
	}

    public function getListPeriode() {
		$sql="SELECT 
				a.*,
                concat(a.tahun_akademik, ' | ', a.semester) as periode
			FROM master_periode a
			ORDER BY a.id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListPeriodeById($id_periode) {
		$this->db->where('id', $id_periode);
		$query=$this->db->get('master_periode');
		$row=$query->row();
		return $row;
	}

    public function getListProdi() {
		$sql="SELECT 
				a.id,
                concat(a.kode, ' - ', a.nama) as nama
			FROM master_prodi a
			ORDER BY a.id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListMataKuliah($idProdi) {
		$sql="SELECT 
				*
			FROM master_mata_kuliah a
			WHERE a.id_prodi = $idProdi
			ORDER BY a.id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListDosen($idProdi) {
		$sql="SELECT 
				*
			FROM master_dosen a
			ORDER BY a.id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListKelas() {
		$sql="SELECT 
				*
			FROM master_kelas a
			ORDER BY a.id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getTotalData($params) {
		$id_periode = (int)$params["id_periode"];

		$sql = "SELECT 
				@rownum := @rownum + 1 AS nomor,
				pmk.id,
				pmk.id_periode,
				concat(mp.tahun_akademik, ' | ', mp.semester) as periode,
				pmk.id_prodi,
				concat(mpi.kode, ' | ', mpi.nama) as prodi
			from penawaran_mata_kuliah pmk 
			inner join master_periode mp on pmk.id_periode = mp.id 
			inner join master_prodi mpi on pmk.id_prodi = mpi.id,
			(SELECT @rownum := 0) r
			WHERE
				pmk.id_Periode = $id_periode";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function getListData($params) {
		$id_periode = (int)$params["id_periode"];

		$sql = "SELECT 
				@rownum := @rownum + 1 AS nomor,
				pmk.id,
				pmk.id_periode,
				mp.tahun_akademik as periode,
				mp.semester,
				pmk.id_prodi,
				mpi.kode as kode_prodi,
				mpi.nama as prodi
			from penawaran_mata_kuliah pmk 
			inner join master_periode mp on pmk.id_periode = mp.id 
			inner join master_prodi mpi on pmk.id_prodi = mpi.id,
			(SELECT @rownum := 0) r
			WHERE
				pmk.id_Periode = $id_periode
			ORDER BY id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function create($params) {
        $data = [
            $params['id_periode'],
			$params['id_prodi'],
			""
		];
        $sql = "insert into penawaran_mata_kuliah (id_periode, id_prodi, deskripsi) values(?, ?, ?)";
        $query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
    }

	public function getProgramStudiByKode($kodeProdi) {
        $sql = "SELECT 
                id,
                kode,
				nama
            from master_prodi
            where kode = $kodeProdi";
        $query=$this->db->query($sql);
        $result=$query->row();
        return $result;
    }

	public function getPenawaranMataKuliahByPeriode($id_periode, $id_prodi) {
        $sql = "SELECT 
                id,
				id_periode,
				id_prodi
            from penawaran_mata_kuliah
            where id_periode = $id_periode and id_prodi = $id_prodi ";
        $query=$this->db->query($sql);
        $result=$query->row();
        return $result;
    }

	public function getMataKuliahByKode($id_prodi, $kode) {
		$sql = "SELECT 
				*
			FROM master_mata_kuliah
			where id_prodi = $id_prodi and kode = '$kode' ";
		$query=$this->db->query($sql);
        $result=$query->row();
        return $result;
	}
	
	public function getDosenByKode($kode) {
        $sql = "SELECT 
                *
            from master_dosen
            where nik = $kode";
        $query=$this->db->query($sql);
        $result=$query->row();
        return $result;
    }

	public function getKelasByKode($kode) {
        $sql = "SELECT 
                *
            from master_kelas
            where kode = '$kode'";
        $query=$this->db->query($sql);
        $result=$query->row();
        return $result;
    }

	public function insertMultiple($params) {
		$this->db->trans_begin();

		for ($i = 0; $i < count($params); $i++) {
			$param = [
				$params[$i]['id_penawaran_mata_kuliah'],
				$params[$i]['id_mata_kuliah'],
				$params[$i]['id_dosen'],
				$params[$i]['id_dosen_tim_1'],
				$params[$i]['id_dosen_tim_2'],
				$params[$i]['id_dosen_tim_3'],
				$params[$i]['id_kelas'],
				$params[$i]['kapasitas'],
			];
			$sql = "insert into penawaran_mata_kuliah_detail (id_penawaran_mata_kuliah, id_mata_kuliah, id_dosen, id_dosen_tim_1, id_dosen_tim_2, id_dosen_tim_3, id_kelas, kapasitas) values(?, ?, ?, ?, ?, ?, ?, ?)";
			$this->db->query($sql, $param);
		}

		if ($this->db->trans_status() === FALSE) {
			print_r($this->db->error());
        	$this->db->trans_rollback();
			return false;
		}
		$this->db->trans_commit();

		return true;
	}

	public function delete($params) {
        $data = [
            $params['id']
        ];
        $sql = "delete from penawaran_mata_kuliah where id = ?";
		$query=$this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function getDataByID($id) {

		$sql = "SELECT 
				pmk.id,
				pmk.id_periode,
				mp.tahun_akademik as periode,
				mp.semester,
				pmk.id_prodi,
				mpi.kode as kode_prodi,
				mpi.nama as prodi
			from penawaran_mata_kuliah pmk 
			inner join master_periode mp on pmk.id_periode = mp.id 
			inner join master_prodi mpi on pmk.id_prodi = mpi.id
			WHERE pmk.id = $id";
		$query = $this->db->query($sql);
		$hasil = $query->row();
		return $hasil;
	}

	public function addKontrakPenawaranMataKuliah($params) {
		$data = [
            $params['id_penawaran_mata_kuliah'],
			$params['id_mata_kuliah'],
			$params['id_dosen'],
			$params["id_dosen_tim_1"],
			$params["id_dosen_tim_2"],
			$params["id_dosen_tim_3"],
			$params['id_kelas'],
			$params['kapasitas'],
		];
		$sql = "insert into penawaran_mata_kuliah_detail (id_penawaran_mata_kuliah, id_mata_kuliah, id_dosen, id_dosen_tim_1, id_dosen_tim_2, id_dosen_tim_3, id_kelas, kapasitas) values(?, ?, ?, ?, ?, ?, ?, ?)";
		$query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function getTotalDataDetail($params) {
		$id_penawaran_mata_kuliah = (int)$params["id_penawaran_mata_kuliah"];

		$sql = "SELECT 
				pmkd.id,
				pmkd.id_penawaran_mata_kuliah,
				pmkd.id_mata_kuliah,
				mmk.kode as kode_mata_kuliah,
				mmk.nama as mata_kuliah,
				pmkd.id_dosen,
				md.nik as nik_dosen,
				md.nama as dosen,
				pmkd.id_dosen_tim_1,
				md_tim_1.nik as nik_dosen_tim_1,
				md_tim_1.nama as dosen_tim_1,
				pmkd.id_dosen_tim_2,
				md_tim_2.nik as nik_dosen_tim_2,
				md_tim_2.nama as dosen_tim_2,
				pmkd.id_kelas,
				mk.kode as kelas,
				pmkd.kapasitas
			FROM penawaran_mata_kuliah_detail pmkd
			left join master_mata_kuliah mmk on pmkd.id_mata_kuliah = mmk.id
			left join master_dosen md on pmkd.id_dosen = md.id 
			left join master_dosen md_tim_1 on pmkd.id_dosen_tim_1 = md_tim_1.id
			left join master_dosen md_tim_2 on pmkd.id_dosen_tim_2 = md_tim_2.id 
			left join master_kelas mk on pmkd.id_kelas = mk.id
			WHERE pmkd.id_penawaran_mata_kuliah = $id_penawaran_mata_kuliah ";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	public function getListDataDetail($params) {
		$id_penawaran_mata_kuliah = (int)$params["id_penawaran_mata_kuliah"];

		$sql = "SELECT 
				@rownum := @rownum + 1 AS nomor,
				pmkd.id,
				pmkd.id_penawaran_mata_kuliah,
				pmkd.id_mata_kuliah,
				mmk.kode as kode_mata_kuliah,
				mmk.nama as mata_kuliah,
				pmkd.id_dosen,
				md.nik as nik_dosen,
				md.nama as dosen,
				pmkd.id_dosen_tim_1,
				md_tim_1.nik as nik_dosen_tim_1,
				md_tim_1.nama as dosen_tim_1,
				pmkd.id_dosen_tim_2,
				md_tim_2.nik as nik_dosen_tim_2,
				md_tim_2.nama as dosen_tim_2,
				pmkd.id_dosen_tim_3,
				md_tim_3.nik as nik_dosen_tim_3,
				md_tim_3.nama as dosen_tim_3,
				pmkd.id_kelas,
				mk.kode as kelas,
				pmkd.kapasitas
			FROM penawaran_mata_kuliah_detail pmkd
			left join master_mata_kuliah mmk on pmkd.id_mata_kuliah = mmk.id
			left join master_dosen md on pmkd.id_dosen = md.id 
			left join master_dosen md_tim_1 on pmkd.id_dosen_tim_1 = md_tim_1.id
			left join master_dosen md_tim_2 on pmkd.id_dosen_tim_2 = md_tim_2.id 
			left join master_dosen md_tim_3 on pmkd.id_dosen_tim_3 = md_tim_3.id 
			left join master_kelas mk on pmkd.id_kelas = mk.id,
			(SELECT @rownum := 0) r
			WHERE pmkd.id_penawaran_mata_kuliah = $id_penawaran_mata_kuliah
			ORDER BY pmkd.id ASC";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function deleteDetail($params) {
		$data = [
            $params['id']
        ];
        $sql = "delete from penawaran_mata_kuliah_detail where id = ?";
		$query=$this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function editKontrakPenawaranMataKuliah($params) {
		$data = [
			$params['id_mata_kuliah'],
			$params['id_dosen'],
			$params["id_dosen_tim_1"],
			$params["id_dosen_tim_2"],
			$params["id_dosen_tim_3"],
			$params['id_kelas'],
			$params['kapasitas'],
			$params["id"],
		];
		$sql = "update penawaran_mata_kuliah_detail set id_mata_kuliah = ?, id_dosen = ?, id_dosen_tim_1 = ?, id_dosen_tim_2 = ?, id_dosen_tim_3 = ?, id_kelas = ?, kapasitas = ? where id = ?";
		$query = $this->db->query($sql, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

}