<?php
class Mahasiswa extends CI_Controller {

	private $mahasiswaModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->library('session');
		$this->load->model('MahasiswaModel');
		$this->mahasiswaModel=$this->MahasiswaModel;
	}

	public function index() {
		$this->load->view('masterMahasiswa/read');
	}

	public function getListMahasiswa() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'aksi', 
			2 =>'nim',
			3=> 'nama',
			4=> 'semester',
		);

		//Get total data
		$totalData = $this->mahasiswaModel->getTotalData();
		
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
			'search' => $search
		);

		$getListMahasiswa=$this->mahasiswaModel->getListMahasiswa($params);
		$totalFiltered=$this->mahasiswaModel->getListMahasiswaCount($params);
			
		$data = array();
		if(!empty($getListMahasiswa)) {
			foreach ($getListMahasiswa as $row) {

				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('Mahasiswa/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
						
					<button class='btn btn-sm btn-danger' data-href='".base_url('Mahasiswa/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['nim'] = $row->nim;
				$nestedData['nama'] = $row->nama;
				$nestedData['semester'] = $row->semester;
				
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

	public function create() {
		$data=array();
		if(!isset($_POST['simpan'])) {
			$data=array();
			$this->load->view('masterMahasiswa/create', $data);
		} else {
			$params=array();
			$params['nama']=$_POST['nama'];
			$params['nim']=$_POST['nim'];
			$params['password']=$_POST['password'];
			$params['semester']=$_POST['semester'];
			$hasil=$this->mahasiswaModel->create($params);
			if ($hasil===TRUE) {
				$this->session->set_flashdata('imageMsg', 'create_success');
				redirect(base_url('Mahasiswa'));
			} else {
				$this->session->set_flashdata('imageMsg', 'create_failed');
				redirect(base_url('Mahasiswa'));
			}
		}
	}

	public function getListMahasiswaUpdate($params) {
			
	}

	public function update() {
		if(!isset($_POST['simpan'])) {
			$id=$_GET['id'];
			$dataMahasiswa=$this->mahasiswaModel->getListMahasiswaById($id);
			$data=[];
			$data['dataMahasiswa']=$dataMahasiswa;
			$this->load->view('masterMahasiswa/update', $data);
		} else {
			$params=$_POST;
			$updateDataMahasiswa=$this->mahasiswaModel->update($params);
			if ($updateDataMahasiswa===TRUE) {
				$this->session->set_flashdata('imageMsg', 'update_success');
				redirect(base_url('Mahasiswa'));
			} else {
				$this->session->set_flashdata('imageMsg', 'update_failed');
				redirect(base_url('Mahasiswa'));
			}
		}
	}

	public function delete() {
		$params=[];
		$id=$_GET['id'];
		$params['id']=$id;
		$hapusDataMahasiswa=$this->mahasiswaModel->delete($params);
		if ($hapusDataMahasiswa===true) {
			$this->session->set_flashdata('imageMsg', 'delete_success');
			redirect(base_url('Mahasiswa'));
		} else {
			$this->session->set_flashdata('imageMsg', 'delete_failed');
			redirect(base_url('Mahasiswa'));
		}
	}

}
