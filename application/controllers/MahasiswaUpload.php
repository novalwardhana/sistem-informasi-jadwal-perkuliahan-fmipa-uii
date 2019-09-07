<?php

class MahasiswaUpload extends CI_Controller {

	private $mahasiswaUploadModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['Mahasiswa'])) {
			redirect(base_url());
		}
		$this->load->library('session');
		$this->load->model('MahasiswaUploadModel');
		$this->mahasiswaUploadModel=$this->MahasiswaUploadModel;
	}

	public function index() {
		$data = array(
			'title' => 'Mahasiswa | Upload'
		);
		$this->load->view('masterMahasiswa/upload', $data);
	}

	public function create() {
		$file = $_FILES['file'];

		// Memilih ekstensi file
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		if($extension == 'csv'){
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} elseif($extension == 'xlsx') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		} else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		}

		// file path
		$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
		$data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

		// Get role ID
		$role = $this->mahasiswaUploadModel->getRoleId();
		if (!isset($role['id'])) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Tidak ada user role Mahasiswa, silahkan buat terlebih dahulu di menu user management / hubungi admin');
			redirect(base_url('mahasiswa/upload'));
		}

    // insert data
    $hasil = TRUE;
		$jumlah_data = count($data);
		$data_mahasiswa = array();
		for($i=2; $i<=$jumlah_data; $i++) {
			$params=array();
			$params['nama'] = $data[$i]['C'];
			$params['nim'] = $data[$i]['B'];
			$params['password'] = $data[$i]['B'];
			$params['semester'] = $data[$i]['D'];

			if ($params['nama']!=null && $params['nim'] != null && $params['password'] != null && $params['semester'] != null) {
				$validationNIM = $this->mahasiswaUploadModel->validationNIM($params['nim']);
				if ($validationNIM>=1) {
					$this->session->set_flashdata('responseModule', 'failed');
					$this->session->set_flashdata('responseModuleBackground', 'danger');
					$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
					$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diinput karena NIM '.$params['nim'].' sudah digunakan');
					redirect(base_url('mahasiswa/upload'));
				}
	
				$validationUsername = $this->mahasiswaUploadModel->validationUsername($params['nim']);
				if ($validationUsername>=1) {
					$this->session->set_flashdata('responseModule', 'failed');
					$this->session->set_flashdata('responseModuleBackground', 'danger');
					$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
					$this->session->set_flashdata('responseModuleMsg', '<br>NIM '.$params['nim'].' sudah digunakan untuk username, silahkan menggunakan NIM lain');
					redirect(base_url('mahasiswa/upload'));
				}
				$data_mahasiswa[] = $params;
			}
		}

		if (count($data_mahasiswa)==0) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data tidak ditemukan');
			redirect(base_url('mahasiswa/upload'));
		}

		if (count($data_mahasiswa)>40) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Maksimal 40 data');
			redirect(base_url('mahasiswa/upload'));
		}
		
		foreach($data_mahasiswa as $row) {
			$hasil=$this->mahasiswaUploadModel->create($row, $role['id']);
		}

    if ($hasil===TRUE) {
      $this->session->set_flashdata('responseModule', 'success');
      $this->session->set_flashdata('responseModuleBackground', 'success');
      $this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
      $this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diinput, silahkan cek di menu master data Mahasiswa');
      redirect(base_url('mahasiswa/upload'));
    } else {
      $this->session->set_flashdata('responseModule', 'failed');
      $this->session->set_flashdata('responseModuleBackground', 'danger');
      $this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
      $this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diinput');
			redirect(base_url('mahasiswa/upload'));
    }
		
	}

}
