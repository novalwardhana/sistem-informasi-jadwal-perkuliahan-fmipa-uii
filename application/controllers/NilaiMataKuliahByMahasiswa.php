<?php

class NilaiMataKuliahByMahasiswa extends CI_Controller {

	private $nilaiMatkulByMhsModel;
	private $id_mahasiswa;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['NilaiMataKuliahByMahasiswa'])) {
			redirect(base_url());
		}
		$this->id_mahasiswa = $this->session->userdata('id_mahasiswa');

		$this->load->library('session');

		$this->load->model('NilaiMataKuliahByMahasiswaModel');
		$this->nilaiMatkulByMhsModel=$this->NilaiMataKuliahByMahasiswaModel;
	}

	public function index() {
		if ($this->id_mahasiswa==null || $this->id_mahasiswa=='') {
			return $this->load->view('nilaiMataKuliahByMahasiswa/notFound');
		}

		$data_mahasiswa = $this->nilaiMatkulByMhsModel->getListMahasiswaById($this->id_mahasiswa);
		if ($data_mahasiswa==null) {
			return $this->load->view('nilaiMataKuliahByMahasiswa/notFound');
		}

		$data = array(
			'data_mahasiswa' => $data_mahasiswa,
			'title' => 'CPL - Laporan Nilai Mahasiswa'
		);
		$this->load->view('nilaiMataKuliahByMahasiswa/read', $data);
	}

	public function getListNilai() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'semester', 
			2 =>'kode_mata_kuliah',
			3=> 'mata_kuliah',
			4=> 'nilai',
			5=> 'harkat'
		);

		if ($_POST['id_mahasiswa']==null || $_POST['id_mahasiswa']=='') {
			$id_mahasiswa=0;
		} else {
			$id_mahasiswa=$_POST['id_mahasiswa'];
		}

		//Get total data
		$totalData = $this->nilaiMatkulByMhsModel->getTotalData($id_mahasiswa);

		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = 'id';
		$dir = 'desc';
		$search=$_POST['search']['value'];

		$params=array(
			'limit' => $limit,
			'start' => $start,
			'order' => $order,
			'dir' => $dir,
			'search' => $search,
			'id_mahasiswa' => $id_mahasiswa
		);

		$getListMahasiswa=$this->nilaiMatkulByMhsModel->getListNilai($params);
		$totalFiltered=count($getListMahasiswa);

		$data = array();
		if(!empty($getListMahasiswa)) {

			$data_harkat = $this->nilaiMatkulByMhsModel->getListHarkat();

			foreach ($getListMahasiswa as $row) {

				$nestedData['nomor'] = '';
				$nestedData['semester'] = $row->semester;
				$nestedData['kode_mata_kuliah'] = $row->kode_mata_kuliah;
				$nestedData['mata_kuliah'] = $row->mata_kuliah;
				$nestedData['nilai'] = $row->nilai;
				$nestedData['harkat'] = $data_harkat;
				
				$data[] = $nestedData;
			}
		}

		$json_data = array(
			"draw"            => intval($_POST['draw']),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
		);
	
		echo json_encode($json_data);
	}

}
