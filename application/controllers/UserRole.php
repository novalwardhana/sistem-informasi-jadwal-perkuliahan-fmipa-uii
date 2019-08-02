<?php

class UserRole extends CI_Controller {

	private $userRoleModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->library('session');
		$this->load->model('UserRoleModel');
		$this->userRoleModel=$this->UserRoleModel;
	}

	public function index() {
		$data=array();
		$this->load->view('userRole/read', $data);
	}

	public function getListUserRole() {
		$columns = array( 
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'nama',
		);
			
		//Get total data
		$totalData = $this->userRoleModel->getTotalData();
			
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

		$getListUserRole=$this->userRoleModel->getListUserRole($params);
		$totalFiltered=$this->userRoleModel->getListUserRoleCount($params);
			
		$data = array();
		if(!empty($getListUserRole)) {
			foreach ($getListUserRole as $row) {

				$nestedData['nomor'] = "";
				$nestedData['aksi'] = "
					<a href='".base_url('UserRole/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('UserRole/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['nama'] = $row->nama;
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
			$this->load->view('userRole/create', $data);
		} else {
			$params=array();
			$params['nama']=$_POST['nama'];
			$hasil=$this->userRoleModel->create($params);
			if ($hasil===TRUE) {
				$this->session->set_flashdata('imageMsg', 'create_success');
				redirect(base_url('UserRole'));
			} else {
				$this->session->set_flashdata('imageMsg', 'create_failed');
				redirect(base_url('UserRole'));
			}
		}
	}

	public function update() {
		if(!isset($_POST['simpan'])) {
			$id=$_GET['id'];
			$data=array();
			$dataRole=$this->userRoleModel->getListRoleById($id);
			$checkboxPermission = $this->userRoleModel->getListPermissionCheckbox();
			$dataRolePermission = $this->userRoleModel->getListPermissionById($id);
			$data['dataRole'] = $dataRole;
			$data['checkboxPermission'] = $checkboxPermission;
			$data['dataRolePermission'] = json_encode($dataRolePermission);
			$this->load->view('userRole/update', $data);
		} else {
			$params=array(
				'id' => $_POST['id'],
				'nama' => $_POST['nama']
			);

			$deleteRolePermission = $this->userRoleModel->deleteRolePermission($_POST['id']);
			if (isset($_POST['role_has_permission'])) {
				$role_has_permission = $_POST['role_has_permission'];
				foreach($role_has_permission AS $value) {
					$createRolePermission = $this->userRoleModel->createRolePermission($_POST['id'], $value);
				}
			}
			
			$hasil = $this->userRoleModel->update($params);
			if ($hasil===TRUE) {
				$this->session->set_flashdata('imageMsg', 'update_success');
				redirect(base_url('UserRole'));
			} else {
				$this->session->set_flashdata('imageMsg', 'update_success');
				redirect(base_url('UserRole'));
			}
		}
	}

	public function delete() {
		$params=[];
		$id=$_GET['id'];
		$params['id']=$id;
		$hapusDataRole=$this->userRoleModel->delete($params);
		if ($hapusDataRole===TRUE) {
			$this->session->set_flashdata('imageMsg', 'delete_success');
			redirect(base_url('UserRole'));
		} else {
			$this->session->set_flashdata('imageMsg', 'delete_success');
			redirect(base_url('UserRole'));
		}
	}

}
