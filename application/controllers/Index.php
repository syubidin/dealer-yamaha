<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model'); // Load model produk
    }

    public function index()
    {
        $data['title'] = 'Dealer Motor';
        $data['products'] = $this->Product_model->get_all_products(); // Ambil semua produk

        // Load tampilan utama
        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }
}
