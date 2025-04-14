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

if (!function_exists('format_tanggal')) {
    function format_tanggal(?string $tanggal): ?string {
        if (empty($tanggal)) {
            return null;
        }
        
        $objekTanggal = DateTime::createFromFormat('Y-m-d', $tanggal);

        if ($objekTanggal) {
            return $objekTanggal->format('d/m/Y');
        } else {
            return null;
        }
    }
}

// Helper untuk mengubah nama bulan menjadi format nama bulan Indonesia
if (!function_exists('format_bulan')) {
    function format_bulan(?string $bulan): ?string {
        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        return $namaBulan[$bulan] ?? null;
    }
}
// Helper untuk mengubah format angka menjadi format rupiah
if (!function_exists('format_rupiah')) {
    function format_rupiah(int $angka, string $mataUang = 'Rp') {
        return $mataUang . ' ' . number_format($angka, 0, ',', '.');
    }
}

// Helper untuk mengubah format angka menjadi seperti format digit uang
if (!function_exists('format_uang')) {
    function format_uang(int $angka) {
        return number_format($angka, 0, ',', '.');
    }
}

// Helper untuk membersihkan karakter dari spasi dan karakter yang tidak diinginkan
function saringKarakter($input) {
    $input = trim($input);
    $input = preg_replace('/[^a-zA-Z0-9!@#$%^&*()_+]/', '', $input);
    return $input;
}