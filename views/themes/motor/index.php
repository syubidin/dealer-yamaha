<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dealer Motor Yamaha</title>
    <link rel="icon" href="<?= base_url('assets/logo-ridezone.png')?>" type="image/x-icon">
    <meta charset="utf-8">
    

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/animate.css">

    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/magnific-popup.css">

    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/aos.css">

    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/ionicons.min.css">

    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/jquery.timepicker.css">


    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/flaticon.css">
    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/icomoon.css">
    <link rel="stylesheet" href="<?=base_url().'views/themes/'.theme_active().'/';?>css/style.css?v=<?=time();?>">

</head>

<body class="goto-here">
    <div class="py-1 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"></div>
                                    <img src="<?= base_url('assets/logo-ridezone.png')?>" alt="E-commerce Logo" class="mr-2" style="height:50px; width:70px">
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-phone2"></span></div>
                            <a href="tel:<?=settings('company_profile','phone');?>"><span
                                    class="text">081382055381</span></a>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-paper-plane"></span></div>
                            <a href="mailto:<?=settings('company_profile','email');?>"><span
                                    class="text">yamaha.motor@gmail.com</span></a>
                        </div>
                        <?php if(empty($this->session->userdata('username')) && $this->session->userdata('access')!='customer'):?>
                        <div class="col-md-1 pr-1 d-flex topper align-items-center text-lg-right">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-user-plus"></span></div>
                            <a href="<?=base_url('auth/register');?>"><span class="text">Register</span></a>
                        </div>
                        <div class="col-md-1 pr-1 d-flex topper align-items-center text-lg-right">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-user"></span></div>
                            <a href="<?=base_url('auth');?>"><span class="text">Login</span></a>
                        </div>
                        <?php endif;?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
        <a class="navbar-brand" href="https://www.yamaha-motor.co.id/" target="blank">Dealer Motor Yamaha</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?=isset($beranda) ? 'active':'';?>"><a href="<?=base_url();?>"
                            class="nav-link">Beranda</a></li>
                    <li class="nav-item <?=isset($publicproduct) ? 'active':'';?>"><a
                            href="<?=base_url('public/product');?>" class="nav-link">Produk</a></li>
                    <li class="nav-item <?=isset($publiccategory) ? 'active':'';?>"><a
                            href="<?=base_url('public/category');?>" class="nav-link">Kategori</a></li>
                    <li class="nav-item <?=isset($publicabout) ? 'active':'';?>"><a
                            href="<?=base_url('public/about');?>" class="nav-link">Tentang Kami</a></li>
                    <!-- <li class="nav-item <?=isset($allproduct) ? 'active':'';?>"><a
                            href="<?=base_url('public/user_profil');?>" class="nav-link">Contact</a></li> -->

                    <?php if($this->session->userdata('username') && $this->session->userdata('access')=='customer'):?>
                    <li class="nav-item cta cta-colored"><a href="<?=base_url('cart');?>" class="nav-link"><span
                                class="icon-shopping_cart">[<?=count(cartTotal(user()['idusers']));?>]</span></a></li>
                    <?php else:?>
                    <li class="nav-item cta cta-colored"><a href="<?=base_url('cart');?>" class="nav-link"
                            id="total"></a></li>
                    <?php endif;?>
                    <?php if($this->session->userdata('username') && $this->session->userdata('access')=='customer'):?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdown04" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><?=user()['user_fullname'];?></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="<?=base_url('user');?>">Profil</a>
                            <a class="dropdown-item" href="<?=base_url('public/konfirmasi');?>">Konfirmasi
                                Pembayaran</a>
                            <a class="dropdown-item" href="<?=base_url('public/testimoni');?>">Testimoni</a>
                            <a class="dropdown-item" href="<?=base_url('auth/logout');?>">Keluar</a>
                        </div>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
    <?php $this->load->view($content);?>
    <hr>

    <footer class="ftco-footer ftco-section">
        <div class="container">
            <div class="row">
                <div class="mouse">
                    <a href="#" class="mouse-icon">
                        <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                    </a>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2"><a href="#">DEALER MOTOR YAMAHA</a></h2>
                        <p>Produk resmi dan bergaransi dari yamaha motor</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="<?=settings('social_account','twitter');?>"><span
                                        class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="<?=settings('social_account','facebook');?>"><span
                                        class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="<?=settings('social_account','instagram');?>"><span
                                        class="icon-instagram"></span></a></li>
                            <li class="ftco-animate"><a href="<?=settings('social_account','youtube');?>"><span
                                        class="icon-youtube"></span></a></li>
                            <li class="ftco-animate"><a href="<?=settings('company_profile','website');?>"><span
                                        class="icon-globe"></span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Menu</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Shop</a></li>
                            <li><a href="#" class="py-2 d-block">About</a></li>
                            <li><a href="#" class="py-2 d-block">Journal</a></li>
                            <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                        </ul>
                    </div>
                </div> -->
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Kategori</h2>
                        <div class="tagcloud">
                            <?php foreach(produk_kategori() as $pk):?>
                            <a href="<?=base_url('category/').$pk['idcategory'].'/'.$pk['category_seo'];?>"
                                class="tag-cloud-link"><?=$pk['category_name'];?></a>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Hubungi Kami</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span
                                        class="text">Jl.Kelapa Gading Jakarta Utara<br>                                        
                                        Kode Pos
                                        14270</span></li>

                                <li><a href="tel:<?=settings('company_profile','phone');?>"><span
                                            class="icon icon-phone"></span><span
                                            class="text">087874080963</span></a></li>
                                <li><a href="mailto:<?=settings('company_profile','email');?>"><span
                                            class="icon icon-envelope"></span><span
                                            class="text">fortunis11@gmail.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:-65px;">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy; <?=date('Y');?> All rights reserved
							
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" /></svg></div>

