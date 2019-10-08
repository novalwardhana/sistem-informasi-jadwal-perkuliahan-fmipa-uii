<?php

class Harkat extends CI_Controller {

	private $harkatModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['Harkat'])) {
			redirect(base_url());
		}
		$this->load->library('session');
		$this->load->model('HarkatModel');
		$this->harkatModel=$this->HarkatModel;
	}

	public function index() {
		$data = array();
		$data['title'] = 'CPL - Master Harkat';
		$this->load->view('masterHarkat/read', $data);
	}

	public function getListHarkat() {
		$columns = array( 
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'harkat',
			3 => 'rentang',
			4 => 'huruf',
		);
			
		//Get total data
		$totalData = $this->harkatModel->getTotalData();
			
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

		$getListHarkat=$this->harkatModel->getListHarkat($params);
		$totalFiltered=$this->harkatModel->getListHarkatCount($params);
			
		$data = array();
		if(!empty($getListHarkat)) {
			foreach ($getListHarkat as $row) {

				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('harkat/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
						
					<button class='btn btn-sm btn-danger' data-href='".base_url('harkat/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['harkat'] = $row->harkat;
				$nestedData['rentang'] = $row->rentang;
				$nestedData['huruf'] = $row->huruf;
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
			$data['title'] = 'CPL - Master Harkat Create';
			$this->load->view('masterHarkat/create', $data);
		} else {
			$params=array();
			$params['harkat']=$_POST['harkat'];
			$params['batas_bawah']=$_POST['batas_bawah'];
			$params['batas_atas']=$_POST['batas_atas'];
			$params['huruf']=$_POST['huruf'];
			$hasil=$this->harkatModel->create($params);

			if ($hasil===TRUE) {
				$this->session->set_flashdata('responseModule', 'success');
				$this->session->set_flashdata('responseModuleBackground', 'success');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diinput');
				redirect(base_url('harkat'));
			} else {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diinput');
				redirect(base_url('harkat'));
			}
		}
	}

	public function update() {
		if(!isset($_POST['simpan'])) {
			$id=$_GET['id'];
			$dataHarkat=$this->harkatModel->getListHarkatById($id);
			$data=[];
			$data['dataHarkat']=$dataHarkat;
			$data['title'] = 'CPL - Master Harkat Update';
			$this->load->view('masterHarkat/update', $data);
		} else {
			$params=$_POST;
			$updateDataHarkat=$this->harkatModel->update($params);
			if ($updateDataHarkat===TRUE) {
				$this->session->set_flashdata('responseModule', 'success');
				$this->session->set_flashdata('responseModuleBackground', 'success');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diupdate');
				redirect(base_url('harkat'));
			} else {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diupdate');
				redirect(base_url('harkat'));
			}
		}
	}

	public function delete() {
		$params=[];
		$id=$_GET['id'];
		$params['id']=$id;
		$hapusDataHarkat=$this->harkatModel->delete($params);
		if ($hapusDataHarkat===TRUE) {
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil dihapus');
			redirect(base_url('harkat'));
		} else {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal dihapus');
			redirect(base_url('harkat'));
		}
	}

}
