<?php
class NilaiMataKuliah extends CI_Controller {

	private $nilaiMataKuliahModel;

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
		$this->load->model('NilaiMataKuliahModel');
		$this->nilaiMataKuliahModel=$this->NilaiMataKuliahModel;
	}

	public function index() {
		$data = array();
		$data['title'] = 'CPL - Laporan Nilai Mahasiswa';
		if ($this->session->userdata('role_user')==='Mahasiswa') {
			redirect(base_url("nilai-mata-kuliah/laporan"));
		}
		$this->load->view('nilaiMataKuliah/index', $data);
	}

	public function comboMahasiswa() {
		if (isset($_GET['q'])) {
			$search=$_GET['q'];
		} else {
			$search='';
		}
		$data = $this->nilaiMataKuliahModel->comboMahasiswa($search);
		echo json_encode($data);
	}

	public function laporan() {
		if ($this->session->userdata('role_user')==='Mahasiswa') {
			$id_mahasiswa = $this->session->userdata('id_mahasiswa');
		} else {
			$id_mahasiswa = $_POST['id_mahasiswa'];
		}
		$data['title'] = 'CPL - Laporan Nilai Mahasiswa';
		$data_mahasiswa=$this->nilaiMataKuliahModel->getListMahasiswaById($id_mahasiswa);
		$data['data_mahasiswa'] = $data_mahasiswa;
		$this->load->view('nilaiMataKuliah/read', $data);
	}

	public function getListMahasiswaById() {
		$data=$this->nilaiMataKuliahModel->getListMahasiswaById($_GET['id']);
		$data=array(
			"id" => $data->id,
			"nama" => $data->nama,
			"nim" => $data->nim,
			"semester" => $data->semester
		);
		echo json_encode($data);
	}

	public function getListNilai() {
		$columns = array( 
			0 =>'nomor', 
			1 => 'akis',
			2 =>'semester', 
			3 =>'kode_mata_kuliah',
			4 => 'mata_kuliah',
			5 => 'nilai',
			6 => 'harkat'
		);

		if ($_POST['id_mahasiswa']==null || $_POST['id_mahasiswa']=='') {
			$id_mahasiswa=0;
		} else {
			$id_mahasiswa=$_POST['id_mahasiswa'];
		}

		//Get total data
		$totalData = $this->nilaiMataKuliahModel->getTotalData($id_mahasiswa);

		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = 'id';
		$dir = 'desc';
		$search=$_POST['search']['value'];

		$params=array(
			'limit' => $limit,
			'start' => $start,
			'order' => $order,
			'dir' => $dir,
			'search' => $search,
			'id_mahasiswa' => $id_mahasiswa
		);

		$getListMahasiswa=$this->nilaiMataKuliahModel->getListNilai($params);
		$totalFiltered=$this->nilaiMataKuliahModel->getListNilaiCount($params);

		$data = array();
		if(!empty($getListMahasiswa)) {

			$data_harkat = $this->nilaiMataKuliahModel->getListHarkat();

			foreach ($getListMahasiswa as $row) {

				$nestedData['nomor'] = '';
				$nestedData['aksi'] = "
					<a href='".base_url('nilai-mata-kuliah/detail-nilai?id_mahasiswa=').$id_mahasiswa.'&kode_mata_kuliah='.$row->kode_mata_kuliah."'>
						<i class='fa fa-plus-circle text-blue'></i>
					</a>
				";
				$nestedData['semester'] = $row->semester;
				$nestedData['kode_mata_kuliah'] = $row->kode_mata_kuliah;
				$nestedData['mata_kuliah'] = $row->mata_kuliah;
				$nestedData['nilai'] = $row->nilai;
				$nestedData['harkat'] = $data_harkat;
				
				$data[] = $nestedData;
			}
		}

		$json_data = array(
			"draw"            => intval($_POST['draw']),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
		);
	
		echo json_encode($json_data);
	}

	public function detailNilai() {
		$cekDetailNilai = $this->nilaiMataKuliahModel->cekDetailNilai($_GET);
		if (!$cekDetailNilai) {
			echo "Nilai bukan dari semester berjalan";
		}

		$id_mahasiswa_peserta_mata_kuliah = $cekDetailNilai->id;
		$detailNilai = $this->nilaiMataKuliahModel->detailNilai($id_mahasiswa_peserta_mata_kuliah);
		print_r($detailNilai);
	}

}
