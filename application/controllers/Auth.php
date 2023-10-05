<?php
	class Auth extends CI_Controller {

		public $authModel=null;
		private $pengaturanSistemModel;

		public function __construct() {
			parent::__construct();
			$this->load->model('AuthModel');
			$this->authModel=$this->AuthModel;
		}

		public function index() {
			if($this->session->userdata('status') != "login"){
				$data = array();
				$data['title'] = 'SIJP - Login';
				$this->load->view('auth/formLogin.php', $data);
			}
		}

		public function prosesLogin() {
			$params=array();
			$params['username'] = $this->input->post("username"); 
			$params['password']= md5($this->input->post("password"));

			$dataUser = $this->authModel->getUserData($params);
			if (!isset($dataUser->username)) {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleTitle', 'Failed');
				$this->session->set_flashdata('responseModuleMsg', 'Login gagal, Username tidak valid');
				return redirect(base_url("auth"));
			}
			if ($dataUser->password != md5($this->input->post("password"))) {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleTitle', 'Failed');
				$this->session->set_flashdata('responseModuleMsg', 'Login gagal, password tidak valid');
				return redirect(base_url("auth"));
			}

			$userDataWithRole = $this->authModel->getUserDataWithRole($params);
			$data_pengguna=array(
				"id_user" => $userDataWithRole->id,
				"username" => $params['username'],
				"password" => $params['password'],
				"nama_user" => $userDataWithRole->nama_user,
				"id_role" => $userDataWithRole->id_role,
				"id_dosen" => $userDataWithRole->id_dosen,
				"id_mahasiswa" => $userDataWithRole->id_mahasiswa,
				"role_user" => $userDataWithRole->role_user,
				"status" => "login"
			);
			$data_permission = $this->authModel->getListPermission($data_pengguna['id_role']);
			$data_pengguna['permission'] = $data_permission;

			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleTitle', 'Success');
			$this->session->set_flashdata('responseModuleMsg', 'Login berhasil');
			$this->session->set_userdata($data_pengguna);
			redirect(base_url("dashboard"));
		}

		public function logout() {
			$this->session->sess_destroy();
			redirect(base_url("auth"));
		}
	}
