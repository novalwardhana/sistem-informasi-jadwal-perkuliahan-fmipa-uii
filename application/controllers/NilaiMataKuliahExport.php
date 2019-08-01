<?php
class NilaiMataKuliahExport extends CI_Controller {

	private $nilaiMataKuliahExportModel;

	public function __construct() {
		parent::__construct();
		$this->load->model('NilaiMataKuliahExportModel');
		$this->nilaiMataKuliahExportModel=$this->NilaiMataKuliahExportModel;
	}

	public function export() {
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

}
