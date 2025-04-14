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

class ControllerTransaksiBola extends Controller {
    public function transaksi_bola() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        $total_bola = $this->model('ModelData')->totalBola();

        $tb = $this->model('ModelTransaksiBola')->tampilSemua();

        $data = [
            "judul" => "Transaksi Bola - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin,
            "total_bola" => $total_bola,
            "tb" => $tb
        ];
        
        $this->view("admin/header", $data);
        $this->view("admin/transaksi_bola", $data);
        $this->view("admin/footer");
    }
    
    public function tambah_tb() {
        if ($_POST['keterangan_tb'] == NULL || $_POST['jumlah_tb'] == NULL || $_POST['harga_tb'] == NULL || $_POST['tanggal_tb'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $tambah = $this->model('ModelTransaksiBola')->tambah($_POST);

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

    public function detail_tb() {
        $id_tb = $this->model('ModelTransaksiBola')->detail($_POST['id_tb']);

        if ($id_tb) {
            $res = [
                'status' => 200,
                'pesan' => 'Data berhasil ditampilkan sesuai ID transaksi bola',
                'data' => $id_tb
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 404,
                'pesan' => 'ID transaksi bola tidak ditemukan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function ubah_tb() {
        if ($_POST['keterangan_tb'] == NULL || $_POST['jumlah_tb'] == NULL || $_POST['harga_tb'] == NULL || $_POST['tanggal_tb'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $ubah = $this->model('ModelTransaksiBola')->ubah($_POST);

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

    public function hapus_tb() {
        $hapus = $this->model('ModelTransaksiBola')->hapus($_POST['id_tb']);

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