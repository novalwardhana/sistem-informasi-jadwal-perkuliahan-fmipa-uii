<?php

    class Klasifikasi extends CI_Controller {

        private $klasifikasiModel;

        public function __construct() {
            parent::__construct();
            if($this->session->userdata('status') != "login"){
				redirect(base_url("Auth"));
			}
            $this->load->library('session');
            $this->load->model('KlasifikasiModel');
            $this->klasifikasiModel=$this->KlasifikasiModel;
        }

        public function index() {
            $this->load->view('masterKlasifikasi/read');
        }

        public function getListKlasifikasi() {
            $columns = array( 
                0 =>'nomor', 
                1 =>'aksi', 
                2 =>'rentang',
                3=> 'keterangan',
                4=> 'predikat'
            );

            
            //Get total data
            $totalData = $this->klasifikasiModel->getTotalData();
            
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

            $getListKlasifikasi=$this->klasifikasiModel->getListKlasifikasi($params);
            $totalFiltered=$this->klasifikasiModel->getListKlasifikasiCount($params);
           
            $data = array();
	        if(!empty($getListKlasifikasi)) {
	            foreach ($getListKlasifikasi as $row)
	            {

	                $nestedData['nomor'] = $row->nomor;
	                $nestedData['aksi'] = "
                        	<a href='".base_url('klasifikasi/update?id=').$row->id."'>
	                          <button class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>
                            </a>
                            
                            <button class='btn btn-sm btn-danger' data-href='".base_url('klasifikasi/delete?id=').$row->id."' data-toggle='modal' data-target='#confirm-delete'>
                                <i class='fa fa-trash'></i>
                            </button>
                        	";
                    $nestedData['rentang'] = $row->rentang;
	                $nestedData['keterangan'] = $row->keterangan;
	                $nestedData['predikat'] = $row->predikat;
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
                $data['main_view']='masterKlasifikasi/create';
                $this->load->view('layout/layoutGeneral', $data);
            } else {
                $params=array();
                $params['batas_bawah']=$_POST['batas_bawah'];
                $params['batas_atas']=$_POST['batas_atas'];
                $params['keterangan']=$_POST['keterangan'];
                $params['predikat']=$_POST['predikat'];
                $hasil=$this->klasifikasiModel->create($params);

                if ($hasil===TRUE) {
                    $this->session->set_flashdata('imageMsg', 'create_success');
                    redirect(base_url('klasifikasi'));
                } else {
                    $this->session->set_flashdata('imageMsg', 'create_failed');
                    redirect(base_url('klasifikasi'));
                }
            }
        }

        public function update() {
            if(!isset($_POST['simpan'])) {
                $id=$_GET['id'];
                $dataKlasifikasi=$this->klasifikasiModel->getListKlasifikasiById($id);
                $data=[];
                $data['dataKlasifikasi']=$dataKlasifikasi;
                $this->load->view('masterKlasifikasi/update', $data);
            } else {
                $params=$_POST;
                $updateDataKlasifikasi=$this->klasifikasiModel->update($params);
                if ($updateDataKlasifikasi===TRUE) {
                    $this->session->set_flashdata('imageMsg', 'update_success');
                    redirect(base_url('klasifikasi'));
                } else {
                    $this->session->set_flashdata('imageMsg', 'update_failed');
                    redirect(base_url('klasifikasi'));
                }
            }
        }

        public function delete() {
            $params=[];
            $id=$_GET['id'];
            $params['id']=$id;
            $hapusDataKlasifikasi=$this->klasifikasiModel->delete($params);
            if ($hapusDataKlasifikasi===TRUE) {
                $this->session->set_flashdata('imageMsg', 'delete_success');
                redirect(base_url('klasifikasi'));
            } else {
                $this->session->set_flashdata('imageMsg', 'delete_failed');
                redirect(base_url('klasifikasi'));
            }
        }

    }