<?php

    class Dosen extends CI_Controller {

        private $dosenModel;

        public function __construct() {
            parent::__construct();
            if($this->session->userdata('status') != "login"){
				redirect(base_url("Auth"));
			}
            $this->load->library('session');
            $this->load->model('DosenModel');
            $this->dosenModel=$this->DosenModel;
        }

        public function index() {
            $this->load->view('masterDosen/read');
        }

        public function getListDosen() {
            $columns = array( 
                0 =>'nomor', 
                1 =>'aksi', 
                2 =>'nik',
                3=> 'nama',
            );

            
            //Get total data
            $totalData = $this->dosenModel->getTotalData();
            
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

            $getListDosen=$this->dosenModel->getListDosen($params);
            $totalFiltered=$this->dosenModel->getListDosenCount($params);
           
            $data = array();
	        if(!empty($getListDosen)) {
	            foreach ($getListDosen as $row)
	            {

	                $nestedData['nomor'] = $row->nomor;
	                $nestedData['aksi'] = "
                        	<a href='".base_url('dosen/update?id=').$row->id."'>
	                          <button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
                            </a>
                            
                            <button class='btn btn-sm btn-danger' data-href='".base_url('dosen/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
                                <i class='fa fa-trash'></i>
                            </button>
                        	";
	                $nestedData['nik'] = $row->nik;
	                $nestedData['nama'] = $row->nama;
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
                $data['main_view']='masterDosen/create';
                $this->load->view('layout/layoutGeneral', $data);
            } else {
                $params=array();
                $params['nik']=$_POST['nik'];
                $params['nama']=$_POST['nama'];
                $params['password']='1234';
                $hasil=$this->dosenModel->create($params);

                if ($hasil===TRUE) {
                    $this->session->set_flashdata('imageMsg', 'create_success');
                    redirect(base_url('dosen'));
                } else {
                    $this->session->set_flashdata('imageMsg', 'create_failed');
                    redirect(base_url('dosen'));
                }
            }
        }

        public function update() {
            if(!isset($_POST['simpan'])) {
                $id=$_GET['id'];
                $dataDosen=$this->dosenModel->getListDosenById($id);
                $data=[];
                $data['dataDosen']=$dataDosen;
                $this->load->view('masterDosen/update', $data);
            } else {
                $params=$_POST;
                $updateDataDosen=$this->dosenModel->update($params);
                if ($updateDataDosen===TRUE) {
                    $this->session->set_flashdata('imageMsg', 'update_success');
                    redirect(base_url('dosen'));
                } else {
                    $this->session->set_flashdata('imageMsg', 'update_success');
                    redirect(base_url('dosen'));
                }
            }
        }

        public function delete() {
            $params=[];
            $id=$_GET['id'];
            $params['id']=$id;
            $hapusDataDosen=$this->dosenModel->delete($params);
            if ($hapusDataDosen===TRUE) {
                $this->session->set_flashdata('imageMsg', 'delete_success');
                redirect(base_url('dosen'));
            } else {
                $this->session->set_flashdata('imageMsg', 'delete_success');
                redirect(base_url('dosen'));
            }
        }

    }