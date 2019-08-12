<?php

class CplEditModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/*
		Used in function Controlller getListCplDetail
	*/
	public function getTotalDataCplDetail($id) {
		$hasil = $this->db->where('id_capaian_pembelajaran_lulusan',$id)->from("capaian_pembelajaran_lulusan_detail")->count_all_results();
		return $hasil;
	}

	public function getListCplDetail($params) {
		$id = (int) $params['id'];
		$sql="SELECT
				a.id,
				a.id_mata_kuliah,
				b.kode,
				b.nama,
				b.semester,
				b.kontribusi AS sks,
				a.kontribusi
			FROM capaian_pembelajaran_lulusan_detail a
			LEFT JOIN mata_kuliah b ON a.id_mata_kuliah=b.id
			WHERE 
				(b.kode like '%".$params['search']."%' OR
				b.nama like '%".$params['search']."%' OR
				b.semester like '%".$params['search']."%' OR
				b.kontribusi like '%".$params['search']."%')
				AND
				a.id_capaian_pembelajaran_lulusan = $id
			ORDER BY a.id DESC
		";
		$query=$this->db->query($sql);
		$hasil=$query->result();
		return $hasil;
	}
	
}
