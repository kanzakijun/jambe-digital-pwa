<?= $this->extend('templates/index') ?>
<?= $this->section('content') ?>
<style>
    .image-preview {
        display: none;
        margin-top: 1rem;
        max-width: 100%;
        max-height: 300px;
    }
</style>
<div class="container-fluid px-4">
    <h1 class="mt-4">Pesanan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pesanan</li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    <div class="row">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?= base_url('products/' . $products['gambar']) ?>" class="img-fluid rounded-start" alt="<?= $products['nama_product'] ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <table>
                            <tr>
                                <th>Product Name</th>
                                <td>:</td>
                                <td><?= $products['nama_product'] ?></td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>:</td>
                                <td><?= $products['deskripsi_product'] ?></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>:</td>
                                <td>Rp.<?= number_format($products['harga'], 2, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <th>Ukuran Minmal</th>
                                <td>:</td>
                                <td><?= $products['panjang'] ?>cm x <?= $products['lebar'] ?>cm</td>
                            </tr>
                            <tr>
                                <th>Minimal Pesan</th>
                                <td>:</td>
                                <td><?= $products['min_pesan'] ?> pcs</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-3 mb-3"> -->

    <div class="row">
        <form action="<?= base_url('pesan') ?>" method="post" enctype="multipart/form-data">
            <label for="" class="form-label">Ukuran</label>
            <table>
                <tr>
                    <th>Panjang</th>
                    <td>:</td>
                    <td><input type="number" name="panjang" min="<?= $products['panjang'] ?>" class="form-control" value="<?= $products['panjang'] ?>"></td>
                    <td>cm</td>
                </tr>
                <tr>
                    <th>Lebar</th>
                    <td>:</td>
                    <td><input type="number" name="lebar" min="<?= $products['lebar'] ?>" class="form-control" value="<?= $products['lebar'] ?>"></td>
                    <td>cm</td>
                </tr>
                <tr>
                    <th>Jumlah Cetak</th>
                    <td>:</td>
                    <td><input type="number" name="jml_cetak" min="1" class="form-control" value="1" required></td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>:</td>
                    <td>
                        <textarea class="form-control" name="ket" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </td>
                </tr>
            </table>
            <label for="">Upload foto draft / file?</label>
            <input type="checkbox" id="file" onclick="toggleFileUpload()">
            <div class="mb-3 mt-3 col-3" id="fileUp" style="display: none;">
                <input type="file" class="form-control" name="inputFile" id="fileInput" onchange="previewImage()">
                <img id="imagePreview" class="image-preview" src="" alt="Image Preview">
            </div>
    </div>
    <input type="hidden" name="id_user" value="<?= user()->id ?>">
    <input type="hidden" name="id_product" value="<?= $products['id_product'] ?>">
    <input type="hidden" name="name" value="<?= $products['nama_product'] ?>">
    <input type="hidden" name="price" value="<?= $products['harga'] ?>">

    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Pesan Sekarang</button>
    </form>
</div>
</div>
<!-- </div> -->
</div>

<script>
    function toggleFileUpload() {
        var fileCheckbox = document.getElementById('file');
        var fileUploadDiv = document.getElementById('fileUp');
        if (fileCheckbox.checked) {
            fileUploadDiv.style.display = 'block';
        } else {
            fileUploadDiv.style.display = 'none';
            // Hide the image preview if checkbox is unchecked
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('imagePreview').src = '';
            document.getElementById('fileInput').value = ''; // Reset the file input
        }
    }

    function previewImage() {
        var fileInput = document.getElementById('fileInput');
        var imagePreview = document.getElementById('imagePreview');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '';
            imagePreview.style.display = 'none';
        }
    }
</script>
<?= $this->endSection() ?>