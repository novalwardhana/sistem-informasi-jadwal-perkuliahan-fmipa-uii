<?php

class CplEdit extends CI_Controller {

	private $cplEditModel;

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
		$this->load->library('session');
		$this->load->model('CplEditModel');
		$this->cplEditModel=$this->CplEditModel;
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

		$totalData = $this->cplEditModel->getTotalDataMataKuliah($_POST['id']);
			
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
			'id' => $_POST['id']
		);

		$getListMataKuliah=$this->cplEditModel->getListMataKuliah($params);
		$totalFiltered=$this->cplEditModel->getListMataKuliahCount($params);
			
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
		$id = $_POST['id_capaian_pembelajaran_lulusan'];
		$dataMataKuliah = $_POST['array_id_mata_kuliah'];
		
		try {
			for($i=0; $i<count($dataMataKuliah); $i++) {
				$id_mata_kuliah = $dataMataKuliah[$i];
				$params = array(
					'id_capaian_pembelajaran_lulusan' => $id,
					'id_mata_kuliah' => $id_mata_kuliah,
					'kontribusi' => NULL
				);
				$hasil = $this->cplEditModel->addCplDetail($params);
				if (!$hasil) {
					throw new Exception("Terjadi error saat menyimpan CPL detail");
				}
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
			'search' => $search,
			'id' => $_POST['id']
		);

		$totalData=$this->cplEditModel->getTotalDataCplDetail($_POST['id']);

		$getMataKuliahCreateCPL=$this->cplEditModel->getListCplDetail($params);
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
				$nestedData['kontribusi'] = "<input type='number' id='kontribusi-$row->id' name='kontribusi-$row->id' value='$row->kontribusi' class='form-control' style='text-align:right; width: 100%' >";;
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

}
