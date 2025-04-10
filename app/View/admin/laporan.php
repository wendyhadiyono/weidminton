            <main class="content">
                <div class="container-fluid p-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Dasbor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                        </ol>
                    </nav>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h4 class="mb-0">Laporan Sisa Main</h4>
                                </div>
                                <div class="card-body">
                                    <p>Cek sisa main anggota terkini yang sedang berada di <?= $data['profil_klub']['kota_asal'] ?>.</p>
                                    <p>Anggota yang sedang berada di luar <?= $data['profil_klub']['kota_asal'] ?> tidak akan ditampilkan</p>
                                    <a href="<?= BASEURL ?>/admin/laporan/sisa_main" class="btn btn-primary">Lihat</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h4 class="mb-0">Laporan Transaksi</h4>
                                </div>
                                <div class="card-body">
                                    <p>Cek semua jenis transaksi sesuai periode yang diinginkan.</p>
                                    <p>Laporan transaksi ini akan menggunakan format rekening koran.</p>
                                    <form action="<?= BASEURL ?>/admin/laporan/transaksi" method="post">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="bulan">
                                                        <option selected>Pilih</option>
                                                        <option value="01">Januari</option>
                                                        <option value="02">Februari</option>
                                                        <option value="03">Maret</option>
                                                        <option value="04">April</option>
                                                        <option value="05">Mei</option>
                                                        <option value="06">Juni</option>
                                                        <option value="07">Juli</option>
                                                        <option value="08">Agustus</option>
                                                        <option value="09">September</option>
                                                        <option value="10">Oktober</option>
                                                        <option value="11">November</option>
                                                        <option value="12">Desember</option>
                                                </select>
                                                <label for="bulan">Bulan</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="tahun">
                                                        <option selected>Pilih</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2024">2024</option>
                                                </select>
                                                <label for="tahun">Tahun</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button type="submit" class="btn btn-primary form-control">Lihat</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>