<?php

class CplAdd extends CI_Controller {

	private $cplAddModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->library('session');
		$this->load->model('CplAddModel');
		$this->cplAddModel=$this->CplAddModel;
	}

	/*
		Get list mata kuliah
	*/
	public function getListMataKuliah() {
		$columns = array( 
			0 => 'checkbox',
			1 =>'nomor',
			2 =>'kode',
			3 => 'nama',
			4 => 'semester',
			5 => 'kontribusi',
		);

		$totalData = $this->cplAddModel->getTotalDataMataKuliah();
			
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

		$getListMataKuliah=$this->cplAddModel->getListMataKuliah($params);
		$totalFiltered=$this->cplAddModel->getListMataKuliahCount($params);
			
		$data = array();
		if(!empty($getListMataKuliah)) {
			foreach ($getListMataKuliah as $row) {
				$nestedData['checkbox'] = "<input type='checkbox' class='checkbox1' id='chk' name='check[]' value='".$row->id."'/>";
				$nestedData['nomor'] = "";
				$nestedData['kode'] = $row->kode;
				$nestedData['nama'] = $row->nama;
				$nestedData['semester'] = $row->semester;
				$nestedData['kontribusi'] = $row->kontribusi;
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

	/* Add Cpl detail */
	public function addCplDetail() {
		$dataMataKuliah = $_POST['array_id_mata_kuliah'];
		
		try {
			for($i=0; $i<count($dataMataKuliah); $i++) {
				$id_mata_kuliah = $dataMataKuliah[$i];
				$params = array(
					'id_mata_kuliah' => $id_mata_kuliah
				);
				$hasil = $this->cplAddModel->addCplDetail($params);
			}
			$data = [
				'success' => true,
				'message' => 'Mata kuliah berhasil ditambahkan'
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

	/* Get list CPL Detail*/
	public function getListCplDetail() {
		$columns = array( 
			0 => 'nomor', 
			1 => 'aksi', 
			2 => 'kode', 
			3 => 'nama',
			4 => 'semester',
			5 => 'sks',
			6 => 'kontribusi',
			7 => 'id',
			8 => 'id_mata_kuliah'
		);

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

		$totalData=$this->cplAddModel->getTotalDataCplDetail();

		$getMataKuliahCreateCPL=$this->cplAddModel->getListCplDetail($params);
		$totalFiltered=count($getMataKuliahCreateCPL);

		$data = array();
		if(!empty($getMataKuliahCreateCPL)) {
			foreach ($getMataKuliahCreateCPL as $row) {
				$nestedData['nomor'] = "";
				$nestedData['aksi'] = "	
				<button class='btn btn-sm btn-danger' onclick='deleteCplDetail($row->id)' data-href='".base_url('CapaianPembelajaranLulusan/delete?id=').$row->id."'>
						<i class='fa fa-trash'></i>
				</button>
				";
				$nestedData['kode'] = $row->kode;
				$nestedData['nama'] = $row->nama;
				$nestedData['semester'] = $row->semester;
				$nestedData['sks'] = $row->sks;
				$nestedData['kontribusi'] = "<input type='number' id='kontribusi-$row->id' name='kontribusi-$row->id' class='form-control' style='text-align:right; width: 100%' >";;
				$nestedData['id'] = $row->id;
				$nestedData['id_mata_kuliah'] = $row->id_mata_kuliah;
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

	/* Delete Cpl Detail*/
	public function deleteCplDetail() {
		$hapus = $this->cplAddModel->deleteCplDetail($_POST['id']);
		if ($hapus) {
			$data = [
				'success' => true,
				'message' => 'Data berhasil di hapus'
			];
		} else {
			$data = [
				'success' => false,
				'message' => 'Data gagal di hapus'
			];
		}
		echo json_encode($data);
	}

	/* Simpan Cpl */
	public function simpanCpl() {
		$nama = $_POST['nama_cpl'];
		$deskirpsi = $_POST['deskripsi_cpl'];

		
	}

}
