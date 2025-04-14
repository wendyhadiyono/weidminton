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

class ControllerPaketMain extends Controller {
    public function paket_main() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        $paket_main = $this->model('ModelPaketMain')->tampilSemua();

        $data = [
            "judul" => "Paket Main - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin,
            "paket_main" => $paket_main
        ];
        
        $this->view("admin/header", $data);
        $this->view("admin/paket_main", $data);
        $this->view("admin/footer");
    }

    public function tambah_paket() {
        if ($_POST['jenis'] == 'Pilih' || $_POST['jumlah_main'] == NULL || $_POST['harga'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $tambah = $this->model('ModelPaketMain')->tambah($_POST);

        if ($tambah) {
            $res = [
                'status' => 200,
                'pesan' => 'Paket main telah ditambahkan'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Paket main gagal ditambahkan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function detail_paket() {
        $id_pm = $this->model('ModelPaketMain')->detail($_POST['id_pm']);

        if ($id_pm) {
            $res = [
                'status' => 200,
                'pesan' => 'Data berhasil ditampilkan sesuai ID paket main',
                'data' => $id_pm
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 404,
                'pesan' => 'ID paket main tidak ditemukan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function ubah_paket() {
        if ($_POST['jenis'] == 'Pilih' || $_POST['jumlah_main'] == NULL || $_POST['harga'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $ubah = $this->model('ModelPaketMain')->ubah($_POST);

        if ($ubah) {
            $res = [
                'status' => 200,
                'pesan' => 'Paket main telah diubah'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Paket main gagal diubah!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function hapus_paket() {
        $hapus = $this->model('ModelPaketMain')->hapus($_POST['id_pm']);

        if ($hapus) {
            $res = [
                'status' => 200,
                'pesan' => 'Paket main telah dihapus'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Paket main gagal dihapus!'
            ];
            echo json_encode($res);

            return false;
        }
    }
}