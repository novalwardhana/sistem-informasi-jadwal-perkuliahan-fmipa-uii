<?php
class NilaiMataKuliah extends CI_Controller {

	private $nilaiMataKuliahModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->library('session');
		$this->load->model('NilaiMataKuliahModel');
		$this->nilaiMataKuliahModel=$this->NilaiMataKuliahModel;
	}

	public function index() {
		$this->load->view('nilaiMataKuliah/read');
	}

	public function comboMahasiswa() {
		if (isset($_GET['q'])) {
			$search=$_GET['q'];
		} else {
			$search='';
		}
		$data = $this->nilaiMataKuliahModel->comboMahasiswa($search);
		echo json_encode($data);
	}

	public function getListMahasiswaById() {
		$data=$this->nilaiMataKuliahModel->getListMahasiswaById($_GET['id']);
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
			1 =>'semester', 
			2 =>'kode_mata_kuliah',
			3=> 'mata_kuliah',
			4=> 'nilai',
			5=> 'huruf'
		);

	
	}

}
