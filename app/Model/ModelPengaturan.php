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

class ModelPengaturan {
    private $table = "profil_klub";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tampilSemua() {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_pk='1'");
        $profil_klub = $this->db->single();
        
        return $profil_klub;
    }

    public function ubah($data) {
        $this->db->query("UPDATE profil_klub SET nama_klub = :nama_klub, kota_asal = :kota_asal, kas_awal = :kas_awal, logo_klub = :logo_klub, gambar_sampul = :gambar_sampul WHERE id_pk = 1");
        $this->db->bind("nama_klub", $data['nama_klub']);
        $this->db->bind("kota_asal", $data['kota_asal']);
        $this->db->bind("kas_awal", $data['kas_awal']);
        $this->db->bind("logo_klub", $data['logo_klub']);
        $this->db->bind("gambar_sampul", $data['gambar_sampul']);
        $this->db->execute();
        $profil_klub = $this->db->rowCount();

        $this->db->query("UPDATE anggota SET domisili = :domisili WHERE domisili <> 'Luar Kota'");
        $this->db->bind("domisili", $data['kota_asal']);
        $this->db->execute();
        $anggota = $this->db->rowCount();

        return $profil_klub + $anggota;
    }
}