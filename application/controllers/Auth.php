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
				$data = array();
				$data['title'] = 'CPL - Login';
				$this->load->view('auth/formLogin.php', $data);
			}
		}

		public function aksiLogin() {
			$params=array();
			$params['username']=$_POST['username'];
			$params['password']=$_POST['password'];
			$hasil=$this->authModel->aksi_login($params);
			if ($hasil==1) {
				
				$dataUser=$this->authModel->dataUser($params);
				$data_pengguna=array(
					"username"=>$params['username'],
					"password"=>$params['password'],
					"nama_user"=>$dataUser->nama_user,
					"id_role"=>$dataUser->id_role,
					"id_dosen" => $dataUser->id_dosen,
					"id_mahasiswa" => $dataUser->id_mahasiswa,
					"role_user" => $dataUser->role_user,
					"status"=>"login"
				);
				$data_permission = $this->authModel->getListPermission($data_pengguna['id_role']);
				$data_pengguna['permission'] = $data_permission;

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
