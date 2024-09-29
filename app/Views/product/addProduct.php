<?= view('layouts/header') ?>
<?= view('layouts/topbar') ?>
<?= view('layouts/sidebar') ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="mt-4">
                <h1>Add Product</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/product">Product</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>

                <div class="row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="card">
                            <div class="card-body">
                                <?= form_open_multipart('product/saveProduct', ['onsubmit' => 'return validateForm()']); ?>
                                <div class="mb-3">
                                    <label for="nama_product" class="form-label">Nama Product<span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" class="form-control" id="nama_product" name="nama_product" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_product" class="form-label">Jenis Product<span class="text-danger"><sup>*</sup></span></label>
                                    <!-- <input type="text" class="form-control" id="jenis_product" name="jenis_product" required> -->
                                    <select class="form-select" name="jenis_product" id="jenis_product" required>
                                        <option value="">Pilih</option>
                                        <option value="sticker">STICKER</option>
                                        <option value="mmt">MMT</option>
                                        <option value="dtf">DTF</option>
                                        <option value="a3">A3</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_product" class="form-label">Deskripsi Product<span class="text-danger"><sup>*</sup></span></label>
                                    <textarea name="deskripsi_product" id="deskripsi_product" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="panjang" class="form-label">Panjang<span class="text-danger"><sup>*</sup></span></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="panjang" name="panjang" aria-describedby="basic-addon1" min="1" required>
                                                <span class="input-group-text" id="basic-addon1">cm</span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="lebar" class="form-label">lebar<span class="text-danger"><sup>*</sup></span></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="lebar" name="lebar" aria-describedby="basic-addon1" min="1" required>
                                                <span class="input-group-text" id="basic-addon1">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="harga" class="form-label">Harga<span class="text-danger"><sup>*</sup></span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                                            <input type="number" class="form-control" id="harga" name="harga" aria-describedby="basic-addon1" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="minPesan" class="form-label">Minimal Pesan<span class="text-danger"><sup>*</sup></span></label>
                                        <input type="number" class="form-control" id="minPesan" name="minPesan" aria-describedby="basic-addon1" min="1" required>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                    <small class="form-text text-muted">Only JPG, JPEG, PNG, GIF files are allowed. Max size: 2MB.</small>
                                </div>
                                <div id="fileError" class="text-danger"></div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button class="btn btn-secondary ms-2" type="button" onclick="history.back()">Cancel</button>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mt-4 w-100">
                    <img id="imagePreview" src="#" alt="Image Preview" class="card-img-top mb-3 mt-3 w-100 h-100 d-none">
                </div>
    </main>
</div>
</div>
</div>
<?= view('layouts/footer') ?>

<script>
    document.getElementById('gambar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        if (file) {
            reader.onload = function(e) {
                const img = document.getElementById('imagePreview');
                img.src = e.target.result;
                img.classList = 'd-block';
            };
            reader.readAsDataURL(file);
        } else {
            // Hide the image preview if no file is selected
            document.getElementById('imagePreview').classList = 'd-none';
        }
    });

    function validateForm() {
        const fileInput = document.getElementById('gambar');
        const file = fileInput.files[0];
        const fileError = document.getElementById('fileError');
        fileError.textContent = ''; // Clear any previous error message

        if (file) {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes

            if (!allowedTypes.includes(file.type)) {
                fileError.textContent = 'Invalid file type. Only JPG, JPEG, PNG, GIF files are allowed.';
                return false;
            }

            if (file.size > maxSize) {
                fileError.textContent = 'File size exceeds the maximum limit of 2MB.';
                return false;
            }
        }

        return true;
    }
</script>