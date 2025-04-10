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

class ModelProfil {
    private $table = "profil_admin";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tampilSemua() {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_pa='1'");
        $profil_admin = $this->db->single();
        
        return $profil_admin;
    }

    public function ubahProfil($data) {
        $this->db->query("UPDATE profil_admin SET nama = :nama, email = :email, id_admin = :id_admin, file_avatar = :file_avatar WHERE id_pa = 1");
        $this->db->bind("nama", $data['nama']);
        $this->db->bind("email", $data['email']);
        $this->db->bind("id_admin", $data['id_admin']);
        $this->db->bind("file_avatar", $data['file_avatar']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahSandi($data) {
        $this->db->query("UPDATE profil_admin SET kata_sandi = :sandi_baru WHERE id_pa = 1");
        $this->db->bind("sandi_baru", $data['sandi_baru']);
        $this->db->execute();

        return $this->db->rowCount();
    }
}