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
        <form action="<?=base_url('user/proses_order');?>" method="post" enctype="multipart/form-data">
            <div class="row justify-content-end">
                <?php if($this->session->userdata('username') && $this->session->userdata('access')=='customer'):?>
                <div class="col-lg-8 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Alamat Pengiriman Anda</h3>
                        <p>Silahkan atur lokasi anda dan lihat ongkos kirim anda</p>
                        <div class="form-group mt-4">
                            <div class="radio">
                                <label class="mr-3"><input type="radio" name="alamatbaru" id="alamatbaru" value="baru"
                                        checked>
                                    Alamat
                                    Baru ? </label>
                                <label><input type="radio" name="alamatsaya" id="alamatsaya"
                                        value="<?=user()['idusers'];?>">
                                    Alamat
                                    Saya</label>
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
                                <select name="kab" id="kab_order" class="form-control px-3" required>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="towncity">Kecamatan</label>
                            <input type="text" class="form-control text-left px-3" name="kec" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="streetaddress">Kode Pos</label>
                            <input type="text" class="form-control text-left px-3" name="kodepos" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="address" id="" cols="30" rows="7" class="form-control text-left px-3"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Pilih Kurir</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="kurir" id="kurir" class="form-control  px-3" required>
                                    <option value="0">-- Pilih Kurir --</option>
                                    <?php foreach($datakurir as $k): ?>
                                    <option value="<?= $k['kode']; ?>"><?= $k['kode'].' - '.$k['nama']; ?>
                                    </option>
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
                            <input type="hidden" class="form-control text-left px-3" name="weight"
                                value="<?=cartWeight(user()['idusers']);?>">
                            <input type="text" class="form-control text-left px-3" name="ongkir" placeholder="" readonly
                                required>
                        </div>
                        <div class="form-group">
                            <label>Estimasi (Hari)</label>
                            <input type="text" class="form-control text-left px-3" name="estimasi" placeholder=""
                                readonly required>
                            <input type="hidden" name="subtotal">
                            <input type="hidden" name="delivery">
                            <input type="hidden" name="carttotal">
                        </div>

                        <div class="form-group">
                            <label for="">Pilih Metode Pembayaran</label>
                            <div class="radio">
                                <label><input type="radio" name="payment_method" value="cash" checked> Pembayaran Tunai (Lunas)</label><br>
                                <label><input type="radio" name="payment_method" value="credit"> Pembayaran Kredit (Cicilan)</label>
                            </div>
                        </div>

                        <div class="form-group" id="payment_credit_section" style="display: none;">
                            <label for="dp">Uang Muka (DP)</label>
                            <input type="number" class="form-control text-left px-3" id="dp" name="dp" min="0" placeholder="Masukkan Uang Muka" required>
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

                        <div class="form-group" id="installment_amount" style="display: none;">
                            <label for="installment_amount_label">Jumlah Cicilan Per Bulan</label>
                            <input type="text" id="installment_amount_input" class="form-control text-left px-3" readonly>
                        </div>
                    </div>
                    <p><button type="button" class="btn btn-primary py-3 px-4" id="cekOngkir" onclick="hitungOngkir()">Hitung</button></p>
                </div>
                <?php endif;?>

                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
    <h3>CART TOTALS</h3>
    <form method="POST" action="<?= site_url('user/add_to_cart_totals'); ?>">
        <input type="hidden" name="order_id" value="<?= isset($order_id) ? $order_id : ''; ?>">

        <!-- SUBTOTAL -->
        <p class="d-flex">
            <span>SUBTOTAL</span>
            <span id="cart-subtotal"><?= isset($cart_totals['total']) ? 'Rp. '.number_format($cart_totals['total'], 0, ',', '.') : 'Rp. 0'; ?></span>
            <input type="hidden" name="subtotal" value="<?= isset($cart_totals['total']) ? $cart_totals['total'] : ''; ?>">
        </p>

        <!-- BUNGA -->
        <p class="d-flex">
            <span>BUNGA (10%)</span>
            <span id="cart-interest"><?= isset($cart_totals['bunga']) ? 'Rp. '.number_format($cart_totals['bunga'], 0, ',', '.') : 'Rp. 0'; ?></span>
            <input type="hidden" name="interest_rate" value="10"> <!-- Contoh bunga 10% -->
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

        <!-- TOTAL SISA CICILAN -->
        <p class="d-flex total-price">
            <span>TOTAL SISA CICILAN</span>
            <span id="total_after_dp"><?= isset($cart_totals['sisa_cicilan']) ? 'Rp. '.number_format($cart_totals['sisa_cicilan'], 0, ',', '.') : 'Rp. 0'; ?></span>
            <input type="hidden" name="sisa_cicilan" value="<?= isset($cart_totals['sisa_cicilan']) ? $cart_totals['sisa_cicilan'] : ''; ?>">
        </p>

        <!-- Down Payment -->
        <div class="form-group">
            <span>JUMLAH DP</span>
            <span id="dp"><?= isset($cart_totals['dp']) ? 'Rp. '.number_format($cart_totals['dp'], 0, ',', '.') : 'Rp. 0'; ?></span>
            <input type="hidden" name="dp" value="<?= isset($cart_totals['dp']) ? $cart_totals['dp'] : ''; ?>">
        </div>

        <!-- Installment Duration -->
        <div class="form-group">
            <span>LAMA ANGSURAN</span>
            <span id="installment_duration"><?= isset($cart_totals['']) ? number_format($cart_totals['installment_duration'], 0, ',', '.').' Bulan' : ' Cash'; ?></span>
            <input type="hidden" name="installment_duration" id="installment_duration" class="form-control">
        </div>

        <!-- Submit Button -->
        <?php if($this->session->userdata('username') && $this->session->userdata('access')=='customer'):?>
        <p>
            <button type="submit" class="btn btn-primary py-3 px-4">Proceed to Checkout</button>
        </p>
        <?php else:?>
        <p>Anda harus login terlebih dahulu untuk melakuak checkout. Silahkan <a
                href="<?=base_url('auth');?>">Klik disini</a> untuk login.</p>
        <?php endif;?>
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
        const totalPrice = parseFloat('<?=cartsubTotal(user()['idusers']);?>');
        
        if (this.value === 'credit') {
            creditSection.style.display = 'block';
            creditDuration.style.display = 'block';
            installmentAmount.style.display = 'block';
        } else {
            creditSection.style.display = 'none';
            creditDuration.style.display = 'none';
            installmentAmount.style.display = 'none';
        }

        // Update cart totals when payment method changes
        updateCartTotals();
    });
});


