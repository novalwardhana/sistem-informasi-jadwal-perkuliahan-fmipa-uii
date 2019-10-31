<?php

class TahunAkademik extends CI_Controller {

	private $tahunAkademikModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['TahunAkademik'])) {
			redirect(base_url());
		}
		$this->load->library('session');
		$this->load->model('TahunAkademikModel');
		$this->tahunAkademikModel=$this->TahunAkademikModel;
	}

	public function index() {
		$data = array();
		$data['title'] = 'CPL - Master Tahun Akademik';
		$this->load->view('masterTahunAkademik/read', $data);
	}

	public function getListTahunAkademik() {
		$columns = array( 
			0  => 'nomor', 
			1  => 'aksi', 
			2  => 'tahun_akademik',
			3  => 'semester'
		);

		//Get total data
		$totalData = $this->tahunAkademikModel->getTotalData();

		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = 'id';
		$dir = 'desc';
		$search=$_POST['search']['value'];

		$params=array(
			'limit' => $limit,
			'start' => $start,
			'order' => $order,
			'dir' => $dir,
			'search' => $search
		);

		$getListTahunAkademik=$this->tahunAkademikModel->getListTahunAkademik($params);
		$totalFiltered=$this->tahunAkademikModel->getListTahunAkademikCount($params);

		$data = array();
		if(!empty($getListTahunAkademik)) {
			foreach ($getListTahunAkademik as $row){
				$nestedData['nomor'] = '';
				$nestedData['aksi'] = "
					<a href='".base_url('tahun-akademik/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
					<button class='btn btn-sm btn-danger' data-href='".base_url('tahun-akademik/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
						<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['tahun_akademik'] = $row->tahun_mulai.' - '.$row->tahun_selesai;
				$nestedData['semester'] = ucfirst($row->semester);
				$data[] = $nestedData;
			}
		}

		$json_data = array(
			"draw"            => intval($_POST['draw']),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
		);
	
		echo json_encode($json_data);

	}

	public function create() {
		$data=array();
		if(!isset($_POST['simpan'])) {
			$data=array();
			$data['title'] = 'CPL - Master Tahun Akademik';
			$this->load->view('masterTahunAkademik/create', $data);
		} else {
	
			try {
				$params=array();
				$params['tahun_mulai']=$_POST['tahun_mulai'];
				$params['tahun_selesai']=$_POST['tahun_selesai'];
				$params['semester']=$_POST['semester'];

				$hasil=$this->tahunAkademikModel->create($params);
				if (!hasil) {
					throw new Exception("Data gagal dihapus.");
				}

				$this->session->set_flashdata('responseModule', 'success');
				$this->session->set_flashdata('responseModuleBackground', 'success');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diinput');
				redirect(base_url('tahun-akademik'));

			} catch (Exception $e) {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diinput');
				redirect(base_url('tahun-akademik'));
			}
		}
	}

	public function update() {
		if(!isset($_POST['simpan'])) {
			$id=$_GET['id'];
			$dataTahunAkademik=$this->tahunAkademikModel->getListTahunAkademikById($id);
			$data=[];
			$data['dataTahunAkademik']=$dataTahunAkademik;
			$data['title'] = 'CPL - Master Tahun Akademik';
			$this->load->view('masterTahunAkademik/update', $data);
		} else {
			$params=$_POST;
			$updateTahunAkademik=$this->tahunAkademikModel->update($params);
			if ($updateTahunAkademik===TRUE) {
				$this->session->set_flashdata('responseModule', 'success');
				$this->session->set_flashdata('responseModuleBackground', 'success');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diupdate');
				redirect(base_url('tahun-akademik'));
			} else {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diupdate');
				redirect(base_url('tahun-akademik'));
			}
		}
	}

	public function delete() {
		$params=[];
		$id=$_GET['id'];
		$params['id']=$id;
		$hapusTahunAkademik=$this->tahunAkademikModel->delete($params);
		if ($hapusTahunAkademik===TRUE) {
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil dihapus');
			redirect(base_url('tahun-akademik'));
		} else {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal dihapus');
			redirect(base_url('tahun-akademik'));
		}
	}

}
