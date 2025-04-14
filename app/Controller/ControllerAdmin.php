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

class ControllerAdmin extends Controller {
    public function index() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        $total_kas = $this->model('ModelData')->totalKas();
        $total_anggota = $this->model('ModelData')->totalAnggota();
        $total_bola = $this->model('ModelData')->totalBola();
        $total_lapangan = $this->model('ModelData')->totalLapangan();

        $bulan = date("m");
        $tahun = date("Y");
        $periode = "$tahun-$bulan";
        $arus_kas = $this->model('ModelLaporan')->dataSaldodanTransaksi($periode);
        $total_pemasukan = $arus_kas['total_pemasukan_bulan_ini'];
        $total_pengeluaran = $arus_kas['total_pengeluaran_bulan_ini'];

        $transaksi_bulan_ini = $this->model('ModelLaporan')->transaksiBulanIni($periode);
        $jumlah_transaksi = $transaksi_bulan_ini['jumlah_transaksi'];

        $transaksi_terakhir = $this->model('ModelLaporan')->transaksiTerakhir();
        $tujuh_transaksi_terakhir = $transaksi_terakhir['tujuh_transaksi_terakhir'];

        $data = [
            "judul" => "Dasbor - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin,
            "total_kas" => $total_kas,
            "total_anggota" => $total_anggota,
            "total_bola" => $total_bola,
            "total_lapangan" => $total_lapangan,
            "bulan" => $bulan,
            "tahun" => $tahun,
            "total_pemasukan" => $total_pemasukan,
            "total_pengeluaran" => $total_pengeluaran,
            "jumlah_transaksi" => $jumlah_transaksi,
            "tujuh_transaksi_terakhir" => $tujuh_transaksi_terakhir
        ];

        $this->view("admin/header", $data);
        $this->view("admin/index", $data);
        $this->view("admin/footer", $data);
    }
}