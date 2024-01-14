
<?php

class MasterRuang extends CI_Controller {

    private $masterRuangModel;

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
        $dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['MasterRuang'])) {
			redirect(base_url());
		}
        $this->load->library('session');
		$this->load->model('MasterRuangModel');
		$this->masterRuangModel=$this->MasterRuangModel;
    }

    public function index() {
        $data = array();
		$data['title'] = 'SIJP - Master Ruang';
		$this->load->view('masterRuang/list', $data);
    }

    public function getData() {
        $columns = array( 
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'kode',
			3 => 'nama',
            4 => 'kapasitas',
		);
			
		$totalData = $this->masterRuangModel->getTotalData();
			
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = 'id';
		$dir = 'desc';
		$search= $this->input->post('search')['value'];
		$params=array(
			'limit' => $limit,
			'start' => $start,
			'order' => $order,
			'dir' => $dir,
			'search' => $search
		);

		$listData = $this->masterRuangModel->getListData($params);
		$totalFilteredData=$this->masterRuangModel->getTotalFilteredData($params);
			
		$data = array();
		if(!empty($listData)) {
			foreach ($listData as $row) {
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('master-ruang/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('master-ruang/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
							<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['kode'] = $row->kode;
				$nestedData['nama'] = $row->nama;
                $nestedData['kapasitas'] = $row->kapasitas;
				$data[] = $nestedData;
			}
		}
			
		$json_data = array(
			"draw"            => intval($_POST['draw']),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFilteredData), 
			"data"            => $data   
		);
		echo json_encode($json_data);
    }

    public function create() {
        $params = (array) json_decode($this->input->raw_input_stream);
		$data=array();

		$simpan = false;
		if(isset($params['simpan'])) {
			$simpan = true;
		}
        switch ($simpan) {
            case true:
                try {
                    $data["kode"] = $params["kode"];
					$data["nama"] = $params["nama"];
                    $data["kapasitas"] = $params["kapasitas"];
                    $result = $this->masterRuangModel->create($data);
					if ($result != 1) {
						throw new Exception($result["message"]);
					}
					$response = array();
					$response["code"] = 200;
					$response["message"] = "success";
					$response["data"] = null;
					echo json_encode($response);
                } catch(Exception $e) {
					$response = array();
					$response["code"] = 400;
					$response["message"] = $e->getMessage();
					$response["data"] = null;
					echo json_encode($response);
				}
                break;
            case false:
                $data['title'] = 'SIJP - Master Ruang Create';
				$this->load->view('masterRuang/create', $data);
                break;
            default:
        }
    }

	public function uploadFromExcel() {
		$data=array();

		$simpan = false;
		if(isset($_POST["simpan"])) {
			$simpan = true;
		}
		switch ($simpan) {
			case true:
				try {
					$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
					if ($extension != "xlsx") {
						throw new Exception("Ekstensi file tidak sesuai");
					}
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
					$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
					$uploadDatas = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
					if (count($uploadDatas) < 2) {
						throw new Exception("Data belum diisi");
					}
					$params = [];
					for ($i = 2; $i <= count($uploadDatas); $i++) {
						$param = [];
						$param["kode"] = $uploadDatas[$i]["A"];
						if ($param["kode"] == "" || $param["kode"] == null) {
							throw new Exception("Kode ruang tidak valid (data baris ke-$i)");
						}
						$param["nama"] = $uploadDatas[$i]["B"];
						if ($param["nama"] == "" || $param["nama"] == null) {
							throw new Exception("Nama ruang tidak valid (data baris ke-$i)");
						}
						$param["kapasitas"] = $uploadDatas[$i]["C"];
						if ($param["kapasitas"] == "" || $param["kapasitas"] == null) {
							throw new Exception("Kapasitas ruang tidak valid (data baris ke-$i)");
						}
						$param["kapasitas"] = (int) $param["kapasitas"];
						if ($param["kapasitas"] <= 0) {
							throw new Exception("Kapasitas ruang tidak valid (data baris ke-$i)");
						}
						$params[] = $param;
					}
					$insertMultiple = $this->masterRuangModel->insertMultiple($params);
					if (!$insertMultiple) {
						throw new Exception("Gagal upload data");
					}
					$response = array();
					$response["code"] = 200;
					$response["message"] = "success";
					$response["data"] = null;
					echo json_encode($response);


				} catch(Exception $e) {
					$response = array();
					$response["code"] = 400;
					$response["message"] = $e->getMessage();
					$response["data"] = null;
					echo json_encode($response);
				}
				break;

			case false:
				$data['title'] = 'SIJP - Master Ruang Upload';
				$this->load->view('masterRuang/upload', $data);
				break;
			default:
		}
	}

    public function delete() {
		try {
			$params = [];
			$id = (int)$this->input->get("id");
			if ($id <= 0) {
				throw new Exception("Parameter tidak valid");
			}
			$params["id"] = $id;
			$result = $this->masterRuangModel->delete($params);
			if ($result != 1) {
				throw new Exception("Gagal hapus data");
			}
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleTitle', 'Success');
			$this->session->set_flashdata('responseModuleMsg', 'Berhasil hapus data');
			redirect(base_url('master-ruang'));
		} catch(Exception $e) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleTitle', 'Failed');
			$this->session->set_flashdata('responseModuleMsg', 'Gagal hapus data');
			redirect(base_url('master-ruang'));
		}
	}

    public function update() {
        $params = (array) json_decode($this->input->raw_input_stream);
		$data=array();

		$simpan = false;
		if(isset($params['simpan'])) {
			$simpan = true;
		}
        switch ($simpan) {
            case true:
                try {
                    $data["id"] = $params["id"];
					$data["kode"] = $params["kode"];
					$data["nama"] = $params["nama"];
                    $data["kapasitas"] = $params["kapasitas"];
                    $result = $this->masterRuangModel->update($data);
					if ($result != 1) {
						throw new Exception($result["message"]);
					}
					$response = array();
					$response["code"] = 200;
					$response["message"] = "success";
					$response["data"] = null;
					echo json_encode($response);
                } catch(Exception $e) {
					$response = array();
					$response["code"] = 400;
					$response["message"] = $e->getMessage();
					$response["data"] = null;
					echo json_encode($response);
				}
                break;
            case false:
                $id = (int)$this->input->get("id");
				if ($id <= 0) {
					$this->session->set_flashdata('responseModule', 'failed');
					$this->session->set_flashdata('responseModuleBackground', 'danger');
					$this->session->set_flashdata('responseModuleTitle', 'Failed');
					$this->session->set_flashdata('responseModuleMsg', 'Gagal update data');
					redirect(base_url('master-ruang'));
				}
                $data['title'] = 'SIJP - Master Periode Update';
                $data["dataRuang"] = $this->masterRuangModel->getMasterRuangByID($id);
                $this->load->view('masterRuang/update', $data);
                break;
            default:
        }
    }

}