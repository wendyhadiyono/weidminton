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

class ControllerProfil extends Controller {
    public function profil() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        $data = [
            "judul" => "Profil Admin - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin
        ];

        $this->view("admin/header", $data);
        $this->view("admin/profil", $data);
        $this->view("admin/footer");
    }

    public function ubah_profil() {
        if ($_POST['nama'] == NULL || $_POST['email'] == NULL || $_POST['id_admin'] == NULL) {
            $_SESSION['pesan_gagal'] = "Data wajib dilengkapi!";
            header("Location: " . BASEURL . "/admin/profil");
        } else {
            $profil_admin = $this->model('ModelProfil')->tampilSemua();
            
            if (isset($_POST['avatar_base64']) && !empty($_POST['avatar_base64'])) {
                $avatar_base64 = $_POST['avatar_base64'];
                $avatar_base64 = preg_replace('/^data:image\/(png|jpeg);base64,/', '', $avatar_base64);
                $decodedData = base64_decode($avatar_base64);

                $nama_file = uniqid() . '.png';
                $jalur_file = 'img/' . $nama_file;
                if (file_put_contents($jalur_file, $decodedData) === false) {
                    $_SESSION['pesan_gagal'] = "Gagal menyimpan gambar";
                    header("Location: " . BASEURL . "/admin/profil");
                    exit;
                }
                
                $_POST['file_avatar'] = $nama_file;
            } else {
                $_POST['file_avatar'] = $profil_admin['file_avatar'];
            }
            
            $ubah = $this->model('ModelProfil')->ubahProfil($_POST);

            if ($ubah) {
                $_SESSION['pesan_berhasil'] = "Profil admin telah diubah";
                $_SESSION['id_admin'] = $_POST['id_admin'];
                header("Location: " . BASEURL . "/admin/profil");
            } else {
                $_SESSION['pesan_gagal'] = "Profil admin gagal diubah";
                header("Location: " . BASEURL . "/admin/profil");
            }
        }
    }

    public function ubah_sandi() {
        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        $sandi_lama = $profil_admin['kata_sandi'];

        $sandi_lama_input = saringKarakter(($_POST['sandi_lama']));
        $sandi_baru_input = saringKarakter($_POST['sandi_baru']);
        $konfirm_sandi_baru_input = saringKarakter($_POST['konfirm_sandi_baru']);

        if ($sandi_lama_input == NULL || $sandi_baru_input == NULL || $konfirm_sandi_baru_input == NULL) {
            $_SESSION['pesan_gagal'] = "Data wajib dilengkapi!";
            header("Location: " . BASEURL . "/admin/profil");
        } elseif ($sandi_lama_input != $sandi_lama) {
            $_SESSION['pesan_gagal'] = "Kata sandi lama salah!";
            header("Location: " . BASEURL . "/admin/profil");
        } elseif ($sandi_baru_input != $konfirm_sandi_baru_input) {
            $_SESSION['pesan_gagal'] = "Kata sandi baru tidak sama!";
            header("Location: " . BASEURL . "/admin/profil");
        } elseif(strlen($sandi_baru_input) <= 6) {
            $_SESSION['pesan_gagal'] = "Kata sandi harus memiliki setidaknya 6 karakter!";
            header("Location: " . BASEURL . "/admin/profil");
        } else {
            $ubah = $this->model('ModelProfil')->ubahSandi(["sandi_baru" => $sandi_baru_input]);

            if ($ubah) {
                $_SESSION['pesan_berhasil'] = "Kata sandi telah diubah";
                header("Location: " . BASEURL . "/admin/profil");
            } else {
                $_SESSION['pesan_gagal'] = "Kata sandi gagal diubah";
                header("Location: " . BASEURL . "/admin/profil");
            }
        }
    }
}