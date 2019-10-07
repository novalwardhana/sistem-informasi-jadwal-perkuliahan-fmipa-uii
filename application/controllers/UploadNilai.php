<?php

class UploadNilai extends CI_Controller {

	private $uploadNilaiModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->library('session');
		$this->load->model('UploadNilaiModel');
		$this->uploadNilaiModel=$this->UploadNilaiModel;
	}

	public function index() {
		$data = array();
		$data['title'] = 'CPL - Upload Nilai';
		$this->load->view('uploadNilai/upload', $data);
	}

	public function comboMahasiswa() {
		if (isset($_GET['q'])) {
			$search=$_GET['q'];
		} else {
			$search='';
		}
		$data = $this->uploadNilaiModel->comboMahasiswa($search);
		echo json_encode($data);
	}

}
