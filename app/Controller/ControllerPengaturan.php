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

class ControllerPengaturan extends Controller {
    public function pengaturan() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

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
            $profil_klub = $this->model('ModelPengaturan')->tampilSemua();
            
            $logo_klub = $profil_klub['logo_klub'];
            $gambar_sampul = $profil_klub['gambar_sampul'];
            
            if (isset($_FILES['logo_klub']) && $_FILES['logo_klub']['error'] == UPLOAD_ERR_OK) {
                $ukuran_file = $_FILES['logo_klub']['size'];
                $batas_ukuran = 1 * 1024 * 1024;

                if ($ukuran_file > $batas_ukuran) {
                    $_SESSION['pesan_gagal'] = "Ukuran file logo klub melebihi batas maksimum 1 MB";
                    header("Location: " . BASEURL . "/admin/pengaturan");
                    exit;
                }

                $file_logo = $_FILES['logo_klub']['tmp_name'];
                $nama_file_logo = $_FILES['logo_klub']['name'];

                $ekstensi_file = strtolower(pathinfo($nama_file_logo, PATHINFO_EXTENSION));
                $tipe_mime = mime_content_type($file_logo);

                $format_diperbolehkan = ['jpg', 'jpeg', 'png', 'heic'];
                $tipe_mime_diperbolehkan = ['image/jpeg', 'image/png', 'image/heic'];

                if (!in_array($ekstensi_file, $format_diperbolehkan) || !in_array($tipe_mime, $tipe_mime_diperbolehkan)) {
                    $_SESSION['pesan_gagal'] = "Harap menggunakan file gambar seperti JPG, PNG atau HEIC";
                    header("Location: " . BASEURL . "/admin/pengaturan");
                    exit;
                }

                $folder = 'img/';
                $tujuan = $folder . basename($nama_file_logo);

                if (move_uploaded_file($file_logo, $tujuan)) {
                    $logo_klub = $nama_file_logo;
                } else {
                    $_SESSION['pesan_gagal'] = "Gagal meng-upload logo klub";
                    header("Location: " . BASEURL . "/admin/pengaturan");
                    exit;
                }
            }
                
            if (isset($_FILES['gambar_sampul']) && $_FILES['gambar_sampul']['error'] == UPLOAD_ERR_OK) {
                $ukuran_file = $_FILES['gambar_sampul']['size'];
                $batas_ukuran = 5 * 1024 * 1024;

                if ($ukuran_file > $batas_ukuran) {
                    $_SESSION['pesan_gagal'] = "Ukuran file logo klub melebihi batas maksimum 5 MB";
                    header("Location: " . BASEURL . "/admin/pengaturan");
                    exit;
                }

                $file_sampul = $_FILES['gambar_sampul']['tmp_name'];
                $nama_file_sampul = $_FILES['gambar_sampul']['name'];

                $ekstensi_file = strtolower(pathinfo($nama_file_sampul, PATHINFO_EXTENSION));
                $tipe_mime = mime_content_type($file_sampul);

                $format_diperbolehkan = ['jpg', 'jpeg', 'png', 'heic'];
                $tipe_mime_diperbolehkan = ['image/jpeg', 'image/png', 'image/heic'];

                if (!in_array($ekstensi_file, $format_diperbolehkan) || !in_array($tipe_mime, $tipe_mime_diperbolehkan)) {
                    $_SESSION['pesan_gagal'] = "Harap menggunakan file gambar seperti JPG, PNG atau HEIC";
                    header("Location: " . BASEURL . "/admin/pengaturan");
                    exit;
                }

                $folder = 'img/';
                $tujuan = $folder . basename($nama_file_sampul);

                if (move_uploaded_file($file_sampul, $tujuan)) {
                    $gambar_sampul = $nama_file_sampul;
                } else {
                    $_SESSION['pesan_gagal'] = "Gagal meng-upload gambar sampul";
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

    public function cadangkan_data() {
        if ($_POST['email'] == NULL) {
            $_SESSION['pesan_gagal'] = "Email wajib dilengkapi!";
            header("Location: " . BASEURL . "/admin/pengaturan");
            exit;
        } else {
            $profil_klub = $this->model('ModelPengaturan')->tampilSemua();
            $profil_admin = $this->model('ModelProfil')->tampilSemua();

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'weidminton@gmail.com';
            $mail->Password = 'kqdpygxsjbqpeczi';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $tujuan = $_POST['email'];
            $subjek = "Pencadangan Data " . $profil_klub['nama_klub'];
            $lampiran = $this->model('ModelPengaturan')->cadangkan();
            $pesan = "Halo, " . $profil_admin['nama'] . ".<br><br>Berikut file sql dari pencadangan data " . $profil_klub['nama_klub'] . " yang Anda lakukan:<br><br>" . $mail->addAttachment($lampiran);

            $mail->setFrom('weidminton@gmail.com', 'WeidMinton');
            $mail->addAddress($tujuan);

            $mail->isHTML(true);
            $mail->Subject = $subjek;
            $mail->Body = $pesan;
            $mail->send();
    
            if ($mail) {
                $_SESSION['pesan_berhasil'] = "Data cadangan telah dikirim ke email tujuan";
                header("Location: " . BASEURL . "/admin/pengaturan");
            } else {
                $_SESSION['pesan_gagal'] = "Gagal mengirim email";
                header("Location: " . BASEURL . "/admin/pengaturan");
                exit;
            }
        }
    }

    public function hapus_data() {
        if ($_POST['kata_sandi'] == NULL) {
            $_SESSION['pesan_gagal'] = "Kata sandi wajib dilengkapi!";
            header("Location: " . BASEURL . "/admin/pengaturan");
            exit;
        } else {
            $profil_admin = $this->model('ModelProfil')->tampilSemua();

            if ($_POST['kata_sandi'] != $profil_admin['kata_sandi']) {
                $_SESSION['pesan_gagal'] = "Kata sandi Anda salah!";
                header("Location: " . BASEURL . "/admin/pengaturan");
                exit;
            } else {
                $hapus = $this->model('ModelPengaturan')->hapus();

                if ($hapus) {
                    $_SESSION['pesan_berhasil'] = "Semua data telah dihapus";
                    header("Location: " . BASEURL . "/admin/pengaturan");
                } else {
                    $_SESSION['pesan_gagal'] = "Data gagal dihapus";
                    header("Location: " . BASEURL . "/admin/pengaturan");
                    exit;
                }
            }
        }
    }
}