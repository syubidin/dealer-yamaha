<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    // Fungsi untuk mengambil semua produk
    public function get_all_products()
    {
        $query = $this->db->get('products'); // Ambil data dari tabel `products`
        return $query->result_array();
    }

    // Fungsi untuk mengambil detail produk berdasarkan ID
    public function get_product_by_id($id)
    {
        $query = $this->db->get_where('products', ['id' => $id]);
        return $query->row_array();
    }
}
