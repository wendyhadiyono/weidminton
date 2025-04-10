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

namespace  App\Controller;

use App\Config\Controller;

class ControllerTransaksiLainnya extends Controller {
    public function transaksi_lainnya() {
        // Pemanggilan "ModelPengaturan" untuk menampilkan profik klub
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        // Pemanggilan "ModelProfil" untuk menampilkan profil admin
        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        // Pemanggilan "ModelData" untuk menampilkan infografik total kas
        $total_kas = $this->model('ModelData')->totalKas();

        // Pemanggilan "ModelTransaksiLainnya" untuk menampilkan semua transaksi lainnya
        $tll = $this->model('ModelTransaksiLainnya')->tampilSemua();

        $data = [
            "judul" => "Transaksi Lainnya - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin,
            "total_kas" => $total_kas,
            "tll" => $tll
        ];
        
        $this->view("admin/header", $data);
        $this->view("admin/transaksi_lainnya", $data);
        $this->view("admin/footer");
    }

    public function tambah_tll() {
        if ($_POST['keterangan_tll'] == NULL || $_POST['nominal_tll'] == NULL || $_POST['tanggal_tll'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $tambah = $this->model('ModelTransaksiLainnya')->tambah($_POST);

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

    public function detail_tll() {
        $id_tll = $this->model('ModelTransaksiLainnya')->detail($_POST['id_tll']);

        if ($id_tll) {
            $res = [
                'status' => 200,
                'pesan' => 'Data berhasil ditampilkan sesuai ID transaksi lainnya!',
                'data' => $id_tll
            ];
            echo json_encode($res);

            return false;
        }
        else {
            $res = [
                'status' => 404,
                'pesan' => 'ID transaksi lainnya tidak ditemukan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function ubah_tll() {
        if ($_POST['keterangan_tll'] == NULL || $_POST['nominal_tll'] == NULL || $_POST['tanggal_tll'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $ubah = $this->model('ModelTransaksiLainnya')->ubah($_POST);

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

    public function hapus_tll() {
        $hapus = $this->model('ModelTransaksiLainnya')->hapus($_POST['id_tll']);

        if ($hapus) {
            $res = [
                'status' => 200,
                'pesan' => 'Transaksi telah dihapus!'
            ];
            echo json_encode($res);

            return false;
        }
        else {
            $res = [
                'status' => 500,
                'pesan' => 'Transaksi gagal dihapus!'
            ];
            echo json_encode($res);

            return false;
        }
    }
}