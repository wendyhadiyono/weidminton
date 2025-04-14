<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="img/aset/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:ital,wght@0,300..900;1,300..900&family=Outfit:wght@100..900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/bootstrap.css">
    <link rel="stylesheet" href="css/beranda.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'] ?></title>
    <style>
        .masthead {
            background-image: url('<?= BASEURL ?>/img/<?= $data['profil_klub']['gambar_sampul'] ?>');
        }
    </style>
</head>
<body class="bg-light">
    <header id="beranda" class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="text-center">
                <img src="<?= BASEURL ?>/img/<?= $data['profil_klub']['logo_klub'] ?>" alt="Logo PB Benben" width="150" class="mb-3">
                <h1 class="text-white">Selamat Datang!</h1>
                <p class="text-white mt-2 mb-5">Cek transparansi keuangan <?= $data['profil_klub']['nama_klub'] ?> secara lengkap dalam satu halaman disini.</p>
                <a class="btn btn-primary" href="#data">Mulai Jelajah</a>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand navbar-dark bg-dark bottom-navbar">
        <ul class="navbar-nav w-100 justify-content-center">
            <li class="nav-item" style="width:20%">
                <a class="nav-link" href="#beranda"><i class="material-icons">home</i>Beranda</a>
            </li>
            <li class="nav-item" style="width:20%">
                <a class="nav-link" href="#data"><i class="material-icons">query_stats</i>Data</a>
            </li>
            <li class="nav-item" style="width:20%">
                <a class="nav-link" href="#anggota"><i class="material-icons">group</i>Anggota</a>
            </li>
            <li class="nav-item" style="width:20%">
                <a class="nav-link" href="#transaksi"><i class="material-icons">attach_money</i>Transaksi</a>
            </li>
            <?php if (!empty($_SESSION['id_admin'])) { ?>
            <li class="nav-item" style="width:20%">
                <a class="nav-link" href="admin"><i class="material-icons">dashboard</i>Dasbor</a>
            </li>
            <?php } else { ?>
            <li class="nav-item" style="width:20%">
                <a class="nav-link" href="autentikasi"><i class="material-icons">login</i>Autentikasi</a>
            </li>
            <?php } ?>
        </ul>
    </nav>
    
    <div id="data" class="container mt-4 p-3">
        <h2 class="text-center mb-3">Data</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card text-white bg-success">
                    <div class="data card-body">
                        <div>
                            <i class="material-icons">attach_money</i>
                            <h5 class="mt-2 card-title">Kas</h5>
                        </div>
                        <h5 class="card-text"><?= format_rupiah($data['total_kas']) ?></h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white" style="background-color:#6610f2;">
                    <div class="data card-body">
                        <div>
                            <i class="material-icons">group</i>
                            <h5 class="mt-2 card-title">Anggota</h5>
                        </div>
                        <h5 class="card-text"><?= $data['total_anggota'] ?> orang</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white" style="background-color:#0dcaf0;">
                    <div class="data card-body">
                        <div>
                            <i class="material-icons">sports_tennis</i>
                            <h5 class="mt-2 card-title">Bola</h5>
                        </div>
                        <h5 class="card-text"><?= $data['total_bola'] ?> pcs</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white" style="background-color:#6c757d;">
                    <div class="data card-body">
                        <div>
                            <i class="material-icons">home_work</i>
                            <h5 class="mt-2 card-title">Lapangan</h5>
                        </div>
                        <h5 class="card-text"><?= $data['total_lapangan'] ?> kali main</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div id="anggota" class="container mt-4 p-3">
        <h2 class="text-center mb-3">Anggota</h2>
        <ul class="list-group">
            <?php
            if (!empty($data['anggota'])) {
                foreach($data['anggota'] as $anggota) {
                    if ($anggota['sisa_main'] > 0 && $anggota['jenis_kelamin'] == 'Laki-laki') {
            ?>
            <li class="list-group-item d-flex align-items-center">
                <img src="<?= BASEURL ?>/img/aset/avatar_l.png" class="rounded-circle img-thumbnail me-3" width="70" alt="avatar">
                <div>
                    <p class="mb-0"><?= $anggota['nama'] ?></p>
                    <small><i><?= $anggota['domisili'] ?></i></small>
                </div>
            </li>
            <?php } elseif ($anggota['sisa_main'] <= 0 && $anggota['jenis_kelamin'] == 'Laki-laki') { ?>
            <li class="list-group-item d-flex align-items-center">
                <img src="<?= BASEURL ?>/img/aset/avatar_l.png" class="rounded-circle img-thumbnail me-3" width="70" alt="avatar">
                <div>
                    <p class="mb-0"><?= $anggota['nama'] ?></p>
                    <small><i><?= $anggota['domisili'] ?></i></small>
                </div>
            </li>
            <?php } elseif ($anggota['sisa_main'] > 0 && $anggota['jenis_kelamin'] == 'Perempuan') { ?>
            <li class="list-group-item d-flex align-items-center">
                <img src="<?= BASEURL ?>/img/aset/avatar_p.png" class="rounded-circle img-thumbnail me-3" width="70" alt="avatar">
                <div>
                    <p class="mb-0"><?= $anggota['nama'] ?></p>
                    <small><i><?= $anggota['domisili'] ?></i></small>
                </div>
            </li>
            <?php } elseif($anggota['sisa_main'] <= 0 && $anggota['jenis_kelamin'] == 'Perempuan') { ?>
            <li class="list-group-item d-flex align-items-center">
                <img src="<?= BASEURL ?>/img/aset/avatar_p.png" class="rounded-circle img-thumbnail me-3" width="70" alt="avatar">
                <div>
                    <p class="mb-0"><?= $anggota['nama'] ?></p>
                    <small><i><?= $anggota['domisili'] ?></i></small>
                </div>
            </li>
            <?php } } } else { ?>
            <li class="list-group-item">
                <p class="text-center">Belum ada anggota.</p>
            </li>
            <?php } ?>
        </ul>
    </div>

    <hr>

    <div id="transaksi" class="container mt-4 mb-3 p-3">
        <h2 class="text-center mb-3">Transaksi</h2>
        <ul class="nav special nav-pills justify-content-center p-1 mb-3" id="pills-tab" role="tablist">
            <li class="nav-item special" role="presentation">
                <button class="nav-link special active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-ta" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Anggota</button>
            </li>
            <li class="nav-item special" role="presentation">
                <button class="nav-link special" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-tb" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Bola</button>
            </li>
            <li class="nav-item special" role="presentation">
                <button class="nav-link special" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-tl" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false">Lapangan</button>
            </li>
            <li class="nav-item special" role="presentation">
                <button class="nav-link special" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-tll" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Lainnya</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <!-- Transaksi Anggota -->
            <div class="tab-pane fade show active" id="pills-ta" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <table class="table small shadow p-3 table-bordered table-striped mb-3">   
                    <tr class="table-dark">
                        <th class="text-center" style="width:10%">#</th>
                        <th style="width:30%">Tanggal</th>
                        <th style="width:30%">Nama</th>
                        <th  class="text-end" style="width:30%">Harga</th>
                    </tr>
                    <?php
                    $no = 1;
                    if(!empty($data['ta'])) {
                        foreach($data['ta'] as $ta) {
                            $tanggal = format_tanggal($ta['tanggal_ta']);
                            $rupiah = format_rupiah($ta['harga_ta']);
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?>.</td>
                        <td><?= $tanggal ?></td>
                        <td><?= $ta['nama_ta'] ?></td>
                        <td class="text-end"><?= $rupiah ?></td>
                    </tr>
                    <?php } } else { ?>
                    <tr>
                        <td colspan="4" class="text-center"><p>Belum ada transaksi anggota.</p></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <!-- Transaksi Bola -->
            <div class="tab-pane fade" id="pills-tb" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                <table class="table small shadow p-3 table-bordered table-striped mb-3">
                <tr class="table-dark">
                    <th class="text-center" style="width:10%">#</th>
                    <th style="width:30%">Tanggal</th>
                    <th style="width:30%">Keterangan</th>
                    <th class="text-end" style="width:30%">Harga</th>
                </tr>
                <?php
                $no = 1;
                if(!empty($data['tb'])) {
                    foreach($data['tb'] as $tb) {
                        $tanggal = format_tanggal($tb['tanggal_tb']);
                        $rupiah = format_rupiah($tb['harga_tb']);
                ?>
                <tr>
                    <td class="text-center"><?= $no++ ?>.</td>
                    <td><?= $tanggal ?></td>
                    <td><?= $tb['keterangan_tb'] ?></td>
                    <td class="text-end"><?= $rupiah ?></td>
                </tr>
                <?php } } else { ?>
                    <tr>
                        <td colspan="4" class="text-center"><p>Belum ada transaksi bola.</p></td>
                    </tr>
                <?php } ?>
                </table>
            </div>
            <!-- Transaksi Lapangan -->
            <div class="tab-pane fade" id="pills-tl" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">
                <table class="table small shadow p-3 table-bordered table-striped mb-3">
                    <tr class="table-dark">
                        <th class="text-center" style="width:10%">#</th>
                        <th style="width:30%">Tanggal</th>
                        <th style="width:30%">Keterangan</th>
                        <th class="text-end" style="width:30%">Harga</th>
                    </tr>
                    <?php
                    $no = 1;
                    if(!empty($data['tl'])) {
                        foreach($data['tl'] as $tl) {
                            $tanggal = format_tanggal($tl['tanggal_tl']);
                            $rupiah = format_rupiah($tl['harga_tl']);
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?>.</td>
                        <td><?= $tanggal ?></td>
                        <td><?= $tl['keterangan_tl'] ?></td>
                        <td class="text-end"><?= $rupiah ?></td>
                    </tr>
                    <?php } } else { ?>
                    <tr>
                        <td colspan="4" class="text-center"><p>Belum ada transaksi lapangan.</p></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <!-- Transaksi Lainnya -->
            <div class="tab-pane fade" id="pills-tll" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                <table class="table small shadow p-3 table-bordered table-striped mb-3">
                    <tr class="table-dark">
                        <th class="text-center" style="width:10%">#</th>
                        <th style="width:30%">Tanggal</th>
                        <th style="width:30%">Keterangan</th>
                        <th class="text-end" style="width:30%">Harga</th>
                    </tr>
                    <?php
                    $no = 1;
                    if(!empty($data['tll'])) {
                        foreach($data['tll'] as $tll) {
                            $tanggal = format_tanggal($tll['tanggal_tll']);
                            $rupiah = format_rupiah($tll['harga_tll']);
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?>.</td>
                        <td><?= $tanggal ?></td>
                        <td><?= $tll['keterangan_tll'] ?></td>
                        <td class="text-end"><?= $rupiah ?></td>
                    </tr>
                    <?php } } else { ?>
                    <tr>
                        <td colspan="4" class="text-center"><p>Belum ada transaksi lainnya.</p></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <script src="<?= BASEURL; ?>/js/bootstrap.js"></script>
</body>
</html>