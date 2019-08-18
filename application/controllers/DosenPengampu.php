<?php
class DosenPengampu extends CI_Controller {

	private $dosenPengampuModel;
	private $dosenModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->library('session');

		$this->load->model('DosenPengampuModel');
		$this->dosenPengampuModel=$this->DosenPengampuModel;

		$this->load->model('DosenModel');
		$this->dosenModel=$this->DosenModel;
	}

	public function index() {
		if ($this->session->userdata('role_user')==='Dosen') {
			$pathUrl = base_url('DosenPengampu/detail?id=').$this->session->userdata('id_dosen');
			redirect($pathUrl);
		}
		$this->load->view('masterDosenPengampu/read');
	}

	public function getListDosen() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'aksi', 
			2 =>'nik',
			3=> 'nama',
		);
			
		//Get total data
		$totalData = $this->dosenModel->getTotalData();
			
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

		$getListDosen=$this->dosenPengampuModel->getListDosen($params);
		$totalFiltered=$this->dosenPengampuModel->getListDosenCount($params);
			
		$data = array();
		if(!empty($getListDosen)) {
			foreach ($getListDosen as $row){
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('DosenPengampu/detail?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-search-plus'></i></button>
						</a>
					";
				$nestedData['nik'] = $row->nik;
				$nestedData['nama'] = $row->nama;
				$nestedData['jumlah_matkul'] = $row->jumlah_mata_kuliah;
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

	public function detail() {
		if ($this->session->userdata('role_user')==='Dosen') {
			$id = $this->session->userdata('id_dosen');
		} else {
			$id=$_GET['id'];
		}

		$dataDosen=$this->dosenModel->getListDosenById($id);
		$dataMataKuliah=$this->dosenPengampuModel->getListMataKuliah();
		$dataKelas=$this->dosenPengampuModel->getListKelas();

		$data=[];
		$data['dataDosen']=$dataDosen;
		$data['dataMataKuliah']=$dataMataKuliah;
		$data['dataKelas']=$dataKelas;

		$this->load->view('masterDosenPengampu/readDetail', $data);
	}

	public function create() {
		$params=$_POST;
		$pathUrl='DosenPengampu/detail?id='.$_POST['id_dosen'];
		$hasil=$this->dosenPengampuModel->create($params);
		if ($hasil===TRUE) {
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diinput');
			redirect(base_url($pathUrl));
		} else {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diinput');
			redirect(base_url($pathUrl));
		}
	}

	public function getListDosenPengampu() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'aksi', 
			2 =>'kode_mata_kuliah',
			3 => 'mata_kuliah',
			4 => 'kelas',
			5 => 'jam_mulai',
			6 => 'jam_selesai',
			7 => 'ruang',
		);

		//Get total data
		$totalData = $this->dosenPengampuModel->getTotalData($_POST['id_dosen']);

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
			'search' => $search,
			'id_dosen' => $_POST['id_dosen']
		);

		$getListDosenPengampu=$this->dosenPengampuModel->getListDosenPengampu($params);
		$totalFiltered=$this->dosenPengampuModel->getListDosenPengampuCount($params);

		$data = array();
		if(!empty($getListDosenPengampu)) {
			foreach ($getListDosenPengampu as $row) {
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<button class='btn btn-sm btn-info' onclick='editRow($row->id)'>
						<i class='fa fa-pencil'></i>
					</button>
					<button class='btn btn-sm btn-danger' data-href='".base_url('DosenPengampu/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
				";
				$nestedData['kode_mata_kuliah'] = $row->kode_mata_kuliah;
				$nestedData['mata_kuliah'] = $row->mata_kuliah;
				$nestedData['kelas'] = $row->kelas;
				$nestedData['jam_mulai'] = $row->jam_mulai;
				$nestedData['jam_selesai'] = $row->jam_selesai;
				$nestedData['ruang'] = $row->ruang;
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

	public function delete() {
		$params=[];
		$id=$_GET['id'];
		$params['id']=$id;

		$dosen=$this->dosenPengampuModel->getDosenId($id);
		$pathUrl='DosenPengampu/detail?id='.$dosen->id_dosen;
	
		$hapusDataDosenPengampu=$this->dosenPengampuModel->delete($params);
		if ($hapusDataDosenPengampu===TRUE) {
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil dihapus');
			redirect(base_url($pathUrl));
		} else {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal dihapus');
			redirect(base_url($pathUrl));
		}
	}

	public function getDosenPengampuById() {
		$data = $this->dosenPengampuModel->getDosenPengampuById($_GET['id']);
		echo json_encode($data);
	}

	public function update() {
		$params=$_POST;
		$pathUrl='DosenPengampu/detail?id='.$_POST['id_dosen'];
		$hasil=$this->dosenPengampuModel->update($params);
		if ($hasil===TRUE) {
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diupdate');
			redirect(base_url($pathUrl));
		} else {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diupdate');
			redirect(base_url($pathUrl));
		}
	}


}
