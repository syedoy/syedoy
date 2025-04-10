<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Kasir</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages
using Vanilla JS." />
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5
dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker,
bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq,
colorlibhq dashboard, colorlibhq admin dashboard" />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/sourcesans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollb
ars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrapicons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
    <!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css
" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="">
    <!-- BEGIN STRUK -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Struk Pembayaran</h3>
                        <hr>
                        <!-- Nama Pelanggan -->
                        <div class="mb-3">
                            <label><strong>Nama Pelanggan:</strong></label>
                            <p><?= $penjualan->NamaPelanggan ?></p>
                        </div>
                        <!-- Tanggal Penjualan -->
                        <div class="mb-3">
                            <label><strong>Tanggal Penjualan:</strong></label>
                            <p><?= $penjualan->TanggalPenjualan ?></p>
                        </div>
                        <hr>
                        <!-- Produk yang dibeli -->
                        <div class="mb-3">
                            <h5><strong>Produk yang Dibeli:</strong></h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detail as $p): ?>
                                        <tr>
                                            <td><?= $p->NamaProduk ?></td>
                                            <td>Rp. <?= number_format($p->Harga)
                                                    ?></td>
                                            <td><?= number_format($p->JumlahProduk) ?></td>
                                            <td>Rp. <?= number_format($p->Subtotal) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <!-- Total Harga -->
                        <div class="mb-3">
                            <label><strong>Total Harga:</strong></label>
                            <p>Rp. <?= number_format($penjualan->Totalharga)
                                    ?></p>
                        </div>
                        <!-- Pembayaran -->
                        <div class="mb-3">
                            <label><strong>Pembayaran:</strong></label>
                            <p>Rp. <?= number_format($penjualan->TotalPembayaran)
                                    ?></p>
                        </div>
                        <!-- Kembalian -->
                        <div class="mb-3">
                            <label><strong>Kembalian:</strong></label>
                            <p>Rp. <?= number_format($penjualan->TotalPembayaran
                                        - $penjualan->Totalharga) ?></p>
                        </div>
                        <hr>
                        <!-- Footer -->
                        <p class="text-center"><strong>Terima Kasih atas
                                Pembelian Anda!</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tombol Print -->
    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary">Cetak
            Struk</button>
    </div>
    <!-- END STRUK -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollb
ars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous">
    </script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Required
Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-
I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)-->
    <!--begin::Required
Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-
0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)-->
    <!--begin::Required Plugin(AdminLTE)-
->
<script src="<?= base_url('assets') ?> /dist/js/adminlte.js"></script>
<!--end::Required Plugin(AdminLTE)-->
    <!--begin::OverlayScrollbars Configure--
>
</body>
<!--end::Body-->

</html>