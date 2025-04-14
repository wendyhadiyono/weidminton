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

class ModelTransaksiAnggota {
    private $table = "transaksi_anggota";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tampilBeranda() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY tanggal_ta DESC LIMIT 10");

        return $this->db->resultSet();
    }

    public function tampilSemua() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY tanggal_ta DESC");

        return $this->db->resultSet();
    }

    public function tambah($data) {
        $this->db->query("INSERT INTO " . $this->table . " (nama_ta, harga_ta, tanggal_ta)
                    VALUES (:nama_ta, :harga_ta, :tanggal_ta)");
        $this->db->bind("nama_ta", $data['nama_ta']);
        $this->db->bind("harga_ta", $data['harga_ta']);
        $this->db->bind("tanggal_ta", $data['tanggal_ta']);
        $this->db->execute();

        $this->db->query("SELECT sisa_main FROM anggota WHERE nama = :nama_ta");
        $this->db->bind("nama_ta", $data['nama_ta']);
        $this->db->execute();
        $anggota = $this->db->single();

        $jumlah_main = isset($data['jumlah_main']) ? intval($data['jumlah_main']) : 0;
        $sisa_main = intval($anggota['sisa_main']) + $jumlah_main;

        $this->db->query("UPDATE anggota SET sisa_main = :sisa_main WHERE nama = :nama_ta");
        $this->db->bind("sisa_main", $sisa_main);
        $this->db->bind("nama_ta", $data['nama_ta']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function detail($id_ta) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_ta = :id_ta");
        $this->db->bind("id_ta", $id_ta);

        return $this->db->single();
    }

    public function ubah($data) {
        $this->db->query("UPDATE " . $this->table . " SET tanggal_ta = :tanggal_ta WHERE id_ta = :id_ta");
        $this->db->bind("id_ta", $data['id_ta']);
        $this->db->bind("tanggal_ta", $data['tanggal_ta']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapus($id_ta) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_ta = :id_ta");
        $this->db->bind("id_ta", $id_ta);
        $this->db->execute();

        return $this->db->rowCount();
    }
}