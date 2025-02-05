<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<section class="content-header">
    <h1><?= $title; ?></h1>
    <ol class="breadcrumb">
    <a href="<?= base_url('product/laporan'); ?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Refresh">
            <i class="fa fa-refresh"></i>
        </a>
        <button onclick="printTable()" class="btn btn-sm btn-primary" data-toggle="tooltip"
            data-placement="top"><i class="bi bi-printer"> Printer</i></button>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <div class="box">
        <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead class="bg-gray">
                    <tr>
                        <th width="20">NO</th>
                        <th>GAMBAR</th>
                        <th>NAMA PRODUK</th>
                        <th>HARGA BELI</th>
                        <th>HARGA JUAL</th>
                        <th>DISKON</th>
                        <th>KEUNTUNGAN</th> <!-- Kolom untuk Keuntungan -->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $n = 1;
                    foreach ($alllaporan as $p): 
                    ?>
                    <tr>
                        <td><?= $n++; ?>.</td>
                        <td>
                            <img src="<?= base_url('uploads/products/' . $p->product_image); ?>" alt="<?= $p->product_name; ?>" width="50" height="50">
                        </td>
                        <td><?= $p->product_name; ?></td>
                        <td><?= 'Rp. ' . number_format($p->harga_beli, 0, ',', '.'); ?></td>
                        <td><?= 'Rp. ' . number_format($p->harga_jual, 0, ',', '.'); ?></td>
                        <td><?= 'Rp. ' . number_format($p->diskon, 0, ',', '.'); ?></td>
                        <td><?= 'Rp. ' . number_format(($p->harga_jual - $p->harga_beli - $p->diskon), 0, ',', '.'); ?></td> <!-- Perhitungan keuntungan dikurangi diskon -->
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script type="text/javascript">
        // Fungsi untuk mencetak tabel
        function printTable() {
            var printContents = document.getElementsByTagName('table')[0].outerHTML; // Ambil elemen tabel
            var originalContents = document.body.innerHTML; // Simpan konten asli halaman
            document.body.innerHTML = printContents; // Ganti konten halaman dengan tabel
            window.print(); // Cetak halaman
            document.body.innerHTML = originalContents; // Kembalikan konten halaman seperti semula
        }

        $(document).ready(function(){ // Ketika dokumen sudah siap
            $('#uploadTable').DataTable({ // Aktifkan DataTables pada tabel
                responsive: true, // Tabel responsif terhadap ukuran layar
                autoWidth: false, // Tidak otomatis mengatur lebar kolom
                language: { // Pengaturan teks di tabel
                    search: "Cari:", // Label pencarian
                    lengthMenu: "Tampilkan MENU entri", // Label dropdown jumlah data
                    info: "Menampilkan START ke END dari TOTAL entri", // Informasi jumlah data
                    paginate: {
                        first: "Pertama", // Label tombol halaman pertama
                        last: "Terakhir", // Label tombol halaman terakhir
                        next: "Berikutnya", // Label tombol halaman berikutnya
                        previous: "Sebelumnya" // Label tombol halaman sebelumnya
                    }
                }
            });
        });
    </script>