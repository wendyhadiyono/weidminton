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

class ControllerPengaturan extends Controller {
    public function pengaturan() {
        // Pemanggilan "ModelPengaturan" untuk menampilkan profil klub
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        // Pemanggilan "ModelProfil" untuk menampilkan profil admin
        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        $data = [
            "judul" => "Pengaturan - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin
        ];
        
        $this->view("admin/header", $data);
        $this->view("admin/pengaturan", $data);
        $this->view("admin/footer");
    }

    public function ubah_profil() {
        if ($_POST['nama_klub'] == NULL || $_POST['kota_asal'] == NULL || $_POST['kas_awal'] == NULL) {
            $_SESSION['pesan_gagal'] = "Data wajib dilengkapi!";
            header("Location: " . BASEURL . "/admin/pengaturan");
            exit;
        } else {
            // Pemanggilan "ModelPengaturan" untuk menampilkan profil klub
            $profil_klub = $this->model('ModelPengaturan')->tampilSemua();
            
            $logo_klub = $profil_klub['logo_klub'];
            $gambar_sampul = $profil_klub['gambar_sampul'];
            
            if (isset($_FILES['logo_klub']) && $_FILES['logo_klub']['error'] == UPLOAD_ERR_OK) {
                $file_logo = $_FILES['logo_klub']['tmp_name'];
                $nama_file_logo = $_FILES['logo_klub']['name'];
                $folder = 'img/';
                $tujuan = $folder . basename($nama_file_logo);
    
                if (move_uploaded_file($file_logo, $tujuan)) {
                    $logo_klub = $nama_file_logo;
                } else {
                    $_SESSION['pesan_gagal'] = "Gagal meng-upload logo klub.";
                    header("Location: " . BASEURL . "/admin/pengaturan");
                    exit;
                }
            }
            
            if (isset($_FILES['gambar_sampul']) && $_FILES['gambar_sampul']['error'] == UPLOAD_ERR_OK) {
                $file_sampul = $_FILES['gambar_sampul']['tmp_name'];
                $nama_file_sampul = $_FILES['gambar_sampul']['name'];
                $folder = 'img/';
                $tujuan = $folder . basename($nama_file_sampul);

                if (move_uploaded_file($file_sampul, $tujuan)) {
                    $gambar_sampul = $nama_file_sampul;
                } else {
                    $_SESSION['pesan_gagal'] = "Gagal meng-upload gambar sampul.";
                    header("Location: " . BASEURL . "/admin/pengaturan");
                    exit;
                }
            }

            $data = [
                "nama_klub" => $_POST['nama_klub'],
                "kota_asal" => $_POST['kota_asal'],
                "kas_awal" => $_POST['kas_awal'],
                "logo_klub" => $logo_klub,
                "gambar_sampul" => $gambar_sampul
            ];

            $ubah = $this->model('ModelPengaturan')->ubah($data);
    
            if ($ubah) {
                $_SESSION['pesan_berhasil'] = "Profil klub telah diubah";
                header("Location: " . BASEURL . "/admin/pengaturan");
            } else {
                $_SESSION['pesan_gagal'] = "Profil klub gagal diubah";
                header("Location: " . BASEURL . "/admin/pengaturan");
            }
        }
    }
}