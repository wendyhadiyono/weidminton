            <main class="content">
				<div class="container-fluid p-0">
					<!-- <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Dasbor</li>
                        </ol>
                    </nav> -->

					<div class="row">
						<div class="col-12">
							<div class="card border">
								<div class="card-body">
									<h5 class="mb-0"><i class="align-middle me-1" data-feather="info"></i> <span class="align-middle">Halo, <?= $data['profil_admin']['nama'] ?>!  Selamat datang di halaman dasbor admin</span></h5>
								</div>
							</div>
						</div>
					</div>

					<!-- Data dan Transaksi -->
					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card border">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h4>Kas</h4>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="dollar-sign"></i>
														</div>
													</div>
												</div>
												<div class="mb-2">
													<span class="text-muted">Total kas terkini</span>
												</div>
												<h4 class="mt-4"><?= format_rupiah($data['total_kas']) ?></h4>
											</div>
										</div>
										<div class="card border">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h4>Bola</h4>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="target"></i>
														</div>
													</div>
												</div>
												<div class="mb-2">
													<span class="text-muted">Total bola terkini</span>
												</div>
												<h4 class="mt-4"><?= $data['total_bola'] ?> pcs</h4>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card border">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h4>Anggota</h4>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<div class="mb-2">
													<span class="text-muted">Total anggota terkini</span>
												</div>
												<h4 class="mt-4"><?= $data['total_anggota'] ?> orang</h4>
											</div>
										</div>
										<div class="card border">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h4>Lapangan</h4>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="home"></i>
														</div>
													</div>
												</div>
												<div class="mb-2">
													<span class="text-muted">Total lapangan terkini</span>
												</div>
												<h4 class="mt-4"><?= $data['total_lapangan'] ?> kali main</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
							<div class="card border flex-fill w-100">
								<div class="card-header">
									<h4 class="mb-0">Jumlah Transaksi <?= format_bulan($data['bulan']) ?> <?= $data['tahun'] ?></h45>
								</div>
								<div class="card-body">
									<div class="align-self-center w-100">
										<table class="table mb-0">
											<thead>
												<tr>
													<th>Jenis</th>
													<th class="text-end">Jumlah</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Transaksi Anggota</td>
													<td class="text-end"><?= $data['jumlah_transaksi']['anggota'] ?> kali</td>
												</tr>
												<tr>
													<td>Transaksi Bola</td>
													<td class="text-end"><?= $data['jumlah_transaksi']['bola'] ?> kali</td>
												</tr>
												<tr>
													<td>Transaksi Lapangan</td>
													<td class="text-end"><?= $data['jumlah_transaksi']['lapangan'] ?> kali</td>
												</tr>
												<tr>
													<td>Transaksi Lainnya</td>
													<td class="text-end"><?= $data['jumlah_transaksi']['lainnya'] ?> kali</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- 7 Transaksi Terakhir dan Rasio Pemasukan Pengeluaran -->
					<div class="row">
						<div class="col-12 col-lg-8 col-xxl-9 d-flex">
							<div class="card border flex-fill w-100">
								<div class="card-header">
                                    <h4 class="mb-0">7 Transaksi Terakhir</h4>
                                </div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th>Tgl</th>
													<th>Keterangan</th>
													<th>Transaksi</th>
													<th>Jenis</th>
													<th class="text-end">Nominal</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if (!empty($data['tujuh_transaksi_terakhir'])) {
													foreach ($data['tujuh_transaksi_terakhir'] as $transaksi) { ?>
												<tr>
													<td><?= date('d/m', strtotime($transaksi['tanggal'])) ?></td>
													<td><?= $transaksi['keterangan'] ?></td>
													<td><?= $transaksi['jenis'] ?></td>
													<td>
														<?php if ($transaksi['jenis'] == 'Anggota') { ?>
														<span class="badge bg-success">Pemasukan</span>
														<?php } else { ?>
														<span class="badge bg-danger">Pengeluaran</span>
														<?php } ?>
													</td>
													<td class="text-end"><?= format_rupiah($transaksi['harga']) ?></td>
												</tr>
												<?php } } else { ?>
												<tr>
													<td colspan="5" class="text-center"><h5><?= "Belum ada transaksi." ?></h5></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-lg-4 col-xxl-3 d-flex">
							<div class="card border flex-fill w-100">
								<div class="card-header">
									<h4 class="mb-0">Rasio Pemasukan & Pengeluaran</h4>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="py-3">
											<div class="chart chart-xs">
												<canvas id="chartjs-dashboard-pie"></canvas>
											</div>
										</div>
										<table class="table mb-0">
											<tbody>
												<tr>
													<td>Pemasukan</td>
													<td class="text-end"><?= format_rupiah($data['total_pemasukan']) ?></td>
												</tr>
												<tr>
													<td>Pengeluaran</td>
													<td class="text-end"><?= format_rupiah($data['total_pengeluaran']) ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>