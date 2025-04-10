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

class ModelTransaksiAnggota {
    private $table = "transaksi_anggota";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tampilBeranda() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY tanggal_ta DESC LIMIT 10");

        return $this->db->resultSet();
    }

    public function tampilSemua() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY tanggal_ta DESC");

        return $this->db->resultSet();
    }

    public function tampilNominalTA(){
        $this->db->query("SELECT * FROM nominal_transaksi_anggota ORDER BY jumlah_main ASC");
        $nta = $this->db->resultSet();

        return $nta;
    }

    public function tambahNominalTA($data) {
        $this->db->query("INSERT INTO nominal_transaksi_anggota (jenis, jumlah_main, nominal)
                    VALUES (:jenis, :jumlah_main, :nominal)");
        $this->db->bind("jenis", $data['jenis']);
        $this->db->bind("jumlah_main", $data['jumlah_main']);
        $this->db->bind("nominal", $data['nominal']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function detailIdNTA($id_nta) {
        $this->db->query("SELECT * FROM nominal_transaksi_anggota WHERE id_nta = :id_nta");
        $this->db->bind("id_nta", $id_nta);
        $nta = $this->db->single();
        
        if ($nta) {
            return $nta;
        } else {
            return null;
        }
    }

    public function ubahNTA($data) {
        $this->db->query("UPDATE nominal_transaksi_anggota SET jenis = :jenis, jumlah_main = :jumlah_main, nominal = :nominal WHERE id_nta = :id_nta");
        $this->db->bind("jenis", $data['jenis']);
        $this->db->bind("jumlah_main", $data['jumlah_main']);
        $this->db->bind("nominal", $data['nominal']);
        $this->db->bind("id_nta", $data['id_nta']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusNTA($id_nta) {
        $this->db->query("DELETE FROM nominal_transaksi_anggota WHERE id_nta = :id_nta");
        $this->db->bind("id_nta", $id_nta);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // Transaksi Anggota
    public function tambah($data) {
        $this->db->query("INSERT INTO " . $this->table . " (nama_ta, nominal_ta, tanggal_ta)
                    VALUES (:nama_ta, :nominal_ta, :tanggal_ta)");
        $this->db->bind("nama_ta", $data['nama_ta']);
        $this->db->bind("nominal_ta", $data['nominal_ta']);
        $this->db->bind("tanggal_ta", $data['tanggal_ta']);
        $this->db->execute();

        $this->db->query("SELECT sisa_main FROM anggota WHERE nama = :nama_ta");
        $this->db->bind("nama_ta", $data['nama_ta']);
        $this->db->execute();
        $anggota = $this->db->single();

        $jumlah_main = isset($data['jumlah_main']) ? intval($data['jumlah_main']) : 0;
        $sisa_main = intval($anggota['sisa_main']) + $jumlah_main;

        $this->db->query("UPDATE anggota SET sisa_main = :sisa_main1 WHERE nama = :nama_ta");
        $this->db->bind("sisa_main1", $sisa_main);
        $this->db->bind("nama_ta", $data['nama_ta']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function detail($id_ta) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_ta = :id_ta");
        $this->db->bind("id_ta", $id_ta);
        $ta = $this->db->single();
        
        if ($ta) {
            return $ta;
        } else {
            return null;
        }
    }

    public function ubah($data) {
        $this->db->query("UPDATE " . $this->table . " SET tanggal_ta = :tanggal_ta WHERE id_ta = :id_ta");
        $this->db->bind("id_ta", $data['id_ta']);
        $this->db->bind("tanggal_ta", $data['tanggal_ta']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapus($id_ta) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_ta = :id_ta");
        $this->db->bind("id_ta", $id_ta);
        $this->db->execute();

        return $this->db->rowCount();
    }
}