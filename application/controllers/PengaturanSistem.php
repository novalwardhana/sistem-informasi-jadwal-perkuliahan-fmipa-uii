<?php

class PengaturanSistem extends CI_Controller {

	private $pengaturanSistemModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
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
		$data['title'] = 'SIJP - Pengaturan Sistem';
		$data_pengaturan = $this->pengaturanSistemModel->getPengaturanSistemData('Superadmin');
		$data_tahun_akademik = $this->pengaturanSistemModel->getListTahunAkademik();
		if (!$data_pengaturan) {
			$data_pengaturan = new StdClass();
			$data_pengaturan->role='Superadmin';
			$data_pengaturan->id_tahun_akademik=null;
			$data_pengaturan->nama_kaprodi='';
			$data_pengaturan->nik_kaprodi='';
		}
		$data['data_pengaturan'] = $data_pengaturan;
		$data['data_tahun_akademik'] = $data_tahun_akademik;
		$this->load->view('pengaturanSistem/setting', $data);
	}

	public function update() {
		$cek_data = $this->pengaturanSistemModel->cekData('Superadmin');
		if ($cek_data===0) {
			$params = array();
			$params['role'] = $_POST['role'];
			$params['id_tahun_akademik'] = $_POST['id_tahun_akademik'];
			$params['nama_kaprodi'] = $_POST['nama_kaprodi'];
			$params['nik_kaprodi'] = $_POST['nik_kaprodi'];
			$hasil=$this->pengaturanSistemModel->create($params);
		} else {
			$params = array();
			$params['role'] = $_POST['role'];
			$params['id_tahun_akademik'] = $_POST['id_tahun_akademik'];
			$params['nama_kaprodi'] = $_POST['nama_kaprodi'];
			$params['nik_kaprodi'] = $_POST['nik_kaprodi'];
			$hasil=$this->pengaturanSistemModel->update($params);
		}

		if ($hasil===TRUE) {
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil disimpan');
			redirect(base_url('pengaturan-sistem'));
		} else {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal disimpan');
			redirect(base_url('pengaturan-sistem'));
		}
	}

}
