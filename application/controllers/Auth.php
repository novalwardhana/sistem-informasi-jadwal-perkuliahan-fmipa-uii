<?php
	class Auth extends CI_Controller {

		public $authModel=null;

		public function __construct() {
			parent::__construct();
			$this->load->model('AuthModel');
			$this->authModel=$this->AuthModel;
		}

		public function index() {
			if($this->session->userdata('status') != "login"){
				$this->load->view('auth/formLogin.php');
			}
		}

		public function aksiLogin() {
			$params=array();
			$params['username']=$_POST['username'];
			$params['password']=$_POST['password'];
			$hasil=$this->authModel->aksi_login($params);
			if ($hasil==1) {
				$role=$this->authModel->cek_role($params);
				$data_pengguna=array(
					"username"=>$params['username'],
					"password"=>$params['password'],
					"role"=>$role->role,
					"status"=>"login"
				);
				$this->session->set_userdata($data_pengguna);
				redirect(base_url("Dashboard"));
			} else {
				redirect(base_url("Auth"));
			}
		}

		public function logout() {
			$this->session->sess_destroy();
			redirect(base_url("Auth"));
		}
	}