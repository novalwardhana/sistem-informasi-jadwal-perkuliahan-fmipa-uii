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

		public function getListPermission($id_role) {
			$id_role = (int) $id_role;
			$sql="SELECT b.module from user_role_has_permission a
				LEFT JOIN user_permission b ON a.id_permission=b.id
				WHERE a.id_role=$id_role;
			";
			$query=$this->db->query($sql);
			$data=$query->result_array();

			$hasil=array();
			foreach($data as $value) {
				$hasil[$value['module']]=TRUE;
			}
			
			return $hasil;
		}

	}
