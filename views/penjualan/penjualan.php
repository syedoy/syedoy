<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Penjualan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#PenjualanModal">
                                Tambah
                            </button>
                        </a>
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
            <div class="modal fade" id="PenjualanModal" tabindex="-1" arialabelledby="PenjualanModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="PenjualanModalLabel">Tambah Penjualan</h1>
                            <button type="button" class="btn-close" data-bsdismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
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
                                                <td><?= $p->pelangganID ?></td>
                                                <td><?= $p->NomorTelpon ?></td>
                                                <td>
                                                    <a href="<?=
                                                                base_url('Penjualan/ProsesPenjualan/' . $p->pelangganID) ?>">
                                                        <button class="btn-btn-primary">Pilih</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        endforeach ?>
                                    </tbody>
                                </table>
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
                        <th>Tanggal Transaksi</th>
                        <th>Total Transaksi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($penjualan as $p):
                    ?>
                        <tr class="align-middle">
                            <td><?= $i ?></td>
                            <td><?= $p->NamaPelanggan ?></td>
                            <td><?= $p->TanggalPenjualan ?></td>
                            <td>Rp. <?= number_format($p->Totalharga) ?></td>
                            <td>
                                <a href="<?= base_url('Penjualan/Detail/' . $p->PenjualanID) ?>">
                                    <button class="btn btn-primary">Detail</button>
                                </a>
                                <a onclick="confirm('Apakah Anda Ingin MengapusData Produk')" href="<?=
                                                                                                    base_url('Penjualan/HapusPenjualan/' . $p->PenjualanID) ?>">
                                    <button class="btn btn-danger">Hapus</button>
                                </a>
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</main>