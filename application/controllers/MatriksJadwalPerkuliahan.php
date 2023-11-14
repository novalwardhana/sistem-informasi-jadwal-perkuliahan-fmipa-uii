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
            $dataProdi .= "<span style='color: green'><i class='fa fa-check-square'></i></span> " . $row->prodi . "<br>";
        }
        $data["prodi"] = $dataProdi;
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
            $data["list_jadwal_perkuliahan"] = $this->matriksJadwalPerkuliahanModel->getListDataJadwalPerkuliahan($listIDPenawaranMataKuliah);
            $data["count_list_data_jadwal_perkuliahan"] = intval($this->matriksJadwalPerkuliahanModel->getTotalDataJadwalPerkuliahan($listIDPenawaranMataKuliah));

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
        $listIDPenawaranMataKuliah = array();
        $listIDPenawaranMataKuliah[] = 0;
        $IDPenawaranMataKuliah = $this->matriksJadwalPerkuliahanModel->getIDPenawaranMataKuliah($id);
        foreach ($IDPenawaranMataKuliah as $row) {
            $listIDPenawaranMataKuliah[] = $row->id;
        }

        /* Get data */
        $totalData = $this->matriksJadwalPerkuliahanModel->getTotalDataJadwalPerkuliahan($listIDPenawaranMataKuliah);
        $listDataJadwalPerkuliahan = $this->matriksJadwalPerkuliahanModel->getListDataJadwalPerkuliahan($listIDPenawaranMataKuliah);
        $totalFiltered = $totalData;
        /* Compose data */
        $data = array();
        if (!empty($listDataJadwalPerkuliahan)) {
            foreach ($listDataJadwalPerkuliahan as $row) {
                $mataKuliah = $row->kode_mata_kuliah . " - " . $row->mata_kuliah;
                $nestedData['nomor'] = "";
                $nestedData['aksi'] = "
                    <button class='btn btn-sm btn-primary' onclick='editJadwalPerkuliahan(" . "\"$row->kode_mata_kuliah - $row->mata_kuliah\"" . "," . "\"$row->dosen\"" . "," . "\"$row->dosen_tim_1\"" . "," . "\"$row->dosen_tim_2\"" . "," . "\"$row->kelas\"" . "," . "\"$row->kapasitas\"" . ",".$row->id_ruang.","."\"$row->hari\"".","."\"$row->jadwal_mulai\"".","."\"$row->jadwal_selesai\"".",".$row->id.",".$id.")' data-toggle='modal' data-target='#edit-jadwal-perkuliahan'>
                        <i class='fa fa-pencil'></i>
                    </button>
                ";
                $nestedData['prodi'] = $row->prodi;
                $nestedData['mata_kuliah'] = $row->kode_mata_kuliah . " - " . $row->mata_kuliah;
                $nestedData["kelas"] = $row->kelas;
                $nestedData['dosen'] = $row->dosen;
                $nestedData["dosen_tim_1"] = $row->dosen_tim_1;
                $nestedData["dosen_tim_2"] = $row->dosen_tim_2;
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

            $resultCheckJadwal = $this->matriksJadwalPerkuliahanModel->checkJadwal($data);
            if (count($resultCheckJadwal) >= 1) {
                throw new Exception("Ruang dan jadwal sudah digunakan kelas lain");
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