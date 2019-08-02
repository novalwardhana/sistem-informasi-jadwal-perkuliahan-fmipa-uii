<?php

class UserManagement extends CI_Controller {

	private $userManagementModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->library('session');
		$this->load->model('UserManagementModel');
		$this->userManagementModel=$this->UserManagementModel;
	}

	public function index() {
		$data=array();
		$this->load->view('userManagement/read', $data);
	}

	public function getListUserManagement() {
		$columns = array( 
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'nama',
			3 => 'username',
			4 => 'role'
		);
			
		//Get total data
		$totalData = $this->userManagementModel->getTotalData();
			
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

		$getListUserManagement=$this->userManagementModel->getListUserManagement($params);
		$totalFiltered=$this->userManagementModel->getListUserManagementCount($params);
			
		$data = array();
		if(!empty($getListUserManagement)) {
			foreach ($getListUserManagement as $row) {

				$nestedData['nomor'] = "";
				$nestedData['aksi'] = "
					<a href='".base_url('UserManagement/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('UserManagement/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['nama'] = $row->nama;
				$nestedData['username'] = $row->username;
				$nestedData['role'] = $row->role;
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
		echo "User Management Create";
	}

}
