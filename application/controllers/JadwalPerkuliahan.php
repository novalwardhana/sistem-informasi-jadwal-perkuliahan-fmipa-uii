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
				$listProdi = "";
				foreach(json_decode($row->list_prodi) as $value) {
					if ($value != null) {
						$listProdi .= "<span style='color: green'><i class='fa fa-check-square'></i></span> ".$value. "<br>";
					}
				}
				$nestedData['nomor'] = "";
				$nestedData['aksi'] = "
					<a href='".base_url('matriks-jadwal-perkuliahan?id=').$row->id."' target='_blank'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-search-plus'></i></button>
					</a>";
				$nestedData['tahun_akademik'] = $row->tahun_akademik;
				$nestedData['semester'] = ucfirst($row->semester);
				$nestedData['list_prodi'] = $listProdi;
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