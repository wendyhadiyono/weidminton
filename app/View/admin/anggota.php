            <main class="content">
                <div class="container-fluid p-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Dasbor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Anggota</li>
                        </ol>
                    </nav>
                    
                    <div class="row">
						<div class="col-12">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h4>Anggota</h4>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-muted">Total anggota terkini</span>
                                    </div>
                                    <h4 class="mt-4 dataAnggota"><?= $data['total_anggota'] ?> orang</h4>
                                </div>
                            </div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="d-inline align-middle mt-1 mb-0">Semua Anggota</h4>
                                    <button type="button" class="btn btn-success text-white ms-2" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">Tambah</button>
                                </div>
                                <div class="card-body">
                                    <div class="container table-responsive">
                                        <table id="tabelAnggota" class="table table-striped table-bordered my-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Domisili</th>
                                                    <th class="text-end">Sisa Main</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($data['anggota'] as $anggota) { ?>
                                                <tr>
                                                    <td><?= $no++; ?>.</td>
                                                    <td><?= $anggota['nama'] ?></td>
                                                    <td><?= $anggota['domisili'] ?></td>
                                                    <td class="text-end"><?= $anggota['sisa_main'] ?> kali</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Pilih </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="<?= BASEURL ?>/admin/anggota/ubah/<?= $anggota['id_anggota'] ?>" class="dropdown-item tombolUbahAnggota" data-id-anggota="<?= $anggota['id_anggota'] ?>" data-bs-toggle="modal" data-bs-target="#modalUbahAnggota">Ubah</a></li>
                                                                <li><a href="<?= BASEURL ?>/admin/anggota/hapus/<?= $anggota['id_anggota'] ?>" class="dropdown-item tombolHapusAnggota" data-id-anggota="<?= $anggota['id_anggota'] ?>">Hapus</a></li>
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

                    <!-- Modal Tambah Anggota -->
                    <div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="labelModal">Tambah Anggota</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="errorTambahAnggota" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none"></div>
                                    <form id="formTambahAnggota" method="post">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" name="nama" class="form-control" placeholder="Nama">
                                                <label for="nama">Nama</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="jenis_kelamin">
                                                    <option selected>Pilih</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="domisili">
                                                    <option selected>Pilih</option>
                                                    <option value="<?= $data['profil_klub']['kota_asal'] ?>"><?= $data['profil_klub']['kota_asal'] ?></option>
                                                    <option value="Luar Kota">Luar Kota</option>
                                                </select>
                                                <label for="domisili">Domisili</label>
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

                    <!-- Modal Ubah Anggota -->
                    <div class="modal fade" id="modalUbahAnggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title" id="labelModal">Ubah Anggota</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="errorUbahAnggota" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none"></div>
                                    <form id="formUbahAnggota" method="post">
                                        <input type="hidden" name="id_anggota" id="id_anggota">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama">
                                                <label for="nama">Nama</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                                    <option selected>Pilih</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="domisili" id="domisili">
                                                    <option selected>Pilih</option>
                                                    <option value="<?= $data['profil_klub']['kota_asal'] ?>"><?= $data['profil_klub']['kota_asal'] ?></option>
                                                    <option value="Luar Kota">Luar Kota</option>
                                                </select>
                                                <label for="domisili">Domisili</label>
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