</body>

<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/jquery.min.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/jquery-migrate-3.0.1.min.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/popper.min.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/bootstrap.min.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/jquery.easing.1.3.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/jquery.waypoints.min.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/jquery.stellar.min.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/owl.carousel.min.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/jquery.magnific-popup.min.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/aos.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/jquery.animateNumber.min.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/bootstrap-datepicker.js"></script>
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/scrollax.min.js"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=<?=settings('general','google_map_api_key');?>&sensor=false">
</script> -->
<!-- <script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/google-map.js"></script> -->
<script src="<?=base_url().'views/themes/'.theme_active().'/';?>js/main.js"></script>
<script>
$(document).ready(function() {

    var quantity = 1;
    $('.quantity-right-plus').click(function(e) {

        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('.quantity').val());

        // If is not undefined

        $('.quantity').val(quantity + 1);


        // Increment

    });

    $('.quantity-left-minus').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('.quantity').val());

        // If is not undefined

        // Increment
        if (quantity > 1) {
            $('.quantity').val(quantity - 1);
        }
    });


});
$(document).ready(function() {
    load_pesanan();
    load_total();
    cart_total();
    $('.buy-now').click(function() {
        var produk_id = $(this).data("produkid");
        var produk_gambar = $(this).data("produkgambar");
        var produk_nama = $(this).data("produknama");
        var produk_harga = $(this).data("produkharga");
        var produk_satuan = $(this).data("produksatuan");
        var produk_berat = $(this).data("produkberat");
        var qty = $('#' + produk_id).val();
        // alert(produk_id);
        // alert(produk_gambar);
        // alert(produk_nama);
        // alert(produk_harga);
        // alert(qty);
        $.ajax({
            url: "<?=base_url();?>welcome/add_to_cart",
            method: "POST",
            data: {
                produk_id: produk_id,
                produk_gambar: produk_gambar,
                produk_nama: produk_nama,
                produk_harga: produk_harga,
                produk_satuan: produk_satuan,
                produk_berat: produk_berat,
                qty: qty
            },
            success: function(data) {
                $('#cart_detail').html(data);
                window.location = "<?=site_url();?>cart";
            }
        });
    });
    $('.buy-now-login').click(function() {
        var produk_id = $(this).data("produkid");
        var produk_gambar = $(this).data("produkgambar");
        var produk_nama = $(this).data("produknama");
        var produk_harga = $(this).data("produkharga");
        var produk_satuan = $(this).data("produksatuan");
        var produk_berat = $(this).data("produkberat");
        var qty = $('#' + produk_id).val();
        // alert(produk_id);
        // alert(produk_gambar);
        // alert(produk_nama);
        // alert(produk_harga);
        // alert(qty);
        $.ajax({
            url: "<?=base_url();?>welcome/add_cart",
            method: "POST",
            data: {
                produk_id: produk_id,
                produk_gambar: produk_gambar,
                produk_nama: produk_nama,
                produk_harga: produk_harga,
                produk_satuan: produk_satuan,
                produk_berat: produk_berat,
                qty: qty
            },
            success: function(data) {
                // $('#cart_detail').html(data);
                window.location = "<?=site_url();?>cart";
            }
        });
    });


    // $('#jml_bayar').mask('000,000,000,000,000', {
    //     reverse: true
    // });
    // $('#jml_bayar').on("input", function() {
    //     var jumlah = $('#jml_bayar').val();
    //     $('#dibayar').html('Rp. ' + jumlah);
    // })
    // // Load shopping cart
    // $('#detail_cart').load("http://localhost/simapp/welcome/load_cart");

    function load_pesanan() {
        $('#cart_detail').load("<?=base_url();?>welcome/load_cart");
    }

    function load_total() {
        $('#total').load("<?=base_url();?>welcome/load_total");
    }

    function cart_total() {
        $('.view-cart-total').load("<?=base_url();?>welcome/cart_total");
    }


    //Hapus Item Cart
    $(document).on('click', '.hapus', function() {
        var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
        $.ajax({
            url: "<?=base_url();?>welcome/hapus",
            method: "POST",
            data: {
                row_id: row_id
            },
            success: function(data) {
                window.location = "<?=site_url();?>cart";
            }


        });
    });
    //Hapus Item Cart
    $(document).on('click', '.hapus_cart', function() {
        var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
        $.ajax({
            url: "<?=base_url();?>welcome/hapus_cart",
            method: "POST",
            data: {
                row_id: row_id
            },
            success: function(data) {
                $('#detail_cart').html(data);
                load_pesanan();
                load_total();
                cart_total();
            }


        });
    });
    $('#form-addbayar').hide();

    // function bayar(id) {
    //     alert(id);
    // }
    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
    }

    function convertToAngka(rupiah) {
        return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
    }
    $('#cekOngkir').click(function() {
        var total = convertToAngka($('#cart-subtotal').html());
        var berat = parseInt($('[name="weight"]').val());
        var kab_id = $('[name="kab"]').val();
        var kurir = $('[name="kurir"]').val();
        var layanan = $('[name="layanan"]').val();
        $.ajax({
            type: "POST",
            data: {
                kab_id: kab_id,
                kurir: kurir,
                layanan: layanan
            },
            url: '<?=base_url();?>wilayah/cek',
            dataType: 'json',
            success: function(data) {
                $('[name="ongkir"]').val(data.biaya);
                $('[name="estimasi"]').val(data.estimasi);
                if (berat > 1000) {
                    var biayaongkir = (berat / 1000) * parseInt(data.biaya);
                } else {
                    var biayaongkir = parseInt(data.biaya);
                }
                $('.biaya-ongkir').html(convertToRupiah(biayaongkir.toFixed(0)));
                $('#cart-total').html(convertToRupiah(biayaongkir + total));
                $('[name="subtotal"]').val(total);
                $('[name="delivery"]').val(biayaongkir);
                $('[name="carttotal"]').val(biayaongkir + total);

                // window.location = "<?=site_url();?>cart";
            }
        });
    });
    $('#alamatsaya').click(function() {
        $('[name="alamatsaya"]').prop('checked', true);
        $('[name="alamatbaru"]').prop('checked', false);
        var x = $('[name="alamatsaya"]').val();
        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>user/viewAlamat',
            dataType: 'json',
            success: function(data) {
                $('[name="prov"]').val(data.prov);
                var kabhtml = '<option value="' + data.kab + '">' + data.nama_kab +
                    '</option>';
                $('#kab_order').html(kabhtml);
                $('[name="kec"]').val(data.kec);
                $('[name="kec"]').prop('readonly', true);
                $('[name="kodepos"]').val(data.kodepos);
                $('[name="kodepos"]').prop('readonly', true);
                $('[name="address"]').val(data.address);
                $('[name="address"]').prop('readonly', true);
            }
        });
    });
    $('#alamatbaru').click(function() {
        $('[name="alamatbaru"]').prop('checked', true);
        $('[name="alamatsaya"]').prop('checked', false);
        $('[name="kec"]').prop('readonly', false);
        $('[name="kodepos"]').prop('readonly', false);
        $('[name="address"]').prop('readonly', false);
        $('[name="prov"]').val(0);
        var kabbaru = '<option value="0">-- Pilih Kota/Kabupaten --</option>';
        $('[name="kab"]').html(kabbaru);
        $('[name="kec"]').val("");
        $('[name="kodepos"]').val("");
        $('[name="address"]').val("");
        $('[name="kurir"]').val(0);
        $('[name="layanan"]').val(0);
        $('[name="ongkir"]').val("");
        $('[name="estimasi"]').val("");
    });


});
$(function() {
    $.ajaxSetup({
        type: "POST",
        url: "<?= base_url('wilayah/ambilData') ?>",
        cache: false,
    });
    //Order
    $("#prov_order").change(function() {
        var value = $(this).val();
        if (value > 0) {
            $.ajax({
                data: {
                    modul: 'kabupaten',
                    id: value
                },
                success: function(respond) {
                    $("#kab_order").html(respond);
                }
            })
        }
    });
    //Customer
    $("#prov_customer").change(function() {
        var value = $(this).val();
        if (value > 0) {
            $.ajax({
                data: {
                    modul: 'kabupaten',
                    id: value
                },
                success: function(respond) {
                    $("#kab_customer").html(respond);
                }
            })
        }
    });
    //Layanan
    $("#kurir").change(function() {
        var value = $(this).val();
        if (value != '') {
            $.ajax({
                data: {
                    modul: 'layanan',
                    id: value
                },
                success: function(respond) {
                    $("#layanan").html(respond);
                }
            })
        }
    });



    // $("#kec").change(function() {
    //     var value = $(this).val();
    //     if (value > 0) {
    //         $.ajax({
    //             data: {
    //                 modul: 'kelurahan',
    //                 id: value
    //             },
    //             success: function(respond) {
    //                 $("#kel").html(respond);
    //             }
    //         })
    //     }
    // });

})
</script>







</html>
