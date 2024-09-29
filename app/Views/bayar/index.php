<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Detail Pembayaran</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Nama Produk: <?= $nama_product ?></h5>
                        <p class="card-text">Jumlah Pesanan: <?= $jml_pesan ?> pcs</p>
                        <p class="card-text">Panjang: <?= $panjang_pesan ?> m</p>
                        <p class="card-text">Lebar: <?= $lebar_pesan ?> m</p>
                        <h4 class="card-title">Total Harga: Rp <?= number_format($total_harga, 0, ',', '.') ?></h4>

                        <form id="payment-form" method="POST" action="<?= base_url('pesanan/processPayment') ?>">
                            <?= csrf_field() ?> <!-- CSRF protection -->
                            <input type="hidden" name="id_pesan" value="<?= $id_pesan ?>">
                            <button type="button" class="btn btn-primary" id="pay-button"><i class="fa fa-credit-card"></i> Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $clientKey ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('<?= $snapToken ?>', {
                // Optional
                onSuccess: function(result) {
                    /* Handling success callback */
                    console.log(result);
                    alert('Payment Success!');
                    // Optionally, you can redirect to a success page
                    window.location.href = "<?= base_url('payment/success/' . $id_pesan) ?>";
                },
                onPending: function(result) {
                    /* Handling pending callback */
                    console.log(result);
                    alert('Waiting for payment...');
                },
                onError: function(result) {
                    /* Handling error callback */
                    console.log(result);
                    alert('Payment Failed!');
                }
            });
        };
    </script>
</body>

</html>