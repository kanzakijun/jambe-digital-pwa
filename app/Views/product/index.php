<?= view('layouts/header'); ?>
<?= view('layouts/topbar') ?>
<?= view('layouts/sidebar') ?>

<div id="layoutSidenav_content">
    <main>
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                <?php if (session()->getFlashdata('success')) : ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '<?= session()->getFlashdata('success') ?>'
                    });
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '<?= session()->getFlashdata('error') ?>'
                    });
                <?php endif; ?>
            });
        </script>
        <div class="container-fluid px-4">
            <?php if (in_groups('admin')) : ?>
                <h1 class="mt-4">Dashboard</h1>
            <?php else : ?>
                <h1 class="mt-4">Profile</h1>
            <?php endif; ?>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body text-center d-flex align-items-center justify-content-center">Product : <?= count($products) ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Warning Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Success Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Danger Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="padding d-flex justify-content-center"></div>
            <a class="btn btn-success m-2" href="/product/addProduct">Add Product</a>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Products
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Product</th>
                                <th>Jenis Product</th>
                                <th>Gambar Product</th>
                                <th>Panjang</th>
                                <th>Lebar</th>
                                <th>Harga</th>
                                <th>Minimal Pesan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nama Product</th>
                                <th>Jenis Product</th>
                                <th>Gambar Product</th>
                                <th>Panjang</th>
                                <th>Lebar</th>
                                <th>Harga</th>
                                <th>Minimal Pesan</th>
                                <th>Detail</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no = 1;
                            foreach ($products as $product) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($product['nama_product']) ?></td>
                                    <td><?= esc($product['jenis_product']) ?></td>
                                    <td><img src="<?= '/products/' . esc($product['gambar']) ?>" alt="" style="max-width: 100px; max-height: 100px;"></td>
                                    <td><?= esc($product['panjang']) ?></td>
                                    <td><?= esc($product['lebar']) ?></td>
                                    <td><?= esc($product['harga']) ?></td>
                                    <td><?= esc($product['min_pesan']) ?></td>
                                    <td class="text-center"><a href="/product/editProduct/<?= $product['id_product'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
</div>
</div>
</div>

<?= view('layouts/footer') ?>