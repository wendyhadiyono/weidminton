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

session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../app/Config/Constant.php";
require_once __DIR__ . "/../app/Config/Helper.php";

use App\Config\AuthMiddleware;
use App\Config\Router;

use App\Controller\ControllerAbsensi;
use App\Controller\ControllerAdmin;
use App\Controller\ControllerAnggota;
use App\Controller\ControllerAutentikasi;
use App\Controller\ControllerBeranda;
use App\Controller\ControllerLaporan;
use App\Controller\ControllerPengaturan;
use App\Controller\ControllerProfil;
use App\Controller\ControllerTransaksiAnggota;
use App\Controller\ControllerTransaksiBola;
use App\Controller\ControllerTransaksiLainnya;
use App\Controller\ControllerTransaksiLapangan;

// Admin
Router::add("GET", "/admin", ControllerAdmin::class, "index", [AuthMiddleware::class]);

// Admin > Profil Admin
Router::add("GET", "/admin/profil", ControllerProfil::class, "profil", [AuthMiddleware::class]);
Router::add("POST", "/admin/profil/ubah", ControllerProfil::class, "ubah_profil", [AuthMiddleware::class]);
Router::add("POST", "/admin/profil/ubah_sandi", ControllerProfil::class, "ubah_sandi", [AuthMiddleware::class]);

// Admin > Pengaturan
Router::add("GET", "/admin/pengaturan", ControllerPengaturan::class, "pengaturan", [AuthMiddleware::class]);
Router::add("POST", "/admin/pengaturan/ubah", ControllerPengaturan::class, "ubah_profil", [AuthMiddleware::class]);

// Admin > Anggota
Router::add("GET", "/admin/anggota", ControllerAnggota::class, "anggota", [AuthMiddleware::class]);
Router::add("POST", "/admin/anggota/tambah", ControllerAnggota::class, "tambah_anggota", [AuthMiddleware::class]);
Router::add("POST", "/admin/anggota/detail", ControllerAnggota::class, "detail_anggota", [AuthMiddleware::class]);
Router::add("POST", "/admin/anggota/ubah", ControllerAnggota::class, "ubah_anggota", [AuthMiddleware::class]);
Router::add("POST", "/admin/anggota/hapus", ControllerAnggota::class, "hapus_anggota", [AuthMiddleware::class]);

// Admin > Absensi
Router::add("GET", "/admin/absensi", ControllerAbsensi::class, "absensi", [AuthMiddleware::class]);
Router::add("POST", "/admin/absensi/tambah", ControllerAbsensi::class, "tambah_absensi", [AuthMiddleware::class]);
Router::add("POST", "/admin/absensi/detail", ControllerAbsensi::class, "detail_absensi", [AuthMiddleware::class]);

// Admin > Laporan
Router::add("GET", "/admin/laporan", ControllerLaporan::class, "laporan", [AuthMiddleware::class]);
Router::add("GET", "/admin/laporan/sisa_main", ControllerLaporan::class, "sisa_main", [AuthMiddleware::class]);
Router::add("POST", "/admin/laporan/transaksi", ControllerLaporan::class, "transaksi", [AuthMiddleware::class]);

// Admin > Transaksi Anggota
Router::add("GET", "/admin/transaksi_anggota", ControllerTransaksiAnggota::class, "transaksi_anggota", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_anggota/tambah", ControllerTransaksiAnggota::class, "tambah_ta", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_anggota/detail", ControllerTransaksiAnggota::class, "detail_ta", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_anggota/ubah", ControllerTransaksiAnggota::class, "ubah_ta", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_anggota/hapus", ControllerTransaksiAnggota::class, "hapus_ta", [AuthMiddleware::class]);

// Admin > Transaksi Anggota > Nominal Transaksi Anggota
Router::add("POST", "/admin/transaksi_anggota/tambah_nominal", ControllerTransaksiAnggota::class, "tambah_nta", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_anggota/detail_nominal", ControllerTransaksiAnggota::class, "detail_nta", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_anggota/ubah_nominal", ControllerTransaksiAnggota::class, "ubah_nta", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_anggota/hapus_nominal", ControllerTransaksiAnggota::class, "hapus_nta", [AuthMiddleware::class]);

// Admin > Transaksi Bola
Router::add("GET", "/admin/transaksi_bola", ControllerTransaksiBola::class, "transaksi_bola", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_bola/tambah", ControllerTransaksiBola::class, "tambah_tb", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_bola/detail", ControllerTransaksiBola::class, "detail_tb", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_bola/ubah", ControllerTransaksiBola::class, "ubah_tb", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_bola/hapus", ControllerTransaksiBola::class, "hapus_tb", [AuthMiddleware::class]);

// Admin > Transaksi Lapangan
Router::add("GET", "/admin/transaksi_lapangan", ControllerTransaksiLapangan::class, "transaksi_lapangan", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_lapangan/tambah", ControllerTransaksiLapangan::class, "tambah_tl", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_lapangan/detail", ControllerTransaksiLapangan::class, "detail_tl", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_lapangan/ubah", ControllerTransaksiLapangan::class, "ubah_tl", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_lapangan/hapus", ControllerTransaksiLapangan::class, "hapus_tl", [AuthMiddleware::class]);

// Admin > Transaksi Lainnya
Router::add("GET", "/admin/transaksi_lainnya", ControllerTransaksiLainnya::class, "transaksi_lainnya", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_lainnya/tambah", ControllerTransaksiLainnya::class, "tambah_tll", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_lainnya/detail", ControllerTransaksiLainnya::class, "detail_tll", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_lainnya/ubah", ControllerTransaksiLainnya::class, "ubah_tll", [AuthMiddleware::class]);
Router::add("POST", "/admin/transaksi_lainnya/hapus", ControllerTransaksiLainnya::class, "hapus_tll", [AuthMiddleware::class]);

// Autentikasi
Router::add("GET", "/autentikasi", ControllerAutentikasi::class, "index", []);
Router::add("POST", "/autentikasi/masuk", ControllerAutentikasi::class, "masuk", []);
Router::add("GET", "/autentikasi/keluar", ControllerAutentikasi::class, "keluar", []);

// Beranda
Router::add("GET", "/", ControllerBeranda::class, "index", []);
Router::add("GET", "/instalasi", ControllerBeranda::class, "instalasi", []);

Router::run();