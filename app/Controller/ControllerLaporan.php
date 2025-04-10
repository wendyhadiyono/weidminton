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

class ControllerLaporan extends Controller {
    public function laporan() {
        // Pemanggilan "ModelPengaturan" untuk menampilkan profil klub
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        // Pemanggilan "ModelProfil" untuk menampilkan profil admin
        $profil_admin = $this->model('ModelProfil')->tampilSemua();

        $data = [
            "judul" => "Laporan - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "profil_admin" => $profil_admin
        ];
        
        $this->view("admin/header", $data);
        $this->view("admin/laporan", $data);
        $this->view("admin/footer");
    }

    public function sisa_main() {
        // Pemanggilan "ModelPengaturan" untuk menampilkan profil klub
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        // Pemanggilan "ModelAnggota" untuk menampilkan semua anggota
        $anggota = $this->model('ModelAnggota')->tampilSemua();

        $data = [
            "judul" => "Laporan Sisa Main - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "anggota" => $anggota
        ];

        $this->view("admin/laporan/header", $data);
        $this->view("admin/laporan/sisa_main", $data);
        $this->view("admin/laporan/footer");
    }

    public function transaksi() {
        // Pemanggilan "ModelPengaturan" untuk menampilkan profil klub
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        // Pemanggilan "ModelLaporan" untuk 
        $bulan = $_POST['bulan'] ?? null;
        $tahun = $_POST['tahun'] ?? null;
        $periode = "$tahun-$bulan";
        $transaksi = $this->model('ModelLaporan')->dataSaldodanTransaksi($periode);
        $saldo_awal = $transaksi['saldo_awal'];
        $saldo_akhir = $transaksi['saldo_akhir'];
        $total_pemasukan = $transaksi['total_pemasukan_bulan_ini'];
        $total_pengeluaran = $transaksi['total_pengeluaran_bulan_ini'];
        $saldo_berjalan = $transaksi['saldo_berjalan'];
        $transaksi = $transaksi['transaksi'];

        $data = [
            "judul" => "Laporan Transaksi - " . $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "bulan" => $bulan,
            "tahun" => $tahun,
            "saldo_awal" => $saldo_awal,
            "saldo_akhir" => $saldo_akhir,
            "total_pemasukan" => $total_pemasukan,
            "total_pengeluaran" => $total_pengeluaran,
            "saldo_berjalan" => $saldo_berjalan,
            "transaksi" => $transaksi
        ];
        
        $this->view("admin/laporan/header", $data);
        $this->view("admin/laporan/transaksi", $data);
        $this->view("admin/laporan/footer");
    }
}