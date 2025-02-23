    <?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class User_m extends CI_Model {

        public function __construct()
        {
            parent::__construct();
            is_logged_in();
        }

        public function addBayar($image)
        {
            $data = [
                'total' => $this->input->post('total', true),
                'file' => $image,
                'keterangan' => $this->input->post('keterangan', true),
                'tgl_bayar' => get_dateTime()
            ];
            $this->db->where('idpembayaran', $this->input->post('idbayar', true));
            $this->db->update('pembayaran', $data);
        }

        public function blocked($id)
        {
            $data = [
                'is_block' => 1
            ];
            $this->db->where('idusers', $id);
            $this->db->update('users', $data);
        }

        public function unblocked($id)
        {
            $data = [
                'is_block' => 0
            ];
            $this->db->where('idusers', $id);
            $this->db->update('users', $data);
        }

        public function tambah_order($data)
        {
            $this->db->insert('pesanan', $data);
            $id = $this->db->insert_id();
            return (isset($id)) ? $id : FALSE;
        }

        public function tambah_bayar($data)
        {
            $this->db->insert('pembayaran', $data);
            $id = $this->db->insert_id();
            return (isset($id)) ? $id : FALSE;
        }

        public function tambah_detail_order($data)
        {
            $this->db->insert('detail_order', $data);
        }

        public function allTransaction()
        {
            $this->db->join('users', 'users.idusers = pesanan.user_id', 'left');
            return $this->db->get('pesanan')->result();
        }

        public function allPayment()
        {
            $this->db->join('pesanan', 'pesanan.idorder = pembayaran.order_id', 'left');
            $sql = "SELECT pembayaran.*, pesanan.*, pembayaran.status AS verify FROM pembayaran, pesanan WHERE pembayaran.order_id = pesanan.idorder";
            return $this->db->query($sql)->result_array();
        }

        public function detailTransaksi($id)
        {
            // $this->db->join('detail_order', 'detail_order.order_id = pesanan.idorder', 'left');
            $this->db->join('users', 'users.idusers = pesanan.user_id', 'left');
            $this->db->join('user_profile', 'user_profile.users_id = users.idusers', 'left');
            return $this->db->get_where('pesanan', ['idorder' => $id])->row();
        }

        public function getProfile($id)
        {
            $this->db->select('user_profile.*, provinsi.nama as nama_prov, kabupaten.nama as nama_kab');
            $this->db->join('kabupaten', 'kabupaten.id_kab = user_profile.kab', 'left');
            $this->db->join('provinsi', 'provinsi.id_prov = user_profile.prov', 'left');
            return $this->db->get_where('user_profile', ['users_id' => $id])->row();
        }

        public function totalBeli($id)
        {
            $this->db->join('detail_order', 'detail_order.order_id = pesanan.idorder', 'left');
            return $this->db->get_where('pesanan', ['user_id' => $id])->result();
        }

        // Add a new method for processing the order.
        public function processOrder($orderData)
        {
            $this->db->insert('pesanan', $orderData);
            return $this->db->insert_id();
        }

        // Add a method for inserting the payment data.
        public function processPayment($paymentData)
        {
            $this->db->insert('pembayaran', $paymentData);
            return $this->db->insert_id();
        }

        // Add a method to insert order details.
        public function processOrderDetails($orderDetails)
        {
            $this->db->insert('detail_order', $orderDetails);
        }

        // A method to clear the cart after order processing.
        public function clearCart($userId)
        {
            $this->db->where('user_id', $userId);
            $this->db->delete('cart');
        }
        public function updatePaymentStatus($idbayar, $data)
        {
            $this->db->where('idpembayaran', $idbayar);
            $this->db->update('pembayaran', $data);
        }
        public function get_cart_totals($user_id) {
            $this->db->where('user_id', $user_id);
            $this->db->order_by('create_at', 'DESC'); // Jika ingin mengambil data terbaru
            $query = $this->db->get('cart'); // Ambil dari tabel `cart`
            return $query->row_array(); // Hanya ambil satu baris (terbaru)
        }

        public function save_credit_payment($data)
        {
            $this->db->insert('credit_payments', $data);
            return $this->db->insert_id();
        }

        public function getCicilanDetail($order_id)
{
    // Memilih kolom yang diperlukan, termasuk total dan sisa cicilan
    $this->db->select('total, remaining_installments as sisa_cicilan');
    // Menambahkan kondisi untuk filter berdasarkan order_id
    $this->db->where('order_id', $order_id);
    
    // Mengambil data dari tabel credit_payments
    return $this->db->get('credit_payments')->row();
}

    
    }

    /* End of file User_m.php */
