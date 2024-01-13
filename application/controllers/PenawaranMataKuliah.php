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
			$data["id_dosen_tim_1"] = intval($params["id_dosen_tim_1"]);
			if ($data["id_dosen_tim_1"] == 0) {
				$data["id_dosen_tim_1"] = null;
			}
			$data["id_dosen_tim_2"] = intval($params["id_dosen_tim_2"]);
			if ($data["id_dosen_tim_2"] == 0) {
				$data["id_dosen_tim_2"] = null;
			}
			$data["id_dosen_tim_3"] = intval($params["id_dosen_tim_3"]);
			if ($data["id_dosen_tim_3"] == 0) {
				$data["id_dosen_tim_3"] = null;
			}
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

	// uploadPenawaranMataKuliah:
	public function uploadPenawaranMataKuliah() {
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

					$id_periode = (int) $_POST["id_periode"];
					$tahun_akademik = $_POST["tahun_akademik"];

					$params = [];
					for ($i = 2; $i <= count($uploadDatas); $i++) {
						$param = [];

						//uploadPenawaranMataKuliah: validasi prodi
						$param["kode_program_studi"] = $uploadDatas[$i]["A"];
						$checkProgramStudi = $this->penawaranMataKuliahModel->getProgramStudiByKode($param["kode_program_studi"]);
						if (!$checkProgramStudi) {
							throw new Exception("Kode program studi tidak valid (data baris ke-$i)");
						}
						$idProgramStudi = (int) $checkProgramStudi->id;
						
						//uploadPenawaranMataKuliah: validasi penawaran mata kuliah
						$penawaranMataKuliah = $this->penawaranMataKuliahModel->getPenawaranMataKuliahByPeriode($id_periode, $idProgramStudi);
						if (!$penawaranMataKuliah) {
							throw new Exception("Penawaran mata kuliah tidak ditemukan untuk periode: $tahun_akademik dan program studi: $checkProgramStudi->nama (data baris ke-$i)");
						}
						$idPenawaranMataKuliah = (int) $penawaranMataKuliah->id;
						$param["id_penawaran_mata_kuliah"] = $idPenawaranMataKuliah;
						

						//uploadPenawaranMataKuliah: validasi mata kuliah
						$kodeMataKuliah = $uploadDatas[$i]["B"];
						$param["kode_mata_kuliah"] = $kodeMataKuliah;
						$mataKuliah = $this->penawaranMataKuliahModel->getMataKuliahByKode($idProgramStudi, $param["kode_mata_kuliah"]);
						if (!$mataKuliah) {
							throw new Exception("Tidak ditemukan mata kuliah di prodi $checkProgramStudi->nama dengan kode: $kodeMataKuliah (data baris ke-$i)");
						}
						$idMataKuliah = (int) $mataKuliah->id;
						$param["id_mata_kuliah"] = $idMataKuliah;
						
						//uploadPenawaranMataKuliah: validasi dosen
						$kodeDosen = $uploadDatas[$i]["C"]."";
						$dosen = $this->penawaranMataKuliahModel->getDosenByKode($kodeDosen);
						if (!$dosen) {
							throw new Exception("Data dosen dengan kode: $kodeDosen tidak ditemukan (data baris ke-$i)");
						}
						$idDosen = (int) $dosen->id;
						$param["id_dosen"] = $idDosen;

						//uploadPenawaranMataKuliah: validasi kelas
						$kodeKelas = $uploadDatas[$i]["D"]."";
						$kelas = $this->penawaranMataKuliahModel->getKelasByKode($kodeKelas);
						if (!$kelas) {
							throw new Exception("Data kelas dengan kode: $kodeKelas tidak ditemukan (data baris ke-$i)");
						}
						$idKelas = (int) $kelas->id;
						$param["id_kelas"] = $idKelas;
						
						//uploadPenawaranMataKuliah: validasi kapasitas
						$kapasitas = (int) $uploadDatas[$i]["E"];
						if ($kapasitas < 1) {
							throw new Exception("Kapasitas tidak valid (data baris ke-$i)");
						}
						$param["kapasitas"] = $kapasitas;

						//uploadPenawaranMataKuliah: validasi dosen tim 1
						$param["id_dosen_tim_1"] = null;
						$kodeDosenTim1 = $uploadDatas[$i]["F"]."";
						if ($kodeDosenTim1 != "" && $kodeDosenTim1 != null) {
							$dosenTim1 = $this->penawaranMataKuliahModel->getDosenByKode($kodeDosenTim1);
							if (!$dosenTim1) {
								throw new Exception("Data dosen tim 1 dengan kode: $kodeDosenTim1 tidak ditemukan (data baris ke-$i)");
							}
							$idDosenTim1 = (int) $dosenTim1->id;
							$param["id_dosen_tim_1"] = $idDosenTim1;
						}

						//uploadPenawaranMataKuliah: validasi dosen tim 2
						$param["id_dosen_tim_2"] = null;
						$kodeDosenTim2 = $uploadDatas[$i]["G"]."";
						if ($kodeDosenTim2 != "" && $kodeDosenTim2 != null) {
							$dosenTim2 = $this->penawaranMataKuliahModel->getDosenByKode($kodeDosenTim2);
							if (!$dosenTim2) {
								throw new Exception("Data dosen tim 2 dengan kode: $kodeDosenTim2 tidak ditemukan (data baris ke-$i)");
							}
							$idDosenTim2 = (int) $dosenTim2->id;
							$param["id_dosen_tim_2"] = $idDosenTim2;
						}

						//uploadPenawaranMataKuliah: validasi dosen tim 3
						$param["id_dosen_tim_3"] = null;
						$kodeDosenTim3 = $uploadDatas[$i]["H"]."";
						if ($kodeDosenTim3 != "" && $kodeDosenTim3 != null) {
							$dosenTim3 = $this->penawaranMataKuliahModel->getDosenByKode($kodeDosenTim3);
							if (!$dosenTim2) {
								throw new Exception("Data dosen tim 3 dengan kode: $kodeDosenTim3 tidak ditemukan (data baris ke-$i)");
							}
							$idDosenTim3 = (int) $dosenTim3->id;
							$param["id_dosen_tim_3"] = $idDosenTim3;
						}

						//uploadPenawaranMataKuliah: validasi unique dosen tim 1
						if ($param["id_dosen_tim_1"] != null) {
							
						}

						//uploadPenawaranMataKuliah: validasi unique dosen tim 2
						if ($param["id_dosen_tim_2"] != null) {

						}

						//uploadPenawaranMataKuliah: validasi unique dosen tim 3
						if ($param["id_dosen_tim_3"] != null) {

						}


						$params[] = $param;
					}
					$insertMultiple = $this->penawaranMataKuliahModel->insertMultiple($params);
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
				$data['title'] = 'SIJP - Penawaran Mata Kuliah Upload';
				$id_periode = $_GET["id_periode"];
				$data["id_periode"] = $id_periode;
				$periode = $this->penawaranMataKuliahModel->getListPeriodeById($id_periode);
				$data["periode"] = $periode;
				$this->load->view('penawaranMataKuliah/upload', $data);
				break;
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
				if ($row->id_dosen_tim_1 == null) {
					$row->id_dosen_tim_1 = 0;
				}
				if ($row->id_dosen_tim_2 == null) {
					$row->id_dosen_tim_2 = 0;
				}
				if ($row->id_dosen_tim_3 == null) {
					$row->id_dosen_tim_3 = 0;
				}
				$nestedData['nomor'] = $row->nomor;
				// <button class='btn btn-sm btn-primary editKontrakPenawaranMatkul' onclick='editKontrakPenawaranMatkul(".$row->id.",".$row->id_penawaran_mata_kuliah.",".$row->id_mata_kuliah.",".$row->id_dosen.",".$row->id_kelas.",".$row->kapasitas.",".$row->id_dosen_tim_1.",".$row->id_dosen_tim_2.")' data-toggle='modal' data-target='#edit-mata-kuliah' data-href='".base_url('penawaran-mata-kuliah/update-detail?id=').$row->id."'>
				// <i class='fa fa-pencil'></i>
				// </button>
				$nestedData['aksi'] = "
					<button class='btn btn-sm btn-primary editKontrakPenawaranMatkul' onclick='editKontrakPenawaranMatkul(".$row->id.",".$row->id_penawaran_mata_kuliah.",".$row->id_mata_kuliah.",".$row->id_dosen.",".$row->id_kelas.",".$row->kapasitas.",".$row->id_dosen_tim_1.",".$row->id_dosen_tim_2.",".$row->id_dosen_tim_3.")' data-toggle='modal' data-target='#edit-mata-kuliah' data-href='".base_url('penawaran-mata-kuliah/update-detail?id=').$row->id."'>
						<i class='fa fa-pencil'></i>
					</button>
					<button class='btn btn-sm btn-danger' data-href='".base_url('penawaran-mata-kuliah/delete-detail?id=').$row->id."&id_penawaran_mata_kuliah=".$row->id_penawaran_mata_kuliah."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
				";
				$nestedData['kode_mata_kuliah'] = $row->kode_mata_kuliah;
                $nestedData['mata_kuliah'] = $row->mata_kuliah;
				$nestedData['dosen'] = $row->dosen;
				$nestedData['dosen_tim_1'] = $row->dosen_tim_1;
				$nestedData['dosen_tim_2'] = $row->dosen_tim_2;
				$nestedData['dosen_tim_3'] = $row->dosen_tim_3;
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
			$data["id_dosen_tim_1"] = intval($params["id_dosen_tim_1"]);
			if ($data["id_dosen_tim_1"] == 0) {
				$data["id_dosen_tim_1"] = null;
			}
			$data["id_dosen_tim_2"] = intval($params["id_dosen_tim_2"]);
			if ($data["id_dosen_tim_2"] == 0) {
				$data["id_dosen_tim_2"] = null;
			}
			$data["id_dosen_tim_3"] = intval($params["id_dosen_tim_3"]);
			if ($data["id_dosen_tim_3"] == 0) {
				$data["id_dosen_tim_3"] = null;
			}
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