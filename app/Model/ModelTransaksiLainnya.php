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

class ModelTransaksiLainnya {
    private $table = "transaksi_lainnya";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tampilBeranda() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY tanggal_tll DESC LIMIT 10");

        return $this->db->resultSet();
    }

    public function tampilSemua() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY tanggal_tll DESC");

        return $this->db->resultSet();
    }

    public function tambah($data) {
        $this->db->query("INSERT INTO " . $this->table . " (keterangan_tll, nominal_tll, tanggal_tll)
                    VALUES (:keterangan_tll, :nominal_tll, :tanggal_tll)");
        $this->db->bind("keterangan_tll", $data['keterangan_tll']);
        $this->db->bind("nominal_tll", $data['nominal_tll']);
        $this->db->bind("tanggal_tll", $data['tanggal_tll']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function detail($id_tll) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_tll = :id_tll");
        $this->db->bind("id_tll", $id_tll);
        $tll = $this->db->single();

        if ($tll) {
            return $tll;
        } else {
            return null;
        }
    }

    public function ubah($data) {
        $this->db->query("UPDATE " . $this->table . " SET keterangan_tll = :keterangan_tll, nominal_tll = :nominal_tll, tanggal_tll = :tanggal_tll WHERE id_tll = :id_tll");
        $this->db->bind("id_tll", $data['id_tll']);
        $this->db->bind("keterangan_tll", $data['keterangan_tll']);
        $this->db->bind("nominal_tll", $data['nominal_tll']);
        $this->db->bind("tanggal_tll", $data['tanggal_tll']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapus($id_tll) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_tll = :id_tll");
        $this->db->bind("id_tll", $id_tll);
        $this->db->execute();

        return $this->db->rowCount();
    }
}