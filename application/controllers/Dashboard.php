<?php
class Dashboard extends CI_Controller {

	private $dashboardModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
		$this->load->model('DashboardModel');
		$this->dashboardModel=$this->DashboardModel;
	}

	public function index() {

		$totalDosen = $this->dashboardModel->getTotalDosen();
		$totalMataKuliah = $this->dashboardModel->getTotalMataKuliah();
		$totalRuang = $this->dashboardModel->getTotalRuang();
		$totalKelas = $this->dashboardModel->getTotalKelas();

		$data=array(
			'title' => 'SIJP - Dashboard',
			'totalDosen'=> $totalDosen,
			'totalMataKuliah' => $totalMataKuliah,
			'totalRuang' => $totalRuang,
			'totalKelas' => $totalKelas
		);
			
		//echo $query->num_rows();
		$this->load->view('dashboard/home', $data);
	}

}
