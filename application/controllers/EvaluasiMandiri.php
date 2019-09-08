<?php

class EvaluasiMandiri extends CI_Controller {

	private $evaluasiMandiriModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['NilaiMataKuliah'])) {
			redirect(base_url());
		}
		$this->load->library('session');
		$this->load->model('EvaluasiMandiriModel');
		$this->evaluasiMandiriModel=$this->EvaluasiMandiriModel;
	}

	public function index() {
		$data = array();
		$data['title'] = 'Laporan | Evaluasi Mandiri';

		$this->load->view('evaluasiMandiri/index', $data);
	}

	public function comboMahasiswa() {
		if (isset($_GET['q'])) {
			$search=$_GET['q'];
		} else {
			$search='';
		}
		$data = $this->evaluasiMandiriModel->comboMahasiswa($search);
		echo json_encode($data);
	}

	public function laporan() {
		print_r($_POST);
	}

}
