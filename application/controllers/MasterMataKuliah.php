<?php

class MasterMataKuliah extends CI_Controller {

    private $masterMataKuliahModel;

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
        $dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['MasterMataKuliah'])) {
			redirect(base_url());
		}
        $this->load->library('session');
		$this->load->model('MasterMataKuliahModel');
		$this->masterMataKuliahModel=$this->MasterMataKuliahModel;
    }

    public function index() {
        $data = array();
		$data['title'] = 'SIJP - Master Mata Kuliah';
		$this->load->view('masterMataKuliah/list', $data);
    }

    public function getData() {
        $columns = array( 
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'prodi',
			3 => 'kode',
            4 => 'nama',
            5 => 'semester',
            6 => 'kontribusi_sks',
		);
			
		$totalData = $this->masterMataKuliahModel->getTotalData();
			
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

		$listData = $this->masterMataKuliahModel->getListData($params);
		$totalFilteredData=$this->masterMataKuliahModel->getTotalFilteredData($params);
			
		$data = array();
		if(!empty($listData)) {
			foreach ($listData as $row) {
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('master-mata-kuliah/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('master-mata-kuliah/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
							<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['prodi'] = $row->prodi;
				$nestedData['kode'] = $row->kode;
                $nestedData['nama'] = $row->nama;
                $nestedData['semester'] = $row->semester;
                $nestedData['kontribusi_sks'] = $row->kontribusi_sks;
				$nestedData['tipe'] = ucfirst($row->tipe);
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
					$data["kode"] = $params["kode"];
                    $data["nama"] = $params["nama"];
                    $data["semester"] = $params["semester"];
					$data["tipe"] = $params["tipe"];
                    $data["kontribusi_sks"] = $params["kontribusi_sks"];
                    $result = $this->masterMataKuliahModel->create($data);
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
                $data['title'] = 'SIJP - Master Mata Kuliah Create';
                $data['listSemester'] = [1, 2, 3, 4, 5, 6, 7, 8];
                $data["listProdi"] = $this->masterMataKuliahModel->getListProdi();
                $data['listTipeMataKuliah'] = [
					[
						"value" => "wajib",
						"label" => "Wajib"
					],
					[
						"value" => "konsentrasi",
						"label" => "Konsentrasi"
					]
				];
				$this->load->view('masterMataKuliah/create', $data);
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
						$checkProgramStudi = $this->masterMataKuliahModel->getProgramStudiByKode($param["kode_program_studi"]);
						if (!$checkProgramStudi) {
							throw new Exception("Kode program studi tidak valid (data baris ke-$i)");
						}
						$idProgramStudi = (int) $checkProgramStudi->id;
						$param["id_program_studi"] = $idProgramStudi;
						$param["kode_mata_kuliah"] = $uploadDatas[$i]["B"];
						$param["nama"] = $uploadDatas[$i]["C"];
						$param["semester"] = (int) $uploadDatas[$i]["D"];
						if ($param["semester"]  <= 0) {
							throw new Exception("Semester tidak valid (data baris ke-$i)");
						}
						$param["kontribusi"] = (int) $uploadDatas[$i]["E"];
						if ($param["kontribusi"]  <= 0) {
							throw new Exception("Kontribusi tidak valid (data baris ke-$i)");
						}
						$param["tipe"] = strtolower($uploadDatas[$i]["F"]);
						if ($param["tipe"] != "wajib" && $param["tipe"] != "konsentrasi" && $param["tipe"] != "pilihan") {
							throw new Exception("Tipe mata kuliah tidak valid (data baris ke-$i)");
						}
						$params[] = $param;
					}
					$insertMultiple = $this->masterMataKuliahModel->insertMultiple($params);
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
				$data['title'] = 'SIJP - Master Mata Kuliah Upload';
				$this->load->view('masterMataKuliah/upload', $data);
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
			$result = $this->masterMataKuliahModel->delete($params);
			if ($result != 1) {
				throw new Exception("Gagal hapus data");
			}
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleTitle', 'Success');
			$this->session->set_flashdata('responseModuleMsg', 'Berhasil hapus data');
			redirect(base_url('master-mata-kuliah'));
		} catch(Exception $e) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleTitle', 'Failed');
			$this->session->set_flashdata('responseModuleMsg', 'Gagal hapus data');
			redirect(base_url('master-mata-kuliah'));
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
                    $data["kode"] = $params["kode"];
                    $data["nama"] = $params["nama"];
                    $data["semester"] = $params["semester"];
					$data["tipe"] = $params["tipe"];
                    $data["kontribusi_sks"] = $params["kontribusi_sks"];
                    $result = $this->masterMataKuliahModel->update($data);
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
                $data['title'] = 'SIJP - Master Mata Kuliah Update';
                $data["dataMataKuliah"] = $this->masterMataKuliahModel->getMasterMataKuliahByID($id);
                $data['listSemester'] = [1, 2, 3, 4, 5, 6, 7, 8];
                $data["listProdi"] = $this->masterMataKuliahModel->getListProdi();
                $data['listTipeMataKuliah'] = [
					[
						"value" => "wajib",
						"label" => "Wajib"
					],
					[
						"value" => "konsentrasi",
						"label" => "Konsentrasi"
					]
				];
				$this->load->view('masterMataKuliah/update', $data);
                break;
            default:
        }
    }

}