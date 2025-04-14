            <main class="content">
				<div class="container-fluid p-0">
					<nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Dasbor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
                        </ol>
                    </nav>

                    <?php if (isset($_SESSION['pesan_gagal'])) { ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?php
							echo $_SESSION['pesan_gagal'];
							unset($_SESSION['pesan_gagal']);
							?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php } elseif (isset($_SESSION['pesan_berhasil'])) { ?>
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<?php
							echo $_SESSION['pesan_berhasil'];
							unset($_SESSION['pesan_berhasil']);
							?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php } ?>

					<div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h4 class="mb-0">Profil Klub</h4>
                                </div>
                                <div class="card-body">
									<form action="<?= BASEURL ?>/admin/pengaturan/ubah" enctype="multipart/form-data" method="post">
										<div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">Nama Klub</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="nama_klub" value="<?= $data['profil_klub']['nama_klub'] ?>" placeholder="">
											</div>
										</div>
                                        <div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">Kota Asal</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kota_asal" value="<?= $data['profil_klub']['kota_asal'] ?>" placeholder="">
											</div>
										</div>
										<div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">Kas Awal</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kas_awal" value="<?= $data['profil_klub']['kas_awal'] ?>" placeholder="">
											</div>
										</div>
										<div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">Logo Klub</label>
											<div class="col-sm-10">
												<input type="file" class="form-control" name="logo_klub">
												<small class="text-muted">Maksimal ukuran file gambar sampul adalah 1 MB.</small>
											</div>
										</div>
										<div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">Gambar Sampul</label>
											<div class="col-sm-10">
												<input type="file" class="form-control" name="gambar_sampul">
												<small class="text-muted">Maksimal ukuran file gambar sampul adalah 5 MB.</small>
											</div>
										</div>
                                        <div class="input-group mb-3">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h4 class="mb-0">Pencadangan</h4>
                                </div>
                                <div class="card-body">
									<p>Cadangkan semua data termasuk data anggota, absensi, paket main dan semua jenis transaksi.</p>
									<p>Hasil pencadangan akan dikirim ke email admin terdaftar.</p>
									<p>Anda juga bisa menggantinya dengan alamat yang diinginkan:</p>
									<form action="<?= BASEURL ?>/admin/pengaturan/cadangkan" method="post">
										<div class="mb-3 col-lg-4">
											<label class="visually-hidden" for="email">Email</label>
											<div class="input-group">
												<div class="input-group-text"><i class="align-middle" data-feather="mail"></i></div>
												<input type="text" class="form-control" name="email" value="<?= $data['profil_admin']['email'] ?>">
											</div>
										</div>
										<div class="mn-3">
											<button type="submit" class="btn btn-primary">Kirim</button>
										</div>
									</form>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h4 class="mb-0">Penghapusan</h4>
                                </div>
                                <div class="card-body">
									<p>Hapus semua data termasuk data anggota, absensi, paket main dan semua jenis transaksi.</p>
									<p>Pastikan Anda sudah melakukan pencadangan data.</p>
									<p>Tindakan ini tidak bisa dibatalkan dan sepenuhnya menjadi tanggung jawab Anda.</p>
									<button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusData">Proses</button>
                                </div>
                            </div>
                        </div>
                    </div>

					<!-- Modal Hapus Data -->
                    <div class="modal fade" id="modalHapusData" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered"">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan Data</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="alert alert-warning alert-dismissible fade show" role="alert">
										<h5 class="mb-0"><i class="align-triangle me-1" data-feather="info"></i> <span class="align-middle">Pastikan Anda sudah mencadangkan data!</span></h5>
									</div>
									<p class=""></p>
									<form action="<?= BASEURL ?>/admin/pengaturan/hapus" method="post">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" name="kata_sandi" placeholder="">
                                                <label for="kata_sandi">Masukkan kata sandi Anda untuk melanjutkan</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button type="submit" class="form-control btn btn-danger">Hapus</button>
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