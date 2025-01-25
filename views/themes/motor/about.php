<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/dashboard1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Tentang Kami</span>
                </p>
                <h1 class="mb-0 bread">Tentang Kami</h1>
            </div>
        </div>
    </div>
</div>
<br><br>

<section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
    <div class="container">
        <div class="row align-items-stretch">
            <!-- Kolom Video -->
            <div class="col-md-5 d-flex align-items-stretch">
                <div class="video-wrapper d-flex justify-content-center align-items-center" 
                    style="background-color: #f8f9fa; border: 1px solid #ddd; padding: 20px; border-radius: 8px; width: 100%; transition: transform 0.3s, box-shadow 0.3s;">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/R885jD-bb2o?si=4NPVHs68f0trKNf2" 
                        title="YouTube video player" frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen 
                        style="max-width: 100%; max-height: 100%; aspect-ratio: 16/9; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    </iframe>
                </div>
            </div>

            <!-- Kolom Teks -->
            <div class="col-md-7 d-flex align-items-stretch">
                <div class="category-wrap-2 ftco-animate" 
                    style="background-color: #ffffff; border: 1px solid #ddd; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s, box-shadow 0.3s;">
                    <div class="text">
                        <h2 style="color: #2c3e50;"><b>Tentang Dealer Yamaha</b></h2>
                        <p style="font-size: 16px; line-height: 1.8; color: #444;">Dealer Yamaha kami menyediakan berbagai jenis sepeda motor Yamaha berkualitas tinggi dengan pelayanan terbaik. Kami juga menyediakan layanan purna jual, termasuk perawatan, suku cadang asli, dan aksesoris resmi Yamaha.</p>
                        <p style="font-size: 16px; line-height: 1.8; color: #444;">Dengan pengalaman bertahun-tahun, kami berkomitmen memberikan kenyamanan dan kepuasan bagi pelanggan kami. Temukan berbagai penawaran menarik hanya di dealer Yamaha kami!</p>
                        <a href="https://www.yamaha-motor.co.id/" target="_blank" class="btn btn-primary" 
                            style="background-color: #007bff; border: none; padding: 10px 20px; font-size: 16px; border-radius: 5px; text-transform: uppercase; transition: background-color 0.3s, transform 0.3s;">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><br><br>

<style>
/* Efek hover untuk video */
.video-wrapper:hover {
    transform: scale(1.03); /* Sedikit memperbesar */
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); /* Bayangan lebih dalam */
}

/* Efek hover untuk teks */
.category-wrap-2:hover {
    transform: scale(1.03); /* Sedikit memperbesar */
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); /* Bayangan lebih dalam */
}

/* Efek hover untuk tombol */
.btn-primary:hover {
    background-color: #0056b3; /* Warna lebih gelap saat hover */
    transform: translateY(-3px); /* Sedikit naik ke atas */
}
</style>



<!-- 
<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
            <div class="col-md-6">
                <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
                <span>Get e-mail updates about our latest shops and special offers</span>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                        <input type="text" class="form-control" placeholder="Enter email address">
                        <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> -->

<section class="ftco-section ftco-counter img" id="section-counter"
    style="background-image: url(<?=base_url().'views/themes/'.theme_active().'/';?>images/dashboard3.jpg);">
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?=money(count(produk()));?>">0</strong>
                                <span>Produk</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?=money(count(produk_kategori()));?>">0</strong>
                                <span>Kategori</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?=money($totalorder);?>">0</strong>
                                <span>Transaksi</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?=money($totalorder);?>">0</strong>
                                <span>Pelanggan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section testimony-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <!-- <span class="subheading">Testimony</span> -->
                <h2 class="mb-4">TESTIMONI PELANGGAN</h2>
                <p>Berikut pengalaman pelanggan kami yang sudah berbelanja.</p>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel">
                    <?php foreach(testi() as $testi):?>
                    <div class="item">
                        <div class="testimony-wrap p-4 pb-5">
                            <!-- Tambahkan gambar pengguna -->
                            <div class="user-img mb-5"
                                style="background-image: url(<?= file_exists('./uploads/users/'.$testi['user_gambar']) ? base_url('uploads/users/'.$testi['user_gambar']) : base_url('uploads/users/default.png'); ?>);">
                                <span class="quote d-flex align-items-center justify-content-center">
                                    <i class="icon-quote-left"></i>
                                </span>
                            </div>
                            <!-- <div class="user-img mb-5"
								style="background-image: url(<?=base_url().'views/themes/'.theme_active().'/';?>images/person_1.jpg)">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div> -->
                            <div class="text text-center">
                                <p class="mb-5 pl-4 line"><?=$testi['message'];?></p>
                                <p class="name"><?=$testi['name'];?></p>
                                <span class="position"><?=$testi['job'];?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row no-gutters ftco-services">
            <div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-shipped"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Free Shipping</h3>
                        <span>On order over $100</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-diet"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Bergaransi</h3>
                        <span>Product well package</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-award"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Produk Berkualitas</h3>
                        <span>Produk dengan kualitas terbaik</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Support</h3>
                        <span>Support</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="row block-9">
            <!-- <div class="col-md-2 order-md-last d-flex">
                <form action="#" class="bg-white p-5 contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea name="" id="" cols="30" rows="7" class="form-control"
                            placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                    </div>
                </form>
            </div> -->

            <div class="col-md-12 d-flex" style="height:400px;">
                <div id="map" class="bg-white"></div>
                <script>
                // Initialize and add the map
                var latitude = -2.08;
                var longitude = 133.68;

                function initMap() {
                    // The location of Uluru
                    var uluru = {
                        lat: latitude,
                        lng: longitude
                    };
                    // The map, centered at Uluru
                    var map = new google.maps.Map(
                        document.getElementById('map'), {
                            zoom: 15,
                            center: uluru
                        });
                    // The marker, positioned at Uluru
                    var marker = new google.maps.Marker({
                        position: uluru,
                        map: map
                    });
                }
                </script>
                <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=<?=settings('general','google_map_api_key');?>&callback=initMap">
                </script>
            </div>
        </div>
    </div>
</section>
