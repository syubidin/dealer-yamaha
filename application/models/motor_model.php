<?php
// Model untuk mengelola data upload ke database
class motor_model extends CI_Model {

    // Konstruktor: digunakan untuk menginisialisasi database
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Memuat library database
    }

    // Method untuk mendapatkan semua data dari tabel tbl_upload
    public function get_motors() {
        $query = $this->db->get('tbl_motor'); // Mengambil semua data dari tabel
        return $query->result(); // Mengembalikan hasil sebagai array objek
    }

    // Method untuk menambahkan data baru ke tabel tbl_upload
    public function insert_motor($data) {
        $this->db->insert('tbl_motor', $data); // Menyisipkan data ke tabel
        return $this->db->insert_id(); // Mengembalikan ID dari data yang baru dimasukkan
    }

    // Method untuk mendapatkan data spesifik berdasarkan ID
    public function get_motor_by_id($id) {
        $this->db->where('id', $id); // Menambahkan kondisi WHERE id = $id
        $query = $this->db->get('tbl_motor'); // Mengambil data dari tabel
        return $query->row(); // Mengembalikan satu baris data sebagai objek
    }

    // Method untuk memperbarui data berdasarkan ID
    public function motor_upload($id, $data) {
        $this->db->where('id', $id); // Menentukan data mana yang akan diupdate

        // Mengambil data lama untuk menghapus file gambar sebelumnya
        $upload = $this->db->get('tbl_motor')->row(); 
        unlink('./motors/' . $upload->gambar); // Menghapus file lama dari folder uploads
        
        $this->db->where('id', $id); // Menentukan data yang sama
        $this->db->update('tbl_motor', $data); // Memperbarui data di tabel
    }

    // Method untuk menghapus data berdasarkan ID
    public function delete_motor($id) {
        $this->db->where('id', $id); // Menentukan data mana yang akan dihapus

        // Mengambil data untuk menghapus file gambar terkait
        $upload = $this->db->get('tbl_motor')->row(); 
        unlink('./motor/' . $upload->gambar); // Menghapus file dari folder uploads

        $this->db->where('id', $id); // Menentukan data yang sama
        $this->db->delete('tbl_motor'); // Menghapus data dari tabel
    }
}
?>