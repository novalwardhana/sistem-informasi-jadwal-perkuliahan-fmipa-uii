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

	/* Create Cpl */
	public function create() {
		$data=array();
		$this->capaianPembelajaranLulusanModel->deleteTempCpl();
		$this->load->view('masterCapaianPembelajaranLulusan/create', $data);
	}

	/* Get list Cpl */
	public function getListCapaianPembelajaranLulusan() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'aksi', 
			2 =>'nama',
			3=> 'deskripsi',
		);
			
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

		$getListCapaianPembelajaranLulusan=$this->capaianPembelajaranLulusanModel->getListCpl($params);
		$totalFiltered=$this->capaianPembelajaranLulusanModel->getListCplCount($params);
			
		$data = array();
		if(!empty($getListCapaianPembelajaranLulusan)) {
			foreach ($getListCapaianPembelajaranLulusan as $row) {

				$nestedData['nomor'] = "";
				$nestedData['aksi'] = "
					<a href='".base_url('CapaianPembelajaranLulusan/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
						
					<button class='btn btn-sm btn-danger' data-href='".base_url('CapaianPembelajaranLulusan/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
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

	/*
		Form update
	*/
	public function update() {
		$id = $_GET['id'];
		$data_cpl = $this->capaianPembelajaranLulusanModel->getCplById($id);
		$data = array(
			'data_cpl' => $data_cpl
		);
		$this->load->view('masterCapaianPembelajaranLulusan/update', $data);
	}

	/* Delete Cpl */
	public function delete() {
		$params=[];
		$id = $_GET['id'];
		$params['id']=$id;

		try {
			$hapusDetail = $this->capaianPembelajaranLulusanModel->deleteCplDetail($params);
			if (!$hapusDetail) {
				throw new Exception("Data gagal dihapus.");
			}

			$hapus = $this->capaianPembelajaranLulusanModel->deleteCpl($params);
			if (!$hapus) {
				echo "aaa";
				throw new Exception("Data gagal dihapus.");
				exit();
			}
			
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil dihapus');
			redirect(base_url('CapaianPembelajaranLulusan'));

		} catch (Exception $e) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal dihapus');
			redirect(base_url('CapaianPembelajaranLulusan'));
		}
		
	}

}
