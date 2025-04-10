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

class ControllerAnggota extends Controller {
    public function anggota() {
        // Pemanggilan "ModelPengaturan" untuk menampilkan profil klub
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        // Pemanggilan "ModelProfil" untuk menampilkan profil admin
        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        // Pemanggilan "ModelData" untuk menampilkan infografik total anggota
        $total_anggota = $this->model('ModelData')->totalAnggota();

        // Pemanggilan "ModelAnggota" untuk menampilkan semua anggota
        $anggota = $this->model('ModelAnggota')->tampilSemua();

        $data = [
            "judul" => "Anggota - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin,
            "total_anggota" => $total_anggota,
            "anggota" => $anggota
        ];

        $this->view("admin/header", $data);
        $this->view("admin/anggota", $data);
        $this->view("admin/footer");
    }

    public function tambah_anggota() {
        if (empty($_POST['nama']) || $_POST['jenis_kelamin'] == 'Pilih' || $_POST['domisili'] == 'Pilih') {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $cekNama = $this->model('ModelAnggota')->cekNama($_POST['nama']);

        if ($cekNama) {
            $res = [
                'status' => 409,
                'pesan' => 'Nama sudah digunakan oleh anggota lain!'
            ];
            echo json_encode($res);

            return false;
        }

        $tambah = $this->model('ModelAnggota')->tambah($_POST);

        if ($tambah) {
            $res = [
                'status' => 200,
                'pesan' => 'Data telah ditambahkan!'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Data gagal ditambahkan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function detail_anggota() {
        $id_anggota = $this->model('ModelAnggota')->detail($_POST['id_anggota']);

        if ($id_anggota) {
            $res = [
                'status' => 200,
                'pesan' => 'Data berhasil ditampilkan sesuai ID anggota!',
                'data' => $id_anggota
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 404,
                'pesan' => 'ID anggota tidak ditemukan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function ubah_anggota() {
        if (empty($_POST['nama']) || $_POST['jenis_kelamin'] == 'Pilih' || $_POST['domisili'] == 'Pilih') {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $ubah = $this->model('ModelAnggota')->ubah($_POST);

        if ($ubah) {
            $res = [
                'status' => 200,
                'pesan' => 'Data telah diubah!'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Data gagal diubah!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function hapus_anggota() {
        $hapus = $this->model('ModelAnggota')->hapus($_POST['id_anggota']);

        if ($hapus) {
            $res = [
                'status' => 200,
                'pesan' => 'Data telah dihapus!'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Data gagal dihapus!'
            ];
            echo json_encode($res);

            return false;
        }
    }
}
