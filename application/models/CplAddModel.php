<?php

class CplAddModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/*
		Used in function Controlller getListMataKuliah
	*/
	public function getListCplDetailId() {
		$this->db->select('id_mata_kuliah');
		$this->db->from('capaian_pembelajaran_lulusan_temp');
		$query = $this->db->get();
		$hasil =$query->result('array');
		
		$data=array();
		$data[]=0;
		foreach($hasil as $value) {
			$data[] = (int) $value['id_mata_kuliah'];
		}

		return $data;
	}

	public function getTotalDataMataKuliah() {
		$dataCpl = $this->getListCplDetailId();
		$hasil = $this->db->where_not_in('id',$dataCpl)->from("mata_kuliah")->count_all_results();
		return $hasil;
	}

	public function getListMataKuliah($params) {
		$dataCpl = $this->getListCplDetailId();
		$dataCpl = implode( ',', $dataCpl );

		$limit=(int)$params['limit'];
		$start=(int)$params['start'];
			
		$sql="SELECT 
				a.*
			FROM mata_kuliah a
			WHERE 
				(a.nama LIKE '%".$params['search']."%' OR
				a.kode LIKE '%".$params['search']."%') AND
				a.id NOT IN ($dataCpl)
			ORDER BY a.semester ASC, a.nama ASC
			LIMIT $limit OFFSET $start ";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	public function getListMataKuliahCount($params) {
		$dataCpl = $this->getListCplDetailId();
		$dataCpl = implode( ',', $dataCpl );

		$sql="SELECT
				a.id
			FROM mata_kuliah a
			WHERE 
				(a.nama LIKE '%".$params['search']."%' OR
				a.kode LIKE '%".$params['search']."%') AND
				a.id NOT IN ($dataCpl)
			";
		$query=$this->db->query($sql);
		$hasil=$query->num_rows();
		return $hasil;
	}

	/*
		Used in function Controlller addCplDetail
	*/
	public function addCplDetail($params) {
		$query=$this->db->insert('capaian_pembelajaran_lulusan_temp', $params);
		return $query;
	}

	/*
		Used in function Controlller getListCplDetail
	*/
	public function getTotalDataCplDetail() {
		$hasil=$this->db->count_all('capaian_pembelajaran_lulusan_temp');
		return $hasil;
	}

	public function getListCplDetail($params) {
		$sql="SELECT
				a.id,
				a.id_mata_kuliah,
				b.kode,
				b.nama,
				b.semester,
				b.kontribusi AS sks
			FROM capaian_pembelajaran_lulusan_temp a
			LEFT JOIN mata_kuliah b ON a.id_mata_kuliah=b.id
			WHERE b.kode like '%".$params['search']."%' OR
				b.nama like '%".$params['search']."%' OR
				b.semester like '%".$params['search']."%' OR
				b.kontribusi like '%".$params['search']."%'
			ORDER BY a.id DESC
		";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}

	/*
		Used in function Controlller deleteCplDetail
	*/
	public function deleteCplDetail($id) {
		$this->db->where('id', $id);
		$query=$this->db->delete('capaian_pembelajaran_lulusan_temp');

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	/*
		Used in function Controlller simpanCpl
	*/
	public function simpanCpl($params) {
		$query=$this->db->insert('capaian_pembelajaran_lulusan', $params);
		$id_cpl = $this->db->insert_id();
		return $id_cpl;
	}

	public function simpanCplDetail($params) {
		$query=$this->db->insert('capaian_pembelajaran_lulusan_detail', $params);
		return $query;
	}



	
}
