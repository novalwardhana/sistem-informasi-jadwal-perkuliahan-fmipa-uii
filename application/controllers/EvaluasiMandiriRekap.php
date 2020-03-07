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
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'nim',
			3 => 'nama',
			4 => 'semester',
			5 => 'cpl_rata_rata',
			6 => 'keterangan',
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
					<a href='#' target='_blank'>
						<button class='btn btn-sm btn-primary'><i class='fa fa-search-plus'></i></button>
					</a>
					";
				$nestedData['nim'] = $row->nim;
				$nestedData['nama'] = $row->nama;
				$nestedData['semester'] = $row->semester;

				$rata_rata_cpl = $this->rataRataCpl($row->id, $row->semester, $data_harkat);
				$nestedData['cpl_rata_rata'] = $rata_rata_cpl;

				$capaian_keterangan = '';
				for($l=0; $l<count($data_klasifikasi); $l++) {
					$batas_bawah = $data_klasifikasi[$l]['batas_bawah'];
					$batas_atas = $data_klasifikasi[$l]['batas_atas'];
					if ($rata_rata_cpl>=$batas_bawah 
						&& 
						$rata_rata_cpl<=$batas_atas
					) {
						$capaian_keterangan = $data_klasifikasi[$l]['predikat'];
					}
				}
				$nestedData['keterangan'] = $capaian_keterangan;

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

	public function rataRataCpl($id_mahasiswa, $semester, $data_harkat) {
		$cpl1 = $this->rekapCpl($id_mahasiswa, $semester, 'CPL 1', $data_harkat);
		$cpl2 = $this->rekapCpl($id_mahasiswa, $semester, 'CPL 2', $data_harkat);
		$cpl3 = $this->rekapCpl($id_mahasiswa, $semester, 'CPL 3', $data_harkat);
		$cpl4 = $this->rekapCpl($id_mahasiswa, $semester, 'CPL 4', $data_harkat);
		$cpl5 = $this->rekapCpl($id_mahasiswa, $semester, 'CPL 5', $data_harkat);
		$cpl6 = $this->rekapCpl($id_mahasiswa, $semester, 'CPL 6', $data_harkat);
		$cpl7 = $this->rekapCpl($id_mahasiswa, $semester, 'CPL 7', $data_harkat);
		$cpl8 = $this->rekapCpl($id_mahasiswa, $semester, 'CPL 8', $data_harkat);
		$cpl9 = $this->rekapCpl($id_mahasiswa, $semester, 'CPL 9', $data_harkat);
		$rataRata = ($cpl1 + $cpl2 + $cpl3 + $cpl4 + $cpl5 + $cpl6 + $cpl7 + $cpl8 + $cpl9) / 9;
		return round($rataRata, 2);
	}

	public function rekapCpl($id_mahasiswa, $semester, $cpl, $data_harkat) {

		$data_cpl = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, $cpl);

		$total_harkat = 0;
		$total_sks = 0;

		$cpl_nama = (isset($data_cpl[0]['nama_cpl'])) ? $data_cpl[0]['nama_cpl'] : ' ';
		$cpl_nama_low = 'skor_maks_'.str_replace(' ','_',strtolower($cpl_nama));
		$data_skor_maks = $this->evaluasiMandiriHasilModel->getSkorMaks($semester);
		$skor_maks = (isset($data_skor_maks[$cpl_nama_low])) ? $data_skor_maks[$cpl_nama_low] : 0;

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
		$capaian = ($skor_maks!=0) ? round((($skor_mahasiswa/$skor_maks)*100),2) : 0;

		return $capaian;
	}

}
