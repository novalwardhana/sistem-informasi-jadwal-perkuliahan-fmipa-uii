<?php

class MasterProdi extends CI_Controller {

    private $masterProdiModel;

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
        $dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['MasterProdi'])) {
			redirect(base_url());
		}
        $this->load->library('session');
		$this->load->model('MasterProdiModel');
		$this->masterProdiModel=$this->MasterProdiModel;
    }

    public function index() {
        $data = array();
		$data['title'] = 'SIJP - Master Prodi';
		$this->load->view('masterProdi/list', $data);
    }

    public function getData() {
        $columns = array( 
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'kode',
			3 => 'nama',
            4 => 'kode_warna_bagan',
		);
			
		$totalData = $this->masterProdiModel->getTotalData();
			
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

		$listData = $this->masterProdiModel->getListData($params);
		$totalFilteredData=$this->masterProdiModel->getTotalFilteredData($params);
			
		$data = array();
		if(!empty($listData)) {
			foreach ($listData as $row) {
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('master-prodi/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('master-prodi/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
							<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['kode'] = $row->kode;
				$nestedData['nama'] = $row->nama;
                $nestedData['kode_warna_bagan'] = $row->kode_warna_bagan;
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
                    if ($params["kode"] == "" || $params["kode"] == null || $params["nama"] == "" || $params["nama"] == null || $params["kode_warna_bagan"] == "" || $params["kode_warna_bagan"] == null) {
                        throw new Exception("Invalid parameter");
                    }
                    $data["kode"] = $params["kode"];
                    $data["nama"] = $params["nama"];
                    $data["kode_warna_bagan"] = $params["kode_warna_bagan"];
                    $result = $this->masterProdiModel->create($data);
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
                $data['title'] = 'SIJP - Master Prodi Create';
                $this->load->view('masterProdi/create', $data);
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
			$result = $this->masterProdiModel->delete($params);
			if ($result != 1) {
				throw new Exception("Gagal hapus data");
			}
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleTitle', 'Success');
			$this->session->set_flashdata('responseModuleMsg', 'Berhasil hapus data');
			redirect(base_url('master-prodi'));
		} catch(Exception $e) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleTitle', 'Failed');
			$this->session->set_flashdata('responseModuleMsg', 'Gagal hapus data');
			redirect(base_url('master-prodi'));
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
                    $data["kode_warna_bagan"] = $params["kode_warna_bagan"];
					$result = $this->masterProdiModel->update($data);
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
					redirect(base_url('master-prodi'));
				}
                $data['title'] = 'SIJP - Master Prodi Update';
                $data["dataProdi"] = $this->masterProdiModel->getMasterProdiByID($id);
                if ($data["dataProdi"] == "" || $data["dataProdi"] == null) {
                    $this->session->set_flashdata('responseModule', 'failed');
					$this->session->set_flashdata('responseModuleBackground', 'danger');
					$this->session->set_flashdata('responseModuleTitle', 'Failed');
					$this->session->set_flashdata('responseModuleMsg', 'Gagal update data, data tidak ditemukan');
					redirect(base_url('master-prodi'));
                }
                $this->load->view('masterProdi/update', $data);
                break;

            default:
        }
    }

}