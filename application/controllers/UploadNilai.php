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

	public function upload() {
		// get id_mahasiswa
		$id_mahasiswa = $_POST['id_mahasiswa'];

		// Redirect url
		$pathUrl = base_url('upload-nilai');
		
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

		print_r($data_nilai);
	}

	private function getIdMataKuliah($kode) {
		$this->db->where('kode', $kode);
		$query=$this->db->get('mata_kuliah');
		$row=$query->row();
		return $row;
	}

}
