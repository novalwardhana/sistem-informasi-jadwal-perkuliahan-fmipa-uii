<?php

class KhsKumulatif extends CI_Controller {

	private $khsKumulatifModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['KhsKumulatif'])) {
			redirect(base_url());
		}
		$this->load->library('session');
		$this->load->model('KhsKumulatifModel');
		$this->khsKumulatifModel=$this->KhsKumulatifModel;
	}

	public function index() {
		$data = array();
		$data['title'] = 'CPL - KHS Kumulatif List';
		$this->load->view('khsKumulatif/read', $data);
	}

	public function comboMahasiswa() {
		if (isset($_GET['q'])) {
			$search=$_GET['q'];
		} else {
			$search='';
		}
		$data = $this->khsKumulatifModel->comboMahasiswa($search);
		echo json_encode($data);
	}

	public function getListMahasiswaById() {
		$data=$this->khsKumulatifModel->getListMahasiswaById($_GET['id']);
		$data=array(
			"id" => $data->id,
			"nama" => $data->nama,
			"nim" => $data->nim,
			"semester" => $data->semester
		);
		echo json_encode($data);
	}

	public function getListNilai() {
		$columns = array( 
			0 =>'nomor', 
			1 => 'aksi',
			2 =>'semester', 
			3 =>'kode_mata_kuliah',
			4 => 'mata_kuliah',
			5 => 'nilai',
			6 => 'harkat'
		);

		if ($_POST['id_mahasiswa']==null || $_POST['id_mahasiswa']=='') {
			$id_mahasiswa=0;
		} else {
			$id_mahasiswa=$_POST['id_mahasiswa'];
		}

		//Get total data
		$totalData = $this->khsKumulatifModel->getTotalData($id_mahasiswa);

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

		$getListMahasiswa=$this->khsKumulatifModel->getListNilai($params);
		$totalFiltered=$this->khsKumulatifModel->getListNilaiCount($params);

		$data = array();
		if(!empty($getListMahasiswa)) {

			$data_harkat = $this->khsKumulatifModel->getListHarkat();

			foreach ($getListMahasiswa as $row) {

				$nestedData['nomor'] = " ";
				$nestedData['aksi'] = "
					<button class='btn btn-sm btn-danger' onclick='deletePeserta($row->id)'>
						<i class='fa fa-trash'></i>
					</button>
				";
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

	public function deleteKhs() {
		$id = $_POST['id_khs_kumulatif'];
		$hapus = $this->khsKumulatifModel->deleteKhs($id);
		if($hapus) {
			$json_data = array(
				'success' => true,
				'message' => 'Data berhasil di hapus'
			);
		} else {
			$json_data = array(
				'success' => false,
				'message' => 'Data tidak berhasil di hapus'
			);
		}
		echo json_encode($json_data);
	}

}
