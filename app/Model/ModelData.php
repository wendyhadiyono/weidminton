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

namespace App\Model;

use App\Config\Database;

class ModelData {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function totalKas() {
        $this->db->query("SELECT kas_awal FROM profil_klub WHERE id_pk='1'");
        $pk = $this->db->single();
        $kas_awal = $pk['kas_awal'];

        $this->db->query("SELECT SUM(nominal_ta) AS total_pemasukan FROM transaksi_anggota");
        $ta = $this->db->single();
        $pemasukan_ta = $ta['total_pemasukan'];

        $this->db->query("SELECT SUM(harga_tb) AS pengeluaran_tb FROM transaksi_bola");
        $tb = $this->db->single();
        $pengeluaran_tb = $tb['pengeluaran_tb'];

        $this->db->query("SELECT SUM(harga_tl) AS pengeluaran_tl FROM transaksi_lapangan");
        $tl = $this->db->single();
        $pengeluaran_tl = $tl['pengeluaran_tl'];
    
        $this->db->query("SELECT SUM(nominal_tll) AS pengeluaran_tll FROM transaksi_lainnya");
        $tll = $this->db->single();
        $pengeluaran_tll = $tll['pengeluaran_tll'];
        
        $total_kas = $kas_awal + $pemasukan_ta - ($pengeluaran_tb + $pengeluaran_tl + $pengeluaran_tll);

        return $total_kas;
    }

    public function totalAnggota() {
        $this->db->query("SELECT COUNT(*) AS total_anggota FROM anggota");
        $anggota = $this->db->single();
        $total_anggota = $anggota['total_anggota'];

        return $total_anggota;
    }

    public function totalBola() {
        $this->db->query("SELECT SUM(jumlah_tb) AS total_bola FROM transaksi_bola");
        $tb = $this->db->single();

        $this->db->query("SELECT SUM(bola_terpakai) AS bola_terpakai FROM absensi_bola_lapangan");
        $abl = $this->db->single();

        $total_bola = $tb['total_bola'] - $abl['bola_terpakai'];

        return $total_bola;
    }

    public function totalLapangan() {
        $this->db->query("SELECT SUM(sisa_main_tl) AS sisa_main_tl FROM transaksi_lapangan ORDER BY id_tl DESC LIMIT 1");
        $tl = $this->db->single();

        $this->db->query("SELECT SUM(lapangan_terpakai) AS lapangan_terpakai FROM absensi_bola_lapangan");
        $abl = $this->db->single();

        $total_lapangan = $tl['sisa_main_tl'] - $abl['lapangan_terpakai'];
        
        return $total_lapangan;
    }
}