// Fungsi untuk mengupdate cart totals, termasuk bunga dan total keseluruhan
function updateCartTotals() {
    const totalPrice = parseFloat('<?=cartsubTotal(user()['idusers']);?>');
    const isCredit = document.querySelector('input[name="payment_method"]:checked').value === 'credit';
    const interestRate = 0.10; // Bunga 10%
    let totalWithInterest = totalPrice;

    // Jika memilih pembayaran kredit, hitung bunga 10%
    if (isCredit) {
        const interest = totalPrice * interestRate;
        totalWithInterest += interest; // Tambahkan bunga ke total
        document.getElementById('cart-interest').textContent = `Rp. ${money(interest)}`;
    } else {
        document.getElementById('cart-interest').textContent = 'Rp. 0';
    }

    // Tambahkan ongkir ke total harga
    const ongkir = parseFloat(document.querySelector('input[name="ongkir"]').value) || 0;
    totalWithInterest += ongkir;
    document.querySelector('.biaya-ongkir').textContent = `Rp. ${money(ongkir)}`;

    // Update total harga setelah dihitung bunga dan ongkir
    document.getElementById('cart-total').textContent = `Rp. ${money(totalWithInterest)}`;
    
    // Update sisa cicilan setelah DP
    updateInstallmentAmount(totalWithInterest);
}

// Fungsi untuk menghitung dan menampilkan sisa cicilan
function updateInstallmentAmount(totalPriceWithInterest) {
    const dp = parseFloat(document.getElementById('dp').value) || 0;
    const remainingPrice = totalPriceWithInterest - dp;

    // Menampilkan total setelah DP
    document.getElementById('total_after_dp').textContent = `Rp. ${money(remainingPrice)}`;

    // Hitung cicilan per bulan jika metode pembayaran adalah kredit
    if (document.querySelector('input[name="payment_method"]:checked').value === 'credit') {
        const duration = parseInt(document.getElementById('installment_duration').value) || 1; // Default 1 bulan
        const monthlyInstallment = remainingPrice / duration;
        document.getElementById('installment_amount_input').value = 'Rp. ' + money(monthlyInstallment);
    }
}

// Update total cicilan setelah DP dan ongkir dihitung
document.getElementById('dp').addEventListener('input', function () {
    const totalPrice = parseFloat('<?=cartsubTotal(user()['idusers']);?>') || 0;
    const interestRate = 0.10; // Bunga 10%
    let totalWithInterest = totalPrice;

    // Jika memilih pembayaran kredit, hitung bunga 10%
    if (document.querySelector('input[name="payment_method"]:checked').value === 'credit') {
        const interest = totalPrice * interestRate;
        totalWithInterest += interest; // Tambahkan bunga ke total
    }

    // Tambahkan ongkir ke total harga
    const ongkir = parseFloat(document.querySelector('input[name="ongkir"]').value) || 0;
    totalWithInterest += ongkir;

    // Update sisa cicilan dan cicilan per bulan
    updateInstallmentAmount(totalWithInterest);
});



document.getElementById('installment_duration').addEventListener('change', function () {
    document.getElementById('dp').dispatchEvent(new Event('input'));
});

// Fungsi untuk mengubah format uang
function money(value) {
    return value.toLocaleString();
}

function hitungOngkir() {
    // Ambil data input
    const provinsi = document.getElementById('prov_order').value;
    const kabupaten = document.getElementById('kab_order').value;
    const kecamatan = document.querySelector('input[name="kec"]').value;
    const kurir = document.getElementById('kurir').value;

    // Validasi input
    if (provinsi === '0' || kabupaten === '0' || !kecamatan || kurir === '0') {
        alert('Silakan lengkapi semua informasi yang diperlukan!');
        return;
    }

    // Simulasi penghitungan ongkir
    const berat = <?= cartWeight(user()['idusers']); ?>; // Berat total dari cart
    const biayaOngkir = berat * 125; // Contoh penghitungan ongkir
    const estimasi = 3; // Estimasi hari pengiriman (3 hari)

    // Tampilkan hasil ke form
    document.querySelector('input[name="ongkir"]').value = biayaOngkir;
    document.querySelector('input[name="estimasi"]').value = estimasi;

    // Update total harga
    const subtotal = <?= cartsubTotal(user()['idusers']); ?>;
    const total = subtotal + biayaOngkir;
    document.querySelector('.biaya-ongkir').textContent = `Rp. ${biayaOngkir}`;
    document.getElementById('cart-total').textContent = `Rp. ${total}`;

    // Update cart totals again after shipping cost
    updateCartTotals();

    // Pesan sukses
    alert('Biaya ongkir berhasil dihitung!');
}

</script>