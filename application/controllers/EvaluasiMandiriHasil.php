<?php

class EvaluasiMandiriHasil extends CI_Controller {

	private $evaluasiMandiriHasilModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['EvaluasiMandiriHasil'])) {
			redirect(base_url());
		}
		$this->load->library('session');
		$this->load->model('EvaluasiMandiriHasilModel');
		$this->evaluasiMandiriHasilModel=$this->EvaluasiMandiriHasilModel;
	}

	public function comboMahasiswa() {
		if (isset($_GET['q'])) {
			$search=$_GET['q'];
		} else {
			$search='';
		}
		$data = $this->evaluasiMandiriHasilModel->comboMahasiswa($search);
		echo json_encode($data);
	}

	public function index() {
		$data = array();
		$data['title'] = 'Laporan | Hasil Evaluasi Mandiri';

		$this->load->view('evaluasiMandiriHasil/index', $data);
	}

	public function laporan() {
		echo "Laporan Hasil evaluasi Mandiri";
	}

}
