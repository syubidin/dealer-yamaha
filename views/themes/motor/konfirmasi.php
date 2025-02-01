<?php
// Debugging, lihat isi dari objek $b
echo '<pre>';
print_r(bayar(user()['idusers']));
echo '</pre>';
?>




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
    <?php if(empty($testi->user_id)): ?>
    <div class="col-md-12 d-flex mb-3">
        <form action="<?=base_url('user/addKonfirmasi');?>" method="post" class="bg-white p-5 contact-form" enctype="multipart/form-data">
            <!-- Pilih Pesanan -->
            <div class="form-group">
    <label>Pilih Pesanan</label>
    <select name="idbayar" class="form-control" id="idbayar" required>
        <option value="">Pilih Pesanan</option>
        <?php foreach(bayar(user()['idusers']) as $b): ?>
            <option value="<?=$b->idpembayaran;?>" data-total="<?=$b->total;?>">
                <!-- Menampilkan nomor pesanan dan gambar pesanan -->
                Pesanan: <?=$b->order_id;?> 
                <img src="<?=base_url('assets/images/yamaha/' . $b->product_image);?>" alt="Gambar Pesanan" style="width: 50px; height: 50px; object-fit: cover;">
            </option>
        <?php endforeach; ?>    
    </select>   
</div>




            <!-- Detail Cicilan (Akan Ditampilkan Setelah Memilih Pesanan) -->
            <div id="detail_cicilan" style="display: none;">
                <div class="form-group">
                    <label>Total Pesanan</label>
                    <input type="text" class="form-control" id="total_pesanan" readonly>
                </div>
                <div class="form-group">
                    <label>Sisa Cicilan</label>
                    <input type="text" class="form-control" id="sisa_cicilan" readonly>
                </div>
                <div class="form-group">
                    <label>Uang Muka</label>
                    <input type="number" class="form-control" name="uang_muka" id="uang_muka" placeholder="Masukkan Uang Muka" required>
                </div>
                <div class="form-group">
                    <label>Durasi Cicilan (bulan)</label>
                    <input type="number" class="form-control" name="durasi_cicilan" id="durasi_cicilan" placeholder="Masukkan Durasi Cicilan" required>
                </div>
                <div class="form-group">
                    <label>Cicilan Per Bulan</label>
                    <input type="text" class="form-control" id="cicilan_per_bulan" readonly>
                </div>
            </div>

            <!-- Tombol Konfirmasi -->
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary py-3 px-5">Konfirmasi Pembayaran</button>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Menampilkan detail cicilan saat pesanan dipilih
    $('#idbayar').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var idbayar = selectedOption.val();

        if (idbayar) {
            // Kirim AJAX request untuk mengambil detail cicilan
            $.ajax({
                url: '<?=base_url('user/getDetailCicilan');?>',
                method: 'POST',
                data: { idbayar: idbayar },
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        // Tampilkan detail cicilan
                        $('#detail_cicilan').show();
                        $('#total_pesanan').val(response.total);
                        $('#sisa_cicilan').val(response.sisa_cicilan);

                        // Hitung cicilan per bulan saat uang muka atau durasi cicilan diubah
                        $('#uang_muka, #durasi_cicilan').on('input', function() {
                            var uangMuka = parseFloat($('#uang_muka').val()) || 0;
                            var durasiCicilan = parseFloat($('#durasi_cicilan').val()) || 1;
                            var sisaCicilan = parseFloat(response.sisa_cicilan) || 0;

                            if (uangMuka > 0 && durasiCicilan > 0) {
                                var cicilanPerBulan = (sisaCicilan - uangMuka) / durasiCicilan;
                                $('#cicilan_per_bulan').val(cicilanPerBulan.toFixed(2));
                            } else {
                                $('#cicilan_per_bulan').val('');
                            }
                        });
                    }
                }
            });
        } else {
            // Sembunyikan detail cicilan jika tidak ada pesanan yang dipilih
            $('#detail_cicilan').hide();
        }
    });
});
</script>