<?php

class Ruang extends CI_Controller {

    private $ruangModel;

    public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['Ruang'])) {
			redirect(base_url());
		}
		$this->load->library('session');
		$this->load->model('RuangModel');
		$this->ruangModel=$this->RuangModel;
    }

    public function index() {
        $data = array();
		$data['title'] = 'SIJP - Master Ruang';
		$this->load->view('masterRuang/read', $data);
    }

    public function getListRuang() {
		$columns = array( 
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'kode',
			3 => 'nama',
            4 => 'kapasitas',
		);
			
		//Get total data
		$totalData = $this->ruangModel->getTotalData();
			
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

		$getListRuang=$this->ruangModel->getListRuang($params);
		$totalFiltered=$this->ruangModel->getListRuangCount($params);
			
		$data = array();
		if(!empty($getListRuang)) {
			foreach ($getListRuang as $row) {

				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='".base_url('ruang/update?id=').$row->id."'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
					</a>
						
					<button class='btn btn-sm btn-danger' data-href='".base_url('ruang/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
							<i class='fa fa-trash'></i>
					</button>
					";
				$nestedData['kode'] = $row->kode;
				$nestedData['nama'] = $row->nama;
                $nestedData['kapasitas'] = $row->kapasitas;
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
			$data['title'] = 'SIJP - Master Ruang Create';
			$this->load->view('masterRuang/create', $data);
		} else {
			$params=array();
			$params['kode'] = $_POST['kode'];
			$params['nama'] = $_POST['nama'];
      		$params['kapasitas'] = $_POST['kapasitas'];
    
			$hasil=$this->ruangModel->create($params);
			if ($hasil===TRUE) {
				$this->session->set_flashdata('responseModule', 'success');
				$this->session->set_flashdata('responseModuleBackground', 'success');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diinput');
				redirect(base_url('ruang'));
			} else {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diinput');
				redirect(base_url('ruang'));
			}
		}
	}

    public function update() {
        if(!isset($_POST['simpan'])) {
            $id=$_GET['id'];
			$dataRuang=$this->ruangModel->getListRuangByID($id);
			$data=[];
			$data['dataRuang']=$dataRuang;
			$data['title'] = 'SIJP - Master Ruang Update';
			$this->load->view('masterRuang/update', $data);
        } else {
            
            $params=$_POST;
            $updateDataRuang = $this->ruangModel->update($params);
			if ($updateDataRuang===TRUE) {
				$this->session->set_flashdata('responseModule', 'success');
				$this->session->set_flashdata('responseModuleBackground', 'success');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil diupdate');
				redirect(base_url('ruang'));
			} else {
				$this->session->set_flashdata('responseModule', 'failed');
				$this->session->set_flashdata('responseModuleBackground', 'danger');
				$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
				$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal diupdate');
				redirect(base_url('ruang'));
			}

        }
    }

    public function delete() {
		$params=[];
		$id=$_GET['id'];
		$params['id']=$id;
		$hapusDataRuang=$this->ruangModel->delete($params);
		if ($hapusDataRuang===TRUE) {
			$this->session->set_flashdata('responseModule', 'success');
			$this->session->set_flashdata('responseModuleBackground', 'success');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-check');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data berhasil dihapus');
			redirect(base_url('ruang'));
		} else {
			$this->session->set_flashdata('responseModule', 'failed');
			$this->session->set_flashdata('responseModuleBackground', 'danger');
			$this->session->set_flashdata('responseModuleIcon', 'fa fa-times');
			$this->session->set_flashdata('responseModuleMsg', '<br>Data gagal dihapus');
			redirect(base_url('ruang'));
		}
	}


}