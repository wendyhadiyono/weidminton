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
												<small class="text-muted">Maksimal ukuran file gambar sampul adalah 2 MB.</small>
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
                                    <h4 class="mb-0">Pembaruan</h4>
                                </div>
                                <div class="card-body">
									<p>WeidMinton yang terpasang saat ini adalah versi <strong><?= VERSI ?></strong>.</p>
									<p>Tekan tombol dibawah untuk mengecek apakah ada pembaruan:</p>
									<button type="submit" class="btn btn-primary">Cek</button>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h4 class="mb-0">Data</h4>
                                </div>
                                <div class="card-body">
									<p><strong>Cadangkan Data</strong></p>
									<p>Cadangkan semua data termasuk data anggota, absensi dan semua jenis transaksi dari database.</p>
									<p>Hasil pencadangan akan dikirim ke email admin.</p>
									<button type="submit" class="btn btn-info">Cadangkan</button>
									<hr>
									<p><strong>Hapus Data</strong></p>
									<p>Hapus semua data termasuk data anggota, absensi dan semua jenis transaksi dari database.</p>
									<p>Tindakan ini tidak bisa dibatalkan dan sepenuhnya menjadi tanggung jawab bendahara.</p>
									<button type="submit" class="btn btn-danger">Hapus</button>
									<!-- <hr>
									<p><strong>Instalasi Ulang</strong></p>
									<p>Lakukan instalasi ulang WeidMinton dari awal.</p>
									<p>Tindakan ini tidak bisa dibatalkan dan sepenuhnya menjadi tanggung jawab bendahara.</p>
									<button type="submit" class="btn btn-warning">Proses</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</main>