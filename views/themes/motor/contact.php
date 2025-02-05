<div class="hero-wrap hero-bread"
     style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/banner6.png'); height:600px;">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Kontak</span>
                </p>
                <h1 class="mb-0 bread">Kontak Kami</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section contact-section bg-light">
    <div class="container">
        <!-- Pesan Flash -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success fade-out">
                <span class="alert-icon">&#10004;</span> <!-- Ikon centang untuk sukses -->
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger fade-out">
                <span class="alert-icon">&#9888;</span> <!-- Ikon peringatan untuk error -->
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <!-- End Pesan Flash -->

        <div class="row block-9 justify-content-center d-flex">
        <?php if(isset($contact) || true): ?>

                <!-- Kotak yang menyatukan form dan gambar -->
                <div class="col-md-12 d-flex" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); background-color: #fff;">
                    <!-- Kolom untuk Formulir Kontak -->
                    <div class="col-md-6 d-flex">
                        <form action="<?=base_url('user/addContact');?>" method="post" class="bg-white p-5 contact-form" 
                              style="box-shadow: none; padding: 20px; flex: 1; display: flex; flex-direction: column;">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="user_id" value="<?=user()['idusers'];?>">
                                <input type="text" class="form-control" name="nama_contact" placeholder="Nama Lengkap Anda"
                                    value="<?=set_value('nama_contact', user()['user_fullname']);?>" required
                                    style="border-radius: 4px; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc;">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_contact" placeholder="No. Telp Anda"
                                    value="<?=set_value('no_contact', user()['user_telp']);?>" required
                                    style="border-radius: 4px; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc;">
                            </div>
                            <div class="form-group">
                                <textarea name="pesan" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Pesan Anda" required style="border-radius: 4px; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc;"></textarea>
                                <small class="text-red"><?=form_error('pesan');?></small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary py-3 px-5" 
                                        style="background-color: #007bff; border: none; border-radius: 5px; font-size: 16px; padding: 10px 20px; cursor: pointer;">
                                    Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Kolom untuk Gambar -->
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <img src="<?=base_url('assets/kontak.jpg') ?>" alt="Kontak Image" style="width: 100%; height: auto;">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
/* Umum untuk pesan flash */
.alert {
    background-color: #ffffff;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    font-size: 16px;
    transition: opacity 1s ease-out;
    opacity: 1; /* Mulai dari penuh */
}

/* Ikon untuk pesan sukses/error */
.alert-icon {
    font-size: 20px;
    margin-right: 15px;
}

/* Pesan Sukses */
.alert-success {
    border-left: 5px solid #00acee;
    color: #00acee;
}

.alert-success .alert-icon {
    color: #00acee;
}

/* Pesan Error */
.alert-danger {
    border-left: 5px solid #dc3545;
    color: #dc3545;
}

.alert-danger .alert-icon {
    color: #dc3545;
}

/* Animasi fade-out */
@keyframes fadeOut {
    0% { opacity: 1; }
    80% { opacity: 1; }
    100% { opacity: 0; }
}

/* Efek fade-out otomatis setelah beberapa detik */
.alert.fade-out {
    animation: fadeOut 4s forwards; /* Durasi 4 detik */
}
</style>
