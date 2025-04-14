            <main class="content">
                <div class="container-fluid p-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Dasbor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Transaksi Lapangan</li>
                        </ol>
                    </nav>

                    <div class="row">
						<div class="col-12">
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
                                    <h4 class="mt-4 dataTransaksiLapangan"><?= $data['total_lapangan'] ?> kali main</h4>
                                </div>
                            </div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="d-inline align-middle mt-1 mb-0">Semua Transaksi Lapangan</h4>
                                    <button type="button" class="btn btn-success text-white ms-2" data-bs-toggle="modal" data-bs-target="#modalTambahTL">Tambah</button>
                                </div>
                                <div class="card-body">
                                    <div class="container table-responsive">
                                        <table id="tabelTL" class="table table-striped table-bordered my-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th class="text-end">Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($data['tl'] as $tl) { ?>
                                            <tr>
                                                <td><?= $no++; ?>.</td>
                                                <td><?= format_tanggal($tl['tanggal_tl']) ?></td>
                                                <td><?= $tl['keterangan_tl'] ?></td>
                                                <td class="text-end"><?= format_rupiah($tl['harga_tl']) ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Pilih </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="<?= BASEURL ?>/admin/transaksi_lapangan/ubah/<?= $tl['id_tl'] ?>" class="dropdown-item tombolUbahTL" data-id-transaksi-lapangan="<?= $tl['id_tl'] ?>"data-bs-toggle="modal" data-bs-target="#modalUbahTL">Ubah</a></li>
                                                            <li><a href="<?= BASEURL ?>/admin/transaksi_lapangan/hapus/<?= $tl['id_tl'] ?>" class="dropdown-item tombolHapusTL" data-id-transaksi-lapangan="<?= $tl['id_tl'] ?>">Hapus</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tambah Transaksi Lapangan -->
                    <div class="modal fade" id="modalTambahTL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="exampleModalLabel">Tambah Transaksi Lapangan</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="errorTambahTL" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
                                    <form id="formTambahTL" method="post">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="keterangan_tl" placeholder="">
                                                <label for="keterangan_tl">Keterangan</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="harga_tl" placeholder="">
                                                <label for="harga_tl">Harga</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" name="tanggal_tl">
                                                <label for="tanggal_tl">Tanggal</label>
                                            </div>
                                        </div>
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

                    <!-- Modal Ubah Transaksi Lapangan -->
                    <div class="modal fade" id="modalUbahTL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="exampleModalLabel">Ubah Transaksi Lapangan</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="errorUbahTL" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
                                    <form id="formUbahTL" method="post">
                                        <input type="hidden" name="id_tl" id="id_tl">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="keterangan_tl" id="keterangan_tl" placeholder="">
                                                <label for="keterangan_tl">Keterangan</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="harga_tl" id="harga_tl" placeholder="">
                                                <label for="harga_tl">Harga</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" name="tanggal_tl" id="tanggal_tl">
                                                <label for="tanggal_tl">Tanggal</label>
                                            </div>
                                        </div>
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
                </div>
            </main>