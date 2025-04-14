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

						<div class="card border">
							<div class="card-body">
								<div class="m-sm-3">
									<div class="text-center">
										<h3>Sandi Baru</h3>
										<p>Buat kata sandi baru Anda:</p>
									</div>
                                    <form action="<?= BASEURL ?>/autentikasi/ubah_sandi" method="post">
                                        <input type="hidden" name="token_tautan" value="<?= $data['token_tautan'] ?>">
										<div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="password" name="kata_sandi" class="form-control" placeholder="">
                                                <label for="kata_sandi">Kata Sandi</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="password" name="konfirmasi_sandi" class="form-control" placeholder="">
                                                <label for="konfirmasi_sandi">Konfirmasi Kata Sandi</label>
                                            </div>
                                        </div>
										<div class="mb-3">
											<button type="submit" class="btn btn-primary form-control">Pulihkan</button>
										</div>
									</form>
								</div>
							</div>
						</div>