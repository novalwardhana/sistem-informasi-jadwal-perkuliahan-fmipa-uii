<?php

class KhsKumulatifUploadNilai extends CI_Controller {

	private $khsKumulatifUploadNilaiModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['KhsKumulatifUploadNilai'])) {
			redirect(base_url());
		}
		$this->load->library('session');
		$this->load->model('KhsKumulatifUploadNilaiModel');
		$this->khsKumulatifUploadNilaiModel=$this->KhsKumulatifUploadNilaiModel;
	}

	public function index() {
		$data = array();
		$data['title'] = 'CPL - KHS Kumulatif Upload Nilai';
		$this->load->view('khsKumulatifUploadNilai/upload', $data);
	}

	public function comboMahasiswa() {
		if (isset($_GET['q'])) {
			$search=$_GET['q'];
		} else {
			$search='';
		}
		$data = $this->khsKumulatifUploadNilaiModel->comboMahasiswa($search);
		echo json_encode($data);
	}

	public function upload() {
		// get id_mahasiswa
		$id_mahasiswa = $_POST['id_mahasiswa'];

		// Redirect url
		$pathUrl = base_url('khs-kumulatif-upload-nilai');
		
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

		// Set input array
		$hasil = TRUE;
		$jumlah_data = count($data);
		$data_nilai = [];
		for($i=2; $i<=$jumlah_data; $i++) {
			$params=array();
			$mata_kuliah = $this->getIdMataKuliah($data[$i]['B']);
			
			if (!$mata_kuliah->id) {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Kode mata kuliah '.$data[$i]['B'].' tidak terdaftar, silahkan cek kembali data yang akan diupload');
				redirect($pathUrl);
			}

			$params['id_mahasiswa'] = $id_mahasiswa;
			$params['id_mata_kuliah'] = $mata_kuliah->id;
			$params['nilai'] = (is_null($data[$i]['D'])) ? NULL : (float) $data[$i]['D'];
			$data_nilai[] = $params;
		}

		if (count($data_nilai)==0) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data tidak ditemukan');
			redirect($pathUrl);
		}

		if (count($data_nilai)>50) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Maksimal 50 data');
			redirect($pathUrl);
		}

		foreach($data_nilai as $row) {
			$hasil = $this->khsKumulatifUploadNilaiModel->addKhsMahasiswa($row);
			if (!$hasil) {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diupload');
				redirect($pathUrl);
			}
		}

		$this->session->set_flashdata('responseModule', 'success');
		$this->session->set_flashdata('responseModuleBackground', 'success');
		$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
		$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diupload, silahkan cek di menu Khs Kumulatif');
		redirect($pathUrl);
	}

	private function getIdMataKuliah($kode) {
		$this->db->where('kode', $kode);
		$query=$this->db->get('mata_kuliah');
		$row=$query->row();
		return $row;
	}

}
