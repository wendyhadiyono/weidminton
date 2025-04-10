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

namespace App\Controller;

use App\Config\Controller;

class ControllerAutentikasi extends Controller {
    public function index() {
        // Pemanggilan "ModelPengaturan" untuk menampilkan profil klub
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        $data = [
            "judul" => "Autentikasi Admin - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub
        ];

        $this->view("autentikasi/index", $data);
        
        if (isset($_SESSION['id_admin'])) {
            header("Location: " . BASEURL . "/admin");
            exit();
        }
    }
    
    public function masuk() {
        // Pemanggilan "ModelProfil" untuk mengambil ID admin dan kata sandi
        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_admin = $_POST['id_admin'];
            $kata_sandi = $_POST['kata_sandi'];

            if ($id_admin == $profil_admin['id_admin'] && $kata_sandi == $profil_admin['kata_sandi']) {
                $_SESSION['id_admin'] = $id_admin;
                header("Location: " . BASEURL . "/admin");
                exit();
            } else {
                $_SESSION['error_autentikasi'] = "Autentikasi gagal"; 
                header("Location: " . BASEURL . "/autentikasi");
            }
        }
    }

    public function keluar() {
        session_destroy();
        header("Location: " . BASEURL);
        exit();
    }
}