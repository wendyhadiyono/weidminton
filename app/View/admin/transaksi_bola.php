            <main class="content">
                <div class="container-fluid p-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Dasbor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Transaksi Bola</li>
                        </ol>
                    </nav>

                    <div class="row">
						<div class="col-12">
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
                                    <h4 class="mt-4 dataTransaksiBola"><?= $data['total_bola'] ?> pcs</h4>
                                </div>
                            </div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="d-inline align-middle mt-1 mb-0">Semua Transaksi Bola</h4>
                                    <button type="button" class="btn btn-success text-white ms-2" data-bs-toggle="modal" data-bs-target="#modalTambahTB">Tambah</button>
                                </div>
                                <div class="card-body">
                                    <div class="container table-responsive">
                                        <table id="tabelTB" class="table table-striped table-bordered my-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Keterangan</th>
                                                    <th>Jumlah</th>
                                                    <th class="text-end">Nominal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($data['tb'] as $tb) { ?>
                                                <tr>
                                                    <td><?= $no++; ?>.</td>
                                                    <td><?= format_tanggal($tb['tanggal_tb']) ?></td>
                                                    <td><?= $tb['keterangan_tb'] ?></td>
                                                    <td><?= $tb['jumlah_tb'] ?> pcs</td>   
                                                    <td class="text-end"><?= format_rupiah($tb['harga_tb']) ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Pilih </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="<?= BASEURL ?>/admin/transaksi_bola/ubah/<?= $tb['id_tb'] ?>" class="dropdown-item tombolUbahTB" data-id-transaksi-bola="<?= $tb['id_tb'] ?>"data-bs-toggle="modal" data-bs-target="#modalUbahTB">Ubah</a></li>
                                                                <li><a href="<?= BASEURL ?>/admin/transaksi_bola/hapus/<?= $tb['id_tb'] ?>" class="dropdown-item tombolHapusTB" data-id-transaksi-bola="<?= $tb['id_tb'] ?>">Hapus</a></li>
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

                    <!-- Modal Tambah Transaksi Bola -->
                    <div class="modal fade" id="modalTambahTB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="exampleModalLabel">Tambah Transaksi Bola</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="errorTambahTB" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
                                    <form id="formTambahTB" method="post">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="keterangan_tb" placeholder="">
                                                <label for="keterangan_tb">Keterangan</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" min="0" name="jumlah_tb" placeholder="">
                                                <label for="jumlah_tb">Jumlah (pcs)</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="harga_tb" placeholder="">
                                                <label for="harga_tb">Harga</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" name="tanggal_tb">
                                                <label for="tanggal_tb">Tanggal</label>
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

                    <!-- Modal Ubah Transaksi Bola -->
                    <div class="modal fade" id="modalUbahTB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="exampleModalLabel">Ubah Transaksi Bola</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="errorUbahTB" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
                                    <form id="formUbahTB" method="post">
                                        <input type="hidden" name="id_tb" id="id_tb">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="keterangan_tb" id="keterangan_tb" placeholder="">
                                                <label for="keterangan_tb">Keterangan</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" min="0" name="jumlah_tb" id="jumlah_tb" placeholder="">
                                                <label for="jumlah_tb">Jumlah (pcs)</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="harga_tb" id="harga_tb" placeholder="">
                                                <label for="harga_tb">Harga</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" name="tanggal_tb" id="tanggal_tb">
                                                <label for="tanggal_tb">Tanggal</label>
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