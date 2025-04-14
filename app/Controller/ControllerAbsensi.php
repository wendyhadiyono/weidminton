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

class ControllerAbsensi extends Controller {
    public function absensi() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        $total_bola = $this->model('ModelData')->totalBola();
        $total_lapangan = $this->model('ModelData')->totalLapangan();

        $anggota = $this->model('ModelAnggota')->tampilSemua();

        $absensi = $this->model('ModelAbsensi')->tampilSemua();

        $data = [
            "judul" => "Absensi - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin,
            "total_bola" => $total_bola,
            "total_lapangan" => $total_lapangan,
            "anggota" => $anggota,
            "absensi" => $absensi
        ];

        $this->view("admin/header", $data);
        $this->view("admin/absensi", $data);
        $this->view("admin/footer");
    }

    public function tambah_absensi() {
        $id_anggota = $_POST['id_anggota'] ?? [];
        
        if ($id_anggota == NULL || $_POST['bola_terpakai'] == NULL || $_POST['tanggal_absensi'] == NULL) {
            $res = [
                'status' => 422,
                'pesan' => 'Data wajib dilengkapi!'
            ];
            echo json_encode($res);

            return false;
        }

        $tambah = $this->model('ModelAbsensi')->tambah($_POST);

        if ($tambah) {
            $res = [
                'status' => 200,
                'pesan' => 'Absensi telah ditambahkan'
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 500,
                'pesan' => 'Absensi gagal ditambahkan!'
            ];
            echo json_encode($res);

            return false;
        }
    }

    public function detail_absensi() {
        $detail_absensi = $this->model('ModelAbsensi')->detail($_POST['tanggal_absensi']);

        if ($detail_absensi) {
            $res = [
                'status' => 200,
                'pesan' => 'Data berhasil ditampilkan sesuai tanggal absensi',
                'data' => $detail_absensi
            ];
            echo json_encode($res);

            return false;
        } else {
            $res = [
                'status' => 404,
                'pesan' => 'Tanggal absensi tidak ditemukan!'
            ];
            echo json_encode($res);

            return false;
        }
    }
}