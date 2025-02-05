<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/dashboard4.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Keranjang</span>
                </p>
                <h1 class="mb-0 bread">Keranjang Saya</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>PRODUCT IMAGE</th>
                                <th>PRODUCT NAME</th>
                                <th>PRICE</th>
                                <th>QTY</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <?php if ($this->session->userdata('username') && $this->session->userdata('access') == 'customer' && user() !== null && isset(user()['idusers'])): ?>
                        <tbody>
                        <?php
                            foreach (cartlist(user()['idusers']) as $items): ?>
                            <tr class="text-center">
                                <!-- Tombol Hapus -->
                                <td class="product-remove">
                                    <a href="#" id="<?=$items['idcart'];?>" class="hapus" onclick="hapusItem(<?=$items['idcart'];?>)">
                                        <span class="ion-ios-close"></span>
                                    </a>
                                </td>

                                <td class="image-prod">
                                    <div class="img"
                                        style="background-image:url('<?=base_url('uploads/products/').$items['product_image'];?>');">
                                    </div>
                                </td>

                                <td class="product-name">
                                    <h3><?=$items['product_name'];?></h3>
                                    <p>Satuan : <?=$items['satuan'];?><br> Berat : <?=floatval($items['berat']) * intval($items['qty']);?> gram
                                    </p>
                                </td>

                                <td class="price"><?=money($items['harga']);?></td>

                                <td class="quantity">
                                    <p class="text-center" style="color:black;"><?=$items['qty'];?></p>
                                </td>

                                <td class="total"><?=money($items['harga'] * $items['qty']);?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                        <?php else:?>
                        <tbody id="cart_detail">
                        </tbody>
                        <?php endif;?>
                    </table>
                </div>
            </div>
        </div>
        <form action="<?= site_url('user/proses_order'); ?>" method="post" enctype="multipart/form-data">
    <div class="row justify-content-end">
        <?php if($this->session->userdata('username') && $this->session->userdata('access') == 'customer'): ?>
        <div class="col-lg-8 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
                <h3>Alamat Pengiriman Anda</h3>
                <p>Silahkan atur lokasi anda dan lihat ongkos kirim anda</p>
                <div class="form-group mt-4">
                    <div class="radio">
                        <label class="mr-3"><input type="radio" name="alamatbaru" id="alamatbaru" value="baru" checked> Alamat Baru ?</label>
                        <label><input type="radio" name="alamatsaya" id="alamatsaya" value="<?= user()['idusers']; ?>"> Alamat Saya</label>
                    </div>
                </div>

                <div class="form-group" id="provbaru">
                    <label for="">Provinsi</label>
                    <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="prov" id="prov_order" class="form-control px-3" required>
                            <option value="0">-- Pilih Provinsi --</option>
                            <?php if (!empty($provinsi)): ?>
                                <?php foreach ($provinsi as $p): ?>
                                    <option value="<?= $p['id_prov']; ?>"><?= $p['nama']; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group" id="kabbaru">
                    <label for="">Kota/Kabupaten</label>
                    <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="kab" id="kab_order" class="form-control px-3" required></select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="towncity">Kecamatan</label>
                    <input type="text" class="form-control text-left px-3" name="kec" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="streetaddress">Kode Pos</label>
                    <input type="number" class="form-control text-left px-3" name="kodepos" required>
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea name="address" cols="30" rows="7" class="form-control text-left px-3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="">Pilih Kurir</label>
                    <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="kurir" id="kurir" class="form-control px-3" required>
                            <option value="0">-- Pilih Kurir --</option>
                            <?php foreach($datakurir as $k): ?>
                                <option value="<?= $k['kode']; ?>"><?= $k['kode'].' - '.$k['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Layanan</label>
                    <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="layanan" id="layanan" class="form-control px-3" required>
                            <option value="0">-- Pilih Layanan --</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Biaya</label>
                    <input type="hidden" class="form-control text-left px-3" name="weight" value="<?= cartWeight(user()['idusers']); ?>">
                    <input type="text" class="form-control text-left px-3" name="ongkir" placeholder="" readonly required>
                </div>

                <div class="form-group">
                    <label>Estimasi (Hari)</label>
                    <input type="text" class="form-control text-left px-3" name="estimasi" placeholder="" readonly required>
                    <input type="hidden" name="subtotal">
                    <input type="hidden" name="delivery">
                    <input type="hidden" name="carttotal">
                </div>

                

                

                <div class="form-group" id="payment_credit_duration" style="display: none;">
                    <label for="installment_duration">Durasi Angsuran (bulan)</label>
                    <select name="installment_duration" id="installment_duration" class="form-control px-3" required>
                        <option value="3">3 Bulan</option>
                        <option value="6">6 Bulan</option>
                        <option value="12">12 Bulan</option>
                        <option value="18">18 Bulan</option>
                        <option value="24">24 Bulan</option>
                    </select>
                </div>

            </div>
            <p><button type="button" class="btn btn-primary py-3 px-4" id="cekOngkir" onclick="hitungOngkir()">Hitung</button></p>
        </div>
        <?php endif; ?>

        <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
                <h3>CART TOTALS</h3>
                <form method="POST" action="<?= site_url('user/add_to_cart_totals'); ?>">
                    <input type="hidden" name="order_id" value="<?= isset($order_id) ? $order_id : ''; ?>">

                    <!-- SUBTOTAL -->
                    <p class="d-flex">
                            <span>SUBTOTAL</span>
                            <span id="cart-subtotal"><?='Rp. '.money(cartsubTotal(user()['idusers']));?></span>
                        </p>

                    
                    <!-- DELIVERY FEE -->
                    <p class="d-flex">
                        <span>DELIVERY</span>
                        <span class="biaya-ongkir"><?= isset($cart_totals['ongkir']) ? 'Rp. '.number_format($cart_totals['ongkir'], 0, ',', '.') : 'Rp. 0'; ?></span>
                        <input type="hidden" name="delivery_fee" value="<?= isset($cart_totals['ongkir']) ? $cart_totals['ongkir'] : ''; ?>">
                    </p>

                    <hr>

                    <!-- TOTAL -->
                    <p class="d-flex total-price">
                        <span>TOTAL</span>
                        <span id="cart-total"><?= isset($cart_totals['total']) ? 'Rp. '.number_format($cart_totals['total'], 0, ',', '.') : 'Rp. 0'; ?></span>
                        <input type="hidden" name="total" value="<?= isset($cart_totals['total']) ? $cart_totals['total'] : ''; ?>">
                    </p>


                    <!-- Submit Button -->
                    <?php if($this->session->userdata('username') && $this->session->userdata('access') == 'customer'): ?>
    <p>
        <button type="submit" class="btn btn-primary py-3 px-4" id="checkout-button">Proceed to Checkout</button>
    </p>
<?php else: ?>
    <p>Anda harus login terlebih dahulu untuk melakuak checkout. Silahkan <a href="<?= base_url('auth'); ?>">Klik disini</a> untuk login.</p>
<?php endif; ?>

                </form>
            </div>                   
        </div>
    </div>
</form>
    </div>

</section>

    <script>
    // JavaScript untuk menampilkan input sesuai dengan pilihan metode pembayaran
    document.querySelectorAll('input[name="payment_method"]').forEach(function (input) {
        input.addEventListener('change', function () {
            const creditSection = document.getElementById('payment_credit_section');
            const creditDuration = document.getElementById('payment_credit_duration');
            const installmentAmount = document.getElementById('installment_amount');

            // Jika memilih kredit, tampilkan bagian cicilan dan durasi
            if (this.value === 'credit') {
                creditSection.style.display = 'block';
                creditDuration.style.display = 'block';
                installmentAmount.style.display = 'block';
            } else {
                // Jika memilih tunai, sembunyikan bagian cicilan dan durasi
                creditSection.style.display = 'none';
                creditDuration.style.display = 'none';
                installmentAmount.style.display = 'none';
            }

            // Update cart totals ketika metode pembayaran berubah
            updateCartTotals();
        });
    });

    // Fungsi untuk mengupdate total harga
    function updateCartTotals() {
    const subtotal = <?= cartsubTotal(user()['idusers']); ?> || 0;
    const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
    const isCredit = selectedPayment && selectedPayment.value === 'credit';
    const interestRate = 0.10;
    let totalWithInterest = subtotal;

    if (isCredit) {
        const interest = subtotal * interestRate;
        totalWithInterest += interest;
        document.getElementById('cart-interest').textContent = `Rp. ${money(interest)}`;
    } else {
        document.getElementById('cart-interest').textContent = 'Rp. 0';
    }

    const ongkir = parseFloat(document.querySelector('input[name="ongkir"]').value) || 0;
    totalWithInterest += ongkir;
    document.querySelector('.biaya-ongkir').textContent = `Rp. ${money(ongkir)}`;

    document.getElementById('cart-subtotal').textContent = `Rp. ${money(subtotal)}`;
    document.getElementById('cart-total').textContent = `Rp. ${money(totalWithInterest)}`;

    // **Update Lama Angsuran**
    const installmentDurationInput = document.getElementById('installment_duration_input');
    const installmentDurationDisplay = document.getElementById('installment_duration_display');
    const installmentDuration = parseInt(document.getElementById('installment_duration')?.value) || 0;

    if (isCredit) {
        installmentDurationDisplay.textContent = installmentDuration > 0 ? `${installmentDuration} Bulan` : 'Cash';
        installmentDurationInput.value = installmentDuration;
    } else {
        installmentDurationDisplay.textContent = 'Cash';
        installmentDurationInput.value = ''; // Mengosongkan nilai agar tidak terkirim ke backend
    }

    updateInstallmentAmount(totalWithInterest);
}



    // Fungsi untuk menghitung dan menampilkan sisa cicilan
    function updateInstallmentAmount(totalPriceWithInterest) {
        const dpInput = document.getElementById('dp');
        if (!dpInput) return;

        const dp = parseFloat(dpInput.value) || 0;
        const remainingPrice = totalPriceWithInterest - dp;

        document.getElementById('total_after_dp').textContent = `Rp. ${money(remainingPrice)}`;

        const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
        if (selectedPayment && selectedPayment.value === 'credit') {
            const duration = parseInt(document.getElementById('installment_duration')?.value) || 1;
            const monthlyInstallment = remainingPrice / duration;
            document.getElementById('installment_amount_input').value = `Rp. ${money(monthlyInstallment)}`;
        } else {
            // Jika tunai, set cicilan ke 0
            document.getElementById('installment_amount_input').value = 'Rp. 0';
        }
    }

    // Fungsi untuk mengupdate total DP dan menghitung sisa cicilan
    function updateDP() {
        const dpInput = document.getElementById('dp'); 
        const dp = parseFloat(dpInput.value) || 0; // Ambil nilai DP (default 0 jika kosong)
        const totalPrice = parseFloat('<?=cartsubTotal(user()['idusers']);?>') || 0;
        const interestRate = 0.10; // Bunga 10%
        let totalWithInterest = totalPrice;

        // Jika memilih kredit, tambahkan bunga
        if (document.querySelector('input[name="payment_method"]:checked').value === 'credit') {
            const interest = totalPrice * interestRate;
            totalWithInterest += interest;
        }

        // Tambahkan ongkir ke total harga
        const ongkir = parseFloat(document.querySelector('input[name="ongkir"]').value) || 0;
        totalWithInterest += ongkir;

        // Hitung sisa cicilan setelah DP
        const remainingPrice = totalWithInterest - dp;

        // Menampilkan total DP dalam format mata uang
        document.getElementById('dp_display').textContent = 'Rp. ' + money(dp);

        // Menampilkan persentase DP yang dibayarkan
        const dpPercentage = ((dp / totalWithInterest) * 100).toFixed(2);
        document.getElementById('dp_percentage').textContent = dpPercentage + '%';

        // Update sisa cicilan setelah DP
        document.getElementById('total_after_dp').textContent = 'Rp. ' + money(remainingPrice);

        // Update cicilan per bulan jika menggunakan kredit
        updateInstallmentAmount(remainingPrice);

        // Pastikan nilai DP yang dihitung diset pada input form untuk dikirim ke controller
        dpInput.value = dp; // Mengupdate nilai input hidden dp dengan nilai yang dihitung
    }

    // Pastikan fungsi updateDP dipanggil saat terjadi perubahan pada form
    document.querySelector('input[name="payment_method"]').addEventListener('change', updateDP);
    document.querySelector('input[name="ongkir"]').addEventListener('input', updateDP);

    // Event listener untuk input DP
    document.getElementById('dp').addEventListener('input', function () {
        const dpValue = parseFloat(this.value) || 0;
        document.getElementById('dp_display').textContent = 'Rp. ' + money(dpValue);
    });

    // Event listener untuk perubahan durasi cicilan
    document.getElementById('installment_duration').addEventListener('change', function () {
        const duration = this.value;
        document.getElementById('installment_duration_display').textContent = duration ? `${duration} Bulan` : 'Cash';
        document.getElementById('installment_duration_input').value = duration;
    });

    // Fungsi untuk mengubah format uang
    function money(value) {
        return value.toLocaleString();
    }

    // Fungsi untuk menghitung ongkir
    function hitungOngkir() {
        const provinsi = document.getElementById('prov_order')?.value;
        const kabupaten = document.getElementById('kab_order')?.value;
        const kecamatan = document.querySelector('input[name="kec"]')?.value;
        const kurir = document.getElementById('kurir')?.value;

        if (!provinsi || !kabupaten || !kecamatan || !kurir || provinsi === '0' || kabupaten === '0' || kurir === '0') {
            alert('Silakan lengkapi semua informasi yang diperlukan!');
            return;
        }

        const berat = <?= cartWeight(user()['idusers']); ?>;
        const biayaOngkir = berat * 125; // Contoh perhitungan ongkir
        const estimasi = 3; // Estimasi 3 hari

        document.querySelector('input[name="ongkir"]').value = biayaOngkir;
        document.querySelector('input[name="estimasi"]').value = estimasi;

        const subtotal = <?= cartsubTotal(user()['idusers']); ?>;
        const total = subtotal + biayaOngkir;
        document.querySelector('.biaya-ongkir').textContent = `Rp. ${money(biayaOngkir)}`;
        document.getElementById('cart-total').textContent = `Rp. ${money(total)}`;

        updateCartTotals();
        alert('Biaya ongkir berhasil dihitung!');
    }

    document.getElementById('checkout-button').addEventListener('click', function(event) {
    const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
    
    // Jika metode pembayaran tunai, form akan diarahkan ke checkout
    if (selectedPayment && selectedPayment.value === 'cash') {
        // Pastikan form di-submit tanpa membuka konfirmasi pembayaran
        document.querySelector('form').submit();
    } else if (selectedPayment && selectedPayment.value === 'credit') {
        // Untuk kredit, lanjutkan dengan konfirmasi pembayaran
        window.location.href = "<?= base_url('konfirmasi-pembayaran'); ?>";
    } else {
        event.preventDefault();  // Cegah pengiriman form jika metode pembayaran belum dipilih
        alert('Pilih metode pembayaran terlebih dahulu!');
    }
});


</script>

