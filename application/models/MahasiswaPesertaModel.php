<?php
    class MahasiswaPesertaModel extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function getTotalDataDosenPengampu() {
            $hasil = $this->db->from("dosen_pengampu_mata_kuliah")->count_all_results();
            return $hasil;
        }

        public function getListDosenPengampu($params) {
            $limit=(int)$params['limit'];
            $start=(int)$params['start'];

            $sql="SELECT 
                    @rownum := @rownum + 1 AS nomor,
                    a.id,
                    a.id_dosen,
                    a.id_kelas,
                    d.nik,
                    d.nama AS dosen,
                    b.kode as kode_mata_kuliah,
                    b.nama as mata_kuliah,
                    c.kode as kelas,
                    a.jam_mulai,
                    a.jam_selesai,
                    a.ruang
                FROM dosen_pengampu_mata_kuliah a
                LEFT join mata_kuliah b on a.id_mata_kuliah=b.id
                LEFT join kelas c on a.id_kelas=c.id 
                LEFT join dosen d ON a.id_dosen=d.id,
                (SELECT @rownum := 0) r
                WHERE
                d.nik like '%".$params['search']."%' OR
                d.nama like '%".$params['search']."%' OR
                b.kode like '%".$params['search']."%' OR
                b.nama like '%".$params['search']."%' OR
                c.kode like '%".$params['search']."%' OR
                a.jam_mulai like '%".$params['search']."%' OR
                a.jam_selesai like '%".$params['search']."%' OR
                a.ruang like '%".$params['search']."%'
                
                ORDER BY id DESC
                LIMIT $limit OFFSET $start ";
            $query=$this->db->query($sql);
            $hasil=$query->result();
            return $hasil;
        }

        public function getListDosenPengampuCount($params) {
            $sql="SELECT 
                @rownum := @rownum + 1 AS nomor,
                a.id,
                a.id_dosen,
                a.id_kelas,
                d.nik,
                d.nama AS dosen,
                b.kode as kode_mata_kuliah,
                b.nama as mata_kuliah,
                c.kode as kelas,
                a.jam_mulai,
                a.jam_selesai,
                a.ruang
            FROM dosen_pengampu_mata_kuliah a
            LEFT join mata_kuliah b on a.id_mata_kuliah=b.id
            LEFT join kelas c on a.id_kelas=c.id
            LEFT join dosen d ON a.id_dosen=d.id,
            (SELECT @rownum := 0) r
            WHERE 
                d.nik like '%".$params['search']."%' OR
                d.nama like '%".$params['search']."%' OR
                b.kode like '%".$params['search']."%' OR
                b.nama like '%".$params['search']."%' OR
                c.kode like '%".$params['search']."%' OR
                a.jam_mulai like '%".$params['search']."%' OR
                a.jam_selesai like '%".$params['search']."%' OR
                a.ruang like '%".$params['search']."%'
            ";

            $query=$this->db->query($sql);
            $hasil=$query->num_rows();
            return $hasil;
        }

        public function getListDosenPengampuById($id) {
            $sql="SELECT
                a.id AS id_dosen_pengampu_mata_kuliah,
                a.id_dosen,
                a.id_mata_kuliah,
                a.id_kelas,
                d.nik,
                d.nama AS dosen,
                b.kode as kode_mata_kuliah,
                b.nama as mata_kuliah,
                c.kode as kelas,
                a.jam_mulai,
                a.jam_selesai,
                a.ruang,
                a.maks_peserta,
                a.cpmk_1_kode,
                COALESCE(a.cpmk_1_persentase, 0) AS cpmk_1_persentase,
                a.cpmk_1_keterangan,
                a.cpmk_2_kode,
                COALESCE(a.cpmk_2_persentase, 0) AS cpmk_2_persentase,
                a.cpmk_2_keterangan,
                a.cpmk_3_kode,
                COALESCE(a.cpmk_3_persentase, 0) AS cpmk_3_persentase,
                a.cpmk_3_keterangan,
                a.cpmk_4_kode,
                COALESCE(a.cpmk_4_persentase, 0) AS cpmk_4_persentase,
                a.cpmk_4_keterangan,
                a.cpmk_5_kode,
                COALESCE(a.cpmk_5_persentase, 0) AS cpmk_5_persentase,
                a.cpmk_5_keterangan,
                a.cpmk_6_kode,
                COALESCE(a.cpmk_6_persentase, 0) AS cpmk_6_persentase,
                a.cpmk_6_keterangan
            FROM dosen_pengampu_mata_kuliah a
            LEFT join mata_kuliah b on a.id_mata_kuliah=b.id
            LEFT join kelas c on a.id_kelas=c.id
            LEFT join dosen d ON a.id_dosen=d.id
            WHERE a.id=$id
            ";
            $query=$this->db->query($sql);
            $row=$query->first_row();
            return $row;
        }

        // Data mahasiswa yang sudah mengambil mata kuliah
        public function getListMahasiswaPeserta($id_dosen_pengampu_mata_kuliah) {
            $this->db->select('id_mahasiswa');
            $this->db->from('mahasiswa_peserta_mata_kuliah');
            $this->db->where('id_dosen_pengampu_mata_kuliah', $id_dosen_pengampu_mata_kuliah);
            $query = $this->db->get();
            $hasil=$query->result('array');
            return $hasil;
        }

        public function getTotalDataMahasiswa($dataMahasiswaPeserta) {
            // $hasil=$this->db->count_all('mahasiswa');
            // return $hasil;
            $dataMahasiswaPeserta[]=0;
            $hasil = $this->db->where_not_in('id',$dataMahasiswaPeserta)->from("mahasiswa")->count_all_results();
            return $hasil;
        }

        public function getListMahasiswa($params) {
            $limit=(int)$params['limit'];
            $start=(int)$params['start'];

            $dataMahasiswaPeserta=$params['dataMahasiswaPeserta'];
            $dataMahasiswaPeserta[]=0;
            $dataMahasiswaPeserta = implode( ',', $dataMahasiswaPeserta );
            
            $sql="SELECT 
                     @rownum := @rownum + 1 AS nomor,
                    a.*
                FROM mahasiswa a, 
                (SELECT @rownum := 0) r
                WHERE (a.nama LIKE '%".$params['search']."%' OR
                    a.nim LIKE '%".$params['search']."%') AND
                    a.id NOT IN ($dataMahasiswaPeserta)
                ORDER BY a.id DESC
                LIMIT $limit OFFSET $start ";
            $query=$this->db->query($sql);
            $hasil=$query->result();
            return $hasil;
        }

        public function getListMahasiswaCount($params) {
            $dataMahasiswaPeserta=$params['dataMahasiswaPeserta'];
            $dataMahasiswaPeserta[]=0;
            $dataMahasiswaPeserta = implode( ',', $dataMahasiswaPeserta );

            $sql="SELECT 
                    @rownum := @rownum + 1 AS nomor,
                    a.*
                FROM mahasiswa a, 
                (SELECT @rownum := 0) r
                WHERE (a.nama LIKE '%".$params['search']."%' OR
                    a.nim LIKE '%".$params['search']."%') AND
                    a.id NOT IN ($dataMahasiswaPeserta) ";
            $query=$this->db->query($sql);
            $hasil=$query->num_rows();
            return $hasil;
        }

        public function addMahasiswaPeserta($params) {
            $query=$this->db->insert('mahasiswa_peserta_mata_kuliah', $params);
            if ($query) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function getTotalDataPeserta($id_dosen_pengampu_mata_kuliah) {
            $hasil = $this->db->where('id_dosen_pengampu_mata_kuliah',$id_dosen_pengampu_mata_kuliah)->from("mahasiswa_peserta_mata_kuliah")->count_all_results();
            return $hasil;
        }

        public function getListPeserta($params) {
            $limit=(int)$params['limit'];
            $start=(int)$params['start'];
            $id_dosen_pengampu_mata_kuliah = (int)$params['id_dosen_pengampu_mata_kuliah'];

            $sql="SELECT 
                    @rownum := @rownum + 1 AS nomor,
                    a.id,
                    a.id_dosen_pengampu_mata_kuliah,
                    a.id_mahasiswa,
                    a.cpmk_1_nilai,a.cpmk_2_nilai,a.cpmk_3_nilai,a.cpmk_4_nilai,a.cpmk_5_nilai,a.cpmk_6_nilai,
                    b.nama AS mahasiswa,
                    b.nim, 
                    b.semester
                FROM mahasiswa_peserta_mata_kuliah a
                LEFT join mahasiswa b on a.id_mahasiswa=b.id,
                (SELECT @rownum := 0) r
                WHERE 
                    a.id_dosen_pengampu_mata_kuliah=$id_dosen_pengampu_mata_kuliah
                    AND
                    (
                        b.nama like '%".$params['search']."%' OR
                        b.nim like '%".$params['search']."%' OR
                        b.semester like '%".$params['search']."%'
                    )
                ORDER BY b.nim ASC, b.nama ASC
                LIMIT $limit OFFSET $start ";
            $query=$this->db->query($sql);
            $hasil=$query->result();
            return $hasil;
        }

        public function getListPesertaCount($params) {
            $limit=(int)$params['limit'];
            $start=(int)$params['start'];
            $id_dosen_pengampu_mata_kuliah = (int)$params['id_dosen_pengampu_mata_kuliah'];

            $sql="SELECT 
                    @rownum := @rownum + 1 AS nomor,
                    a.id,
                    a.id_dosen_pengampu_mata_kuliah,
                    a.id_mahasiswa,
                    b.nama AS mahasiswa,
                    b.nim, 
                    b.semester
                FROM mahasiswa_peserta_mata_kuliah a
                LEFT join mahasiswa b on a.id_mahasiswa=b.id,
                (SELECT @rownum := 0) r
                WHERE 
                    a.id_dosen_pengampu_mata_kuliah=$id_dosen_pengampu_mata_kuliah
                    AND
                    (
                        b.nama like '%".$params['search']."%' OR
                        b.nim like '%".$params['search']."%' OR
                        b.semester like '%".$params['search']."%'
                    )
                ";

            $query=$this->db->query($sql);
            $hasil=$query->num_rows();
            return $hasil;
        }

        public function delete($id_mahasiswa_peserta_mata_kuliah) {
            $this->db->where('id', $id_mahasiswa_peserta_mata_kuliah);
            $query=$this->db->delete('mahasiswa_peserta_mata_kuliah');
            if ($query) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function updateNilai($params) {

            $this->db->where('id', $params['id_peserta']);
            $query=$this->db->update('mahasiswa_peserta_mata_kuliah', $params['data']);


            if ($query) {
                return TRUE;
            } else {
                return FALSE;
            }

        }

        public function getListHarkat() {
            $sql="SELECT batas_bawah, batas_atas, huruf from harkat order by batas_bawah asc";
            $query = $this->db->query($sql);

            return $query->result_array();
        }

    }