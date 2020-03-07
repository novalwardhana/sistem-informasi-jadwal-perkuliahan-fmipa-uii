<?php

class EvaluasiMandiriRekap extends CI_Controller {

	private $evaluasiMandiriRekapModel;
	private $evaluasiMandiriHasilModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$dataSessionPermission = $this->session->userdata('permission');
		if (!isset($dataSessionPermission['EvaluasiMandiriRekap'])) {
			redirect(base_url());
		}
		$this->load->library('session');

		$this->load->model('EvaluasiMandiriRekapModel');
		$this->evaluasiMandiriRekapModel=$this->EvaluasiMandiriRekapModel;

		$this->load->model('EvaluasiMandiriHasilModel');
		$this->evaluasiMandiriHasilModel=$this->EvaluasiMandiriHasilModel;
	}

	public function index() {
		$data = array();
		$data['title'] = 'CPL - Rekap Evaluasi Mandiri';
		$this->load->view('evaluasiMandiriRekap/read', $data);
	}

	public function getListRekap() {
		$columns = array( 
			0 =>'nomor', 
			1 =>'aksi', 
			2 =>'nim',
			3=> 'nama',
			4=> 'semester',
			5=> 'cpl1',
		);

		//Get total data
		$totalData = $this->evaluasiMandiriRekapModel->getTotalData();
		
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

		$getListMahasiswa=$this->evaluasiMandiriRekapModel->getListMahasiswa($params);
		$totalFiltered=$this->evaluasiMandiriRekapModel->getListMahasiswaCount($params);
		$data_harkat = $this->evaluasiMandiriHasilModel->getListHarkat();
		$data_klasifikasi = $this->evaluasiMandiriHasilModel->getListKlasifikasi();
			
		$data = array();
		if(!empty($getListMahasiswa)) {
			foreach ($getListMahasiswa as $row) {

				$nestedData['nomor'] = $row->nomor;
				$nestedData['aksi'] = "
					<a href='#'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-print'></i></button>
					</a>
					";
				$nestedData['nim'] = $row->nim;
				$nestedData['nama'] = $row->nama;
				$nestedData['semester'] = $row->semester;
				$nestedData['cpl1'] = $this->rekapCpl($row->id, 'CPL 1', $data_harkat, $data_klasifikasi);
				
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

	public function rekapCpl($id_mahasiswa, $cpl, $data_harkat, $data_klasifikasi) {
		$data_cpl = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, $cpl);
		$total_harkat = 0;
		$total_sks = 0;

		for($j=0; $j<count($data_cpl); $j++) {
			$harkat=0;

			if ($data_cpl[$j]['capaian_nilai_max']>=100) {
				
				$harkat = 100;

			} else {

				for($k=0; $k<count($data_harkat); $k++) {
					$batas_bawah = $data_harkat[$k]['batas_bawah'];
					$batas_atas = $data_harkat[$k]['batas_atas'];
					if ($data_cpl[$j]['capaian_nilai_max']>=$batas_bawah 
						&& 
						$data_cpl[$j]['capaian_nilai_max']<$batas_atas
					) {
						$harkat = $data_harkat[$k]['harkat'];
					}
				}

			}
			
			$subtotal_harkat = $data_cpl[$j]['mk_sks'] * $harkat * $data_cpl[$j]['cpld_kontribusi'];
			$total_harkat += $subtotal_harkat;
			$total_sks += $data_cpl[$j]['mk_sks'];
		}

		$skor_mahasiswa = ($total_sks!=0) ? round(($total_harkat/$total_sks), 2) : 0;

		return $skor_mahasiswa;
	}

}
