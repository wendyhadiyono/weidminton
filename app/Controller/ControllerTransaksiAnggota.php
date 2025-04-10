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
        // Pemanggilan "ModelPengaturan" untuk menampilkan profik klub
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        // Pemanggilan "ModelProfil" untuk menampilkan profil admin
        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        // Pemanggilan "ModelData" untuk menampilkan infografik total kas
        $total_kas = $this->model('ModelData')->totalKas();

        // Pemanggilan "ModelAnggota" untuk menampilkan semua nama anggota
        $anggota = $this->model('ModelAnggota')->tampilSemua();

        // Pemanggilan "ModelTransaksiAnggota" untuk menampilkan semua transaksi anggota
        $ta = $this->model('ModelTransaksiAnggota')->tampilSemua();
        $nta = $this->model('ModelTransaksiAnggota')->tampilNominalTA();

        $data = [
            "judul" => "Transaksi Anggota - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin,
            "total_kas" => $total_kas,
            "nta" => $nta,
            "anggota" => $anggota,
            "ta" => $ta
        ];

        $this->view("admin/header", $data);
        $this->view("admin/transaksi_anggota", $data);
        $this->view("admin/footer");
    }

    public function tambah_nta() {
        if ($_POST['jenis'] == NULL || $_POST['jumlah_main'] == 'Pilih' || $_POST['nominal'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $tambah = $this->model('ModelTransaksiAnggota')->tambahNominalTA($_POST);

        if ($tambah) {
            $res = [
                'status' => 200,
                'pesan' => 'Nominal transaksi anggota telah ditambahkan!'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Nominal transaksi anggota gagal ditambahkan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function detail_nta() {
        $id_nta = $this->model('ModelTransaksiAnggota')->detailIdNTA($_POST['id_nta']);

        if ($id_nta) {
            $res = [
                'status' => 200,
                'pesan' => 'Data berhasil ditampilkan sesuai ID nominal transaksi anggota!',
                'data' => $id_nta
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 404,
                'pesan' => 'ID nominal transaksi anggota tidak ditemukan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function ubah_nta() {
        if ($_POST['jenis'] == NULL || $_POST['jumlah_main'] == NULL || $_POST['nominal'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);
        }

        $ubah = $this->model('ModelTransaksiAnggota')->ubahNTA($_POST);

        if ($ubah) {
            $res = [
                'status' => 200,
                'pesan' => 'Nominal transaksi anggota telah diubah!'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Nominal transaksi anggota gagal diubah!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function hapus_nta() {
        $hapus = $this->model('ModelTransaksiAnggota')->hapusNTA($_POST['id_nta']);

        if ($hapus) {
            $res = [
                'status' => 200,
                'pesan' => 'Nominal transaksi anggota telah dihapus!'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Nominal transaksi anggota gagal dihapus!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    // Transaksi Anggota
    public function tambah_ta() {
        if ($_POST['nama_ta'] == NULL || $_POST['nominal_ta'] == 'Pilih' || $_POST['tanggal_ta'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $data = [
            "nama_ta" => $_POST['nama_ta'],
            "nominal_ta" => $_POST['nominal_ta'],
            "tanggal_ta" => $_POST['tanggal_ta'],
            "jumlah_main" => $_POST['jumlah_main']
        ];

        $tambah = $this->model('ModelTransaksiAnggota')->tambah($data);

        if ($tambah) {
            $res = [
                'status' => 200,
                'pesan' => 'Transaksi telah ditambahkan!'
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
                'pesan' => 'Data berhasil ditampilkan sesuai ID transaksi anggota!',
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
                'pesan' => 'Transaksi telah diubah!'
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
                'pesan' => 'Transaksi telah dihapus!'
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