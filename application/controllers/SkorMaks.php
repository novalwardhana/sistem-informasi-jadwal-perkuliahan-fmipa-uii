<?php

class SkorMaks extends CI_Controller {

	private $skorMaksModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['SkorMaks'])) {
			redirect(base_url());
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
			0  => 'nomor', 
			1  => 'aksi', 
			2  => 'semester',
			3  => 'skor_maks_cpl_1',
			4  => 'skor_maks_cpl_2',
			5  => 'skor_maks_cpl_3',
			6  => 'skor_maks_cpl_4',
			7  => 'skor_maks_cpl_5',
			8  => 'skor_maks_cpl_6',
			9  => 'skor_maks_cpl_7',
			10 => 'skor_maks_cpl_8',
			11 => 'skor_maks_cpl_9',
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
					<a href='".base_url('skor-maks/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('skor-maks/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['semester'] = $row->semester;
				$nestedData['skor_maks_cpl_1'] = $row->skor_maks_cpl_1;
				$nestedData['skor_maks_cpl_2'] = $row->skor_maks_cpl_2;
				$nestedData['skor_maks_cpl_3'] = $row->skor_maks_cpl_3;
				$nestedData['skor_maks_cpl_4'] = $row->skor_maks_cpl_4;
				$nestedData['skor_maks_cpl_5'] = $row->skor_maks_cpl_5;
				$nestedData['skor_maks_cpl_6'] = $row->skor_maks_cpl_6;
				$nestedData['skor_maks_cpl_7'] = $row->skor_maks_cpl_7;
				$nestedData['skor_maks_cpl_8'] = $row->skor_maks_cpl_8;
				$nestedData['skor_maks_cpl_9'] = $row->skor_maks_cpl_9;
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
	
			try {
				$params=array();
				$params['semester']=$_POST['semester'];
				$params['skor_maks_cpl_1']=$_POST['skor_maks_cpl_1'];
				$params['skor_maks_cpl_2']=$_POST['skor_maks_cpl_2'];
				$params['skor_maks_cpl_3']=$_POST['skor_maks_cpl_3'];
				$params['skor_maks_cpl_4']=$_POST['skor_maks_cpl_4'];
				$params['skor_maks_cpl_5']=$_POST['skor_maks_cpl_5'];
				$params['skor_maks_cpl_6']=$_POST['skor_maks_cpl_6'];
				$params['skor_maks_cpl_7']=$_POST['skor_maks_cpl_7'];
				$params['skor_maks_cpl_8']=$_POST['skor_maks_cpl_8'];
				$params['skor_maks_cpl_9']=$_POST['skor_maks_cpl_9'];

				$hasil=$this->skorMaksModel->create($params);
				if (!hasil) {
					throw new Exception("Data gagal dihapus.");
				}

				$this->session->set_flashdata('responseModule', 'success');
				$this->session->set_flashdata('responseModuleBackground', 'success');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diinput');
				redirect(base_url('skor-maks'));

			} catch (Exception $e) {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diinput');
				redirect(base_url('skor-maks'));
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
				$this->session->set_flashdata('responseModule', 'success');
				$this->session->set_flashdata('responseModuleBackground', 'success');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diupdate');
				redirect(base_url('skor-maks'));
			} else {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diupdate');
				redirect(base_url('skor-maks'));
			}
		}
	}

	public function delete() {
		$params=[];
		$id=$_GET['id'];
		$params['id']=$id;
		$hapusDataSkorMaks=$this->skorMaksModel->delete($params);
		if ($hapusDataSkorMaks===TRUE) {
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil dihapus');
			redirect(base_url('skor-maks'));
		} else {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal dihapus');
			redirect(base_url('skor-maks'));
		}
	}

}
