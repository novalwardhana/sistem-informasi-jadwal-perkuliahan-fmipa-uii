<?php

class MasterPeriode extends CI_Controller {

    private $masterPeriodeModel;

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
        $dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['MasterPeriode'])) {
			redirect(base_url());
		}
        $this->load->library('session');
		$this->load->model('MasterPeriodeModel');
		$this->masterPeriodeModel=$this->MasterPeriodeModel;
    }

    public function index() {
        $data = array();
		$data['title'] = 'SIJP - Master Periode';
		$this->load->view('masterPeriode/list', $data);
    }

    public function getData() {
        $columns = array( 
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'tahun_akademik',
			3 => 'semester',
		);
			
		$totalData = $this->masterPeriodeModel->getTotalData();
			
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

		$listData = $this->masterPeriodeModel->getListData($params);
		$totalFilteredData=$this->masterPeriodeModel->getTotalFilteredData($params);
			
		$data = array();
		if(!empty($listData)) {
			foreach ($listData as $row) {
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('master-periode/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('master-periode/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
							<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['tahun_akademik'] = $row->tahun_akademik;
				$nestedData['semester'] = ucfirst($row->semester);
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
					$data["tahun_akademik"] = $params["tahun_akademik"];
					$data["semester"] = $params["semester"];
					$result = $this->masterPeriodeModel->create($data);
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
				$data['title'] = 'SIJP - Master Periode Create';
				$data['listTahunAkademik'] = [
					"2016 - 2017",
					"2017 - 2018",
					"2018 - 2019",
					"2019 - 2020",
					"2020 - 2021",
					"2021 - 2022",
					"2022 - 2023",
					"2023 - 2024",
					"2024 - 2025"
				];
				$data['listSemester'] = [
					[
						"kode" => "ganjil",
						"label" => "Ganjil"
					],
					[
						"kode" => "genap",
						"label" => "Genap"
					]
				];
				$this->load->view('masterPeriode/create', $data);
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
			$result = $this->masterPeriodeModel->delete($params);
			if ($result != 1) {
				throw new Exception("Gagal hapus data");
			}
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleTitle', 'Success');
			$this->session->set_flashdata('responseModuleMsg', 'Berhasil hapus data');
			redirect(base_url('master-periode'));
		} catch(Exception $e) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleTitle', 'Failed');
			$this->session->set_flashdata('responseModuleMsg', 'Gagal hapus data');
			redirect(base_url('master-periode'));
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
					$data["tahun_akademik"] = $params["tahun_akademik"];
					$data["semester"] = $params["semester"];
					$result = $this->masterPeriodeModel->update($data);
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
					redirect(base_url('master-periode'));
				}
				$data['title'] = 'SIJP - Master Periode Update';
				$data['listTahunAkademik'] = [
					"2016 - 2017",
					"2017 - 2018",
					"2018 - 2019",
					"2019 - 2020",
					"2020 - 2021",
					"2021 - 2022",
					"2022 - 2023",
					"2023 - 2024",
					"2024 - 2025"
				];
				$data['listSemester'] = [
					[
						"kode" => "ganjil",
						"label" => "Ganjil"
					],
					[
						"kode" => "genap",
						"label" => "Genap"
					]
				];
				$data["dataPeriode"] = $this->masterPeriodeModel->getMasterPeriodeByID($id);
				if ($data["dataPeriode"]==null || $data["dataPeriode"]== "") {
					$this->session->set_flashdata('responseModule', 'failed');
					$this->session->set_flashdata('responseModuleBackground', 'danger');
					$this->session->set_flashdata('responseModuleTitle', 'Failed');
					$this->session->set_flashdata('responseModuleMsg', 'Gagal update data, data tidak ditemukan');
					redirect(base_url('master-periode'));
				}
				$this->load->view('masterPeriode/update', $data);
				break;
			default:
		}
	}


}