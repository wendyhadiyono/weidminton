            <main class="content">
                <div class="container-fluid p-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Dasbor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Transaksi Lainnya</li>
                        </ol>
                    </nav>

                    <div class="row">
						<div class="col-12">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h4>Kas</h4>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-muted">Total kas terkini</span>
                                    </div>
                                    <h4 class="mt-4 dataTransaksiLainnya"><?= format_rupiah($data['total_kas']) ?></h4>
                                </div>
                            </div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="d-inline align-middle mt-1 mb-0">Semua Transaksi Lainnya</h4>
                                    <button type="button" class="btn btn-success text-white ms-2" data-bs-toggle="modal" data-bs-target="#modalTambahTLL">Tambah</button>
                                </div>
                                <div class="card-body">
                                    <div class="container table-responsive">
                                        <table id="tabelTLL" class="table table-striped table-bordered my-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Keterangan</th>
                                                    <th class="text-end">Nominal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($data['tll'] as $tll) { ?>
                                                <tr>
                                                    <td><?= $no++; ?>.</td>
                                                    <td><?= format_tanggal($tll['tanggal_tll']) ?></td>
                                                    <td><?= $tll['keterangan_tll'] ?></td>
                                                    <td class="text-end"><?= format_rupiah($tll['nominal_tll']) ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Pilih </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="<?= BASEURL ?>/admin/transaksi_lainnya/ubah/<?= $tll['id_tll'] ?>" class="dropdown-item tombolUbahTLL" data-id-transaksi-lainnya="<?= $tll['id_tll'] ?>"data-bs-toggle="modal" data-bs-target="#modalUbahTLL">Ubah</a></li>
                                                                <li><a href="<?= BASEURL ?>/admin/transaksi_lainnya/hapus/<?= $tll['id_tll'] ?>" class="dropdown-item tombolHapusTLL" data-id-transaksi-lainnya="<?= $tll['id_tll'] ?>">Hapus</a></li>
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

                    <!-- Modal Tambah Transaksi Lainnya -->
                    <div class="modal fade" id="modalTambahTLL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="exampleModalLabel">Tambah Transaksi Lainnya</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="errorTambahTLL" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
                                    <form id="formTambahTLL" method="post">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="keterangan_tll" placeholder="">
                                                <label for="keterangan_tll">Keterangan</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="nominal_tll" placeholder="">
                                                <label for="nominal_tll">Nominal</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" name="tanggal_tll">
                                                <label for="tanggal_tll">Tanggal</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button type="submit" class="form-control btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Ubah Transaksi Lainnya -->
                    <div class="modal fade" id="modalUbahTLL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="exampleModalLabel">Ubah Transaksi Lainnya</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="errorUbahTLL" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
                                    <form id="formUbahTLL" method="post">
                                        <input type="hidden" name="id_tll" id="id_tll">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="keterangan_tll" id="keterangan_tll" placeholder="">
                                                <label for="keterangan_tll">Keterangan</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="nominal_tll" id="nominal_tll" placeholder="">
                                                <label for="nominal_tll">Nominal</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" name="tanggal_tll" id="tanggal_tll">
                                                <label for="tanggal_tll">Tanggal</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button type="submit" class="form-control btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>