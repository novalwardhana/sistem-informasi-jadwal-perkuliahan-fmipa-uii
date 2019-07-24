<?php

class SkorMaks extends CI_Controller {

	private $skorMaksModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->library('session');
		$this->load->model('SkorMaksModel');
		$this->skorMaksModel=$this->SkorMaksModel;
	}

	public function index() {
		$this->load->view('masterSkorMaks/read');
	}

	public function getListSkorMaks() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'aksi', 
			2 =>'semester',
			3=> 'cpl',
			4=> 'skor_maks'
		);

		//Get total data
		$totalData = $this->skorMaksModel->getTotalData();
			
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

		$getListSkorMaks=$this->skorMaksModel->getListSkorMaks($params);
		$totalFiltered=$this->skorMaksModel->getListSkorMaksCount($params);
			
		$data = array();
		if(!empty($getListSkorMaks)) {
			foreach ($getListSkorMaks as $row){
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('SkorMaks/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('SkorMaks/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['semester'] = $row->semester;
				$nestedData['cpl'] = $row->cpl;
				$nestedData['skor_maks'] = $row->skor_maks;
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
			$this->load->view('masterSkorMaks/create', $data);
		} else {
			$params=array();
			$params['semester']=$_POST['semester'];
			$params['cpl']=$_POST['cpl'];
			$params['skor_maks']=$_POST['skor_maks'];
			$hasil=$this->skorMaksModel->create($params);
			if ($hasil===TRUE) {
				$this->session->set_flashdata('imageMsg', 'create_success');
				redirect(base_url('SkorMaks'));
			} else {
				$this->session->set_flashdata('imageMsg', 'create_failed');
				redirect(base_url('SkorMaks'));
			}
		}
	}

	public function update() {
		if(!isset($_POST['simpan'])) {
			$id=$_GET['id'];
			$dataSkorMaks=$this->skorMaksModel->getListSkorMaksById($id);
			$data=[];
			$data['dataSkorMaks']=$dataSkorMaks;
			$this->load->view('masterSkorMaks/update', $data);
		} else {
			$params=$_POST;
			$updateDataSkorMaks=$this->skorMaksModel->update($params);
			if ($updateDataSkorMaks===TRUE) {
				$this->session->set_flashdata('imageMsg', 'update_success');
				redirect(base_url('SkorMaks'));
			} else {
				$this->session->set_flashdata('imageMsg', 'update_failed');
				redirect(base_url('SkorMaks'));
			}
		}
	}

	public function delete() {
		$params=[];
		$id=$_GET['id'];
		$params['id']=$id;
		$hapusDataSkorMaks=$this->skorMaksModel->delete($params);
		if ($hapusDataSkorMaks===TRUE) {
			$this->session->set_flashdata('imageMsg', 'delete_success');
			redirect(base_url('SkorMaks'));
		} else {
			$this->session->set_flashdata('imageMsg', 'delete_failed');
			redirect(base_url('SkorMaks'));
		}
	}

}
