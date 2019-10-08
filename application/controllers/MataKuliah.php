<?php
    
class MataKuliah extends CI_Controller {

	private $mataKuliahModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['MataKuliah'])) {
			redirect(base_url());
		}
		$this->load->library('session');
		$this->load->model('MataKuliahModel');
		$this->mataKuliahModel=$this->MataKuliahModel;
	}

	public function index() {
		$data = array();
		$data['title'] = 'CPL - Master Mata Kuliah';
		$this->load->view('masterMataKuliah/read', $data);
	}

	public function getListMataKuliah() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'aksi', 
			2 =>'kode',
			3=> 'nama',
			4=> 'semester',
			5=> 'kontribusi',
		);

		//Get total data
		$totalData = $this->mataKuliahModel->getTotalData();
			
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

		$getListMataKuliah=$this->mataKuliahModel->getListMataKuliah($params);
		$totalFiltered=$this->mataKuliahModel->getListMataKuliahCount($params);
			
		$data = array();
		if(!empty($getListMataKuliah)) {
			foreach ($getListMataKuliah as $row) {
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('mata-kuliah/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
						
					<button class='btn btn-sm btn-danger' data-href='".base_url('mata-kuliah/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['kode'] = $row->kode;
				$nestedData['nama'] = $row->nama;
				$nestedData['semester'] = $row->semester;
				$nestedData['kontribusi'] = $row->kontribusi;
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
			$data = array();
			$data['title'] = 'CPL - Master Mata Kuliah Create';
			$this->load->view('masterMataKuliah/create', $data);
		} else {
			$params=array();
			$params['kode']=$_POST['kode'];
			$params['nama']=$_POST['nama'];
			$params['semester']=$_POST['semester'];
			$params['kontribusi']=$_POST['kontribusi'];
			$hasil=$this->mataKuliahModel->create($params);

			if ($hasil===TRUE) {
				$this->session->set_flashdata('responseModule', 'success');
				$this->session->set_flashdata('responseModuleBackground', 'success');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diinput');
				redirect(base_url('mata-kuliah'));
			} else {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diinput');
				redirect(base_url('mata-kuliah'));
			}

		}
	}

	public function update() {
		if(!isset($_POST['simpan'])) {
			$id=$_GET['id'];
			$dataMataKuliah=$this->mataKuliahModel->getListMataKuliahById($id);
			$data=[];
			$data['dataMataKuliah']=$dataMataKuliah;
			$data['title'] = 'CPL - Master Mata Kuliah Update';
			$this->load->view('masterMataKuliah/update', $data);
		} else {
			$params=$_POST;
			$updateDataMataKuliah=$this->mataKuliahModel->update($params);
			if ($updateDataMataKuliah===TRUE) {
				$this->session->set_flashdata('responseModule', 'success');
				$this->session->set_flashdata('responseModuleBackground', 'success');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diupdate');
				redirect(base_url('mata-kuliah'));
			} else {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diupdate');
				redirect(base_url('mata-kuliah'));
			}
		}
	}

	public function delete() {
		$params=[];
		$id=$_GET['id'];
		$params['id']=$id;
		$hapusDataMataKuliah=$this->mataKuliahModel->delete($params);
		if ($hapusDataMataKuliah===TRUE) {
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil dihapus');
			redirect(base_url('mata-kuliah'));
		} else {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal dihapus');
			redirect(base_url('mata-kuliah'));
		}
	}

}
