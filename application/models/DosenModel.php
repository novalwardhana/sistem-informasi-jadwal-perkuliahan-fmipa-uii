<?php
    class DosenModel extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function getTotalData() {
            $hasil=$this->db->count_all('dosen');
            return $hasil;
        }

        public function getListDosen($params) {
            $limit=(int)$params['limit'];
            $start=(int)$params['start'];
            
            $sql="SELECT 
                     @rownum := @rownum + 1 AS nomor,
                    a.*
                FROM dosen a, 
                (SELECT @rownum := 0) r
                WHERE a.nama LIKE '%".$params['search']."%' OR
                    a.nik LIKE '%".$params['search']."%'
                ORDER BY id DESC
                LIMIT $limit OFFSET $start ";
            $query=$this->db->query($sql);
            $hasil=$query->result();
            return $hasil;
        }

        public function getListDosenCount($params) {
            $sql="SELECT 
                    @rownum := @rownum + 1 AS nomor,
                    a.*
                FROM dosen a, 
                (SELECT @rownum := 0) r
                WHERE a.nama LIKE '%".$params['search']."%' OR
                    a.nik LIKE '%".$params['search']."%' ";
            $query=$this->db->query($sql);
            $hasil=$query->num_rows();
            return $hasil;
        }

        public function create($params) {
            $query=$this->db->insert('dosen', $params);
            return $query;
        }

        public function getListDosenById($id) {
            $this->db->where('id', $id);
            $query=$this->db->get('dosen');
            $row=$query->row();
            return $row;
        }

        public function update($params) {
            $data = [
                'nik' => $params['nik'],
                'nama' => $params['nama']
            ];
           
            $this->db->where('id', $params['id']);
            $query=$this->db->update('dosen', $data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($params) {
            $this->db->where('id', $params['id']);
            $query=$this->db->delete('dosen');
            if ($query) {
                return true;
            } else {
                return false;
            }
        }
    }