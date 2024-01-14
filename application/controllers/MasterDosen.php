<?php
class MasterDosen extends CI_Controller {

    private $masterDosenModel;

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
        $dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['MasterDosen'])) {
			redirect(base_url());
		}
        $this->load->library('session');
		$this->load->model('MasterDosenModel');
		$this->masterDosenModel=$this->MasterDosenModel;
    }

    public function index() {
        $data = array();
		$data['title'] = 'SIJP - Master Dosen';
		$this->load->view('masterDosen/list', $data);
    }

    public function getData() {
        $columns = array( 
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'prodi',
			3 => 'nik',
            4 => 'nama',
		);
			
		$totalData = $this->masterDosenModel->getTotalData();
			
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

		$listData = $this->masterDosenModel->getListData($params);
		$totalFilteredData=$this->masterDosenModel->getTotalFilteredData($params);
			
		$data = array();
		if(!empty($listData)) {
			foreach ($listData as $row) {
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('master-dosen/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('master-dosen/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
							<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['prodi'] = $row->prodi;
				$nestedData['nik'] = $row->nik;
                $nestedData['nama'] = $row->nama;
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
                    $data["id_prodi"] = $params["id_prodi"];
                    $data["nik"] = $params["nik"];
                    $data["nama"] = $params["nama"];
                    $result = $this->masterDosenModel->create($data);
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
                $data['title'] = 'SIJP - Master Dosen Create';
                $data["listProdi"] = $this->masterDosenModel->getListProdi();
                $this->load->view('masterDosen/create', $data);
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
						$param["kode_program_studi"] = $uploadDatas[$i]["A"];
						$checkProgramStudi = $this->masterDosenModel->getProgramStudiByKode($param["kode_program_studi"]);
						if (!$checkProgramStudi) {
							throw new Exception("Kode program studi tidak valid: $param[kode_program_studi] (data baris ke-$i)");
						}
						$idProgramStudi = (int) $checkProgramStudi->id;
						$param["id_program_studi"] = $idProgramStudi;
						$param["nik"] = $uploadDatas[$i]["B"];
						if ($param["nik"] == "" || $param["nik"] == null) {
							throw new Exception("NIK dosen harus diisi (data baris ke-$i)");
						}
						$param["nama"] = $uploadDatas[$i]["C"];
						if ($param["nama"] == "" || $param["nama"] == null) {
							throw new Exception("Nama dosen harus diisi (data baris ke-$i)");
						}
						$params[] = $param;
					}
					$insertMultiple = $this->masterDosenModel->insertMultiple($params);
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
				$data['title'] = 'SIJP - Master Dosen Upload';
				$this->load->view('masterDosen/upload', $data);
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
			$result = $this->masterDosenModel->delete($params);
			if ($result != 1) {
				throw new Exception("Gagal hapus data");
			}
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleTitle', 'Success');
			$this->session->set_flashdata('responseModuleMsg', 'Berhasil hapus data');
			redirect(base_url('master-dosen'));
		} catch(Exception $e) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleTitle', 'Failed');
			$this->session->set_flashdata('responseModuleMsg', 'Gagal hapus data');
			redirect(base_url('master-dosen'));
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
                    $data["id_prodi"] = $params["id_prodi"];
                    $data["nik"] = $params["nik"];
                    $data["nama"] = $params["nama"];
                    $result = $this->masterDosenModel->update($data);
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
					redirect(base_url('master-dosen'));
				}
                $data['title'] = 'SIJP - Master Dosen Update';
                $data["dataDosen"] = $this->masterDosenModel->getMasterDosenByID($id);
                $data["listProdi"] = $this->masterDosenModel->getListProdi();
                $this->load->view('masterDosen/update', $data);
                break;
            default:
        }
    }


}