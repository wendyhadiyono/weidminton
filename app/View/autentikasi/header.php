<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="<?= BASEURL ?>/img/aset/favicon.png">
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
				<div class="col-lg-4 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<div class="text-center mt-4">
							<img src="<?= BASEURL ?>/img/<?= $data['profil_klub']['logo_klub'] ?>" alt="" width="80" class="mb-3">
						</div>

                        