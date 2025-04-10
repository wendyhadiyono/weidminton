            <main class="content">
                <div class="container-fluid p-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Dasbor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Transaksi Anggota</li>
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
                                    <h4 class="mt-4 dataTransaksiAnggota"><?= format_rupiah($data['total_kas']) ?></h4>
                                </div>
                            </div>
						</div>
					</div>

                    <div class="accordion accordion-dark mb-4" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Nominal Transaksi Anggota
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body bg-white">
                                    <p>Sesuaikan nominal dengan peraturan dari klub badminton Anda.</p>
                                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahNTA">Tambah</button>
                                    <div class="table-responsive">
                                        <table id="tabelNTA" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Jenis</th>
                                                    <th>Jumlah Main</th>
                                                    <th class="text-end">Nominal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($data['nta'])) {
                                                    $no = 1;
                                                    foreach ($data['nta'] as $nta) { ?>			
                                                <tr>
                                                    <td><?= $no++ ?>.</td>
                                                    <td><?= $nta['jenis'] ?></td>
                                                    <td><?= $nta['jumlah_main'] ?> kali</td>
                                                    <td class="text-end"><?= format_rupiah($nta['nominal']) ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Pilih </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="<?= BASEURL ?>/admin/transaksi_anggota/ubah_nominal/<?= $nta['id_nta'] ?>" class="dropdown-item tombolUbahNTA" data-id-nta="<?= $nta['id_nta'] ?>" data-bs-toggle="modal" data-bs-target="#modalUbahNTA">Ubah</a></li>
                                                                <li><a href="<?= BASEURL ?>/admin/transaksi_anggota/hapus_nominal/<?= $nta['id_nta'] ?>" class="dropdown-item tombolHapusNTA" data-id-nta="<?= $nta['id_nta'] ?>">Hapus</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php } } else { ?>
                                                <tr>
                                                    <td colspan="5" class="text-center"><h6>Belum ada nominal transaksi anggota.</h6></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="d-inline align-middle mt-1 mb-0">Semua Transaksi Anggota</h4>
                                    <button type="button" class="btn btn-success text-white ms-2" data-bs-toggle="modal" data-bs-target="#modalTambahTA">Tambah</button>
                                </div>
                                <div class="card-body">
                                    <div class="container table-responsive">
                                        <table id="tabelTA" class="table table-striped table-bordered my-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama</th>
                                                    <th class="text-end">Nominal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($data['ta'] as $ta) { ?>
                                                <tr>
                                                    <td><?= $no++; ?>.</td>
                                                    <td><?= format_tanggal($ta['tanggal_ta']) ?></td>
                                                    <td><?= $ta['nama_ta'] ?></td>     
                                                    <td class="text-end"><?= format_rupiah($ta['nominal_ta']) ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Pilih </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="<?= BASEURL ?>/admin/transaksi_anggota/ubah/<?= $ta['id_ta'] ?>" class="dropdown-item tombolUbahTA" data-id-transaksi-anggota="<?= $ta['id_ta'] ?>" data-bs-toggle="modal" data-bs-target="#modalUbahTA">Ubah</a></li>
                                                                <li><a href="<?= BASEURL ?>/admin/transaksi_anggota/hapus/<?= $ta['id_ta'] ?>" class="dropdown-item tombolHapusTA" data-id-transaksi-anggota="<?= $ta['id_ta'] ?>">Hapus</a></li>
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

                    <!-- Modal Tambah Nominal Transaksi Anggota -->
                    <div class="modal fade" id="modalTambahNTA" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered"">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="exampleModalLabel">Tambah Nominal Transaksi Anggota</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
                                    <div id="errorTambahNTA" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
									<form id="formTambahNTA" method="post">
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
                                                <input type="text" class="form-control" name="nominal" placeholder="">
                                                <label for="nominal">Nominal</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button type="submit" class="form-control btn btn-primary">Simpan</button>
                                        </div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
								</div>
							</div>
						</div>
					</div>

                    <!-- Modal Ubah Nominal Transaksi Anggota -->
                    <div class="modal fade" id="modalUbahNTA" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered"">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="exampleModalLabel">Ubah Nominal Transaksi Anggota</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
                                    <div id="errorUbahNTA" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
									<form id="formUbahNTA" method="post">
                                        <input type="hidden" name="id_nta" id="id_nta">
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
                                                <input type="text" class="form-control" name="nominal" id="nominal" placeholder="">
                                                <label for="nominal">Nominal</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button type="submit" class="form-control btn btn-primary">Simpan</button>
                                        </div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
								</div>
							</div>
						</div>
					</div>

                    <!-- Modal Tambah Transaksi Anggota -->
                    <div class="modal fade" id="modalTambahTA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="exampleModalLabel">Tambah Transaksi Anggota</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="errorTambahTA" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
                                    <form id="formTambahTA" method="post">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="nama_ta">
                                                    <option selected>Pilih</option>
                                                    <?php foreach ($data['anggota'] as $anggota) : ?>
                                                    <option value="<?= $anggota['nama'] ?>"><?= $anggota['nama'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <label for="nama_ta">Nama</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" id="nominal_ta" name="nominal_ta">
                                                    <option selected>Pilih</option>
                                                    <?php foreach ($data['nta'] as $nta) { ?>
                                                    <option value="<?= $nta['nominal'] ?>" data-jumlah="<?= $nta['jumlah_main'] ?>"><?= format_rupiah($nta['nominal']) ?> -- <?= $nta['jenis'] ?> (<?= $nta['jumlah_main'] ?> kali main)</option>
                                                    <?php } ?>
                                                </select>
                                                <label for="nominal_ta">Nominal</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" name="tanggal_ta">
                                                <label for="tanggal_ta">Tanggal</label>
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

                    <!-- Modal Ubah Transaksi Anggota -->
                    <div class="modal fade" id="modalUbahTA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="exampleModalLabel">Ubah Transaksi Anggota</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="errorUbahTA" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
                                    <form id="formUbahTA" method="post">
                                        <input type="hidden" name="id_ta" id="id_ta">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="nama_ta" id="nama_ta" disabled>
                                                    <option selected>Pilih</option>
                                                    <?php foreach ($data['anggota'] as $anggota) : ?>
                                                    <option value="<?= $anggota['nama'] ?>"><?= $anggota['nama'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <label for="nama_ta">Nama</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="nominal_ta" id="nominal_ta" disabled>
                                                    <option selected>Pilih</option>
                                                    <?php foreach ($data['nta'] as $nta) { ?>
                                                    <option value="<?= $nta['nominal'] ?>"><?= format_rupiah($nta['nominal']) ?> -- <?= $nta['jenis'] ?> (<?= $nta['jumlah_main'] ?> kali main)</option>
                                                    <?php } ?>
                                                </select>
                                                <label for="nominal_ta">Nominal</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" name="tanggal_ta" id="tanggal_ta">
                                                <label for="tanggal_ta">Tanggal</label>
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