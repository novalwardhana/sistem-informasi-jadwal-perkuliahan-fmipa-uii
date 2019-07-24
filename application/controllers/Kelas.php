<?php

class Kelas extends CI_Controller {

	private $kelasModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
				redirect(base_url("Auth"));
		}
		$this->load->library('session');
		$this->load->model('KelasModel');
		$this->kelasModel=$this->KelasModel;
	}

	public function index() {
		$this->load->view('masterKelas/read');
	}

	public function getListKelas() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'aksi', 
			2 =>'kode',
		);

		//Get total data
		$totalData = $this->kelasModel->getTotalData();
		
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

		$getListKelas=$this->kelasModel->getListKelas($params);
		$totalFiltered=$this->kelasModel->getListKelasCount($params);
			
		$data = array();
		if(!empty($getListKelas)) {
			foreach ($getListKelas as $row){
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('Kelas/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					
					<button class='btn btn-sm btn-danger' data-href='".base_url('Kelas/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['kode'] = $row->kode;
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
			$this->load->view('masterKelas/create', $data);
		} else {
			$params=array();
			$params['kode']=$_POST['kode'];
			$hasil=$this->kelasModel->create($params);
			if ($hasil===TRUE) {
				$this->session->set_flashdata('imageMsg', 'create_success');
				redirect(base_url('Kelas'));
			} else {
				$this->session->set_flashdata('imageMsg', 'create_failed');
				redirect(base_url('Kelas'));
			}
		}
	}

	public function update() {
		if(!isset($_POST['simpan'])) {
			$id=$_GET['id'];
			$dataKelas=$this->kelasModel->getListKelasById($id);
			$data=[];
			$data['dataKelas']=$dataKelas;
			$this->load->view('masterKelas/update', $data);
		} else {
			$params=$_POST;
			$updateDataKelas=$this->kelasModel->update($params);
			if ($updateDataKelas===TRUE) {
				$this->session->set_flashdata('imageMsg', 'update_success');
				redirect(base_url('Kelas'));
			} else {
				$this->session->set_flashdata('imageMsg', 'update_failed');
				redirect(base_url('Kelas'));
			}
		}
	}

	public function delete() {
			$params=[];
		$id=$_GET['id'];
		$params['id']=$id;
		$hapusDataKelas=$this->kelasModel->delete($params);
		if ($hapusDataKelas===TRUE) {
			$this->session->set_flashdata('imageMsg', 'delete_success');
			redirect(base_url('Kelas'));
		} else {
			$this->session->set_flashdata('imageMsg', 'delete_failed');
			redirect(base_url('Kelas'));
		}
	}

}
