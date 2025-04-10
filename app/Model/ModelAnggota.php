<?php

// Copyright [2025] [Wendy]

// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at

//     http://www.apache.org/licenses/LICENSE-2.0

// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

namespace App\Model;

use App\Config\Database;

class ModelAnggota {
    private $table = "anggota";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tampilSemua() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY nama ASC");

        return $this->db->resultSet();
    }

    public function tambah($data) {
        $this->db->query("INSERT INTO " . $this->table . " (nama, jenis_kelamin, domisili)
                    VALUES (:nama, :jenis_kelamin, :domisili)");
        $this->db->bind("nama", $data['nama']);
        $this->db->bind("jenis_kelamin", $data['jenis_kelamin']);
        $this->db->bind("domisili", $data['domisili']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function detail($id_anggota) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_anggota = :id_anggota");
        $this->db->bind("id_anggota", $id_anggota);
        $anggota = $this->db->single();
        
        if ($anggota) {
            return $anggota;
        } else {
            return null;
        }
    }

    public function ubah($data) {
        $this->db->query("UPDATE " . $this->table . " SET nama = :nama, jenis_kelamin = :jenis_kelamin, domisili = :domisili WHERE id_anggota = :id_anggota");
        $this->db->bind("nama", $data['nama']);
        $this->db->bind("jenis_kelamin", $data['jenis_kelamin']);
        $this->db->bind("domisili", $data['domisili']);
        $this->db->bind("id_anggota", $data['id_anggota']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cekNama($nama) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE nama = :nama");
        $this->db->bind(":nama", $nama);
        $this->db->execute();
        
        return $this->db->single();
    }

    public function hapus($id_anggota) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_anggota = :id_anggota");
        $this->db->bind("id_anggota", $id_anggota);
        $this->db->execute();

        return $this->db->rowCount();
    }
}