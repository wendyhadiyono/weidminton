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

class ModelLaporan {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function dataSaldodanTransaksi($periode) {
        list($tahun, $bulan) = explode('-', $periode);
    
        $tanggal_awal = "$tahun-$bulan-01";
        $tanggal_akhir = date("Y-m-t", strtotime($tanggal_awal));
        
        $this->db->query("SELECT kas_awal FROM profil_klub WHERE id_pk='1'");
        $profil_klub = $this->db->single();
        $kas_awal = $profil_klub['kas_awal'];

        $query_saldo_awal = "SELECT SUM(harga_ta) AS total_pemasukan FROM transaksi_anggota WHERE tanggal_ta < :tanggal_awal";
        $this->db->query($query_saldo_awal);
        $this->db->bind(':tanggal_awal', $tanggal_awal);
        $total_pemasukan_sebelum = $this->db->single()['total_pemasukan'] ?? 0;

        $query_total_pengeluaran_sebelum = "SELECT SUM(harga_tb) AS total_pengeluaran_bola FROM transaksi_bola WHERE tanggal_tb < :tanggal_awal
            UNION ALL
            SELECT SUM(harga_tl) AS total_pengeluaran_lapangan FROM transaksi_lapangan WHERE tanggal_tl < :tanggal_awal
            UNION ALL
            SELECT SUM(harga_tll) AS total_pengeluaran_lainnya FROM transaksi_lainnya WHERE tanggal_tll < :tanggal_awal";
    
        $this->db->query($query_total_pengeluaran_sebelum);
        $this->db->bind(':tanggal_awal', $tanggal_awal);
        $total_pengeluaran_sebelum = 0;
    
        $result_total_pengeluaran_sebelum = $this->db->resultSet();
        foreach ($result_total_pengeluaran_sebelum as $row) {
            $total_pengeluaran_sebelum += array_sum($row);
        }
    
        $saldo_awal = $kas_awal + $total_pemasukan_sebelum - $total_pengeluaran_sebelum;
    
        $query_pemasukan_bulan_ini = "SELECT SUM(harga_ta) AS total_pemasukan_bulan_ini FROM transaksi_anggota WHERE tanggal_ta BETWEEN :tanggal_awal AND :tanggal_akhir";
        $this->db->query($query_pemasukan_bulan_ini);
        $this->db->bind(':tanggal_awal', $tanggal_awal);
        $this->db->bind(':tanggal_akhir', $tanggal_akhir);
        $total_pemasukan_bulan_ini = $this->db->single()['total_pemasukan_bulan_ini'] ?? 0;
    
        $query_pengeluaran_bulan_ini = "SELECT SUM(harga_tb) AS total_pengeluaran_bola FROM transaksi_bola WHERE tanggal_tb BETWEEN :tanggal_awal AND :tanggal_akhir
            UNION ALL
            SELECT SUM(harga_tl) AS total_pengeluaran_lapangan FROM transaksi_lapangan WHERE tanggal_tl BETWEEN :tanggal_awal AND :tanggal_akhir
            UNION ALL
            SELECT SUM(harga_tll) AS total_pengeluaran_lainnya FROM transaksi_lainnya WHERE tanggal_tll BETWEEN :tanggal_awal AND :tanggal_akhir";
        $this->db->query($query_pengeluaran_bulan_ini);
        $this->db->bind(':tanggal_awal', $tanggal_awal);
        $this->db->bind(':tanggal_akhir', $tanggal_akhir);
        $total_pengeluaran_bulan_ini = 0;
    
        $result_pengeluaran_bulan_ini = $this->db->resultSet();
        foreach ($result_pengeluaran_bulan_ini as $row) {
            $total_pengeluaran_bulan_ini += array_sum($row);
        }
    
        $saldo_akhir = $saldo_awal + $total_pemasukan_bulan_ini - $total_pengeluaran_bulan_ini;
    
        $query = "SELECT 'Anggota' COLLATE utf8mb4_unicode_ci AS jenis, nama_ta AS keterangan, harga_ta AS harga, tanggal_ta AS tanggal 
            FROM transaksi_anggota 
            WHERE tanggal_ta BETWEEN :tanggal_awal AND :tanggal_akhir
            UNION ALL
            SELECT 'Bola' COLLATE utf8mb4_unicode_ci AS jenis, keterangan_tb AS keterangan, harga_tb AS harga, tanggal_tb AS tanggal 
            FROM transaksi_bola 
            WHERE tanggal_tb BETWEEN :tanggal_awal AND :tanggal_akhir
            UNION ALL
            SELECT 'Lapangan' COLLATE utf8mb4_unicode_ci AS jenis, keterangan_tl AS keterangan, harga_tl AS harga, tanggal_tl AS tanggal 
            FROM transaksi_lapangan 
            WHERE tanggal_tl BETWEEN :tanggal_awal AND :tanggal_akhir
            UNION ALL
            SELECT 'Lainnya' COLLATE utf8mb4_unicode_ci AS jenis, keterangan_tll AS keterangan, harga_tll AS harga, tanggal_tll AS tanggal 
            FROM transaksi_lainnya 
            WHERE tanggal_tll BETWEEN :tanggal_awal AND :tanggal_akhir
            ORDER BY tanggal ASC";
    
