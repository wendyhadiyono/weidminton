			<main class="content">
				<div class="container-fluid p-0">
					<nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Dasbor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profil Admin</li>
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
                                    <h4 class="mb-0">Profil Admin</h4>
                                </div>
                                <div class="card-body">
									<form action="<?= BASEURL ?>/admin/profil/ubah" method="post">
										<div class="text-center mb-3">
											<img src="<?= BASEURL ?>/img/<?= $data['profil_admin']['file_avatar'] ?>" id="pratinjau_avatar" class="img-fluid rounded-circle img-thumbnail me-1" width="180" alt="avatar">
											<input type="hidden" name="avatar_base64" id="avatar_base64">
										</div>
										<div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">Avatar</label>
											<div class="col-sm-10">
												<input type="file" class="form-control" id="file_avatar" accept="image/*">
											</div>
										</div>
										<div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="nama" value="<?= $data['profil_admin']['nama'] ?>" placeholder="">
											</div>
										</div>
										<div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="email" value="<?= $data['profil_admin']['email'] ?>" placeholder="">
											</div>
										</div>
										<div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">ID Admin</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="id_admin" value="<?= $data['profil_admin']['id_admin'] ?>" placeholder="">
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
                                    <h4 class="mb-0">Ubah Kata Sandi</h4>
                                </div>
                                <div class="card-body">
									<form action="<?= BASEURL ?>/admin/profil/ubah_sandi" method="post">	
                                        <div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">Kata Sandi Lama</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="sandi_lama" placeholder="">
											</div>
										</div>
										<div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">Kata Sandi Baru</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="sandi_baru" placeholder="">
											</div>
										</div>
										<div class="row mb-3">
											<label for="colFormLabel" class="col-sm-2 col-form-label">Konfirmasi Sandi Baru</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="konfirm_sandi_baru" placeholder="">
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

					<div class="modal fade" id="modalCrop" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="exampleModalLabel">Crop Avatar</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div id="croppie-container"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
									<button type="button" class="btn btn-success" id="tombolCrop">Crop</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>