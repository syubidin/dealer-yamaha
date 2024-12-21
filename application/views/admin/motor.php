<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Produk Motor</title>

    <!-- Ini buat tampilan tabel biar lebih keren pakai DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
    <!-- Tambahin Bootstrap CSS biar gampang bikin halaman yang rapi dan responsif -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <style>
        body{
            background-color:#EEEDEA;
        }
    </style>

    <div class="container my-5"> <!-- Area utama halaman yang dikasih jarak atas-bawah (margin). -->
        <div class="text-center mb-4"> <!-- Buat judul halaman, posisinya di tengah. -->
            <h2 class="text-primary">Data Upload</h2> <!-- Judul besar, warna biru. -->
            
            <!-- Tombol buat nambah data baru, link-nya ke halaman tambah data -->
            <a href="<?= site_url('upload/create'); ?>" class="btn btn-success btn-sm mt-3">
                <i class="bi bi-plus-circle"></i> Tambah Data <!-- Teks tombol dan icon tambah. -->
            </a>
        </div>

        <div class="container">
        <!-- Tabel buat nampilin data -->
        <table id="motorTable" class="table table-bordered table-striped table-hover">
            <thead class="table-primary"> <!-- Bagian header tabel, warnanya biru muda. -->
                <tr>
                    <th>Kode</th> <!-- Kolom nomor urut. -->
                    <th>Nama</th> <!-- Kolom buat nampilin gambar. -->
                    <th>Gambar</th> <!-- Kolom buat deskripsi data. -->
                    <th>Tipe</th> <!-- Kolom buat deskripsi data. -->
                    <th>Model</th> <!-- Kolom buat deskripsi data. -->
                    <th>Bahan Bakar</th> <!-- Kolom buat deskripsi data. -->
                    <th>Tahun Produksi</th> <!-- Kolom buat deskripsi data. -->
                    <th>Stok</th> <!-- Kolom buat tombol edit atau hapus data. -->
                    <th>Harga Beli</th> <!-- Kolom buat tombol edit atau hapus data. -->
                    <th>Deskripsi</th> <!-- Kolom buat tombol edit atau hapus data. -->
                    <th>Harga Jual</th> <!-- Kolom buat tombol edit atau hapus data. -->
                    <th>Action</th> <!-- Kolom buat tombol edit atau hapus data. -->
                </tr>
            </thead>
            <tbody>
                <!-- Di sini datanya bakal dimasukin pakai PHP -->
                <?php $no=1; foreach ($motors as $motor): ?> <!-- Mulai looping datanya. -->
                    <tr>
                        <td><?= $no; ?></td> <!-- Nomor urut data. -->
                        <td><?= $motor->nama_motor; ?></td> <!-- Deskripsi data. -->
                        <td class="text-center"> <!-- Gambar ditaruh di tengah kolom. -->
                            <img src="<?= base_url('motors/'.$motor->gambar); ?>" class="img-thumbnail" width="90px"> <!-- Nampilin gambar ukuran kecil (thumbnail). -->
                        </td>
                        <td><?= $motor->tipe; ?></td> <!-- Deskripsi data. -->
                        <td><?= $motor->model; ?></td> <!-- Deskripsi data. -->
                        <td><?= $motor->bahan_bakar; ?></td> <!-- Deskripsi data. -->
                        <td><?= $motor->tahun_produksi; ?></td> <!-- Deskripsi data. -->
                        <td><?= $motor->stok; ?></td> <!-- Deskripsi data. -->
                        <td><?= $motor->harga_beli; ?></td> <!-- Deskripsi data. -->
                        <td><?= $motor->deskripsi; ?></td> <!-- Deskripsi data. -->
                        <td><?= $motor->harga; ?></td> <!-- Deskripsi data. -->
                        <td class="text-center"> <!-- Tombol edit dan hapus ada di tengah kolom. -->
                            <a href="<?= site_url('motor/edit/'.$motor->id); ?>" class="btn btn-warning btn-sm"> <!-- Tombol edit data. -->
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="<?= site_url('motor/delete/'.$motor->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');"> <!-- Tombol hapus data (pakai konfirmasi dulu). -->
                            <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php $no++; endforeach; ?> <!-- Nomor data naik terus tiap looping. -->
            </tbody>
        </table>
    </div>

    <!-- Script buat aktifin DataTables biar tabelnya interaktif -->
    <script type="text/javascript">
        $(document).ready(function(){ // Kalo halaman udah siap, jalankan ini.
            $('#motorTable').DataTable({ // Aktifin fitur DataTables di tabel dengan ID "uploadTable".
                responsive: true, // Tabelnya bisa menyesuaikan ukuran layar.
                autoWidth: false, // Lebar tabelnya ga diatur otomatis (supaya lebih rapi).
                
                // Ngatur teks-teks di tabel (misalnya bahasa yang dipake).
                language: {
                    search: "Cari:", // Teks buat kolom cari.
                    lengthMenu: "Tampilkan MENU entri", // Pilihan jumlah data yang mau ditampilkan.
                    info: "Menampilkan START ke END dari TOTAL entri", // Informasi jumlah data yang tampil.
                    paginate: { 
                        first: "Pertama", // Tombol ke halaman pertama.
                        last: "Terakhir", // Tombol ke halaman terakhir.
                        next: "Berikutnya", // Tombol ke halaman berikutnya.
                        previous: "Sebelumnya" // Tombol ke halaman sebelumnya.
                    }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Script jQuery buat bantuin urusan interaktif di halaman -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Script buat fitur DataTables, misalnya filter dan pagination -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <!-- Bootstrap JS, buat fitur interaktif kayak tombol atau modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>