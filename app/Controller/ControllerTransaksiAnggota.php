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

class ControllerTransaksiAnggota extends Controller {
    public function transaksi_anggota() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        $total_kas = $this->model('ModelData')->totalKas();

        $anggota = $this->model('ModelAnggota')->tampilSemua();

        $paket_main = $this->model('ModelPaketMain')->tampilSemua();

        $ta = $this->model('ModelTransaksiAnggota')->tampilSemua();

        $data = [
            "judul" => "Transaksi Anggota - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin,
            "total_kas" => $total_kas,
            "anggota" => $anggota,
            "paket_main" => $paket_main,
            "ta" => $ta
        ];

        $this->view("admin/header", $data);
        $this->view("admin/transaksi_anggota", $data);
        $this->view("admin/footer");
    }

    public function tambah_ta() {
        if ($_POST['nama_ta'] == NULL || $_POST['harga_ta'] == 'Pilih' || $_POST['tanggal_ta'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $data = [
            "nama_ta" => $_POST['nama_ta'],
            "harga_ta" => $_POST['harga_ta'],
            "tanggal_ta" => $_POST['tanggal_ta'],
            "jumlah_main" => $_POST['jumlah_main']
        ];

        $tambah = $this->model('ModelTransaksiAnggota')->tambah($data);

        if ($tambah) {
            $res = [
                'status' => 200,
                'pesan' => 'Transaksi telah ditambahkan'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Transaksi gagal ditambahkan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function detail_ta() {
        $id_ta = $this->model('ModelTransaksiAnggota')->detail($_POST['id_ta']);

        if ($id_ta) {
            $res = [
                'status' => 200,
                'pesan' => 'Data berhasil ditampilkan sesuai ID transaksi anggota',
                'data' => $id_ta
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 404,
                'pesan' => 'ID transaksi anggota tidak ditemukan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function ubah_ta() {
        if ($_POST['tanggal_ta'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);
        }

        $ubah = $this->model('ModelTransaksiAnggota')->ubah($_POST);

        if ($ubah) {
            $res = [
                'status' => 200,
                'pesan' => 'Transaksi telah diubah'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Transaksi gagal diubah!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function hapus_ta() {
        $hapus = $this->model('ModelTransaksiAnggota')->hapus($_POST['id_ta']);

        if ($hapus) {
            $res = [
                'status' => 200,
                'pesan' => 'Transaksi telah dihapus'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Transaksi gagal dihapus!'
            ];
            echo json_encode($res);

            return false;
        }
    }
}