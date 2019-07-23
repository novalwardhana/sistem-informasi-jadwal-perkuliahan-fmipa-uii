<?php
    class DashboardModel extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function getTotalMahasiswa() {
            $totalMahasiswa = $this->db->query('SELECT * FROM mahasiswa')->num_rows();
            return $totalMahasiswa;
        }

        public function getTotalDosen() {
            $totalDosen = $this->db->query('SELECT * FROM dosen')->num_rows();
            return $totalDosen;
        }

        public function getTotalMataKuliah() {
            $totalMataKuliah = $this->db->query('SELECT * FROM mata_kuliah')->num_rows();
            return $totalMataKuliah;
        }

        public function getTotalKelas() {
            $totalKelas = $this->db->query('SELECT * FROM kelas')->num_rows();
            return $totalKelas;
        }

    }