<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="<?= BASEURL ?>/img/favicon.png">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap">
	<link rel="stylesheet" href="<?= BASEURL ?>/css/bootstrap.css">
	<link rel="stylesheet" href="<?= BASEURL ?>/css/app.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'] ?></title>
    <style>
        .pesan-error {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-light">
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<div class="text-center mt-4">
							<img src="<?= BASEURL ?>/img/<?= $data['profil_klub']['logo_klub'] ?>" alt="" width="100" class="mb-3">
							<h2>Autentikasi Admin</h2>
							<p class="lead">Masuk ke Dasbor <?= $data['profil_klub']['nama_klub'] ?></p>
						</div>

						<?php if (isset($_SESSION['error_autentikasi'])): ?>
						<div class="alert alert-danger">
							<?php
							echo $_SESSION['error_autentikasi'];
							unset($_SESSION['error_autentikasi']);
							?>
						</div>
						<?php endif; ?>

						<div class="card border">
							<div class="card-body">
								<div class="m-sm-3">
                                    <form action="<?= BASEURL ?>/autentikasi/masuk" method="post">
                                        <div class="mb-3">
											<label class="form-label">ID Admin</label>
											<input class="form-control" type="text" name="id_admin" placeholder="Masukkan ID Admin">
										</div>
                                        <div class="mb-3">
											<label class="form-label">Kata Sandi</label>
											<input class="form-control" type="password" name="kata_sandi" placeholder="Masukkan kata sandi">
                                            <small>
												<a href="<?= BASEURL ?>/autentikasi/reset_kata_sandi">Lupa kata sandi?</a>
											</small>
                                        </div>
										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Masuk</submit>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mt-3">
							<a href="<?= BASEURL ?>">Batal (kembali ke beranda)</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="<?= BASEURL ?>/js/app.js"></script>

</body>
</html>