<?php

    class KelasModel extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function getTotalData() {
            $hasil=$this->db->count_all('kelas');
            return $hasil;
        }

        public function getListKelas($params) {
            $limit=(int)$params['limit'];
            $start=(int)$params['start'];
            
            $sql="SELECT 
                     @rownum := @rownum + 1 AS nomor,
                    a.*
                FROM kelas a, 
                (SELECT @rownum := 0) r
                WHERE a.kode LIKE '%".$params['search']."%'
                ORDER BY a.id DESC
                LIMIT $limit OFFSET $start ";
            $query=$this->db->query($sql);
            $hasil=$query->result();
            return $hasil;
        }

        public function getListKelasCount($params) {
            $sql="SELECT 
                    @rownum := @rownum + 1 AS nomor,
                    a.*
                FROM kelas a, 
                (SELECT @rownum := 0) r
                WHERE a.kode LIKE '%".$params['search']."%' ";
            $query=$this->db->query($sql);
            $hasil=$query->num_rows();
            return $hasil;
        }

        public function create($params) {
            $query=$this->db->insert('kelas', $params);
            return $query;
        }

        public function getListKelasById($id) {
            $this->db->where('id', $id);
            $query=$this->db->get('kelas');
            $row=$query->row();
            return $row;
        }

        public function update($params) {
            $data = [
                'kode' => $params['kode']
            ];
           
            $this->db->where('id', $params['id']);
            $query=$this->db->update('kelas', $data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($params) {
            $this->db->where('id', $params['id']);
            $query=$this->db->delete('kelas');
            if ($query) {
                return true;
            } else {
                return false;
            }
        }


    }