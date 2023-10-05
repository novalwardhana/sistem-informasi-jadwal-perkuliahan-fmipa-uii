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
        print_r($resp);
        exit();
        echo json_encode($resp);
    }

}