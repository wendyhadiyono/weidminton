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

class ControllerTransaksiLapangan extends Controller {
    public function transaksi_lapangan() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        $total_lapangan = $this->model('ModelData')->totalLapangan();

        $tl = $this->model('ModelTransaksiLapangan')->tampilSemua();

        $data = [
            "judul" => "Transaksi Lapangan - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin,
            "total_lapangan" => $total_lapangan,
            "tl" => $tl
        ];

        $this->view("admin/header", $data);
        $this->view("admin/transaksi_lapangan", $data);
        $this->view("admin/footer");
    }
    
    public function tambah_tl() {
        if ($_POST['keterangan_tl'] == NULL || $_POST['harga_tl'] == NULL || $_POST['tanggal_tl'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $tambah = $this->model('ModelTransaksiLapangan')->tambah($_POST);

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

    public function detail_tl() {
        $id_tl = $this->model('ModelTransaksiLapangan')->detail($_POST['id_tl']);

        if ($id_tl) {
            $res = [
                'status' => 200,
                'pesan' => 'Data berhasil ditampilkan sesuai ID transaksi lapangan',
                'data' => $id_tl
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 404,
                'pesan' => 'ID transaksi lapangan tidak ditemukan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function ubah_tl() {
        if ($_POST['keterangan_tl'] == NULL || $_POST['harga_tl'] == NULL || $_POST['tanggal_tl'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $ubah = $this->model('ModelTransaksiLapangan')->ubah($_POST);

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

    public function hapus_tl() {
        $hapus = $this->model('ModelTransaksiLapangan')->hapus($_POST['id_tl']);

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