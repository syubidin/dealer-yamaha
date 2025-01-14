<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/dashboard4.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Kategori</span>
                </p>
                <h1 class="mb-0 bread">KATEGORI PRODUK KAMI</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-category ftco-no-pt mt-4">
    <div class="container position-relative">
        <div class="row justify-content-center mt-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h4 class="mb-4">Kategori Produk Kami</h4>
            </div>
        </div>

        <!-- Carousel -->
        <div id="categoryCarousel" class="carousel slide" data-ride="carousel">
            <!-- Carousel Items -->
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row">
                        <?php 
                        $query = $this->db->query("SELECT * FROM product_category LIMIT 0, 3")->result_array();
                        foreach($query as $pk): ?>
                        <div class="col-md-4">
                            <a href="<?=base_url('category/').$pk['idcategory'].'/'.$pk['category_seo'];?>">
                                <div class="category-wrap ftco-animate img mb-2 d-flex align-items-end"
                                    style="background-image: url(<?=base_url().'uploads/category/'.$pk['category_image'];?>);
                                           border-radius: 10px;
                                           box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                           height: 300px; /* Ukuran tetap */
                                           background-size: cover;
                                           background-position: center;
                                           overflow: hidden;
                                           transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                    <div class="text px-3 py-1" 
                                        style="background: rgba(0, 0, 0, 0.5); 
                                               border-radius: 5px; 
                                               text-align: center;">
                                        <h2 class="mb-0" style="color: white; font-size: 18px; font-weight: bold; text-transform: uppercase;">
                                            <?=$pk['category_name'];?>
                                        </h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row">
                        <?php 
                        $query = $this->db->query("SELECT * FROM product_category LIMIT 3, 3")->result_array();
                        foreach($query as $pk): ?>
                        <div class="col-md-4">
                            <a href="<?=base_url('category/').$pk['idcategory'].'/'.$pk['category_seo'];?>">
                                <div class="category-wrap ftco-animate img mb-2 d-flex align-items-end"
                                    style="background-image: url(<?=base_url().'uploads/category/'.$pk['category_image'];?>);
                                           border-radius: 10px;
                                           box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                           height: 300px; /* Ukuran tetap */
                                           background-size: cover;
                                           background-position: center;
                                           overflow: hidden;
                                           transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                    <div class="text px-3 py-1" 
                                        style="background: rgba(0, 0, 0, 0.5); 
                                               border-radius: 5px; 
                                               text-align: center;">
                                        <h2 class="mb-0" style="color: white; font-size: 18px; font-weight: bold; text-transform: uppercase;">
                                            <?=$pk['category_name'];?>
                                        </h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#categoryCarousel" role="button" data-slide="prev" 
                style="position: absolute; left: -50px; top: 50%; transform: translateY(-50%); z-index: 1000;">
                <span class="carousel-control-prev-icon" aria-hidden="true" 
                      style="background-color: black; border-radius: 50%; padding: 10px;"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#categoryCarousel" role="button" data-slide="next" 
                style="position: absolute; right: -50px; top: 50%; transform: translateY(-50%); z-index: 1000;">
                <span class="carousel-control-next-icon" aria-hidden="true" 
                      style="background-color: black; border-radius: 50%; padding: 10px;"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>
