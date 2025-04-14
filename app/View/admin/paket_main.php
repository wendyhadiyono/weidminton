            <main class="content">
                <div class="container-fluid p-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Dasbor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Paket Main</li>
                        </ol>
                    </nav>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header">
                                <h5 class="mb-0"><i class="align-middle me-1" data-feather="info"></i> <span class="align-middle">Sesuaikan dengan peraturan dari klub badminton Anda</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="d-inline align-middle mt-1 mb-0">Semua Paket Main</h4>
                                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPaket">Tambah</button>
                                </div>
                                <div class="card-body">
                                    <div class="container table-responsive">
                                        <table id="tabelPaket" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Jenis</th>
                                                    <th>Jumlah Main</th>
                                                    <th class="text-end">Harga</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($data['paket_main'])) {
                                                    $no = 1;
                                                    foreach ($data['paket_main'] as $paket_main) { ?>			
                                                <tr>
                                                    <td><?= $no++ ?>.</td>
                                                    <td><?= $paket_main['jenis'] ?></td>
                                                    <td><?= $paket_main['jumlah_main'] ?> kali</td>
                                                    <td class="text-end"><?= format_rupiah($paket_main['harga']) ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Pilih </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="<?= BASEURL ?>/admin/paket_main/ubah/<?= $paket_main['id_pm'] ?>" class="dropdown-item tombolUbahPaket" data-id-pm="<?= $paket_main['id_pm'] ?>" data-bs-toggle="modal" data-bs-target="#modalUbahPaket">Ubah</a></li>
                                                                <li><a href="<?= BASEURL ?>/admin/paket_main/hapus/<?= $paket_main['id_pm'] ?>" class="dropdown-item tombolHapusPaket" data-id-pm="<?= $paket_main['id_pm'] ?>">Hapus</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php } } else { ?>
                                                <tr>
                                                    <td colspan="5" class="text-center"><h6>Belum ada paket main.</h6></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tambah Paket Main -->
                    <div class="modal fade" id="modalTambahPaket" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered"">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="exampleModalLabel">Tambah Paket Main</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
                                    <div id="errorTambahPaket" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
									<form id="formTambahPaket" method="post">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="jenis">
                                                    <option selected>Pilih</option>
                                                    <option value="Harian">Harian</option>
                                                    <option value="Mingguan">Mingguan</option>
                                                    <option value="Bulanan">Bulanan</option>
                                                </select>
                                                <label for="jenis">Jenis</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="number" min="1" class="form-control" name="jumlah_main" placeholder="">
                                                <label for="jumlah_main">Jumlah Main</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="harga" placeholder="">
                                                <label for="harga">Harga</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button type="submit" class="form-control btn btn-primary">Simpan</button>
                                        </div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
								</div>
							</div>
						</div>
					</div>

                    <!-- Modal Ubah Paket Main -->
                    <div class="modal fade" id="modalUbahPaket" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered"">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="exampleModalLabel">Ubah Paket Main</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
                                    <div id="errorUbahPaket" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
									<form id="formUbahPaket" method="post">
                                        <input type="hidden" name="id_pm" id="id_pm">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="jenis" id="jenis">
                                                    <option selected>Pilih</option>
                                                    <option value="Harian">Harian</option>
                                                    <option value="Mingguan">Mingguan</option>
                                                    <option value="Bulanan">Bulanan</option>
                                                </select>
                                                <label for="jenis">Jenis</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="number" min="1" class="form-control" name="jumlah_main" id="jumlah_main" placeholder="">
                                                <label for="jumlah_main">Jumlah Main</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="harga" id="harga" placeholder="">
                                                <label for="harga">Harga</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button type="submit" class="form-control btn btn-primary">Simpan</button>
                                        </div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
								</div>
							</div>
						</div>
					</div>
                </div>
            </main>