<?php

class KhsKumulatif extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data = array();
		$data['title'] = 'CPL - KHS Kumulatif List';
		$this->load->view('khsKumulatif/read', $data);
	}

}
