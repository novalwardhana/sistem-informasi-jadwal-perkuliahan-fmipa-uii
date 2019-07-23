<?php

    class MataKuliahModel extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function getTotalData() {
            $hasil=$this->db->count_all('mata_kuliah');
            return $hasil;
        }

        public function getListMataKuliah($params) {
            $limit=(int)$params['limit'];
            $start=(int)$params['start'];
            
            $sql="SELECT 
                     @rownum := @rownum + 1 AS nomor,
                    a.*
                FROM mata_kuliah a, 
                (SELECT @rownum := 0) r
                WHERE a.nama LIKE '%".$params['search']."%' OR
                    a.kode LIKE '%".$params['search']."%'
                ORDER BY a.id DESC
                LIMIT $limit OFFSET $start ";
            $query=$this->db->query($sql);
            $hasil=$query->result();
            return $hasil;
        }

        public function getListMataKuliahCount($params) {
            $sql="SELECT 
                    @rownum := @rownum + 1 AS nomor,
                    a.*
                FROM mata_kuliah a, 
                (SELECT @rownum := 0) r
                WHERE a.nama LIKE '%".$params['search']."%' OR
                    a.kode LIKE '%".$params['search']."%' ";
            $query=$this->db->query($sql);
            $hasil=$query->num_rows();
            return $hasil;
        }

        public function create($params) {
            $query=$this->db->insert('mata_kuliah', $params);
            return $query;
        }

        public function getListMataKuliahById($id) {
            $this->db->where('id', $id);
            $query=$this->db->get('mata_kuliah');
            $row=$query->row();
            return $row;
        }

        public function update($params) {
            $data = [
                'kode' => $params['kode'],
                'nama' => $params['nama'],
                'semester' => $params['semester'],
                'kontribusi' => $params['kontribusi']
            ];
           
            $this->db->where('id', $params['id']);
            $query=$this->db->update('mata_kuliah', $data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($params) {
            $this->db->where('id', $params['id']);
            $query=$this->db->delete('mata_kuliah');
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

    }
