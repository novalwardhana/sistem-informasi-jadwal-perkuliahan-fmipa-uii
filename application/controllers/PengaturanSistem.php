<?php

class PengaturanSistem extends CI_Controller {

	private $pengaturanSistemModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['PengaturanSistem'])) {
			redirect(base_url());
		}
		$this->load->library('session');
		$this->load->model('PengaturanSistemModel');
		$this->pengaturanSistemModel=$this->PengaturanSistemModel;
	}

	public function index() {
		$data = array();
		$data['title'] = 'CPL - Pengaturan Sistem';
		$data_pengaturan = $this->pengaturanSistemModel->getPengaturanSistemData('Superadmin');
		$data_tahun_akademik = $this->pengaturanSistemModel->getListTahunAkademik();
		if (!$data_pengaturan) {
			$data_pengaturan = new StdClass();
			$data_pengaturan->role='Superadmin';
			$data_pengaturan->id_tahun_akademik=null;
			$data_pengaturan->nama_kaprodi='';
			$data_pengaturan->nik_kaprodi='';
			$data_pengaturan->nama_pembimbing_akademik='';
			$data_pengaturan->nik_pembimbing_akademik='';
		}
		$data['data_pengaturan'] = $data_pengaturan;
		$data['data_tahun_akademik'] = $data_tahun_akademik;
		$this->load->view('pengaturanSistem/setting', $data);
	}

	public function update() {
		$cek_data = $this->pengaturanSistemModel->cekData('Superadmin');
		if ($cek_data===0) {

		} else {
			
		}
	}

}
