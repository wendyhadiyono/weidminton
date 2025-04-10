            
			
			<div class="modal fade" id="tentang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header bg-light">
							<h5 class="modal-title" id="labelModal">Tentang</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body text-center">
							<h4 style="font-weight:500;">WeidMinton</h4>
							<p class="text-muted">versi <?= VERSI ?></p>
							<p class="mt-3">Membantu mengelola klub badminton kalian seperti mengelola kas, data anggota, data transaksi hingga melakukan absensi dan lain sebagainya secara digital.</p>
						</div>
					</div>
				</div>
			</div>
					
			<footer class="footer border-top">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<p class="text-muted">&copy; 2024 - <?= date("Y") ?></p>
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<p class="text-muted"><a data-bs-toggle="modal" data-bs-target="#tentang" target="_blank">Tentang</a></p>
								</li>
								<li class="list-inline-item">
									<p class="text-muted"><a href="https://github.com/wendyhadiyono" target="_blank">GitHub</a></p>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
	<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
	<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
	<script src="<?= BASEURL ?>/js/app.js"></script>
    <script src="<?= BASEURL ?>/js/script.js"></script>
	<script>
		// Array yang berisi ID tabel
		var tabelIds = ['#tabelAnggota','#tabelAbsensi','#tabelTA', '#tabelTB', '#tabelTL', '#tabelTLL'];
		
		var options = {
			language: {
				url: 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/id.json',
				"paginate": {
					"first": "&laquo;",
					"last": "&raquo;",
					"next": "&rsaquo;",
					"previous": "&lsaquo;"
				},
			},
			"info": false,
		};

		tabelIds.forEach(function(tabelId) {
			new DataTable(tabelId, options);
		});
	</script>
</body>
</html>