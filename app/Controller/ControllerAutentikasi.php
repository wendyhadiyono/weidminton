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
use PHPMailer\PHPMailer\PHPMailer;

class ControllerAutentikasi extends Controller {
    public function index() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        $data = [
            "judul" => "Autentikasi Admin - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub
        ];

        $this->view('autentikasi/header', $data);
        $this->view("autentikasi/index", $data);
        $this->view("autentikasi/footer");
        
        if (isset($_SESSION['id_admin'])) {
            header("Location: " . BASEURL . "/admin");
            exit;
        }
    }
    
    public function masuk() {
        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_admin = $_POST['id_admin'];
            $kata_sandi = $_POST['kata_sandi'];

            if ($id_admin == $profil_admin['id_admin'] && $kata_sandi == $profil_admin['kata_sandi']) {
                $_SESSION['id_admin'] = $id_admin;

                if (isset($_POST['ingat_saya'])) {
                    $_SESSION['ingat_saya'] = 1;
                } else {
                    $_SESSION['ingat_saya'] = 0;
                }

                header("Location: " . BASEURL . "/admin");
                exit;
            } else {
                $_SESSION['pesan_gagal'] = "Autentikasi gagal"; 
                header("Location: " . BASEURL . "/autentikasi");
            }
        }
    }

    public function keluar() {
        session_destroy();
        header("Location: " . BASEURL . "/autentikasi");
        exit;
    }

    public function pulihkan_sandi() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        $data = [
            "judul" => "Pulihkan Sandi - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub
        ];

        $this->view('autentikasi/header', $data);
        $this->view("autentikasi/pulihkan_sandi", $data);
        $this->view("autentikasi/footer");
        
        if (isset($_SESSION['id_admin'])) {
            header("Location: " . BASEURL . "/admin");
            exit;
        }
    }

    public function kirim_link() {
        if ($_POST['email'] == NULL) {
            $_SESSION['pesan_gagal'] = "Data wajib dilengkapi!";
            header("Location: " . BASEURL . "/autentikasi/pulihkan_sandi");
            exit;
        } else {
            $profil_admin = $this->model('ModelProfil')->tampilSemua();
            $email = $profil_admin['email'];

            if ($_POST['email'] != $email) {
                $_SESSION['pesan_gagal'] = "Email admin tidak dikenali!";
                header("Location: " . BASEURL . "/autentikasi/pulihkan_sandi");
                exit;
            } else {
                $token_tautan = md5($email . time());
                $masa_berlaku = date("Y-m-d H:i:s", strtotime('+2 minutes'));

                $data = [
                    "token_tautan" => $token_tautan,
                    "masa_berlaku" => $masa_berlaku,
                    "email" => $email
                ];

                $kirim = $this->model('ModelProfil')->kirim($data);

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'weidminton@gmail.com';
                $mail->Password = 'kqdpygxsjbqpeczi';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $tujuan = $email;
                $subjek = "Pemulihan Sandi";
                $link = BASEURL . "/autentikasi/sandi_baru?token_tautan=$token_tautan";
                $pesan = "Halo, " . $profil_admin['nama'] . ".<br><br>Berikut link untuk pemulihan sandi Anda:<br><br>" . "<a href='$link'>$link</a>";

                $mail->setFrom('weidminton@gmail.com', 'WeidMinton');
                $mail->addAddress($tujuan);

                $mail->isHTML(true);
                $mail->Subject = $subjek;
                $mail->Body = $pesan;
                $mail->send();

                if ($mail) {
                    $_SESSION['pesan_berhasil'] = "Link pemulihan kata sandi sudah dikirim ke email admin terdaftar dan hanya berlaku selama 15 menit";
                    header("Location: " . BASEURL . "/autentikasi/pulihkan_sandi");
                    exit;
                } else {
                    $_SESSION['pesan_gagal'] = "Link pemulihan kata sandi gagal dikirim";
                    header("Location: " . BASEURL . "/autentikasi/pulihkan_sandi");
                    exit;
                }
            }
        }
    }
    
    public function sandi_baru() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();
        $profil_admin = $this->model('ModelProfil')->tampilSemua();
        
        $masa_berlaku = $profil_admin['masa_berlaku'];
        
        if (strtotime($masa_berlaku) < time()) {
            echo "Link pemulihan sandi tidak berlaku, silahkan meminta <a href=' " . BASEURL . "/autentikasi'>link</a> yang baru.";
        } else {
            $token_tautan = $_GET['token_tautan'];
            if ($token_tautan == $profil_admin['token_tautan'] && $masa_berlaku) {
                $data = [
                    "judul" => "Sandi Baru - " . $profil_klub['nama_klub'],
                    "profil_klub" => $profil_klub,
                    "token_tautan" => $token_tautan
                ];
    
                $this->view('autentikasi/header', $data);
                $this->view("autentikasi/sandi_baru", $data);
                $this->view("autentikasi/footer");
            }
        }
        
        if (isset($_SESSION['id_admin'])) {
            header("Location: " . BASEURL . "/admin");
            exit;
        }
    }

    public function ubah_sandi() {
        // $profil_admin = $this->model('ModelProfil')->tampilSemua();
        $kata_sandi = saringKarakter($_POST['kata_sandi']);
        $konfirmasi_sandi = saringKarakter($_POST['konfirmasi_sandi']);
        $token_tautan = $_POST['token_tautan'];

        if ($kata_sandi == NULL || $konfirmasi_sandi == NULL) {
            $_SESSION['pesan_gagal'] = "Kata sandi wajib dilengkapi!";
            header("Location: " . BASEURL . "/autentikasi/sandi_baru?token_tautan=$token_tautan");
        } elseif ($kata_sandi != $konfirmasi_sandi) {
            $_SESSION['pesan_gagal'] = "Kata sandi baru tidak sama!";
            header("Location: " . BASEURL . "/autentikasi/sandi_baru?token_tautan=$token_tautan");
        } elseif(strlen($kata_sandi) <= 6) {
            $_SESSION['pesan_gagal'] = "Kata sandi harus memiliki setidaknya 6 karakter!";
            header("Location: " . BASEURL . "/autentikasi/sandi_baru?token_tautan=$token_tautan");
        } else {
            $ubah = $this->model('ModelProfil')->ubahSandiBaru(["kata_sandi" => $kata_sandi, "token_tautan" => $token_tautan]);

            if ($ubah) {
                $_SESSION['pesan_berhasil'] = "Kata sandi telah diubah";
                header("Location: " . BASEURL . "/autentikasi");
            } else {
                $_SESSION['pesan_gagal'] = "Kata sandi gagal diubah";
                header("Location: " . BASEURL . "/autentikasi/sandi_baru?token_tautan=$token_tautan");
            }
        }
    }
}