<?php
    class mahasiswaPeserta extends CI_Controller {

        private $mahasiswaPesertaModel;

        public function __construct() {
            parent::__construct();
            if($this->session->userdata('status') != "login"){
				redirect(base_url("Auth"));
			}
            $this->load->library('session');

            $this->load->model('MahasiswaPesertaModel');
            $this->mahasiswaPesertaModel=$this->MahasiswaPesertaModel;
        }

        public function index() {
            $this->load->view('MahasiswaPeserta/read');
        }

        public function getListDosenPengampu() {
            $columns = array( 
                0 => 'nomor', 
                1 => 'aksi', 
                2 => 'nik',
                3 => 'dosen',
                4 =>'kode_mata_kuliah',
                5 => 'mata_kuliah',
                6 => 'kelas',
                7 => 'jam_mulai',
                8 => 'jam_selesai',
                9 => 'ruang',
            );

            //Get total data
            $totalData = $this->mahasiswaPesertaModel->getTotalDataDosenPengampu();

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

            $getListDosenPengampu=$this->mahasiswaPesertaModel->getListDosenPengampu($params);
            $totalFiltered=$this->mahasiswaPesertaModel->getListDosenPengampuCount($params);
            
            $data = array();
            if(!empty($getListDosenPengampu)) {
                foreach ($getListDosenPengampu as $row)
	            {
	                $nestedData['nomor'] = " ";
                    $nestedData['aksi'] = "
                        <a href='".base_url('mahasiswaPeserta/detail?id=').$row->id."'>
                            <button class='btn btn-sm btn-primary'><i class='fa fa-search-plus'></i></button>
                        </a>
                    ";
                    $nestedData['nik'] = $row->nik;
                    $nestedData['dosen'] = $row->dosen;
	                $nestedData['kode_mata_kuliah'] = $row->kode_mata_kuliah;
                    $nestedData['mata_kuliah'] = $row->mata_kuliah;
                    $nestedData['kelas'] = $row->kelas;
                    $nestedData['jam_mulai'] = $row->jam_mulai;
                    $nestedData['jam_selesai'] = $row->jam_selesai;
                    $nestedData['ruang'] = $row->ruang;
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

        public function detail() {
            $dataPengampu = $this->mahasiswaPesertaModel->getListDosenPengampuById($_GET['id']);
            
            $data=[];
            $data['dataPengampu'] = $dataPengampu;
            $this->load->view('mahasiswaPeserta/readDetail', $data);
        }

        public function getListMahasiswa() {
            $columns = array( 
                0 =>    'checkbox',
                1 =>    'nomor', 
                2 =>    'nim',
                3 =>    'nama',
                4 =>    'semester',
            );

            $id_dosen_pengampu_mata_kuliah=$_POST['id_dosen_pengampu_mata_kuliah'];

            $dataMahasiswaPesertaArray = $this->mahasiswaPesertaModel->getListMahasiswaPeserta($id_dosen_pengampu_mata_kuliah);
            $dataMahasiswaPeserta=[];
            for($i=0; $i<count($dataMahasiswaPesertaArray); $i++) {
                $dataMahasiswaPeserta[$i]=$dataMahasiswaPesertaArray[$i]['id_mahasiswa'];
            }
            
            //Get total data
            $totalData = $this->mahasiswaPesertaModel->getTotalDataMahasiswa($dataMahasiswaPeserta);

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
                'search' => $search,
                'dataMahasiswaPeserta' => $dataMahasiswaPeserta
            );

            $getListMahasiswa=$this->mahasiswaPesertaModel->getListMahasiswa($params);
            $totalFiltered=$this->mahasiswaPesertaModel->getListMahasiswaCount($params);

            $data = array();
	        if(!empty($getListMahasiswa)) {
	            foreach ($getListMahasiswa as $row)
	            {
                    $nestedData['checkbox'] = "<input type='checkbox' class='checkbox1' id='chk' name='check[]' value='".$row->id."'/>";
	                $nestedData['nomor'] = " ";
	                $nestedData['nim'] = $row->nim;
	                $nestedData['nama'] = $row->nama;
                    $nestedData['semester'] = $row->semester;
	                
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

        public function addMahasiswaPeserta() {
           $id_dosen_pengampu_mata_kuliah = $_POST['id_dosen_pengampu_mata_kuliah'];
           $dataMahasiswa = $_POST['array_id_mahasiswa'];

            try {
                for($i=0; $i<count($dataMahasiswa); $i++) {
                    $params=array(
                        'id_dosen_pengampu_mata_kuliah' => $id_dosen_pengampu_mata_kuliah,
                        'id_mahasiswa' => $dataMahasiswa[$i]
                    );
                    $hasil = $this->mahasiswaPesertaModel->addMahasiswaPeserta($params);
                    if (!$hasil) {
                        throw new Exception("Configuration file not found.");
                    }
                }
                $data = [
                    'success' => true,
                    'message' => 'Peserta mata kuliah berhasil ditambahkan'
                ];
                echo json_encode($data);
            } catch (Exception $e) {
                $data = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
                echo json_encode($data);
            }
        }

        public function getListPeserta() {
            $columns = array(
                0 =>    'nomor', 
                1 =>    'aksi',
                2 =>   'id_peserta',
                3 =>    'nama',
                4 =>    'nim',
                5 =>    'semester',
                6 =>    'kp_komponen_penilaian_1',
                7 =>    'kp_komponen_penilaian_2',
                8 =>    'kp_komponen_penilaian_3',
                9 =>    'kp_komponen_penilaian_4',
                10 =>    'kp_komponen_penilaian_5',
                11 =>   'kp_komponen_penilaian_6',
                12 =>   'nilai_akhir',
                13 =>   'harkat'
            );

            //Get total data
            $totalData = $this->mahasiswaPesertaModel->getTotalDataPeserta($_POST['id_dosen_pengampu_mata_kuliah']);
            
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
                'search' => $search,
                'id_dosen_pengampu_mata_kuliah' => $_POST['id_dosen_pengampu_mata_kuliah']
            );

            $getListPeserta=$this->mahasiswaPesertaModel->getListPeserta($params);
            $totalFiltered=$this->mahasiswaPesertaModel->getListPesertaCount($params);

            $data = array();
	        if(!empty($getListPeserta)) {

                $data_harkat = $this->mahasiswaPesertaModel->getListHarkat();

	            foreach ($getListPeserta as $row)
	            {
                    $nestedData['nomor'] = " ";
                    $nestedData['aksi'] = "
                        <button class='btn btn-sm btn-danger' onclick='deletePeserta($row->id)'>
                            <i class='fa fa-trash'></i>
                        </button>
                    ";
                    $nestedData['id_peserta'] = $row->id;
                    $nestedData['nim'] = $row->nim;
                    $nestedData['nama'] = $row->mahasiswa;
                    $nestedData['semester'] = $row->semester;
                    $nestedData['kp_komponen_penilaian_1'] = "<input type='number' id='input-penilaian-cpmk1-$row->id' name='input-penilaian-cpmk1-$row->id' value='$row->cpmk_1_nilai' class='form-control' style='text-align:right; width: 100%' placeholder='0 - 100'>";
                    $nestedData['kp_komponen_penilaian_2'] = "<input type='number' id='input-penilaian-cpmk2-$row->id' name='input-penilaian-cpmk2-$row->id' value='$row->cpmk_2_nilai' class='form-control' style='text-align:right; width: 100%' placeholder='0 - 100 '>";
                    $nestedData['kp_komponen_penilaian_3'] = "<input type='number' id='input-penilaian-cpmk3-$row->id' name='input-penilaian-cpmk3-$row->id' value='$row->cpmk_3_nilai' class='form-control' style='text-align:right; width: 100%' placeholder='0 - 100'>";
                    $nestedData['kp_komponen_penilaian_4'] = "<input type='number' id='input-penilaian-cpmk4-$row->id' name='input-penilaian-cpmk4-$row->id' value='$row->cpmk_4_nilai' class='form-control' style='text-align:right; width: 100%' placeholder='0 - 100'>";
                    $nestedData['kp_komponen_penilaian_5'] = "<input type='number' id='input-penilaian-cpmk5-$row->id' name='input-penilaian-cpmk5-$row->id' value='$row->cpmk_5_nilai' class='form-control' style='text-align:right; width: 100%' placeholder='0 - 100'>";
                    $nestedData['kp_komponen_penilaian_6'] = "<input type='number' id='input-penilaian-cpmk6-$row->id' name='input-penilaian-cpmk6-$row->id' value='$row->cpmk_6_nilai' class='form-control' style='text-align:right; width: 100%' placeholder='0 - 100'>";
                    $nestedData['nilai_akhir'] = [$row->cpmk_1_nilai, $row->cpmk_2_nilai, $row->cpmk_3_nilai, $row->cpmk_4_nilai, $row->cpmk_5_nilai, $row->cpmk_6_nilai];
                    $nestedData['harkat'] = $data_harkat;

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

        public function deleteMahasiswaPeserta() {
            $id_mahasiswa_peserta_mata_kuliah = $_POST['id_mahasiswa_peserta_mata_kuliah'];
            $hapus = $this->mahasiswaPesertaModel->delete($id_mahasiswa_peserta_mata_kuliah);
            if($hapus) {
                $json_data = array(
                    'success' => true,
                    'message' => 'Data berhasil di hapus'
                );
            } else {
                $json_data = array(
                    'success' => false,
                    'message' => 'Data tidak berhasil di hapus'
                );
            }
            echo json_encode($json_data);
        }

        public function updateNilai() {

            $data_peserta = json_decode($_POST['data_peserta'], true);

            try {

                for($i=0; $i<count($data_peserta); $i++) {
                    $data = array(
                        'cpmk_1_nilai' => ($data_peserta[$i]['cpmk_1']!=null) ? $data_peserta[$i]['cpmk_1'] : NULL,
                        'cpmk_2_nilai' => ($data_peserta[$i]['cpmk_2']!=null) ? $data_peserta[$i]['cpmk_2'] : NULL,
                        'cpmk_3_nilai' => ($data_peserta[$i]['cpmk_3']!=null) ? $data_peserta[$i]['cpmk_3'] : NULL,
                        'cpmk_4_nilai' => ($data_peserta[$i]['cpmk_4']!=null) ? $data_peserta[$i]['cpmk_4'] : NULL,
                        'cpmk_5_nilai' => ($data_peserta[$i]['cpmk_5']!=null) ? $data_peserta[$i]['cpmk_5'] : NULL,
                        'cpmk_6_nilai' => ($data_peserta[$i]['cpmk_6']!=null) ? $data_peserta[$i]['cpmk_6'] : NULL,
                    );
                    $params = array(
                        "id_peserta" => $data_peserta[$i]['id_peserta'],
                        "data" => $data
                    );

                    $hasil = $this->mahasiswaPesertaModel->updateNilai($params);
                    if (!$hasil) {
                        throw new Exception("Data gagal di update");
                    }
                }
                $data = [
                    'success' => true,
                    'message' => 'Nilai mahasiswa berhasil di update'
                ];
                echo json_encode($data);

            } catch (Exception $e) {
                $data = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
                echo json_encode($data);
            }


        }

    }