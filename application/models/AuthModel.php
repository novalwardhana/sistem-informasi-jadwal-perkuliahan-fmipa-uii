<?php
	class AuthModel Extends CI_Model {

		public function aksi_Login($params) {
			$sql="SELECT a.* FROM user a WHERE a.username='".$params['username']."' AND a.password='".$params['password']."' ";
			$query=$this->db->query($sql);
			$hasil=$query->num_rows();
			return $hasil;
		}

		public function cek_role($params) {
			$sql="SELECT a.id_role FROM user a WHERE a.username='".$params['username']."' AND a.password='".$params['password']."' ";
			$query=$this->db->query($sql);
			$hasil=$query->first_row();
			return $hasil;
		}

	}
