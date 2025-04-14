                        <?php if (isset($_SESSION['pesan_gagal'])) { ?>
					    <div class="alert alert-danger fade show" role="alert">
                            <?php
                            echo $_SESSION['pesan_gagal'];
                            unset($_SESSION['pesan_gagal']);
                            ?>
					    </div>
					    <?php } elseif (isset($_SESSION['pesan_berhasil'])) { ?>
						<div class="alert alert-warning fade show" role="alert">
                            <?php
                            echo $_SESSION['pesan_berhasil'];
                            unset($_SESSION['pesan_berhasil']);
                            ?>
					    </div>
					    <?php } ?>

						<div class="card border">
							<div class="card-body">
								<div class="m-sm-3">
									<div class="text-center">
										<h3>Pulihkan Sandi</h3>
										<p>Masukkan email admin terdaftar</p>
									</div>
                                    <form action="<?= BASEURL ?>/autentikasi/kirim_link" method="post">
										<div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" name="email" class="form-control" placeholder="">
                                                <label for="email">Email</label>
                                            </div>
                                        </div>
										<div class="mb-3">
											<button type="submit" class="btn btn-primary form-control">Kirim</button>
										</div>
									</form>
                                    <p class="text-end"><a href="<?= BASEURL ?>/autentikasi">Kembali ke autentikasi</a></p>
								</div>
							</div>
						</div>