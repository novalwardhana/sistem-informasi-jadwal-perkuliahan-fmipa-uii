<?php

    class HarkatModel extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function getTotalData() {
            $hasil=$this->db->count_all('harkat');
            return $hasil;
        }

        public function getListHarkat($params) {
            $limit=(int)$params['limit'];
            $start=(int)$params['start'];
            
            $sql="SELECT 
                     @rownum := @rownum + 1 AS nomor,
                    a.*,
                    CONCAT(FORMAT(COALESCE(a.batas_bawah, 0),2,'de_DE'),' sd ',FORMAT(COALESCE(a.batas_atas, 0),2,'de_DE')) AS rentang 
                FROM harkat a, 
                (SELECT @rownum := 0) r
                WHERE a.harkat LIKE '%".$params['search']."%' OR
                    a.huruf LIKE '%".$params['search']."%'
                ORDER BY a.batas_bawah ASC
                LIMIT $limit OFFSET $start ";
            $query=$this->db->query($sql);
            $hasil=$query->result();
            return $hasil;
        }

        public function getListHarkatCount($params) {
            $sql="SELECT 
                    @rownum := @rownum + 1 AS nomor,
                    a.*,
                    CONCAT(FORMAT(COALESCE(a.batas_bawah, 0),2,'de_DE'),' sd ',FORMAT(COALESCE(a.batas_atas, 0),2,'de_DE')) AS rentang 
                FROM harkat a, 
                (SELECT @rownum := 0) r
                WHERE a.harkat LIKE '%".$params['search']."%' OR
                    a.huruf LIKE '%".$params['search']."%' ";
            $query=$this->db->query($sql);
            $hasil=$query->num_rows();
            return $hasil;
        }

        public function create($params) {
            $query=$this->db->insert('harkat', $params);
            return $query;
        }

        public function getListHarkatById($id) {
            $this->db->where('id', $id);
            $query=$this->db->get('harkat');
            $row=$query->row();
            return $row;
        }

        public function update($params) {
            $data = [
                'harkat' => $params['harkat'],
                'batas_bawah' => $params['batas_bawah'],
                'batas_atas' => $params['batas_atas'],
                'huruf' => $params['huruf']
            ];
           
            $this->db->where('id', $params['id']);
            $query=$this->db->update('harkat', $data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($params) {
            $this->db->where('id', $params['id']);
            $query=$this->db->delete('harkat');
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

    }