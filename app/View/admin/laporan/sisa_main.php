    <div id="laporan" class="container bg-white p-3">
        <div class="text-center">
            <img src="<?= BASEURL ?>/img/<?= $data['profil_klub']['logo_klub'] ?>" alt="Logo" width="80" class="mb-3">
            <h3>Laporan Sisa Main</h3>
        </div>

        <table class="table table-white table-bordered table-striped mt-3">
            <thead class="">
                <tr>
                    <th class="text-center">#</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th class="text-end">Sisa Main</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($data['anggota'] as $anggota) { ?>
                    <?php if ($anggota['domisili'] != 'Luar Kota') { ?>
                <tr>
                    <td class="text-center"><?= $no++ ?>.</td>
                    <td><?= $anggota['nama'] ?></td>
                    <td>
                        <?php if ($anggota['sisa_main'] > 0) { ?><span class="badge bg-success">aktif</span>
                        <?php } elseif ($anggota['sisa_main'] == 0) { ?><span class="badge bg-warning">habis</span>
                        <?php } elseif ($anggota['sisa_main'] < 0 ) { ?><span class="badge text-bg-danger">inaktif</span><?php } ?>
                    </td>
                    <td class="text-end"><?= $anggota['sisa_main'] ?> kali</td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
        <p class="text-end"><small>Laporan ini dibuat secara otomatis.</small></p>
    </div>

    <div class="modal fade" id="modalPratinjau" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagePreviewModalLabel">Pratinjau Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="gambarPratinjau" src="#" alt="Pratinjau Gambar" style="max-width: 100%;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a id="linkUnduh" class="btn btn-primary" href="#" download="laporan_sisa_main.png">Unduh Gambar</a>
                </div>
            </div>
        </div>
    </div>