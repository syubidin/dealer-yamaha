<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Controller Upload untuk mengelola data upload gambar dan deskripsi
class motor extends CI_Controller{

    // Konstruktor untuk menginisialisasi helper, library, dan model
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url')); // Helper untuk form dan URL
        $this->load->library('upload'); // Library upload untuk menangani unggahan file
        $this->load->model('motor_model'); // Model untuk interaksi dengan database
    }

    // Method default untuk menampilkan semua data upload
    public function index(){
        $data['motors'] = $this->motor_model->get_uploads(); // Mengambil semua data upload dari model
        $this->load->view('admin/motor', $data); // Memuat view dan mengirim data
    }

    // Method untuk membuat data baru
    public function create(){
        if ($this->input->post('submit')){ // Mengecek jika form dikirimkan
            // Konfigurasi untuk proses unggahan file
            $config['upload_path']='./uploads/'; // Lokasi penyimpanan file
            $config['allowed_types']='gif|jpg|png'; // Tipe file yang diizinkan
            $config['file_name']='motor_' . rand(1, 1000); // Penamaan file secara otomatis dengan angka random
            $this->upload->initialize($config); // Inisialisasi konfigurasi

            if ($this->motor->do_motor('gambar')){ // Jika unggahan berhasil
                $upload_data = $this->upload->data(); // Data file yang diunggah
                $data = array(
                    'gambar' => $upload_data['file_name'], // Nama file
                    'nama_motor' => $this->input->post('nama_motor'), // Deskripsi dari input pengguna
                    'tipe' => $this->input->post('tipe'),
                    'model' => $this->input->post('model'),
                    'bahan_bakar'=> $this->input->post('bahan_bakar'),
                    'tahun_produksi' => $this->input->post('tahun_produksi'),
                    'stok' => $this->input->post('stok'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'harga' => $this->input->post('harga'),
                    'harga_beli' => $this->input->post('harga_beli')
                );
                $this->motor_model->insert_motor($data); // Menyimpan data ke database
                redirect('motor'); // Redirect ke halaman index
            }else{ 
                // Jika unggahan gagal, tampilkan pesan error
                $error = array('error' => $this->motor->display_errors());
                $this->load->view('admin/create', $error);
            }
        }else{
            // Menampilkan halaman form jika belum ada data yang dikirim
            $this->load->view('admin/create');
        }
    }

    // Method untuk mengedit data berdasarkan ID
    public function edit($id){
        if ($this->input->post('submit')){ // Mengecek jika form dikirimkan
            // Konfigurasi untuk unggahan file baru
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = 'motor_' . rand(1, 1000); // Penamaan file baru
            $this->upload->initialize($config); // Inisialisasi konfigurasi

            if ($this->upload->do_motor('gambar')){ // Jika unggahan berhasil
                $upload_data = $this->upload->data(); // Data file baru
                $data = array(
                    'gambar' => $upload_data['file_name'], // Nama file
                    'nama_motor' => $this->input->post('nama_motor'), // Deskripsi dari input pengguna
                    'tipe' => $this->input->post('tipe'),
                    'model' => $this->input->post('model'),
                    'bahan_bakar'=> $this->input->post('bahan_bakar'),
                    'tahun_produksi' => $this->input->post('tahun_produksi'),
                    'stok' => $this->input->post('stok'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'harga' => $this->input->post('harga'),
                    'harga_beli' => $this->input->post('harga_beli')
                );
                $this->motor_model->update_upload($id, $data); // Mengupdate data di database
                redirect('motor'); // Redirect ke halaman index
            }
        }else{
            // Jika form belum dikirim, ambil data berdasarkan ID dan tampilkan halaman edit
            $data['motor'] = $this->upload_model->get_motor_by_id($id);
            $this->load->view('admin/edit', $data);
        }
    }

    // Method untuk menghapus data berdasarkan ID
    public function delete($id){
        $this->upload_model->delete_upload($id); // Memanggil fungsi delete di model untuk menghapus data
        redirect('motor'); // Redirect ke halaman index setelah penghapusan
    }
}
?>