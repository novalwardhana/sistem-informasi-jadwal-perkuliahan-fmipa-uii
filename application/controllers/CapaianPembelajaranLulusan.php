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

	public function getListMataKuliah() {
		$columns = array( 
			0 => 'checkbox',
			1 =>'nomor',
			2 =>'kode',
			3 => 'nama',
			4 => 'semester',
			5 => 'kontribusi',
		);

		//Get total data
		$totalData = $this->capaianPembelajaranLulusanModel->getTotalDataMataKuliah();
			
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

		$getListMataKuliah=$this->capaianPembelajaranLulusanModel->getListMataKuliah($params);
		$totalFiltered=$this->capaianPembelajaranLulusanModel->getListMataKuliahCount($params);
			
		$data = array();
		if(!empty($getListMataKuliah)) {
			foreach ($getListMataKuliah as $row) {
				$nestedData['checkbox'] = "<input type='checkbox' class='checkbox1' id='chk' name='check[]' value='".$row->id."'/>";
				$nestedData['nomor'] = "";
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

	public function addMataKuliahTemp() {
		$dataMataKuliah = $_POST['array_id_mata_kuliah'];
		
		try {
			for($i=0; $i<count($dataMataKuliah); $i++) {
				$id_mata_kuliah = $dataMataKuliah[$i];
				$params = array(
					'id_mata_kuliah' => $id_mata_kuliah
				);
				$hasil = $this->capaianPembelajaranLulusanModel->addMataKuliah($params);
			}
			$data = [
				'success' => true,
				'message' => 'Mata kuliah berhasil ditambahkan'
			];
			echo json_encode($data);
		} catch (Exception $e) {
			$data = [
				'success' => false,
				'message' => $e->getMessage()
			];
			echo json_encode($data);
		}
	}

	public function getMataKuliahCreateCPL() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'kode', 
			2 =>'nama',
			3=> 'semester',
			4=> 'sks',
			5 => 'kontribusi'
		);

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

		$totalData=$this->capaianPembelajaranLulusanModel->getMataKuliahCreateCPLTotalData();

		$getMataKuliahCreateCPL=$this->capaianPembelajaranLulusanModel->getMataKuliahCreateCPL($params);
		$totalFiltered=count($getMataKuliahCreateCPL);

		$data = array();
		if(!empty($getMataKuliahCreateCPL)) {
			foreach ($getMataKuliahCreateCPL as $row) {
				$nestedData['nomor'] = "";
				$nestedData['aksi'] = "	
				<button class='btn btn-sm btn-danger' onclick='deleteMataKuliah($row->id)' data-href='".base_url('CapaianPembelajaranLulusan/delete?id=').$row->id."'>
						<i class='fa fa-trash'></i>
				</button>
				";
				$nestedData['kode'] = $row->kode;
				$nestedData['nama'] = $row->nama;
				$nestedData['semester'] = $row->semester;
				$nestedData['sks'] = $row->sks;
				$nestedData['kontribusi'] = " ";
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

	public function deleteMataKuliahCreateCPL() {
		$hapus = $this->capaianPembelajaranLulusanModel->deleteMataKuliahCreateCPL($_POST['id']);
		if ($hapus) {
			$data = [
				'success' => true,
				'message' => 'Data berhasil di hapus'
			];
		} else {
			$data = [
				'success' => false,
				'message' => 'Data gagal di hapus'
			];
		}
		echo json_encode($data);
	}

}
