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
		$data['title'] = 'CPL - Laporan Hasil Evaluasi Mandiri';

		$this->load->view('evaluasiMandiriHasil/index', $data);
	}

	public function laporan() {
		$id_mahasiswa = $_POST['id_mahasiswa'];

		$data_laporan = array();
		$data_cpl1 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 1');
		$data_cpl2 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 2');
		$data_cpl3 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 3');
		$data_cpl4 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 4');
		$data_cpl5 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 5');
		$data_cpl6 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 6');
		$data_cpl7 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 7');
		$data_cpl8 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 8');
		$data_cpl9 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 9');
		$data_laporan[] = $data_cpl1;
		$data_laporan[] = $data_cpl2;
		$data_laporan[] = $data_cpl3;
		$data_laporan[] = $data_cpl4;
		$data_laporan[] = $data_cpl5;
		$data_laporan[] = $data_cpl6;
		$data_laporan[] = $data_cpl7;
		$data_laporan[] = $data_cpl8;
		$data_laporan[] = $data_cpl9;

		$data = array();
		$data['title'] = 'CPL - Laporan Hasil Evaluasi Mandiri Detail';
		$data['data_mahasiswa'] = $this->evaluasiMandiriHasilModel->getListMahasiswaById($id_mahasiswa);
		$data['data_skor_maks'] = $this->evaluasiMandiriHasilModel->getSkorMaks($data['data_mahasiswa']->semester);
		$data['data_laporan'] = $data_laporan;
		$data['data_harkat'] = $this->evaluasiMandiriHasilModel->getListHarkat();
		$data['data_klasifikasi'] = $this->evaluasiMandiriHasilModel->getListKlasifikasi();

		$this->load->view('evaluasiMandiriHasil/read', $data);
	}

}
