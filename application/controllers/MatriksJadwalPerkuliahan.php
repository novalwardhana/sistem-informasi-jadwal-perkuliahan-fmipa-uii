<?php

class MatriksJadwalPerkuliahan extends CI_Controller
{

    private $matriksJadwalPerkuliahanModel;

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("auth"));
        }
        $dataSessionPermission = $this->session->userdata('permission');
        if (!isset($dataSessionPermission["MatriksJadwalPerkuliahan"])) {
            redirect(base_url());
        }
        $this->load->library('session');
        $this->load->model('MatriksJadwalPerkuliahanModel');
        $this->matriksJadwalPerkuliahanModel = $this->MatriksJadwalPerkuliahanModel;
    }

    public function index()
    {
        $data = array();
        $data["title"] = "SIJP - Matriks Jadwal Perkuliahan";
        $id = (int) $this->input->get("id");
        $data["periode"] = $this->matriksJadwalPerkuliahanModel->getMasterPeriodeByID($id);

        /* Get ID penawaran mata kuliah */
        $listIDPenawaranMataKuliah = array();
        $listIDPenawaranMataKuliah[] = 0;
        $IDPenawaranMataKuliah = $this->matriksJadwalPerkuliahanModel->getIDPenawaranMataKuliah($id);
        foreach ($IDPenawaranMataKuliah as $row) {
            $listIDPenawaranMataKuliah[] = $row->id;
        }

        /* Get prodi penawaran mata kuliah */
        $listProdi = $this->matriksJadwalPerkuliahanModel->getProdiPenawaranMataKuliah($id);
        $dataProdi = "";
        foreach ($listProdi as $row) {
            $dataProdi .= "<span style='color: green'><i class='fa fa-check-square'></i></span> " . $row->prodi . " &nbsp; &nbsp; &nbsp;";
        }
        $data["prodi"] = $dataProdi;
        $data["listProdi"] = $this->matriksJadwalPerkuliahanModel->getListProdi();
        $data["listMataKuliah"] = $this->matriksJadwalPerkuliahanModel->getListMataKuliah();
        $data["listKelas"] = $this->matriksJadwalPerkuliahanModel->getListKelas();
        $data["listDosen"] = $this->matriksJadwalPerkuliahanModel->getListDosen();
        $data["listRuang"] = $this->matriksJadwalPerkuliahanModel->getListRuang();
        $data["listHari"] = [
            ["id" => "senin", "nama" => "Senin"],
            ["id" => "selasa", "nama" => "Selasa"],
            ["id" => "rabu", "nama" => "Rabu"],
            ["id" => "kamis", "nama" => "Kamis"],
            ["id" => "jumat", "nama" => "Jumat"],
            ["id" => "sabtu", "nama" => "Sabtu"],
        ];
        $data["dataHariCombobox"] = [
            ["id" => "senin", "text" => "Senin"],
            ["id" => "selasa", "text" => "Selasa"],
            ["id" => "rabu", "text" => "Rabu"],
            ["id" => "kamis", "text" => "Kamis"],
            ["id" => "jumat", "text" => "Jumat"],
            ["id" => "sabtu", "text" => "Sabtu"],
        ];
        $data["data_ruang_combobox"] = $this->matriksJadwalPerkuliahanModel->getDataRuangForCombobox();
        $data["id"] = $id;
        $this->load->view('matriksJadwalPerkuliahan/matriks', $data);
    }

    public function getDataRuang()
    {
        $resp = array();
        $resp["code"] = 200;
        $resp["message"] = "Success";
        $resp["data"] = array();
        $resp["data"]["ruang"] = $this->matriksJadwalPerkuliahanModel->getDataRuang();
        $resp["data"]["jadwal_perkuliahan"] = $this->matriksJadwalPerkuliahanModel->getDataJadwalPerkuliahan();
        echo json_encode($resp);
    }

    public function getDataMatriks()
    {

        /* Set response data */
        $resp = array();
        $data = array();

        try {
            /* Set id */
            $id = (int) $this->input->get("id");
            $data["id"] = $id;

            /* Get ID penawaran mata kuliah */
            $listIDPenawaranMataKuliah = array();
            $listIDPenawaranMataKuliah[] = 0;
            $IDPenawaranMataKuliah = $this->matriksJadwalPerkuliahanModel->getIDPenawaranMataKuliah($id);
            foreach ($IDPenawaranMataKuliah as $row) {
                $listIDPenawaranMataKuliah[] = $row->id;
            }
            $data["list_id_penawaran_mata_kuliah"] = $listIDPenawaranMataKuliah;

            /* Get data jadwal perkuliahan by ID */
            $data["jadwal_perkuliahan_senin"] = $this->matriksJadwalPerkuliahanModel->getDataJadwalPerkuliahanByID($listIDPenawaranMataKuliah, "senin");
            $data["jadwal_perkuliahan_selasa"] = $this->matriksJadwalPerkuliahanModel->getDataJadwalPerkuliahanByID($listIDPenawaranMataKuliah, "selasa");
            $data["jadwal_perkuliahan_rabu"] = $this->matriksJadwalPerkuliahanModel->getDataJadwalPerkuliahanByID($listIDPenawaranMataKuliah, "rabu");
            $data["jadwal_perkuliahan_kamis"] = $this->matriksJadwalPerkuliahanModel->getDataJadwalPerkuliahanByID($listIDPenawaranMataKuliah, "kamis");
            $data["jadwal_perkuliahan_jumat"] = $this->matriksJadwalPerkuliahanModel->getDataJadwalPerkuliahanByID($listIDPenawaranMataKuliah, "jumat");
            $data["jadwal_perkuliahan_sabtu"] = $this->matriksJadwalPerkuliahanModel->getDataJadwalPerkuliahanByID($listIDPenawaranMataKuliah, "sabtu");

            /* Get data ruang */
            $data["list_ruang"] = $this->matriksJadwalPerkuliahanModel->getDataRuang();

            /* Get list jadwal perkuliahan */
            $data["list_jadwal_perkuliahan"] = $this->matriksJadwalPerkuliahanModel->getListDataJadwalPerkuliahan($listIDPenawaranMataKuliah, null, null, null, null, null, null, null, null, null, null, null);
            $data["count_list_data_jadwal_perkuliahan"] = intval($this->matriksJadwalPerkuliahanModel->getTotalDataJadwalPerkuliahan($listIDPenawaranMataKuliah, null, null, null, null, null, null, null, null, null, null));

            $resp["code"] = 200;
            $resp["message"] = "Success";
            $resp["data"] = $data;
            echo json_encode($resp);
        } catch (Exception $e) {
            $resp["code"] = 500;
            $resp["message"] = $e->getMessage();
            $resp["data"] = $data;
            echo json_encode($resp);
        }
    }

    public function getListMatriks()
    {

        /* Get list id penaawaran mata kuliah */
        $id = (int) $this->input->get("id");
        $id_prodi = null;
        if ($this->input->get("id_prodi") != "" && $this->input->get("id_prodi") != null) {
            $id_prodi = (int) $this->input->get("id_prodi");
        }
        $id_mata_kuliah = null;
        if ($this->input->get("id_mata_kuliah") != "" && $this->input->get("id_mata_kuliah") != null) {
            $id_mata_kuliah = (int) $this->input->get("id_mata_kuliah");
        }
        $id_kelas = null;
        if ($this->input->get("id_kelas") != "" && $this->input->get("id_kelas") != null) {
            $id_kelas = (int) $this->input->get("id_kelas");
        }
        $id_dosen = null;
        if ($this->input->get("id_dosen") != "" && $this->input->get("id_dosen") != null) {
            $id_dosen = (int) $this->input->get("id_dosen");
        }
        $hari = null;
        if ($this->input->get("hari") != "" && $this->input->get("hari") != null) {
            $hari = $this->input->get("hari");
        }
        $jam_mulai = null;
        if ($this->input->get("jam_mulai") != "" && $this->input->get("jam_mulai") != null) {
            $jam_mulai = $this->input->get("jam_mulai");
        }
        $jam_selesai = null;
        if ($this->input->get("jam_selesai") != "" && $this->input->get("jam_selesai") != null) {
            $jam_selesai = $this->input->get("jam_selesai");
        }
        $id_ruang = null;
        if ($this->input->get("id_ruang") != "" && $this->input->get("id_ruang") != null) {
            $id_ruang = (int) $this->input->get("id_ruang");
        }
        $kapasitas_awal = null;
        if ($this->input->get("kapasitas_awal") != "" && $this->input->get("kapasitas_awal") != null) {
            $kapasitas_awal = (int) $this->input->get("kapasitas_awal");
        }
        $kapasitas_akhir = null;
        if ($this->input->get("kapasitas_akhir") != "" && $this->input->get("kapasitas_akhir") != null) {
            $kapasitas_akhir = (int) $this->input->get("kapasitas_akhir");
        }
        
        
        $listIDPenawaranMataKuliah = array();
        $listIDPenawaranMataKuliah[] = 0;
        $IDPenawaranMataKuliah = $this->matriksJadwalPerkuliahanModel->getIDPenawaranMataKuliah($id);
        foreach ($IDPenawaranMataKuliah as $row) {
            $listIDPenawaranMataKuliah[] = $row->id;
        }

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

        /* Get data */
        $totalData = $this->matriksJadwalPerkuliahanModel->getTotalDataJadwalPerkuliahan($listIDPenawaranMataKuliah, $id_prodi, $id_mata_kuliah, $id_kelas, $id_dosen, $hari, $id_ruang, $kapasitas_awal, $kapasitas_akhir, $jam_mulai, $jam_selesai);
        $listDataJadwalPerkuliahan = $this->matriksJadwalPerkuliahanModel->getListDataJadwalPerkuliahan($listIDPenawaranMataKuliah, $id_prodi, $id_mata_kuliah, $id_kelas, $id_dosen, $hari, $id_ruang, $kapasitas_awal, $kapasitas_akhir, $jam_mulai, $jam_selesai, $params);
        $totalFiltered = $totalData;
        /* Compose data */
        $data = array();
        if (!empty($listDataJadwalPerkuliahan)) {
            foreach ($listDataJadwalPerkuliahan as $row) {
                $mataKuliah = $row->kode_mata_kuliah . " - " . $row->mata_kuliah;
                $nestedData['nomor'] = "";
                // $nestedData['aksi'] = "
                //     <button class='btn btn-sm btn-primary' onclick='editJadwalPerkuliahan(" . "\"$row->kode_mata_kuliah - $row->mata_kuliah\"" . "," . "\"$row->dosen\"" . "," . "\"$row->dosen_tim_1\"" . "," . "\"$row->dosen_tim_2\"" . "," . "\"$row->kelas\"" . "," . "\"$row->kapasitas\"" . ",".$row->id_ruang.","."\"$row->hari\"".","."\"$row->jadwal_mulai\"".","."\"$row->jadwal_selesai\"".",".$row->id.",".$id.")' data-toggle='modal' data-target='#edit-jadwal-perkuliahan'>
                //         <i class='fa fa-pencil'></i>
                //     </button>
                // ";
                $nestedData['aksi'] = "
                    <button class='btn btn-sm btn-primary' onclick='editJadwalPerkuliahan(" . "\"$row->kode_mata_kuliah - $row->mata_kuliah\"" . "," . "\"$row->dosen\"" . "," . "\"$row->dosen_tim_1\"" . "," . "\"$row->dosen_tim_2\"" . "," . "\"$row->dosen_tim_3\"" . "," . "\"$row->kelas\"" . "," . "\"$row->kapasitas\"" . ",".$row->id_ruang.","."\"$row->hari\"".","."\"$row->jadwal_mulai\"".","."\"$row->jadwal_selesai\"".",".$row->id.",".$id.")' data-toggle='modal' data-target='#edit-jadwal-perkuliahan'>
                        <i class='fa fa-pencil'></i>
                    </button>
                ";
                $nestedData['prodi'] = $row->prodi;
                $nestedData['mata_kuliah'] = $row->kode_mata_kuliah . " - " . $row->mata_kuliah;
                $nestedData["kelas"] = $row->kelas;
                $nestedData['dosen'] = $row->dosen;
                $nestedData["dosen_tim_1"] = $row->dosen_tim_1;
                $nestedData["dosen_tim_2"] = $row->dosen_tim_2;
                $nestedData["dosen_tim_3"] = $row->dosen_tim_3;
                $nestedData['hari'] = $row->hari;
                $nestedData['jadwal_mulai'] = $row->jadwal_mulai;
                $nestedData["jadwal_selesai"] = $row->jadwal_selesai;
                $nestedData["ruang"] = $row->ruang;
                $nestedData["kapasitas"] = $row->kapasitas;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);

    }

    public function setJadwal() {
        $params = (array) json_decode($this->input->raw_input_stream);
        $data = array();

        try {
            $data["id"] = intval($params["id"]);
			$data["id_periode"] = intval($params["id_periode"]);
            $data["hari"] = $params["hari"];
            $data["jadwal_mulai"] = $params["jadwal_mulai"];
            $data["jadwal_selesai"] = $params["jadwal_selesai"];
            $data["id_ruang"] = $params["id_ruang"];

            $resultCheckJadwal = $this->matriksJadwalPerkuliahanModel->validasiJadwal($data);
            if (count($resultCheckJadwal) >= 1) {
                throw new Exception("Ruang dan jadwal sudah digunakan kelas lain");
            }

            $penawaranMataKuliahDetail = $this->matriksJadwalPerkuliahanModel->penawaranMataKuliahDetail($data);
            if (count($penawaranMataKuliahDetail) < 1) {
                throw new Exception("Jadwal perkuliahan tidak valid");
            }
            if ($penawaranMataKuliahDetail[0]->id_dosen != null) {
                $resultCheckDosen = $this->matriksJadwalPerkuliahanModel->validasiDosen($data, $penawaranMataKuliahDetail[0]->id_dosen);
                if (count($resultCheckDosen) >= 1) {
                    throw new Exception("Dosen utama sudah mengajar di rentang jadwal yang dipilih");
                }
            }
            if ($penawaranMataKuliahDetail[0]->id_dosen_tim_1 != null) {
                $resultCheckDosen = $this->matriksJadwalPerkuliahanModel->validasiDosen($data, $penawaranMataKuliahDetail[0]->id_dosen_tim_1);
                if (count($resultCheckDosen) >= 1) {
                    throw new Exception("Dosen tim 1 sudah mengajar di rentang jadwal yang dipilih");
                }
            }
            if ($penawaranMataKuliahDetail[0]->id_dosen_tim_2 != null) {
                $resultCheckDosen = $this->matriksJadwalPerkuliahanModel->validasiDosen($data, $penawaranMataKuliahDetail[0]->id_dosen_tim_2);
                if (count($resultCheckDosen) >= 1) {
                    throw new Exception("Dosen tim 2 sudah mengajar di rentang jadwal yang dipilih");
                }
            }
            if ($penawaranMataKuliahDetail[0]->id_dosen_tim_3 != null) {
                $resultCheckDosen = $this->matriksJadwalPerkuliahanModel->validasiDosen($data, $penawaranMataKuliahDetail[0]->id_dosen_tim_3);
                if (count($resultCheckDosen) >= 1) {
                    throw new Exception("Dosen tim 3 sudah mengajar di rentang jadwal yang dipilih");
                }
            }

            $result = $this->matriksJadwalPerkuliahanModel->setJadwal($data);
			if ($result != 1) {
				throw new Exception("Failed insert kontrak penawaran mata kuliah");
			}
            
			$response = array();
			$response["code"] = 200;
			$response["message"] = "success";
			$response["data"] = null;
			echo json_encode($response);
        } catch (Exception $e) {
            $response = array();
			$response["code"] = 400;
			$response["message"] = $e->getMessage();
			$response["data"] = null;
			echo json_encode($response);
        }
    }

}