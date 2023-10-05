<?php

class PenawaranMataKuliah extends CI_Controller {

    private $penawaranMataKuliahModel;

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
        $dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['PenawaranMataKuliah'])) {
			redirect(base_url());
		}
        $this->load->library('session');
        $this->load->model('PenawaranMataKuliahModel');
		$this->penawaranMataKuliahModel=$this->PenawaranMataKuliahModel;
    }

    public function index() {
        $data = array();
		$data['title'] = 'SIJP - Penawaran Mata Kuliah';
        $data["listPeriode"] = $this->penawaranMataKuliahModel->getListPeriode();
        $data["listProdi"] = $this->penawaranMataKuliahModel->getListProdi();
		$this->load->view('penawaranMataKuliah/list', $data);
    }
    
    public function getData() {
		$order = 'id';
		$dir = 'desc';
		$id_periode= intval($this->input->post("id_periode"));
		$params=array(
			'order' => $order,
			'dir' => $dir,
			'id_periode' => $id_periode
		);
        $totalData = $this->penawaranMataKuliahModel->getTotalData($params);
        $listData = $this->penawaranMataKuliahModel->getListData($params);
		$totalFilteredData = $this->penawaranMataKuliahModel->getTotalData($params);

        $data = array();
		if(!empty($listData)) {
			foreach ($listData as $row) {
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
                    <a href='".base_url('penawaran-mata-kuliah/detail?id=').$row->id."' target='_blank'>
                        <button class='btn btn-sm btn-primary'><i class='fa fa-search-plus'></i></button>
                    </a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('penawaran-mata-kuliah/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
                ";
				$nestedData['periode'] = $row->periode;
                $nestedData['semester'] = $row->semester;
                $nestedData['kode_prodi'] = $row->kode_prodi;
				$nestedData['prodi'] = $row->prodi;
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
		$data = array();
		$data["id_periode"] = $params["id_periode"];
		$data["id_prodi"] = $params["id_prodi"];

		try {
			$result = $this->penawaranMataKuliahModel->create($data);
			if ($result != 1) {
				throw new Exception("Failed insert data");
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
		
	}

	public function delete() {
		try {
			$id = intval($this->input->get("id"));
			$params = array();
			$params["id"] = $id;
			$result = $this->penawaranMataKuliahModel->delete($params);
			if ($result != 1) {
				throw new Exception("Gagal menghapus data");
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
	}

	public function detail() {
		$id = intval($this->input->get("id"));
		$penawaranMataKuliah = $this->penawaranMataKuliahModel->getDataByID($id);
		$listMataKuliah = $this->penawaranMataKuliahModel->getListMataKuliah($penawaranMataKuliah->id_prodi);
		$listDosen = $this->penawaranMataKuliahModel->getListDosen($penawaranMataKuliah->id_prodi);
		$listKelas = $this->penawaranMataKuliahModel->getListKelas();
		$data = array();
		$data['title'] = 'SIJP - Detail Penawaran Mata Kuliah';
		$data["id_penawaran_mata_kuliah"] = $id;
		$data["penawaranMataKuliah"] = $penawaranMataKuliah;
		$data["listMataKuliah"] = $listMataKuliah;
		$data["listDosen"] = $listDosen;
		$data["listKelas"] = $listKelas;
		$this->load->view('penawaranMataKuliah/detail', $data);
	}

	public function addKontrakPenawaranMataKuliah() {
		$params = (array) json_decode($this->input->raw_input_stream);
		$data=array();

		try {
			$data["id_penawaran_mata_kuliah"] = intval($params["id_penawaran_mata_kuliah"]);
			$data["id_mata_kuliah"] = intval($params["id_mata_kuliah"]);
			$data["id_dosen"] = intval($params["id_dosen"]);
			$data["id_kelas"] = intval($params["id_kelas"]);
			$data["kapasitas"] = intval($params["kapasitas"]);
			$result = $this->penawaranMataKuliahModel->addKontrakPenawaranMataKuliah($data);
			if ($result != 1) {
				throw new Exception("Failed insert kontrak penawaran mata kuliah");
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
	}

	public function getDataDetail() {
		$order = 'id';
		$dir = 'desc';
		$id_penawaran_mata_kuliah= intval($this->input->post("id_penawaran_mata_kuliah"));
		$params=array(
			'order' => $order,
			'dir' => $dir,
			'id_penawaran_mata_kuliah' => $id_penawaran_mata_kuliah
		);
        $totalData = $this->penawaranMataKuliahModel->getTotalDataDetail($params);
        $listData = $this->penawaranMataKuliahModel->getListDataDetail($params);
		$totalFilteredData = $this->penawaranMataKuliahModel->getTotalDataDetail($params);

        $data = array();
		if(!empty($listData)) {
			foreach ($listData as $row) {
				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<button class='btn btn-sm btn-primary editKontrakPenawaranMatkul' onclick='editKontrakPenawaranMatkul(".$row->id.",".$row->id_penawaran_mata_kuliah.",".$row->id_mata_kuliah.",".$row->id_dosen.",".$row->id_kelas.",".$row->kapasitas.")' data-toggle='modal' data-target='#edit-mata-kuliah' data-href='".base_url('penawaran-mata-kuliah/update-detail?id=').$row->id."'>
						<i class='fa fa-pencil'></i>
					</button>
					<button class='btn btn-sm btn-danger' data-href='".base_url('penawaran-mata-kuliah/delete-detail?id=').$row->id."&id_penawaran_mata_kuliah=".$row->id_penawaran_mata_kuliah."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
				";
				$nestedData['kode_mata_kuliah'] = $row->kode_mata_kuliah;
                $nestedData['mata_kuliah'] = $row->mata_kuliah;
                $nestedData['nik_dosen'] = $row->nik_dosen;
				$nestedData['dosen'] = $row->dosen;
				$nestedData['kelas'] = $row->kelas;
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

	public function deleteDetail() {
		try {
			$id = (int)$this->input->get("id");
			if ($id <= 0) {
				throw new Exception("Parameter tidak valid");
			}
			$id_penawaran_mata_kuliah = (int)$this->input->get("id_penawaran_mata_kuliah");
			if ($id_penawaran_mata_kuliah <= 0) {
				throw new Exception("Parameter tidak valid");
			}
			$params["id"] = $id;
			$result = $this->penawaranMataKuliahModel->deleteDetail($params);
			if ($result != 1) {
				throw new Exception("Gagal hapus data");
			}
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleTitle', 'Success');
			$this->session->set_flashdata('responseModuleMsg', 'Berhasil hapus data');
			redirect(base_url('penawaran-mata-kuliah/detail?id=').$id_penawaran_mata_kuliah);
		} catch(Exception $e) {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleTitle', 'Failed');
			$this->session->set_flashdata('responseModuleMsg', 'Gagal hapus data');
			redirect(base_url('penawaran-mata-kuliah/detail?id=').$id_penawaran_mata_kuliah);
		}
	}

	public function editKontrakPenawaranMataKuliah() {
		$params = (array) json_decode($this->input->raw_input_stream);
		$data=array();

		try {
			$data["id"] = intval($params["id"]);
			$data["id_penawaran_mata_kuliah"] = intval($params["id_penawaran_mata_kuliah"]);
			$data["id_mata_kuliah"] = intval($params["id_mata_kuliah"]);
			$data["id_dosen"] = intval($params["id_dosen"]);
			$data["id_kelas"] = intval($params["id_kelas"]);
			$data["kapasitas"] = intval($params["kapasitas"]);
			$result = $this->penawaranMataKuliahModel->editKontrakPenawaranMataKuliah($data);
			if ($result != 1) {
				throw new Exception("Failed update kontrak penawaran mata kuliah");
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
	}

}