<?php

class JadwalPerkuliahanUploadNilai extends CI_Controller {

	private $jadwalPerkuliahanModel;
	private $jadwalPerkuliahanUploadNilaiModel;

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
		$this->load->model('JadwalPerkuliahanUploadNilaiModel');
		$this->jadwalPerkuliahanModel=$this->JadwalPerkuliahanModel;
		$this->jadwalPerkuliahanUploadNilaiModel=$this->JadwalPerkuliahanUploadNilaiModel;
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

	public function create() {
		$id_dosen_pengampu_mata_kuliah = $_POST['id_dosen_pengampu_mata_kuliah'];
		$pathUrl = base_url('jadwal-perkuliahan/upload-nilai?id=').$id_dosen_pengampu_mata_kuliah;

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

		$hasil = TRUE;
		$jumlah_data = count($data);
    $data_nilai = [];
		for($i=2; $i<=$jumlah_data; $i++) {
      $params=array();
      
      // set id dosen pengampu
      $params['id_dosen_pengampu_mata_kuliah'] = $id_dosen_pengampu_mata_kuliah;
      
      // set id mahasiswa
			$id_mahasiswa = $this->jadwalPerkuliahanUploadNilaiModel->getIdMahasiswa($data[$i]['B']);
			if (!$id_mahasiswa) {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>NIM '.$data[$i]['B'].' tidak terdaftar, silahkan cek kembali data yang akan diupload');
				redirect($pathUrl);
			}
      $params['id_mahasiswa'] = $id_mahasiswa;

      // set nilai cpmk 
      $params['cpmk_1_nilai'] = (is_null($data[$i]['D'])) ? NULL : (float) $data[$i]['D'];
      $params['cpmk_2_nilai'] = (is_null($data[$i]['E'])) ? NULL : (float) $data[$i]['E'];
      $params['cpmk_3_nilai'] = (is_null($data[$i]['F'])) ? NULL : (float) $data[$i]['F'];
      $params['cpmk_4_nilai'] = (is_null($data[$i]['G'])) ? NULL : (float) $data[$i]['G'];
      $params['cpmk_5_nilai'] = (is_null($data[$i]['H'])) ? NULL : (float) $data[$i]['H'];
      $params['cpmk_6_nilai'] = (is_null($data[$i]['I'])) ? NULL : (float) $data[$i]['I'];
      $params['cpmk_7_nilai'] = (is_null($data[$i]['J'])) ? NULL : (float) $data[$i]['J'];
      $params['cpmk_8_nilai'] = (is_null($data[$i]['K'])) ? NULL : (float) $data[$i]['K'];
      $params['cpmk_9_nilai'] = (is_null($data[$i]['L'])) ? NULL : (float) $data[$i]['L'];
      $params['cpmk_10_nilai'] = (is_null($data[$i]['M'])) ? NULL : (float) $data[$i]['M'];

      $data_nilai[] = $params;

		}

		if (count($data_nilai)==0) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data tidak ditemukan');
			redirect($pathUrl);
		}

		if (count($data_nilai)>40) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Maksimal 40 data');
			redirect($pathUrl);
		}
		
		foreach($data_nilai as $row) {
			$hasil = $this->jadwalPerkuliahanUploadNilaiModel->addMahasiswaPeserta($row);
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
		$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diupload, silahkan cek di menu jadwal perkuliahan');
		redirect($pathUrl);

	}

}
