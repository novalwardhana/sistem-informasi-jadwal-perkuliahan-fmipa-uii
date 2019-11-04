<?php

class EvaluasiMandiri extends CI_Controller {

	private $evaluasiMandiriModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['EvaluasiMandiri'])) {
			redirect(base_url());
		}
		$this->load->library('session');
		$this->load->model('EvaluasiMandiriModel');
		$this->evaluasiMandiriModel=$this->EvaluasiMandiriModel;
	}

	public function index() {
		$data = array();
		$data['title'] = 'CPL - Laporan Evaluasi Mandiri';

		if ($this->session->userdata('role_user')==='Mahasiswa') {
			redirect(base_url("evaluasi-mandiri/laporan"));
		}
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
		if ($this->session->userdata('role_user')==='Mahasiswa') {
			$id_mahasiswa = $this->session->userdata('id_mahasiswa');
		} else {
			$id_mahasiswa = $_POST['id_mahasiswa'];
		}

		$data_laporan = array();
		$data_cpl1 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 1');
		$data_cpl2 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 2');
		$data_cpl3 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 3');
		$data_cpl4 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 4');
		$data_cpl5 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 5');
		$data_cpl6 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 6');
		$data_cpl7 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 7');
		$data_cpl8 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 8');
		$data_cpl9 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 9');
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
		$data['title'] = 'CPL - Laporan Evaluasi Mandiri Detail';
		$data['data_mahasiswa'] = $this->evaluasiMandiriModel->getListMahasiswaById($id_mahasiswa);
		$data['data_skor_maks'] = $this->evaluasiMandiriModel->getSkorMaks($data['data_mahasiswa']->semester);
		$data['data_laporan'] = $data_laporan;
		$data['data_harkat'] = $this->evaluasiMandiriModel->getListHarkat();

		$this->load->view('evaluasiMandiri/read', $data);

	}

	public function exportPDF() {
		if ($this->session->userdata('role_user')==='Mahasiswa') {
			$id_mahasiswa = $this->session->userdata('id_mahasiswa');
		} else {
			$id_mahasiswa = $_GET['id_mahasiswa'];
		}

		$data_laporan = array();
		$data_cpl1 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 1');
		$data_cpl2 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 2');
		$data_cpl3 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 3');
		$data_cpl4 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 4');
		$data_cpl5 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 5');
		$data_cpl6 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 6');
		$data_cpl7 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 7');
		$data_cpl8 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 8');
		$data_cpl9 = $this->evaluasiMandiriModel->getListCpl($id_mahasiswa, 'CPL 9');
		$data_laporan[] = $data_cpl1;
		$data_laporan[] = $data_cpl2;
		$data_laporan[] = $data_cpl3;
		$data_laporan[] = $data_cpl4;
		$data_laporan[] = $data_cpl5;
		$data_laporan[] = $data_cpl6;
		$data_laporan[] = $data_cpl7;
		$data_laporan[] = $data_cpl8;
		$data_laporan[] = $data_cpl9;

		$data_pengaturan_sistem = $this->evaluasiMandiriModel->getPengaturanSistemData('Superadmin');
		if (!$data_pengaturan_sistem) {
			$data_pengaturan_sistem = array(
				'role' => 'Superadmin',
				'id_tahun_akademik' => null,
				'nama_kaprodi' => '',
				'nik_kaprodi' => '',
				'nama_pembimbing_akademik' => '',
				'nik_pembimbing_akademik' => '',
			);
		}

		$data = array();
		$data['title'] = 'CPL - Laporan Evaluasi Mandiri Detail';
		$data['data_mahasiswa'] = $this->evaluasiMandiriModel->getListMahasiswaById($id_mahasiswa);
		$data['data_skor_maks'] = $this->evaluasiMandiriModel->getSkorMaks($data['data_mahasiswa']->semester);
		$data['data_laporan'] = $data_laporan;
		$data['data_harkat'] = $this->evaluasiMandiriModel->getListHarkat();
		$data['pengaturan_sistem'] = $data_pengaturan_sistem;
		$data['tanggal'] = $this->formatTanggal(date('Y-m-d'));

		$this->load->library('Pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "Evaluasi_Mandiri.pdf";
		$this->pdf->load_view('evaluasiMandiriExport/export', $data);
	}

	private function formatTanggal($tanggal){
		$bulan = array (
			1 => 'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
	 
		return (int)$pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}

}
