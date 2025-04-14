            <main class="content">
                <div class="container-fluid p-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Dasbor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Absensi</li>
                        </ol>
                    </nav>

                    <div class="row">
						<div class="col-12 col-md-6">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h4>Bola</h4>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="target"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-muted">Total bola terkini</span>
                                    </div>
                                    <h4 class="mt-4 dataBola"><?= $data['total_bola'] ?> pcs</h4>
                                </div>
							</div>
						</div>
						<div class="col-12 col-md-6">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h4>Lapangan</h4>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="home"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-muted">Total lapangan terkini</span>
                                    </div>
                                    <h4 class="mt-4 dataLapangan"><?= $data['total_lapangan'] ?> kali main</h4>
                                </div>
                            </div>							
						</div>
					</div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="d-inline align-middle mt-1 mb-0">Semua Absensi</h4>
                                    <button type="button" class="btn btn-success text-white ms-2" data-bs-toggle="modal" data-bs-target="#modalAbsensi">Tambah</button>
                                </div>
                                <div class="card-body">
                                    <div class="container table-responsive">
                                        <table id="tabelAbsensi" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Jumlah Pemain</th>
                                                    <th>Bola Terpakai</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; foreach($data['absensi'] as $absensi) { ?>
                                                <tr>
                                                    <td><?= $no++ ?>.</td>
                                                    <td><?= format_tanggal($absensi['tanggal_absensi']) ?></td>
                                                    <td><?= $absensi['total_anggota'] ?> orang</td>
                                                    <td><?= $absensi['bola_terpakai'] ?> pcs</td>
                                                    <td><a href="<?= BASEURL ?>/admin/absensi/detail/<?= $absensi['tanggal_absensi'] ?>" class="btn btn-info tombolDetailAbsensi" data-tanggal-absensi="<?= $absensi['tanggal_absensi'] ?>" data-bs-toggle="modal" data-bs-target="#">Detail</a></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Absensi -->
                    <div class="modal fade" id="modalAbsensi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="labelModal">Absensi Mingguan</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color:#ffffff;">
                                    <div id="errorAbsensi" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
                                    <form id="formAbsensi" method="post">
                                        <div class="row g-2 mb-3">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="number" min="0" name="bola_terpakai" class="form-control" placeholder="">
                                                    <label for="bola_terpakai">Bola (pcs)</label>
                                                </div>
                                            </div>
                                        
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="date" name="tanggal_absensi" class="form-control">
                                                    <label for="tanggal_absensi">Tanggal</label>
                                                </div>
                                            </div>
                                        </div>
                                        <table id="tabelAbsensiAnggota" class="table table-bordered table-striped">
                                            <thead>
                                                <th>Nama</th>
                                                <th>Sisa Main</th>
                                                <th>Kehadiran</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach($data['anggota'] as $anggota) {
                                                    if ($anggota['sisa_main'] <= 0 && $anggota['domisili'] != 'Luar Kota') {
                                                ?>
                                                <tr>
                                                    <td><?= $anggota['nama'] ?></td>
                                                    <td><?= $anggota['sisa_main'] ?></td>
                                                    <td><input type="checkbox" class="form-check-input" value="<?= $anggota['id_anggota'] ?>" name="id_anggota[]"> Hadir</td>
                                                </tr>
                                                <?php } elseif ($anggota['sisa_main'] != 0 && $anggota['domisili'] != 'Luar Kota') { ?>
                                                <tr>
                                                    <td><?= $anggota['nama'] ?></td>
                                                    <td><?= $anggota['sisa_main'] ?></td>
                                                    <td><input type="checkbox" class="form-check-input" value="<?= $anggota['id_anggota'] ?>" name="id_anggota[]"> Hadir</td>
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>
                                        <div class="input-group mb-3">
                                            <button type="submit" class="form-control btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail Absensi -->
                    <div class="modal fade" id="modalDetailAbsensi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="labelModal">Anggota yang Hadir</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color:#ffffff;">
                                    <ol id="detailAbsensi" class="list-group list-group-numbered list-group-flush">
                                    </ol>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>