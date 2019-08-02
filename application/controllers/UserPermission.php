<?php

class UserPermission extends CI_Controller {

	private $userPermissionModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->library('session');
		$this->load->model('UserPermissionModel');
		$this->userPermissionModel=$this->UserPermissionModel;
	}

	public function index() {
		$data=array();
		$this->load->view('userPermission/read', $data);
	}

	public function getListUserPermission() {
		$columns = array( 
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'nama',
			3 => 'module'
		);
			
		//Get total data
		$totalData = $this->userPermissionModel->getTotalData();
			
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

		$getListUserPermission=$this->userPermissionModel->getListUserPermission($params);
		$totalFiltered=$this->userPermissionModel->getListUserPermissionCount($params);
			
		$data = array();
		if(!empty($getListUserPermission)) {
			foreach ($getListUserPermission as $row) {

				$nestedData['nomor'] = "";
				$nestedData['aksi'] = "
					<a href='".base_url('UserPermission/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('UserPermission/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['nama'] = $row->nama;
				$nestedData['module'] = $row->module;
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

}
