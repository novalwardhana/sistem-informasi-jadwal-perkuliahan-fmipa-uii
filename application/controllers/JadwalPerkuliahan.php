<?php

class JadwalPerkuliahan extends CI_Controller {

    private $jadwalPerkuliahanModel;

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "login") {
            redirect(base_url("auth"));
        }
        $dataSessionPermission = $this->session->userdata('permission');
        if (!isset($dataSessionPermission["JadwalPerkuliahan"])) {
            redirect(base_url());
        }
        $this->load->library('session');
        $this->load->model('JadwalPerkuliahanModel');
        $this->jadwalPerkuliahanModel = $this->JadwalPerkuliahanModel;
    }

    public function index() {
        $data = array();
        $data["title"] = "SIJP - Jadwal Perkuliahan";
        $this->load->view('jadwalPerkuliahan/read', $data);
    }

    public function getListJadwal() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'aksi', 
			2 =>'nik',
			3=> 'nama',
		);
			
		//Get total data
		$totalData = $this->jadwalPerkuliahanModel->getTotalData();
			
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

		$getListJadwalPerkuliahan=$this->jadwalPerkuliahanModel->getListJadwalPerkuliahan($params);
		$totalFiltered=$this->jadwalPerkuliahanModel->getListJadwalPerkuliahanCount($params);
			
		$data = array();
		if(!empty($getListJadwalPerkuliahan)) {
			foreach ($getListJadwalPerkuliahan as $row) {

				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('jadwal-perkuliahan/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
						
					<button class='btn btn-sm btn-danger' data-href='".base_url('jadwal-perkuliahan/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
							<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['ruang'] = $row->ruang;
				$nestedData['mata_kuliah'] = $row->mata_kuliah;
                $nestedData['dosen'] = $row->dosen;
                $nestedData['kelas'] = $row->kelas;
                $nestedData['jadwal_mulai'] = $row->jadwal_mulai;
                $nestedData['jadwal_selesai'] = $row->jadwal_selesai;
                $nestedData['kode_warna_bagan'] = $row->kode_warna_bagan;
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
			$listRuang = $this->JadwalPerkuliahanModel->getListRuang();
			$listMataKuliah = $this->JadwalPerkuliahanModel->getListMataKuliah();
			$listDosen = $this->JadwalPerkuliahanModel->getListDosen();
			$listKelas = $this->JadwalPerkuliahanModel->getListKelas();
			$data['title'] = 'SIJP - Jadwal Perkuliahan Create';
			$data["listRuang"] = $listRuang;
			$data["listMataKuliah"] = $listMataKuliah;
			$data["listDosen"] = $listDosen;
			$data["listKelas"] = $listKelas;
			$this->load->view('jadwalPerkuliahan/create', $data);
			
		} else {



		}
	}
}