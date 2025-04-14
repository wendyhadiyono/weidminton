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

class ModelTransaksiLapangan {
    private $table = "transaksi_lapangan";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tampilBeranda() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY tanggal_tl DESC LIMIT 10");

        return $this->db->resultSet();
    }

    public function tampilSemua() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY tanggal_tl DESC");

        return $this->db->resultSet();
    }

    public function tambah($data) {
        $sisa_main_tl = $data['harga_tl'] / 100000;
        $this->db->query("INSERT INTO " . $this->table . " (keterangan_tl, harga_tl, sisa_main_tl, tanggal_tl)
                    VALUES (:keterangan_tl, :harga_tl, :sisa_main_tl, :tanggal_tl)");
        $this->db->bind("keterangan_tl", $data['keterangan_tl']);
        $this->db->bind("harga_tl", $data['harga_tl']);
        $this->db->bind("sisa_main_tl", $sisa_main_tl);
        $this->db->bind("tanggal_tl", $data['tanggal_tl']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function detail($id_tl) {
        $query = $this->db->query("SELECT * FROM " . $this->table . " WHERE id_tl = :id_tl");
        $this->db->bind("id_tl", $id_tl);
        
        return $this->db->single();
    }

    public function ubah($data) {
        $this->db->query("UPDATE " . $this->table . " SET keterangan_tl = :keterangan_tl, harga_tl = :harga_tl, tanggal_tl = :tanggal_tl WHERE id_tl = :id_tl");
        $this->db->bind("id_tl", $data['id_tl']);
        $this->db->bind("keterangan_tl", $data['keterangan_tl']);
        $this->db->bind("harga_tl", $data['harga_tl']);
        $this->db->bind("tanggal_tl", $data['tanggal_tl']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapus($id_tl) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_tl = :id_tl");
        $this->db->bind("id_tl", $id_tl);
        $this->db->execute();

        return $this->db->rowCount();
    }
}