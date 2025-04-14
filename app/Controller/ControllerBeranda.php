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

class ControllerBeranda extends Controller {
    public function index() {
        $profil_klub = $this->model('ModelPengaturan')->tampilSemua();

        $total_kas = $this->model('ModelData')->totalKas();
        $total_anggota = $this->model('ModelData')->totalAnggota();
        $total_bola = $this->model('ModelData')->totalBola();
        $total_lapangan = $this->model('ModelData')->totalLapangan();

        $anggota = $this->model('ModelAnggota')->tampilSemua();

        $ta = $this->model('ModelTransaksiAnggota')->tampilBeranda();
        $tb = $this->model('ModelTransaksiBola')->tampilBeranda();
        $tll = $this->model('ModelTransaksiLainnya')->tampilBeranda();
        $tl = $this->model('ModelTransaksiLapangan')->tampilBeranda();

        $data = [
            "judul" => $profil_klub['nama_klub'],
            "profil_klub" => $profil_klub,
            "total_kas" => $total_kas,
            "total_anggota" => $total_anggota,
            "total_bola" => $total_bola,
            "total_lapangan" => $total_lapangan,
            "anggota" => $anggota,
            "ta" => $ta,
            "tb" => $tb,
            "tll" => $tll,
            "tl" => $tl
        ];
        
        $this->view('beranda/index', $data);
    }

    public function instalasi() {
        $this->view('beranda/instalasi');
    }
}