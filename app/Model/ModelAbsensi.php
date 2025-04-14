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

class ModelAbsensi {
    private $table1 = "absensi_anggota";
    private $table2 = "absensi_bola_lapangan";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tampilSemua() {
        $this->db->query("SELECT 
                MIN(aa.id_anggota) AS id_anggota, 
                COUNT(aa.nama) as total_anggota, 
                aa.tanggal_absensi, 
                abl.bola_terpakai, 
                abl.lapangan_terpakai
            FROM 
                absensi_anggota aa
            INNER JOIN 
                absensi_bola_lapangan abl 
            ON 
                aa.tanggal_absensi = abl.tanggal_absensi
            GROUP BY 
                aa.tanggal_absensi
            ORDER BY 
                aa.tanggal_absensi DESC;");

        return $this->db->resultSet();
    }

    public function tambah($data) {
        $id_anggota = $data['id_anggota'] ?? [];
        foreach ($id_anggota as $id) {
            $this->db->query("SELECT * FROM anggota WHERE id_anggota = :id");
            $this->db->bind("id", $id);
            $this->db->execute();
            $anggota = $this->db->single();

            $sisa_main = $anggota['sisa_main'] - 1;
            $this->db->query("UPDATE anggota SET sisa_main = :sisa_main WHERE id_anggota = :id");
            $this->db->bind("sisa_main", $sisa_main);
            $this->db->bind("id", $id);
            $this->db->execute();

            $nama = $anggota['nama'];
            $this->db->query("INSERT INTO " . $this->table1 . " (id_anggota, nama, tanggal_absensi)
                    VALUES (:id_anggota, :nama, :tanggal_absensi)");
            $this->db->bind("id_anggota", $id);
            $this->db->bind("nama", $nama);
            $this->db->bind("tanggal_absensi", $data['tanggal_absensi']);
            $this->db->execute();
        }

        $this->db->query("INSERT INTO absensi_bola_lapangan (bola_terpakai, lapangan_terpakai, tanggal_absensi)
                VALUES (:bola_terpakai, :lapangan_terpakai, :tanggal_absensi)");
        $this->db->bind("bola_terpakai", $data['bola_terpakai']);
        $this->db->bind("lapangan_terpakai", 1);
        $this->db->bind("tanggal_absensi", $data['tanggal_absensi']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function detail($tanggal_absensi) {
        $this->db->query("SELECT 
                aa.id_anggota, 
                aa.nama, 
                aa.tanggal_absensi, 
                abl.bola_terpakai, 
                abl.lapangan_terpakai
            FROM 
                absensi_anggota aa
            INNER JOIN 
                absensi_bola_lapangan abl 
            ON 
                aa.tanggal_absensi = abl.tanggal_absensi
            WHERE
                aa.tanggal_absensi = :tanggal_absensi");
        $this->db->bind('tanggal_absensi', $tanggal_absensi);

        return $this->db->resultSet();
    }
}