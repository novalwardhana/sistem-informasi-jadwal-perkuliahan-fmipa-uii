<?php

class MatriksJadwalPerkuliahan extends CI_Controller {

    private $matriksJadwalPerkuliahanModel;

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "login") {
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

    public function index() {
        $data = array();
        $data["title"] = "SIJP - Matriks Jadwal Perkuliahan";
        $id = (int)$this->input->get("id");
        $data["id"] = $id;
        $this->load->view('matriksJadwalPerkuliahan/matriks', $data);
    }

    public function getDataRuang() {
        $resp = array();
        $resp["code"] = 200;
        $resp["message"] = "Success";
        $resp["data"] = array();
        $resp["data"]["ruang"] = $this->matriksJadwalPerkuliahanModel->getDataRuang();
        $resp["data"]["jadwal_perkuliahan"] = $this->matriksJadwalPerkuliahanModel->getDataJadwalPerkuliahan();
        echo json_encode($resp);
    }

    public function getDataMatriks() {

        /* Set response data */
        $resp = array();
        $data = array();

        try {
            /* Set id */
            $id = (int)$this->input->get("id");
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
            $data["count_list_data_jadwal_perkuliahan"] = intval($this->matriksJadwalPerkuliahanModel->countListDataJadwalPerkuliahan($listIDPenawaranMataKuliah));

            $resp["code"] = 200;
            $resp["message"] = "Success";
            $resp["data"] = $data;
            echo json_encode($resp);
        } catch(Exception $e) {
            $resp["code"] = 500;
            $resp["message"] = $e->getMessage();
            $resp["data"] = $data;
            echo json_encode($resp);
        }
    }

}