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

class ModelPaketMain {
    private $table = "paket_main";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tampilSemua(){
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY jumlah_main ASC");
        
        return $this->db->resultSet();
    }

    public function tambah($data) {
        $this->db->query("INSERT INTO " . $this->table . " (jenis, jumlah_main, harga)
                    VALUES (:jenis, :jumlah_main, :harga)");
        $this->db->bind("jenis", $data['jenis']);
        $this->db->bind("jumlah_main", $data['jumlah_main']);
        $this->db->bind("harga", $data['harga']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function detail($id_pm) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_pm = :id_pm");
        $this->db->bind("id_pm", $id_pm);

        return $this->db->single();
    }

    public function ubah($data) {
        $this->db->query("UPDATE " . $this->table . " SET jenis = :jenis, jumlah_main = :jumlah_main, harga = :harga WHERE id_pm = :id_pm");
        $this->db->bind("jenis", $data['jenis']);
        $this->db->bind("jumlah_main", $data['jumlah_main']);
        $this->db->bind("harga", $data['harga']);
        $this->db->bind("id_pm", $data['id_pm']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapus($id_pm) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_pm = :id_pm");
        $this->db->bind("id_pm", $id_pm);
        $this->db->execute();

        return $this->db->rowCount();
    }
}