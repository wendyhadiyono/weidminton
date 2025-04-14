    <div id="laporan" class="container bg-white p-3">
        <div class="text-center">
            <img src="<?= BASEURL ?>/img/<?= $data['profil_klub']['logo_klub'] ?>" alt="Logo PB Benben" width="80" class="mb-3">
            <h3>Laporan Transaksi</h3>
        </div>

        <div class="border p-3 mt-3">
            <table class="small" style="width:100%">
                <tr>
                    <td style="width:40%">Periode</td>
                    <td>: <?= format_bulan($data['bulan']) ?> <?= $data['tahun'] ?></td>
                </tr>
                <tr>
                    <td>Mata Uang</td>
                    <td>: Rupiah</td>
                </tr>
                <tr>
                    <td>Saldo Awal</td>
                    <td>: <?= format_uang($data['saldo_awal']) ?></td>
                </tr>
            </table>
        </div>

        <table class="table border small table-md mt-3">
            <thead class="table-info">
                <tr>
                    <th class="text-center">Tgl</th>
                    <th>Keterangan</th>
                    <th>Transaksi</th>
                    <th class="text-end">Nominal</th>
                    <th class="text-end">Saldo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">01</td>
                    <td>Saldo Awal</td>
                    <td>-</td>
                    <td class="text-end">-</td>
                    <td class="text-end"><?= format_uang($data['saldo_awal']) ?></td>
                </tr>
                <?php
                $saldo_berjalan = $data['saldo_awal'];
                if (!empty($data['transaksi'])) {
                    foreach($data['transaksi'] as $transaksi) {
                        if ($transaksi['jenis'] == 'Anggota') {
                            $saldo_berjalan += $transaksi['harga'];
                        } else {
                            $saldo_berjalan -= $transaksi['harga'];
                        }
                ?>
                <tr>
                    <td class="text-center"><?= date('d', strtotime($transaksi['tanggal'])) ?></td>
                    <td><?= $transaksi['keterangan'] ?></td>
                    <td><?= $transaksi['jenis'] ?></td>
                    <td class="text-end"><?= format_uang($transaksi['harga']) ?></td>
                    <td class="text-end"><?= format_uang($saldo_berjalan) ?></td>
                </tr>
                <?php } } else { ?>
                    <td colspan="5"><h5 class="text-center mb-0">Belum ada transaksi untuk periode ini.</h5></td>
                <?php } ?>
            </tbody>
        </table>

        <div class="border p-3">
            <table class="small" style="width:100%">
                <tr>
                    <td style="width:40%">Total Pemasukan</td>
                    <td>: <?= format_uang($data['total_pemasukan']) ?></td>
                </tr>
                <tr>
                    <td>Total Pengeluaran</td>
                    <td>: <?= format_uang($data['total_pengeluaran']) ?></td>
                </tr>
                <tr>
                    <td>Saldo Akhir</td>
                    <td>: <?= format_uang($data['saldo_akhir']) ?></td>
                </tr>
            </table>
        </div>
        
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
                    <a id="linkUnduh" class="btn btn-primary" href="#" download="Laporan_Transaksi_<?= format_bulan($data['bulan']) ?>_<?= $data['tahun'] ?>.png">Unduh Gambar</a>
                </div>
            </div>
        </div>
    </div>