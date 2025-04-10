<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Produk</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <!-- <a href="<?= base_url('Produk/Create') ?>"
class="btn btn-default">
<button type="button" class="btn btn-primary">
Tambah
</button>
</a> -->

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#ProdukModal">
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
        <div class="container-fluid"></div>
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
            <div class="modal fade" id="ProdukModal" tabindex="-1" arialabelledby="ProdukModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-xs">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ProdukModalLabel">Tambah Produk</h1>
                            <button type="button" class="btn-close" data-bsdismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <form method="post" action="<?=
                                                            base_url('Produk/ProsesCreate') ?>">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                                            <input type="text" class="formcontrol" name="NamaProduk" />
                                            <?= form_error('NamaProduk', '<small
class="text-danger">', '</small>') ?>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Harga
                                                Produk</label>
                                            <input type="number" class="formcontrol" name="Harga" />
                                            <?= form_error('Harga', '<small
class="text-danger">', '</small>') ?>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jumlah
                                                Stok</label>
                                            <input type="number" class="formcontrol" name="Stok" />
                                            <?= form_error('Stok', '<small
class="text-danger">', '</small>') ?>
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
            <!-- END MODAL -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($produk as $p):
                    ?>
                        <tr class="align-middle">
                            <td><?= $i ?></td>
                            <td><?= $p->NamaProduk ?></td>
                            <td>Rp. <?= number_format($p->Harga) ?></td>
                            <td><?= number_format($p->Stok) ?></td>
                            <td>
                                <!-- <a href="<?= base_url('Produk/Edit/' . $p->ProdukID) ?>"> -->
                                <button class="btn btn-primary" data-bs-target="#ProdukModal<?= $p->ProdukID ?>"
                                    data-bs-toggle="modal">Edit</button>
                                <!-- </a> -->
                                <a onclick="return confirm('Apakah Anda Ingin Mengapus Data Produk')" href="<?= base_url('Produk/Hapus/' . $p->ProdukID) ?>">
                                    <button class="btn btn-danger">Hapus</button>
                                </a>
                            </td>
                        </tr>
                        <!-- MODAL -->
                        <div class="modal fade" id="ProdukModal<?= $p->ProdukID ?>" tabindex="-1" aria-labelledby="ProdukModalLabel" ariahidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-xs">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="ProdukModalLabel">Edit Produk</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <form method="post" action="<?=
                                                                        base_url('Produk/ProsesEdit/' . $p->ProdukID) ?>">
                                                <!--begin::Body-->
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="formlabel">Nama Produk</label>
                                                        <input type="text" class="form-control" value="<?= $p->NamaProduk ?>" name="NamaProduk" />
                                                        <?=
                                                        form_error('NamaProduk', '<small class="text-danger">', '</small>') ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="formlabel">Harga Produk</label>
                                                        <input type="number" class="form-control" name="Harga" value="<?= $p->Harga ?>" />
                                                        <?= form_error(
                                                            'Harga',
                                                            '<small class="text-danger">',
                                                            '</small>'
                                                        ) ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="formlabel">Jumlah Stok</label>
                                                        <input type="number" class="form-control" name="Stok" value="<?= $p->Stok
                                                                                                                        ?>" />
                                                        <?= form_error(
                                                            'Stok',
                                                            '<small class="text-danger">',
                                                            '</small>'
                                                        ) ?>
                                                    </div>
                                                    <input type="hidden" value="<?= $p->ProdukID ?>" name="id">
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
                        <!-- END MODAL -->
                    <?php $i++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</main>