<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="<?= BASEURL ?>/img/aset/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/app.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'] ?></title>
    <style>
        #laporan {
            margin-top: 80px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar bg-dark fixed-top">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 text-white"><?= $data['profil_klub']['nama_klub'] ?></span>
            <div class="d-flex">
                <a href="<?= BASEURL ?>/admin/laporan" class="btn btn-secondary me-2">Kembali</a>
                <button id="tombolUnduh" class="btn btn-primary">Unduh</button>
            </div>
        </div>
    </nav>
