<?php
    class SkorMaksModel extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function getTotalData() {
            $hasil=$this->db->count_all('skor_maks_per_semester');
            return $hasil;
        }

        public function getListSkorMaks($params) {
            $limit=(int)$params['limit'];
            $start=(int)$params['start'];
            
            $sql="SELECT 
                     @rownum := @rownum + 1 AS nomor,
                    a.*
                FROM skor_maks_per_semester a, 
                (SELECT @rownum := 0) r
                WHERE a.semester LIKE '%".$params['search']."%' OR
                    a.cpl LIKE '%".$params['search']."%' OR
                    a.skor_maks LIKE '%".$params['search']."%'
                ORDER BY a.id DESC
                LIMIT $limit OFFSET $start ";
            $query=$this->db->query($sql);
            $hasil=$query->result();
            return $hasil;
        }

        public function getListSkorMaksCount($params) {
            $sql="SELECT 
                    @rownum := @rownum + 1 AS nomor,
                    a.*
                FROM skor_maks_per_semester a, 
                (SELECT @rownum := 0) r
                WHERE a.semester LIKE '%".$params['search']."%' OR
                    a.cpl LIKE '%".$params['search']."%' OR
                    a.skor_maks LIKE '%".$params['search']."%'
                ";
            $query=$this->db->query($sql);
            $hasil=$query->num_rows();
            return $hasil;
        }

        public function create($params) {
            $query=$this->db->insert('skor_maks_per_semester', $params);
            return $query;
        }

        public function getListSkorMaksById($id) {
            $this->db->where('id', $id);
            $query=$this->db->get('skor_maks_per_semester');
            $row=$query->row();
            return $row;
        }

        public function update($params) {
            $data = [
                'semester' => $params['semester'],
                'cpl' => $params['cpl'],
                'skor_maks' => $params['skor_maks']
            ];
           
            $this->db->where('id', $params['id']);
            $query=$this->db->update('skor_maks_per_semester', $data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($params) {
            $this->db->where('id', $params['id']);
            $query=$this->db->delete('skor_maks_per_semester');
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

    }