<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
		$total_data = $this->evaluasiMandiriRekapModel->getTotalData();
		$data['total_data'] = $total_data;
		$data['jumlah_halaman'] = ceil($total_data/10);
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
					<a href='".base_url('rekap-evaluasi-mandiri/detail?id=').$row->id."' target='_blank'>
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

	public function detailRekap() {
		$id_mahasiswa=$_GET['id'];

		$data_laporan = array();
		$data_cpl1 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 1');
		$data_cpl2 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 2');
		$data_cpl3 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 3');
		$data_cpl4 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 4');
		$data_cpl5 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 5');
		$data_cpl6 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 6');
		$data_cpl7 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 7');
		$data_cpl8 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 8');
		$data_cpl9 = $this->evaluasiMandiriHasilModel->getListCpl($id_mahasiswa, 'CPL 9');
		$data_laporan[] = $data_cpl1;
		$data_laporan[] = $data_cpl2;
		$data_laporan[] = $data_cpl3;
		$data_laporan[] = $data_cpl4;
		$data_laporan[] = $data_cpl5;
		$data_laporan[] = $data_cpl6;
		$data_laporan[] = $data_cpl7;
		$data_laporan[] = $data_cpl8;
		$data_laporan[] = $data_cpl9;

		$data = array();
		$data['title'] = 'CPL - Laporan Hasil Evaluasi Mandiri Detail';
		$data['data_mahasiswa'] = $this->evaluasiMandiriHasilModel->getListMahasiswaById($id_mahasiswa);
		$data['data_skor_maks'] = $this->evaluasiMandiriHasilModel->getSkorMaks($data['data_mahasiswa']->semester);
		$data['data_laporan'] = $data_laporan;
		$data['data_harkat'] = $this->evaluasiMandiriHasilModel->getListHarkat();
		$data['data_klasifikasi'] = $this->evaluasiMandiriHasilModel->getListKlasifikasi();

		$this->load->view('evaluasiMandiriHasil/read', $data);
	}

	public function exportExcel() {

		if (isset($_GET["start"])) {
			$start = $_GET["start"];
		} else {
			$start = 0;
		}

		if (isset($_GET["search"])) {
			$search = $_GET["search"];
		} else {
			$search = '';
		}

		if (isset($_GET["limit"])) {
			$limit = $_GET["limit"];
		} else {
			$limit = 0;
		}

		$data = $this->getExportData($start, $limit, $search);
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(8);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(12);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);

		$sheet->setCellValue('A1', 'Laporan Rekap Hasil Evalusi Mandiri');
		$sheet->getStyle("A1")->getFont()->setBold(true);
		$sheet->getStyle("A1")->getFont()->setSize(14);
		$sheet->getStyle("A1")->getFont()->setName('times');
		$sheet->mergeCells('A1:F1');

		$sheet->setCellValue('A2', 'Program Studi DIII Analisis Kimia');
		$sheet->getStyle("A2")->getFont()->setBold(true);
		$sheet->getStyle("A2")->getFont()->setSize(13);
		$sheet->getStyle("A2")->getFont()->setName('times');
		$sheet->mergeCells('A2:F2');

		$sheet->setCellValue('A3', 'Universitas Islam Indonesia');
		$sheet->getStyle("A3")->getFont()->setBold(true);
		$sheet->getStyle("A3")->getFont()->setSize(13);
		$sheet->getStyle("A3")->getFont()->setName('times');
		$sheet->mergeCells('A3:F3');

		$spreadsheet->getActiveSheet()->getStyle('A5:F5')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFD2D2D2');

		$sheet->setCellValue('A5', 'Nomor');
		$sheet->getStyle("A5")->getFont()->setBold(true);
		$sheet->getStyle("A5")->getFont()->setSize(12);
		$sheet->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("A5")->getFont()->setName('times');

		$sheet->setCellValue('B5', 'NIM');
		$sheet->getStyle("B5")->getFont()->setBold(true);
		$sheet->getStyle("B5")->getFont()->setSize(12);
		$sheet->getStyle('B5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("B5")->getFont()->setName('times');

		$sheet->setCellValue('C5', 'Nama');
		$sheet->getStyle("C5")->getFont()->setBold(true);
		$sheet->getStyle("C5")->getFont()->setSize(12);
		$sheet->getStyle('C5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
		$sheet->getStyle("C5")->getFont()->setName('times');

		$sheet->setCellValue('D5', 'Semester');
		$sheet->getStyle("D5")->getFont()->setBold(true);
		$sheet->getStyle("D5")->getFont()->setSize(12);
		$sheet->getStyle('D5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("D5")->getFont()->setName('times');

		$sheet->setCellValue('E5', 'Rata-rata CPL');
		$sheet->getStyle("E5")->getFont()->setBold(true);
		$sheet->getStyle("E5")->getFont()->setSize(12);
		$sheet->getStyle('E5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		//$sheet->getStyle('E5')->getAlignment()->setIndent(1);
		$sheet->getStyle("E5")->getFont()->setName('times');

		$sheet->setCellValue('F5', 'Keterangan');
		$sheet->getStyle("F5")->getFont()->setBold(true);
		$sheet->getStyle("F5")->getFont()->setSize(12);
		$sheet->getStyle('F5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
		$sheet->getStyle("F5")->getFont()->setName('times');

		$index=5;
		$nomor=0;
		foreach($data as $row) {
			$index++;
			$nomor++;

			$sheet->setCellValue('A'.$index, $nomor);
			$sheet->getStyle('A'.$index)->getFont()->setSize(12);
			$sheet->getStyle('A'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('A'.$index)->getFont()->setName('times');

			$sheet->setCellValue('B'.$index, $row['nim']);
			$sheet->getStyle('B'.$index)->getFont()->setSize(12);
			$sheet->getStyle('B'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('B'.$index)->getFont()->setName('times');

			$sheet->setCellValue('C'.$index, $row['nama']);
			$sheet->getStyle('C'.$index)->getFont()->setSize(12);
			$sheet->getStyle('C'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			$sheet->getStyle('C'.$index)->getFont()->setName('times');

			$sheet->setCellValue('D'.$index, $row['semester']);
			$sheet->getStyle('D'.$index)->getFont()->setSize(12);
			$sheet->getStyle('D'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('D'.$index)->getFont()->setName('times');

			$sheet->setCellValue('E'.$index, $row['cpl_rata_rata']);
			$sheet->getStyle('E'.$index)->getFont()->setSize(12);
			$sheet->getStyle('E'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			//$sheet->getStyle('E'.$index)->getAlignment()->setIndent(1);
			$sheet->getStyle('E'.$index)->getFont()->setName('times');

			$sheet->setCellValue('F'.$index, $row['keterangan']);
			$sheet->getStyle('F'.$index)->getFont()->setSize(12);
			$sheet->getStyle('F'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			$sheet->getStyle('F'.$index)->getFont()->setName('times');
		}

		$writer = new Xlsx($spreadsheet);
		$filename = 'Laporan Rekap Hasil Evaluasi Mandiri';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	private function getExportData($start, $limit, $search) {
		$order = 'nim';
		$dir = 'asc';

		$params=array(
			'limit' => $limit,
			'start' => $start,
			'order' => $order,
			'dir' => $dir,
			'search' => $search
		);

		$getListMahasiswa=$this->evaluasiMandiriRekapModel->getListMahasiswa($params);
		$data_harkat = $this->evaluasiMandiriHasilModel->getListHarkat();
		$data_klasifikasi = $this->evaluasiMandiriHasilModel->getListKlasifikasi();

		$data = array();
		if(!empty($getListMahasiswa)) {
			foreach ($getListMahasiswa as $row) {

				$nestedData['nomor'] = $row->nomor;
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
		return $data;
	}

}
