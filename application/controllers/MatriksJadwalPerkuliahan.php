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
        $this->load->view('matriksJadwalPerkuliahan/read', $data);
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

    public function matriksJadwalPerkuliahan() {
        $data = array();
        $data["title"] = "SIJP - Matriks Jadwal Perkuliahan";

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

        print_r($data);
        //$this->load->view('matriksJadwalPerkuliahan/read', $data);
    }

}