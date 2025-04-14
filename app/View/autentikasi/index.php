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
										<h3>Autentikasi Admin</h3>
										<p>Masuk ke Dasbor <?= $data['profil_klub']['nama_klub'] ?></p>
									</div>
                                    <form action="<?= BASEURL ?>/autentikasi/masuk" method="post">
										<div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" name="id_admin" class="form-control" placeholder="">
                                                <label for="id_admin">ID Admin</label>
                                            </div>
                                        </div>
										<div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="password" name="kata_sandi" class="form-control" placeholder="">
                                                <label for="kata_sandi">Kata Sandi</label>
                                            </div>
                                        </div>
										<div class="d-flex justify-content-between mb-0">
											<p><input type="checkbox" name="ingat_saya" class="form-check-input"> Ingat saya</p>
											<p class="text-center"><a href="<?= BASEURL ?>/autentikasi/pulihkan_sandi">Lupa kata sandi?</a></p>
										</div>
										<div class="mb-3">
											<button type="submit" class="btn btn-primary form-control">Masuk</button>
										</div>
									</form>
								</div>
							</div>
						</div>