<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/dashboard5.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Konfirmasi</span>
                </p>
                <h1 class="mb-0 bread">Konfirmasi Pembayaran</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="bg-white p-3 mb-4" style="overflow:scroll; height:300px;width:100%;color:black;">
            <?=$infobank->informasi;?>
        </div>
        <div class="row block-9">
            <?php if(empty($testi->user_id)):?>
            <div class="col-md-12 d-flex mb-3">
                <form action="<?=base_url('user/addKonfirmasi');?>" method="post" class="bg-white p-5 contact-form" enctype="multipart/form-data">
                    <!-- Pilih Pesanan -->
                    <div class="form-group">
                        <label>Pilih Pesanan</label>
                        <select name="idbayar" class="form-control" required>
                            <option value="">Pilih Pesanan</option>
                            <?php foreach(bayar(user()['idusers']) as $b): ?>
                                <option value="<?=$b->idpembayaran;?>">
                                    Pesanan: <?=$b->code;?> | Total: <?=number_format($b->total, 0, ',', '.');?> | Sisa Cicilan: <?=number_format($b->sisa_cicilan, 0, ',', '.');?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Pilih Metode Pembayaran -->
                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <select name="jenis_pembayaran" class="form-control" id="jenis_pembayaran" required>
                            <option value="cash">Cash (Lunas)</option>
                            <option value="credit">Credit</option>
                        </select>
                    </div>

                    <!-- Form untuk Pembayaran Cash -->
                    <div id="cash_payment" class="payment-method">
                        <div class="form-group">
                            <label>Total Pembayaran</label>
                            <input type="text" class="form-control" name="total" placeholder="Total Bayar" value="" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" cols="30" rows="7" class="form-control" placeholder="Keterangan" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>File Bukti Pembayaran</label>
                            <input type="file" class="form-control" name="bukti" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary py-3 px-5">Konfirmasi Pembayaran</button>
                        </div>
                    </div>

                    <!-- Form untuk Pembayaran Kredit -->
                    <div id="credit_payment" class="payment-method" style="display:none;">
                        <div class="form-group">
                            <label>Uang Muka</label>
                            <input type="number" class="form-control" name="uang_muka" placeholder="Masukkan Uang Muka" required>
                        </div>
                        <div class="form-group">
                            <label>Durasi Cicilan (bulan)</label>
                            <input type="number" class="form-control" name="durasi_cicilan" placeholder="Masukkan Durasi Cicilan" required>
                        </div>
                        <div class="form-group">
                            <label>Sisa Cicilan</label>
                            <input type="text" class="form-control" name="sisa_cicilan" placeholder="Sisa Cicilan" required readonly>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary py-3 px-5">Konfirmasi Pembayaran Cicilan</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    $('#jenis_pembayaran').on('change', function() {
    var jenisPembayaran = $(this).val();

    // Menyesuaikan tampilan form berdasarkan pilihan metode pembayaran
    if (jenisPembayaran === 'cash') {
        $('#cash_payment').show();
        $('#credit_payment').hide();
    } else if (jenisPembayaran === 'credit') {
        $('#credit_payment').show();
        $('#cash_payment').hide();
    }
});

// Menyesuaikan total dan sisa cicilan berdasarkan pesanan yang dipilih
$('select[name="idbayar"]').on('change', function() {
    var selectedOrder = $(this).val();
    if (selectedOrder) {
        $.ajax({
            url: '<?=base_url('user/getOrderDetails');?>',
            method: 'POST',
            data: { order_id: selectedOrder },
            dataType: 'json',
            success: function(response) {
                if (response) {
                    // Update nilai total dan sisa cicilan
                    $('input[name="total"]').val(response.total);
                    $('input[name="sisa_cicilan"]').val(response.sisa_cicilan);
                }
            }
        });
    }
});

</script>