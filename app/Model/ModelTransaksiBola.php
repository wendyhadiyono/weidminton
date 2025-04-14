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

class ModelTransaksiBola {
    private $table = "transaksi_bola";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tampilBeranda() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY tanggal_tb DESC LIMIT 10");

        return $this->db->resultSet();
    }

    public function tampilSemua() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY tanggal_tb DESC");

        return $this->db->resultSet();
    }

    public function tambah($data) {
        $query = "INSERT INTO " . $this->table . " (keterangan_tb, jumlah_tb, harga_tb, tanggal_tb)
                    VALUES (:keterangan_tb, :jumlah_tb, :harga_tb, :tanggal_tb)";
        $this->db->query($query);
        $this->db->bind("keterangan_tb", $data['keterangan_tb']);
        $this->db->bind("jumlah_tb", $data['jumlah_tb']);
        $this->db->bind("harga_tb", $data['harga_tb']);
        $this->db->bind("tanggal_tb", $data['tanggal_tb']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function detail($id_tb) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_tb = :id_tb");
        $this->db->bind('id_tb', $id_tb);
        
        return $this->db->single();
    }

    public function ubah($data) {
        $query = "UPDATE " . $this->table . " SET keterangan_tb = :keterangan_tb, jumlah_tb = :jumlah_tb, harga_tb = :harga_tb, tanggal_tb = :tanggal_tb WHERE id_tb = :id_tb";
        $this->db->query($query);
        $this->db->bind("id_tb", $data['id_tb']);
        $this->db->bind("keterangan_tb", $data['keterangan_tb']);
        $this->db->bind("jumlah_tb", $data['jumlah_tb']);
        $this->db->bind("harga_tb", $data['harga_tb']);
        $this->db->bind("tanggal_tb", $data['tanggal_tb']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapus($id_tb) {
        $query = "DELETE FROM " . $this->table . " WHERE id_tb = :id_tb";
        $this->db->query($query);
        $this->db->bind("id_tb", $id_tb);
        $this->db->execute();

        return $this->db->rowCount();
    }
}