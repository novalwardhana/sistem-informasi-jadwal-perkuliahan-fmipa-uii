<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class NilaiMataKuliahExport extends CI_Controller {

	private $nilaiMataKuliahExportModel;

	public function __construct() {
		parent::__construct();
		$this->load->model('NilaiMataKuliahExportModel');
		$this->nilaiMataKuliahExportModel=$this->NilaiMataKuliahExportModel;
	}

	public function exportPDF() {
		$data=$this->nilaiMataKuliahExportModel->getListMahasiswaById($_GET['id_mahasiswa']);
		$data_mahasiswa=array(
			"id" => $data->id,
			"nama" => $data->nama,
			"nim" => $data->nim,
			"semester" => $data->semester
		);

		$data_mahasiswa_nilai=$this->nilaiMataKuliahExportModel->getListNilai($_GET['id_mahasiswa']);
		
		$data_harkat=$this->nilaiMataKuliahExportModel->getListHarkat();
		
		$data = array(
			'data_mahasiswa' => $data_mahasiswa,
			'data_mahasiswa_nilai' => $data_mahasiswa_nilai,
			'data_harkat' => $data_harkat
		);

		$this->load->library('Pdf');
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->filename = "Image3X4.pdf";
		$this->pdf->load_view('nilaiMataKuliahExport/export', $data);
		
	}

	public function exportExcel() {
		$data=$this->nilaiMataKuliahExportModel->getListMahasiswaById($_GET['id_mahasiswa']);
		$data_mahasiswa=array(
			"id" => $data->id,
			"nama" => $data->nama,
			"nim" => $data->nim,
			"semester" => $data->semester
		);

		$data_mahasiswa_nilai=$this->nilaiMataKuliahExportModel->getListNilai($_GET['id_mahasiswa']);

		$data_harkat=$this->nilaiMataKuliahExportModel->getListHarkat();
		
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(8);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);

		$sheet->setCellValue('A1', 'Laporan Nilai Mata Kuliah');
		$sheet->getStyle("A1")->getFont()->setBold(true);
		$sheet->getStyle("A1")->getFont()->setSize(14);
		$sheet->getStyle("A1")->getFont()->setName('times');
		$sheet->mergeCells('A1:F1');
		

		$sheet->setCellValue('A3', 'Nama Mahasiswa');
		$sheet->setCellValue('C3', $data_mahasiswa['nama']);
		$sheet->getStyle("A3:N3")->getFont()->setBold(true);
		$sheet->getStyle("A3:N3")->getFont()->setSize(13);
		$sheet->getStyle("A3:N3")->getFont()->setName('times');
		$sheet->mergeCells('A3:B3');
		$sheet->mergeCells('C3:F3');


		$sheet->setCellValue('A4', 'NIM');
		$sheet->setCellValue('C4', $data_mahasiswa['nim']);
		$sheet->getStyle("A4:N4")->getFont()->setBold(true);
		$sheet->getStyle("A4:N4")->getFont()->setSize(13);
		$sheet->getStyle("A4:N4")->getFont()->setName('times');
		$sheet->getStyle('C4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
		$sheet->mergeCells('A4:B4');
		$sheet->mergeCells('C4:F4');

		$sheet->setCellValue('A5', 'Semester');
		$sheet->setCellValue('C5', $data_mahasiswa['semester']);
		$sheet->getStyle("A5:N5")->getFont()->setBold(true);
		$sheet->getStyle("A5:N5")->getFont()->setSize(13);
		$sheet->getStyle("A5:N5")->getFont()->setName('times');
		$sheet->getStyle('C5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
		$sheet->mergeCells('A5:B5');
		$sheet->mergeCells('C5:F5');

		$spreadsheet->getActiveSheet()->getStyle('A7:F7')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFD2D2D2');

		$sheet->setCellValue('A7', 'Nomor');
		$sheet->getStyle("A7")->getFont()->setBold(true);
		$sheet->getStyle("A7")->getFont()->setSize(12);
		$sheet->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("A7")->getFont()->setName('times');

		$sheet->setCellValue('B7', 'Semester');
		$sheet->getStyle("B7")->getFont()->setBold(true);
		$sheet->getStyle("B7")->getFont()->setSize(12);
		$sheet->getStyle('B7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("B7")->getFont()->setName('times');

		$sheet->setCellValue('C7', 'Kode');
		$sheet->getStyle("C7")->getFont()->setBold(true);
		$sheet->getStyle("C7")->getFont()->setSize(12);
		$sheet->getStyle('C7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
		$sheet->getStyle("C7")->getFont()->setName('times');

		$sheet->setCellValue('D7', 'Mata Kuliah');
		$sheet->getStyle("D7")->getFont()->setBold(true);
		$sheet->getStyle("D7")->getFont()->setSize(12);
		$sheet->getStyle('D7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
		$sheet->getStyle("D7")->getFont()->setName('times');

		$sheet->setCellValue('E7', 'Nilai');
		$sheet->getStyle("E7")->getFont()->setBold(true);
		$sheet->getStyle("E7")->getFont()->setSize(12);
		$sheet->getStyle('E7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		$sheet->getStyle("E7")->getFont()->setName('times');

		$sheet->setCellValue('F7', 'Huruf');
		$sheet->getStyle("F7")->getFont()->setBold(true);
		$sheet->getStyle("F7")->getFont()->setSize(12);
		$sheet->getStyle('F7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("F7")->getFont()->setName('times');
		
		$index=7;
		$nomor=0;
		foreach($data_mahasiswa_nilai as $row) {
			$index++;
			$nomor++;

			$sheet->setCellValue('A'.$index, $nomor);
			$sheet->getStyle('A'.$index)->getFont()->setSize(12);
			$sheet->getStyle('A'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('A'.$index)->getFont()->setName('times');

			$sheet->setCellValue('B'.$index, $row['semester']);
			$sheet->getStyle('B'.$index)->getFont()->setSize(12);
			$sheet->getStyle('B'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('B'.$index)->getFont()->setName('times');

			$sheet->setCellValue('C'.$index, $row['kode_mata_kuliah']);
			$sheet->getStyle('C'.$index)->getFont()->setSize(12);
			$sheet->getStyle('C'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			$sheet->getStyle('C'.$index)->getFont()->setName('times');

			$sheet->setCellValue('D'.$index, $row['mata_kuliah']);
			$sheet->getStyle('D'.$index)->getFont()->setSize(12);
			$sheet->getStyle('D'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			$sheet->getStyle('D'.$index)->getFont()->setName('times');

			$sheet->setCellValue('E'.$index, number_format($row['nilai'],2,".",","));
			$sheet->getStyle('E'.$index)->getFont()->setSize(12);
			$sheet->getStyle('E'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$sheet->getStyle('E'.$index)->getFont()->setName('times');

			$harkat="-";
			foreach($data_harkat as $row_harkat) {
				$batas_bawah = (float) $row_harkat['batas_bawah'];
				$batas_atas = (float) $row_harkat['batas_atas'];
				if ($row['nilai']>=$batas_bawah && $row['nilai']<$batas_atas) {
					$harkat=$row_harkat['huruf'];
				}
			}
			if ($row['nilai']>=100) {
				$harkat="A";
			}

			$sheet->setCellValue('F'.$index, $harkat);
			$sheet->getStyle('F'.$index)->getFont()->setSize(12);
			$sheet->getStyle('F'.$index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('F'.$index)->getFont()->setName('times');
		}

		$writer = new Xlsx($spreadsheet);
		
		$filename = 'Laporan Nilai Mata Kuliah';
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

}