        $this->db->query($query);
        $this->db->bind(':tanggal_awal', $tanggal_awal);
        $this->db->bind(':tanggal_akhir', $tanggal_akhir);
    
        $result = $this->db->resultSet();
    
        $saldo_berjalan = 0;
        $transaksi_data = [];
    
        foreach ($result as $row) {
            $transaksi_data[] = [
                'jenis' => $row['jenis'],
                'keterangan' => $row['keterangan'],
                'harga' => $row['harga'],
                'tanggal' => $row['tanggal']
            ];
    
            // Hitung saldo berjalan
            if ($row['jenis'] == 'Anggota') {
                $saldo_berjalan += $row['harga'];
            } else {
                $saldo_berjalan -= $row['harga'];
            }
        }
    
        return [
            'saldo_awal' => $saldo_awal,
            'saldo_akhir' => $saldo_akhir,
            'total_pemasukan_bulan_ini' => $total_pemasukan_bulan_ini,
            'total_pengeluaran_bulan_ini' => $total_pengeluaran_bulan_ini,
            'saldo_berjalan' => $saldo_berjalan,
            'transaksi' => $transaksi_data
        ];
    }

    public function transaksiBulanIni($periode) {
        list($tahun, $bulan) = explode('-', $periode);
    
        // Hitung tanggal awal dan akhir bulan
        $tanggal_awal = "$tahun-$bulan-01";
        $tanggal_akhir = date("Y-m-t", strtotime($tanggal_awal));

        $query_jumlah_transaksi = "SELECT 
                    (SELECT COUNT(*) 
                    FROM transaksi_anggota 
                        WHERE tanggal_ta BETWEEN :tanggal_awal AND :tanggal_akhir) AS anggota,
                    (SELECT COUNT(*) 
                    FROM transaksi_bola 
                        WHERE tanggal_tb BETWEEN :tanggal_awal AND :tanggal_akhir) AS bola,
                    (SELECT COUNT(*) 
                    FROM transaksi_lapangan 
                        WHERE tanggal_tl BETWEEN :tanggal_awal AND :tanggal_akhir) AS lapangan,
                    (SELECT COUNT(*) 
                    FROM transaksi_lainnya 
                        WHERE tanggal_tll BETWEEN :tanggal_awal AND :tanggal_akhir) AS lainnya";

        $this->db->query($query_jumlah_transaksi);
        $this->db->bind(':tanggal_awal', $tanggal_awal);
        $this->db->bind(':tanggal_akhir', $tanggal_akhir);
        $jumlah_transaksi = $this->db->single();

        return [
            'jumlah_transaksi' => $jumlah_transaksi
        ];
    }

    public function transaksiTerakhir() {
        $query = "SELECT 'Anggota' COLLATE utf8mb4_unicode_ci AS jenis, nama_ta AS keterangan, harga_ta AS harga, tanggal_ta AS tanggal 
            FROM transaksi_anggota 
            UNION ALL
            SELECT 'Bola' COLLATE utf8mb4_unicode_ci AS jenis, keterangan_tb AS keterangan, harga_tb AS harga, tanggal_tb AS tanggal 
            FROM transaksi_bola 
            UNION ALL
            SELECT 'Lapangan' COLLATE utf8mb4_unicode_ci AS jenis, keterangan_tl AS keterangan, harga_tl AS harga, tanggal_tl AS tanggal 
            FROM transaksi_lapangan 
            UNION ALL
            SELECT 'Lainnya' COLLATE utf8mb4_unicode_ci AS jenis, keterangan_tll AS keterangan, harga_tll AS harga, tanggal_tll AS tanggal 
            FROM transaksi_lainnya 
            ORDER BY tanggal DESC LIMIT 7";
    
        $this->db->query($query);
        $result = $this->db->resultSet();

        $transaksi_data = [];

        foreach ($result as $row) {
            $transaksi_data[] = [
                'jenis' => $row['jenis'],
                'keterangan' => $row['keterangan'],
                'harga' => $row['harga'],
                'tanggal' => $row['tanggal']
            ];
        }

        return [
            'tujuh_transaksi_terakhir' => $transaksi_data
        ];
    }
}