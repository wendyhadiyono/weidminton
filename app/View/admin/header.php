<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="<?= BASEURL ?>/img/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
	<link rel="stylesheet" href="<?= BASEURL ?>/css/bootstrap.css">
	<link rel="stylesheet" href="<?= BASEURL ?>/css/admin.css">
	<link rel="stylesheet" href="<?= BASEURL ?>/css/alertify.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/app.css">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $data['judul'] ?></title>
</head>
<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="<?= BASEURL ?>/admin"><span class="align-middle"><?= $data['profil_klub']['nama_klub'] ?></span></a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">Utama</li>
					<li class="sidebar-item <?= ($_SERVER['PATH_INFO'] == '/admin') ? 'active' : ''; ?>">
						<a class="sidebar-link" href="<?= BASEURL ?>/admin">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dasbor</span>
						</a>
					</li>
					<li class="sidebar-item <?= ($_SERVER['PATH_INFO'] == '/admin/anggota') ? 'active' : ''; ?>">
						<a class="sidebar-link" href="<?= BASEURL ?>/admin/anggota">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Anggota</span>
						</a>
					</li>
					<li class="sidebar-item <?= ($_SERVER['PATH_INFO'] == '/admin/absensi') ? 'active' : ''; ?>">
						<a class="sidebar-link" href="<?= BASEURL ?>/admin/absensi">
							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Absensi</span>
						</a>
					</li>
					<li class="sidebar-item <?= ($_SERVER['PATH_INFO'] == '/admin/laporan') ? 'active' : ''; ?>">
						<a class="sidebar-link" href="<?= BASEURL ?>/admin/laporan">
							<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Laporan</span>
						</a>
					</li>
					<li class="sidebar-header">Transaksi</li>
					<li class="sidebar-item <?= ($_SERVER['PATH_INFO'] == '/admin/transaksi_anggota') ? 'active' : ''; ?>">
						<a class="sidebar-link" href="<?= BASEURL ?>/admin/transaksi_anggota">
							<i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Transaksi Anggota</span>
						</a>
					</li>
					<li class="sidebar-item <?= ($_SERVER['PATH_INFO'] == '/admin/transaksi_bola') ? 'active' : ''; ?>">
						<a class="sidebar-link" href="<?= BASEURL ?>/admin/transaksi_bola">
							<i class="align-middle" data-feather="target"></i> <span class="align-middle">Transaksi Bola</span>
						</a>
					</li>
					<li class="sidebar-item <?= ($_SERVER['PATH_INFO'] == '/admin/transaksi_lapangan') ? 'active' : ''; ?>">
						<a class="sidebar-link" href="<?= BASEURL ?>/admin/transaksi_lapangan">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">Transaksi Lapangan</span>
						</a>
					</li>
					<li class="sidebar-item <?= ($_SERVER['PATH_INFO'] == '/admin/transaksi_lainnya') ? 'active' : ''; ?>">
						<a class="sidebar-link" href="<?= BASEURL ?>/admin/transaksi_lainnya">
							<i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Transaksi Lainnya</span>
						</a>
					</li>
					<li class="sidebar-header">Lainnya</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="<?= BASEURL ?>" target="_blank">
							<i class="align-middle" data-feather="link"></i> <span class="align-middle">Lihat Beranda</span>
						</a>
					</li>
					<li class="sidebar-item <?= ($_SERVER['PATH_INFO'] == '/admin/profil') ? 'active' : ''; ?>">
						<a class="sidebar-link" href="<?= BASEURL ?>/admin/profil">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil Admin</span>
						</a>
					</li>
					<li class="sidebar-item <?= ($_SERVER['PATH_INFO'] == '/admin/pengaturan') ? 'active' : ''; ?>">
						<a class="sidebar-link" href="<?= BASEURL ?>/admin/pengaturan">
							<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Pengaturan</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle"><i class="hamburger align-self-center"></i></a>
				<ul class="navbar-nav navbar-align">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle d-sm-inline-block" href="#" data-bs-toggle="dropdown"><img src="<?= BASEURL ?>/img/<?= $data['profil_admin']['file_avatar'] ?>" class="avatar img-fluid rounded-circle me-1" alt="avatar" /> <span class="text-dark"><?= $data['profil_admin']['nama'] ?></span></a>
						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="<?= BASEURL ?>/admin/profil">Profil</a>
							<a class="dropdown-item" href="<?= BASEURL ?>/admin/pengaturan">Pengaturan</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= BASEURL ?>" target="_blank">Lihat Beranda</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= BASEURL ?>/autentikasi/keluar">Keluar</a>
						</div>
					</li>
				</ul>
			</nav>

