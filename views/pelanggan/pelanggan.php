<!--begin::App Main-->
<main class="app-main">
	<!--begin::App Content Header-->
	<div class="app-content-header">
		<!--begin::Container-->
		<div class="container-fluid">
			<!--begin::Row-->
			<div class="row">
				<div class="col-sm-6">
					<h3 class="mb-0">Pelanggan</h3>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-end">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal"
							data-bs-target="#PelangganModal">
							Tambah
						</button>
					</ol>
				</div>
			</div>
			<!--end::Row-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::App Content Header-->
	<!--begin::App Content-->
	<div class="app-content">
		<!--begin::Container-->
		<div class="container-fluid">
			<div class="card-body">
				<?php if ($this->session->flashdata('success')): ?>
					<div class="col-12">
						<div class="callout callout-info">
							<?= $this->session->flashdata('success'); ?>
						</div>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('error')): ?>
					<div class="col-12">
						<div class="callout callout-danger">
							<?= $this->session->flashdata('error'); ?>
						</div>
					</div>
				<?php endif ?>
				<br>
				<!-- Modal -->
				<div class="modal fade" id="PelangganModal" tabindex="-1" arialabelledby="ProdukModalLabel"
					aria-hidden="true">
					<div class="modal-dialog modal-dialog-scrollable modal-xs">
						<div class="modal-content">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="ProdukModalLabel">Tambah Pelanggan</h1>
								<button type="button" class="btn-close" data-bsdismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="card-body">
									<form method="post" action="<?=
																base_url('Pelanggan/ProsesCreate') ?>">
										<!--begin::Body-->
										<div class="card-body">
											<div class="mb-3">
												<label " class=" form-label">Nama
													Pelanggan</label>
												<input type="text" class="formcontrol" name="NamaPelanggan" />
												<?= form_error(
													'NamaPelanggan',
													'<small class="text-danger" >',
													'</small>'
												) ?>
											</div>
											<div class="mb-3">
												<label class="formlabel">Alamat</label>
												<input type="text" class="formcontrol" name="Alamat" />
												<?= form_error(
													'Alamat',
													'<small class="text-danger" >',
													'</small>'
												) ?>
											</div>
											<div class="mb-3">
												<label class="form-label">Nomor
													Telepon</label>
												<input type="text" class="formcontrol" name="NomorTelpon" />
												<?= form_error(
													'NomorTelpon',
													'<small class="text-danger" >',
													'</small>'
												) ?>
											</div>
										</div>
										<!--end::Body-->
										<!--begin::Footer-->
										<div class="card-footer">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
										<!--end::Footer-->
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="width: 10px">#</th>
							<th>Nama Pelanggan</th>
							<th>Alamat</th>
							<th>Nomor Telpon</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						foreach ($pelanggan as $p):
						?>
							<tr class="align-middle">
								<td><?= $i ?></td>
								<td><?= $p->NamaPelanggan ?></td>
								<td><?= $p->Alamat ?></td>
								<td><?= $p->NomorTelpon ?></td>
								<td>
									<button class="btn btn-primary" data-bs-target="#PelangganModal<?= $p->pelangganID ?>"
										data-bs-toggle="modal">Edit</button>
									<a onclick="return confirm('Apakah Anda Ingin Mengapus Data Pelanggan')" href="<?= base_url('Pelanggan/Hapus/' . $p->pelangganID) ?>">
										<button class="btn btn-danger">Hapus</button>
									</a>
								</td>
							</tr>
							<div class="modal fade" id="PelangganModal<?= $p->pelangganID ?>" tabindex="-1" aria-labelledby="ProdukModalLabel" ariahidden="true">
								<div class="modal-dialog modal-dialog-scrollable modal-xs">
									<div class="modal-content">
										<div class="modal-header">
											<h1 class="modal-title fs-5" id="ProdukModalLabel">Tambah Pelanggan</h1>
											<button type="button" class="btnclose" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<div class="card-body">
												<form method="post" action="<?=
																			base_url('Pelanggan/ProsesEdit/'. $p->pelangganID) ?>">
													<!--begin::Body-->
													<div class="card-body">
														<div class="mb-3">
															<label class="formlabel">Nama Pelanggan</label>
															<input type="text" class="form-control" value="<?= $p->NamaPelanggan ?>" name="NamaPelanggan" />
															<?=
															form_error('NamaPelanggan', '<small class="text-danger" >', '</small>') ?>
														</div>
														<div class="mb-3">
															<label class="formlabel">Alamat</label>
															<input type="text" class="form-control" name="Alamat" value="<?= $p->Alamat ?>" />
															<?=
															form_error('Alamat', '<small class="text-danger" >', '</small>') ?>
														</div>
														<div class="mb-3">
															<label class="formlabel">Nomor Telepon</label>
															<input type="text" class="form-control" name="NomorTelpon"
																value="<?= $p->NomorTelpon ?>" />
															<?=
															form_error('NomorTelpon', '<small class="text-danger" >', '</small>') ?>
														</div>
														<input type="hidden" value="<?= $p->pelangganID ?>" name="id">
													</div>
													<!--end::Body-->
													<!--begin::Footer-->
													<div class="card-footer">
														<button type="submit" class="btn btn-primary">Edit</button>
													</div>
													<!--end::Footer-->
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php $i++;
						endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>
</main>