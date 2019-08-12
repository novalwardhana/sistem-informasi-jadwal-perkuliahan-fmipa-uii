<?php

class CapaianPembelajaranLulusan extends CI_controller {

	private $capaianPembelajaranLulusanModel;
	
	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->library('session');
		$this->load->model('CapaianPembelajaranLulusanModel');
		$this->capaianPembelajaranLulusanModel=$this->CapaianPembelajaranLulusanModel;
	}

	public function index() {
		$this->load->view('masterCapaianPembelajaranLulusan/read');
	}

	public function getListCapaianPembelajaranLulusan() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'aksi', 
			2 =>'nama',
			3=> 'deskripsi',
		);
			
		//Get total data
		$totalData = $this->capaianPembelajaranLulusanModel->getTotalData();
			
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

		$getListCapaianPembelajaranLulusan=$this->capaianPembelajaranLulusanModel->getListCapaianPembelajaranLulusan($params);
		$totalFiltered=count($getListCapaianPembelajaranLulusan);
			
		$data = array();
		if(!empty($getListCapaianPembelajaranLulusan)) {
			foreach ($getListCapaianPembelajaranLulusan as $row) {

				$nestedData['nomor'] = "";
				$nestedData['aksi'] = "
					<a href='".base_url('Dosen/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
						
					<button class='btn btn-sm btn-danger' data-href='".base_url('Dosen/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
							<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['nama'] = $row->nama;
				$nestedData['deskripsi'] = $row->deskripsi;
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
			$this->load->view('masterCapaianPembelajaranLulusan/create', $data);
		} else {

		}
	}

}
