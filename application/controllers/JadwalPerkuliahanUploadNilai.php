<?php

class JadwalPerkuliahanUploadNilai extends CI_Controller {

	private $jadwalPerkuliahanModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['JadwalPerkuliahan'])) {
			redirect(base_url());
		}
		$this->load->library('session');

		$this->load->model('JadwalPerkuliahanModel');
		$this->jadwalPerkuliahanModel=$this->JadwalPerkuliahanModel;
	}

	public function index() {
		$dataPengampu = $this->jadwalPerkuliahanModel->getListDosenPengampuById($_GET['id']);

		//Validasi role user dosen
		if ($this->session->userdata('role_user')==='Dosen') {
			if (isset($dataPengampu->id_dosen)) {
				if ($dataPengampu->id_dosen != $this->session->userdata('id_dosen')) {
					redirect(base_url("jadwal-perkuliahan"));
				}
			} else {
				redirect(base_url("jadwal-perkuliahan"));
			}
		}

		$data=[];
		$data['title'] = 'Jadwal Perkuliahan | Upload Nilai';
		$data['dataPengampu'] = $dataPengampu;
		$this->load->view('jadwalPerkuliahanUploadNilai/upload', $data);
	}

}
