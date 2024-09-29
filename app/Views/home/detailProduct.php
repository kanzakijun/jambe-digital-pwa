<?php require 'layouts/headerDetail.php'; ?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Product Details</li>
                </ol>
            </nav>
            <h1>Product Details - <i><?= $products['nama_product'] ?></i></h1>
        </div>
    </div><!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper init-swiper">

                        <script type="application/json" class="swiper-config">
                            {
                                "loop": true,
                                "speed": 600,
                                "autoplay": {
                                    "delay": 5000
                                },
                                "slidesPerView": "auto",
                                "pagination": {
                                    "el": ".swiper-pagination",
                                    "type": "bullets",
                                    "clickable": true
                                }
                            }
                        </script>

                        <div class="swiper-wrapper align-items-center">

                            <div class="swiper-slide">
                                <img src="../../../products/<?= $products['gambar'] ?>" alt="">
                            </div>

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                        <h3>Product information</h3>
                        <ul>
                            <li><strong>Nama Product</strong>: <?= $products['nama_product'] ?></li>
                            <li><strong>Jenis Product</strong>: <?= $products['jenis_product'] ?></li>
                            <li><strong>Minimal Pesan</strong>: <?= $products['min_pesan'] ?> pcs</li>
                            <li><strong>Harga</strong>: Rp.<?= number_format($products['harga'], 2, ',', '.') ?></li>
                        </ul>
                        <a href="<?= base_url('dashboard/pesanan/' . $products['id_product']) ?>" class="btn btn-success"><i class="fa fa-plus"></i>Pesan Sekarang</a>
                    </div>
                    <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                        <h2>Deskripsi</h2>
                        <p>
                            <?= $products['deskripsi_product'] ?>
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Portfolio Details Section -->

</main>

<?php require 'layouts/footerDetail.php' ?>