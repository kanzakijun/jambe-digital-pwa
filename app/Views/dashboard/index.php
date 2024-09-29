<?= $this->extend('templates/index') ?>
<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <?= session()->getFlashdata('success') ?>
    <div class="row">
        <table id="datatablesSimple" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Product</th>
                    <th>Panjang Pesan</th>
                    <th>Lebar Pesan</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($pesanan as $pesan) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $pesan->product_name ?></td>
                        <td><?= $pesan->panjang_pesan ?> m</td>
                        <td><?= $pesan->lebar_pesan ?> m</td>
                        <td><?= $pesan->keterangan ?></td>
                        <td><?php
                            if ($pesan->status_id == 'n') {
                                echo '<span class="btn btn-sm bg-warning text-dark">Menunggu Validasi</span>';
                            } elseif ($pesan->status_id == 'p') {
                                echo '<span class="btn btn-sm bg-info text-dark">Diproses</span>';
                            } elseif ($pesan->status_id == 'y') {
                                echo '<span class="btn btn-sm bg-success text-white">Selesai</span>';
                            } elseif ($pesan->status_id == 'r') {
                                echo '<span class="btn btn-sm bg-danger text-white">Ditolak</span>';
                            } elseif ($pesan->status_id == 't') {
                                echo '<span class="btn btn-sm bg-secondary text-white">Menunggu Pembayaran</span>';
                            } ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal<?= $pesan->id_pesan ?>">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="detailModal<?= $pesan->id_pesan ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $pesan->id_pesan ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel<?= $pesan->id_pesan ?>">Detail Pesanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <img src="<?= base_url() ?>pesanan/<?= $pesan->file ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $pesan->product_name ?></h5>
                                            <p class="card-text"><?= $pesan->keterangan ?></p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><span>Panjang : </span><?= $pesan->panjang_pesan * 100 ?> cm </li>
                                            <li class="list-group-item"><span>Lebar : </span><?= $pesan->lebar_pesan * 100 ?> cm </li>
                                            <li class="list-group-item"><span>Jumlah Pesan : </span><?= $pesan->jml_pesan ?> pcs</li>
                                        </ul>
                                        <div class="card-body d-grid gap-2 d-flex justify-content-between">
                                            <h5 class="card-title text-danger"> Total Harga : Rp <?= number_format($pesan->total_harga, 0, ',', '.') ?></h5>
                                            <?php if ($pesan->status_id == 't') : ?>
                                                <button class="btn btn-primary" onclick="bayar('<?= $pesan->id_pesan ?>')"><i class="fa fa-credit-card"></i> Bayar</button>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function bayar(id) {
        window.location.href = '<?= base_url('bayar/') ?>' + id
    }
</script>
<?= $this->endSection() ?>