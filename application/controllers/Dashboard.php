<?php
class Dashboard extends CI_Controller {

	private $dashboardModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->model('DashboardModel');
		$this->dashboardModel=$this->DashboardModel;
	}

	public function index() {

		$totalMahasiswa = $this->dashboardModel->getTotalMahasiswa();
		$totalDosen = $this->dashboardModel->getTotalDosen();
		$totalMataKuliah = $this->dashboardModel->getTotalMataKuliah();
		$totalKelas = $this->dashboardModel->getTotalKelas();

		$data=array(
			'totalMahasiswa' => $totalMahasiswa,
			'totalDosen'=> $totalDosen,
			'totalMataKuliah' => $totalMataKuliah,
			'totalKelas' => $totalKelas
		);
			
		//echo $query->num_rows();
		$this->load->view('dashboard/home', $data);
	}

}
