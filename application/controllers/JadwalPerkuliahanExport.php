<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class JadwalPerkuliahanExport extends CI_Controller {

	private $jadwalPerkuliahanExportModel;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');

		$this->load->model('JadwalPerkuliahanExportModel');
		$this->jadwalPerkuliahanExportModel=$this->JadwalPerkuliahanExportModel;
	}

	public function export() {
		$dataPengampu = $this->jadwalPerkuliahanExportModel->getListDosenPengampuById($_GET['id']);
		$dataPeserta = $this->jadwalPerkuliahanExportModel->getListPeserta($_GET['id']);
		$dataHarkat = $this->jadwalPerkuliahanExportModel->getListHarkat();
			
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(36);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);

		$sheet->setCellValue('A1', 'Laporan Mahasiwa Peserta Mata Kuliah');
		$sheet->getStyle("A1")->getFont()->setBold(true);
		$sheet->getStyle("A1")->getFont()->setSize(14);
		$sheet->getStyle("A1")->getFont()->setName('times');
		$sheet->mergeCells('A1:L1');

		$sheet->setCellValue('A3', 'Nama Dosen');
		$sheet->setCellValue('C3', $dataPengampu->dosen);
		$sheet->getStyle("A3:N3")->getFont()->setBold(true);
		$sheet->getStyle("A3:N3")->getFont()->setSize(13);
		$sheet->getStyle("A3:N3")->getFont()->setName('times');
		$sheet->mergeCells('A3:B3');
		$sheet->mergeCells('C3:L3');

		$sheet->setCellValue('A4', 'NIK');
		$sheet->setCellValue('C4', $dataPengampu->nik);
		$sheet->getStyle("A4:N4")->getFont()->setBold(true);
		$sheet->getStyle("A4:N4")->getFont()->setSize(13);
		$sheet->getStyle("A4:N4")->getFont()->setName('times');
		$sheet->getStyle('C4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
		$sheet->mergeCells('A4:B4');
		$sheet->mergeCells('C4:L4');

		$sheet->setCellValue('A5', 'Mata Kuliah');
		$sheet->setCellValue('C5', $dataPengampu->kode_mata_kuliah." - ".$dataPengampu->mata_kuliah);
		$sheet->getStyle("A5:N5")->getFont()->setBold(true);
		$sheet->getStyle("A5:N5")->getFont()->setSize(13);
		$sheet->getStyle("A5:N5")->getFont()->setName('times');
		$sheet->mergeCells('A5:B5');
		$sheet->mergeCells('C5:L5');

		$sheet->setCellValue('A6', 'Kelas');
		$sheet->setCellValue('C6', $dataPengampu->kelas);
		$sheet->getStyle("A6:N6")->getFont()->setBold(true);
		$sheet->getStyle("A6:N6")->getFont()->setSize(13);
		$sheet->getStyle("A6:N6")->getFont()->setName('times');
		$sheet->mergeCells('A6:B6');
		$sheet->mergeCells('C6:L6');

		$sheet->setCellValue('A7', 'Jam Mulai');
		$sheet->setCellValue('C7', $dataPengampu->jam_mulai);
		$sheet->getStyle("A7:N7")->getFont()->setBold(true);
		$sheet->getStyle("A7:N7")->getFont()->setSize(13);
		$sheet->getStyle("A7:N7")->getFont()->setName('times');
		$sheet->mergeCells('A7:B7');
		$sheet->mergeCells('C7:L7');

		$sheet->setCellValue('A8', 'Jam Selesai');
		$sheet->setCellValue('C8', $dataPengampu->jam_selesai);
		$sheet->getStyle("A8:N8")->getFont()->setBold(true);
		$sheet->getStyle("A8:N8")->getFont()->setSize(13);
		$sheet->getStyle("A8:N8")->getFont()->setName('times');
		$sheet->mergeCells('A8:B8');
		$sheet->mergeCells('C8:L8');

		$sheet->setCellValue('A10', 'Nomor');
		$sheet->getStyle("A10")->getFont()->setBold(true);
		$sheet->getStyle("A10")->getFont()->setSize(12);
		$sheet->getStyle('A10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("A10")->getFont()->setName('times');
		$sheet->mergeCells('A10:A12');

		$sheet->setCellValue('B10', 'NIM');
		$sheet->getStyle("B10")->getFont()->setBold(true);
		$sheet->getStyle("B10")->getFont()->setSize(12);
		$sheet->getStyle('B10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("B10")->getFont()->setName('times');
		$sheet->mergeCells('B10:B12');

		$sheet->setCellValue('C10', 'Nama');
		$sheet->getStyle("C10")->getFont()->setBold(true);
		$sheet->getStyle("C10")->getFont()->setSize(12);
		$sheet->getStyle("C10")->getFont()->setName('times');
		$sheet->mergeCells('C10:C12');

		$sheet->setCellValue('D10', 'Semester');
		$sheet->getStyle("D10")->getFont()->setBold(true);
		$sheet->getStyle("D10")->getFont()->setSize(12);
		$sheet->getStyle('D10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("D10")->getFont()->setName('times');
		$sheet->mergeCells('D10:D12');

		$sheet->setCellValue('E10', 'Penilaian');
		$sheet->getStyle("E10:J10")->getFont()->setBold(true);
		$sheet->getStyle("E10:J10")->getFont()->setSize(12);
		$sheet->getStyle('E10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("E10:J10")->getFont()->setName('times');
		$sheet->mergeCells('E10:J10');

		$sheet->setCellValue('E11', $dataPengampu->cpmk_1_kode);
		$sheet->setCellValue('F11', $dataPengampu->cpmk_2_kode);
		$sheet->setCellValue('G11', $dataPengampu->cpmk_3_kode);
		$sheet->setCellValue('H11', $dataPengampu->cpmk_4_kode);
		$sheet->setCellValue('I11', $dataPengampu->cpmk_5_kode);
		$sheet->setCellValue('J11', $dataPengampu->cpmk_6_kode);
		$sheet->getStyle("E11:J11")->getFont()->setBold(true);
		$sheet->getStyle("E11:J11")->getFont()->setSize(10);
		$sheet->getStyle('E11:J11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("E11:J11")->getFont()->setName('times');

		$sheet->setCellValue('E12', "[ ".number_format($dataPengampu->cpmk_1_persentase,2,",",".")."% ]");
		$sheet->setCellValue('F12', "[ ".number_format($dataPengampu->cpmk_2_persentase,2,",",".")."% ]");
		$sheet->setCellValue('G12', "[ ".number_format($dataPengampu->cpmk_3_persentase,2,",",".")."% ]");
		$sheet->setCellValue('H12', "[ ".number_format($dataPengampu->cpmk_4_persentase,2,",",".")."% ]");
		$sheet->setCellValue('I12', "[ ".number_format($dataPengampu->cpmk_5_persentase,2,",",".")."% ]");
		$sheet->setCellValue('J12', "[ ".number_format($dataPengampu->cpmk_6_persentase,2,",",".")."% ]");
		$sheet->getStyle("E12:J12")->getFont()->setBold(true);
		$sheet->getStyle("E12:J12")->getFont()->setSize(10);
		$sheet->getStyle('E12:J12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("E12:J12")->getFont()->setName('times');

		$sheet->setCellValue('K10', 'Nilai Akhir');
		$sheet->getStyle("K10")->getFont()->setBold(true);
		$sheet->getStyle("K10")->getFont()->setSize(12);
		$sheet->getStyle('K10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("K10")->getFont()->setName('times');
		$sheet->mergeCells('K10:K12');

		$sheet->setCellValue('L10', 'Harkat');
		$sheet->getStyle("L10")->getFont()->setBold(true);
		$sheet->getStyle("L10")->getFont()->setSize(12);
		$sheet->getStyle('L10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("L10")->getFont()->setName('times');
		$sheet->mergeCells('L10:L12');

		$spreadsheet->getActiveSheet()->getStyle('A10:L10')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFD2D2D2');

		$spreadsheet->getActiveSheet()->getStyle('E11:J11')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFE2E2E2');
			
		$spreadsheet->getActiveSheet()->getStyle('E12:J12')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFE2E2E2');

		$index=12;
		$nomor=0;
		foreach($dataPeserta as $row) {
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
			
			$sheet->setCellValue('C'.$index, $row['mahasiswa']);
			$sheet->getStyle('C'.$index)->getFont()->setSize(12);
			$sheet->getStyle('C'.$index)->getFont()->setName('times');

			$sheet->setCellValue('D'.$index, $row['semester']);
			$sheet->getStyle('D'.$index)->getFont()->setSize(12);
			$sheet->getStyle('D'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('D'.$index)->getFont()->setName('times');

			$sheet->setCellValue('E'.$index, $row['cpmk_1_nilai']);
			$sheet->getStyle('E'.$index)->getFont()->setSize(12);
			$sheet->getStyle('E'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$sheet->getStyle('E'.$index)->getFont()->setName('times');

			$sheet->setCellValue('F'.$index, $row['cpmk_2_nilai']);
			$sheet->getStyle('F'.$index)->getFont()->setSize(12);
			$sheet->getStyle('F'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$sheet->getStyle('F'.$index)->getFont()->setName('times');

			$sheet->setCellValue('G'.$index, $row['cpmk_3_nilai']);
			$sheet->getStyle('G'.$index)->getFont()->setSize(12);
			$sheet->getStyle('G'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$sheet->getStyle('G'.$index)->getFont()->setName('times');

			$sheet->setCellValue('H'.$index, $row['cpmk_4_nilai']);
			$sheet->getStyle('H'.$index)->getFont()->setSize(12);
			$sheet->getStyle('H'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$sheet->getStyle('H'.$index)->getFont()->setName('times');

			$sheet->setCellValue('I'.$index, $row['cpmk_5_nilai']);
			$sheet->getStyle('I'.$index)->getFont()->setSize(12);
			$sheet->getStyle('I'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$sheet->getStyle('I'.$index)->getFont()->setName('times');

			$sheet->setCellValue('J'.$index, $row['cpmk_6_nilai']);
			$sheet->getStyle('J'.$index)->getFont()->setSize(12);
			$sheet->getStyle('J'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$sheet->getStyle('J'.$index)->getFont()->setName('times');

			$nilai_akhir=(($dataPengampu->cpmk_1_persentase/100) * $row['cpmk_1_nilai']) + (($dataPengampu->cpmk_2_persentase/100) * $row['cpmk_2_nilai']) + (($dataPengampu->cpmk_3_persentase/100) * $row['cpmk_3_nilai']) + (($dataPengampu->cpmk_4_persentase/100) * $row['cpmk_4_nilai']) + (($dataPengampu->cpmk_5_persentase/100) * $row['cpmk_5_nilai']) + (($dataPengampu->cpmk_6_persentase/100) * $row['cpmk_6_nilai']);
	
			$sheet->setCellValue('K'.$index, number_format($nilai_akhir,2,".",","));
			$sheet->getStyle('K'.$index)->getFont()->setSize(12);
			$sheet->getStyle('K'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$sheet->getStyle('K'.$index)->getFont()->setName('times');

			$harkat="-";
			foreach($dataHarkat as $row) {
				$batas_bawah = (float) $row['batas_bawah'];
				$batas_atas = (float) $row['batas_atas'];
				if ($nilai_akhir>=$batas_bawah && $nilai_akhir<$batas_atas) {
					$harkat=$row['huruf'];
				}
			}
			if ($nilai_akhir>=100) {
				$harkat="A";
			}

			$sheet->setCellValue('L'.$index, $harkat);
			$sheet->getStyle('L'.$index)->getFont()->setSize(12);
			$sheet->getStyle('L'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('L'.$index)->getFont()->setName('times');
		}

		$j=$index+2;

		$sheet->setCellValue('A'.$j, 'Keterangan Kode:');
		$sheet->getStyle('A'.$j)->getFont()->setBold(true);
		$sheet->getStyle('A'.$j)->getFont()->setSize(12);
		$sheet->getStyle('A'.$j)->getFont()->setName('times');
		$sheet->mergeCells('A'.$j.':'.'B'.$j);
			
		$j++;
		$sheet->setCellValue('A'.$j, $dataPengampu->cpmk_1_kode);
		$sheet->getStyle('A'.$j)->getFont()->setBold(true);
		$sheet->getStyle('A'.$j)->getFont()->setSize(10);
		$sheet->getStyle('A'.$j)->getFont()->setName('times');
		$sheet->mergeCells('A'.$j.':'.'B'.$j);

		$sheet->setCellValue('C'.$j, $dataPengampu->cpmk_1_keterangan);
		$sheet->getStyle('C'.$j)->getFont()->setBold(true);
		$sheet->getStyle('C'.$j)->getFont()->setSize(10);
		$sheet->getStyle('C'.$j)->getFont()->setName('times');
		$sheet->mergeCells('C'.$j.':'.'L'.$j);

		$j++;
		$sheet->setCellValue('A'.$j, $dataPengampu->cpmk_2_kode);
		$sheet->getStyle('A'.$j)->getFont()->setBold(true);
		$sheet->getStyle('A'.$j)->getFont()->setSize(10);
		$sheet->getStyle('A'.$j)->getFont()->setName('times');
		$sheet->mergeCells('A'.$j.':'.'B'.$j);

		$sheet->setCellValue('C'.$j, $dataPengampu->cpmk_2_keterangan);
		$sheet->getStyle('C'.$j)->getFont()->setBold(true);
		$sheet->getStyle('C'.$j)->getFont()->setSize(10);
		$sheet->getStyle('C'.$j)->getFont()->setName('times');
		$sheet->mergeCells('C'.$j.':'.'L'.$j);

		$j++;
		$sheet->setCellValue('A'.$j, $dataPengampu->cpmk_3_kode);
		$sheet->getStyle('A'.$j)->getFont()->setBold(true);
		$sheet->getStyle('A'.$j)->getFont()->setSize(10);
		$sheet->getStyle('A'.$j)->getFont()->setName('times');
		$sheet->mergeCells('A'.$j.':'.'B'.$j);

		$sheet->setCellValue('C'.$j, $dataPengampu->cpmk_3_keterangan);
		$sheet->getStyle('C'.$j)->getFont()->setBold(true);
		$sheet->getStyle('C'.$j)->getFont()->setSize(10);
		$sheet->getStyle('C'.$j)->getFont()->setName('times');
		$sheet->mergeCells('C'.$j.':'.'L'.$j);

		$j++;
		$sheet->setCellValue('A'.$j, $dataPengampu->cpmk_4_kode);
		$sheet->getStyle('A'.$j)->getFont()->setBold(true);
		$sheet->getStyle('A'.$j)->getFont()->setSize(10);
		$sheet->getStyle('A'.$j)->getFont()->setName('times');
		$sheet->mergeCells('A'.$j.':'.'B'.$j);

		$sheet->setCellValue('C'.$j, $dataPengampu->cpmk_4_keterangan);
		$sheet->getStyle('C'.$j)->getFont()->setBold(true);
		$sheet->getStyle('C'.$j)->getFont()->setSize(10);
		$sheet->getStyle('C'.$j)->getFont()->setName('times');
		$sheet->mergeCells('C'.$j.':'.'L'.$j);

		$j++;
		$sheet->setCellValue('A'.$j, $dataPengampu->cpmk_5_kode);
		$sheet->getStyle('A'.$j)->getFont()->setBold(true);
		$sheet->getStyle('A'.$j)->getFont()->setSize(10);
		$sheet->getStyle('A'.$j)->getFont()->setName('times');
		$sheet->mergeCells('A'.$j.':'.'B'.$j);

		$sheet->setCellValue('C'.$j, $dataPengampu->cpmk_5_keterangan);
		$sheet->getStyle('C'.$j)->getFont()->setBold(true);
		$sheet->getStyle('C'.$j)->getFont()->setSize(10);
		$sheet->getStyle('C'.$j)->getFont()->setName('times');
		$sheet->mergeCells('C'.$j.':'.'L'.$j);

		$j++;
		$sheet->setCellValue('A'.$j, $dataPengampu->cpmk_6_kode);
		$sheet->getStyle('A'.$j)->getFont()->setBold(true);
		$sheet->getStyle('A'.$j)->getFont()->setSize(10);
		$sheet->getStyle('A'.$j)->getFont()->setName('times');
		$sheet->mergeCells('A'.$j.':'.'B'.$j);

		$sheet->setCellValue('C'.$j, $dataPengampu->cpmk_6_keterangan);
		$sheet->getStyle('C'.$j)->getFont()->setBold(true);
		$sheet->getStyle('C'.$j)->getFont()->setSize(10);
		$sheet->getStyle('C'.$j)->getFont()->setName('times');
		$sheet->mergeCells('C'.$j.':'.'L'.$j);
			
		$writer = new Xlsx($spreadsheet);
		
		$filename = 'Laporan Mahasiswa Peserta Perkuliahan';
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

}
