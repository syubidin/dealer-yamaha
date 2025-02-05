<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_m');
    }

    public function index()
    {
        $data['title'] = 'All Transactions';
        $data['transaction'] = true;
        $data['alltransaction'] = $this->User_m->allTransaction();
        $data['content'] = 'backend/transaction';
        $this->load->view('backend/index', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Transaction Details';
        $data['detail'] = $this->User_m->detailTransaksi($id);
        $data['content'] = 'backend/detail';
        $this->load->view('backend/index', $data);
    }

    public function ongkir()
    {
        $data['content'] = 'backend/ongkir';
        $this->load->view('backend/index', $data);
    }

    public function payment()
    {
        $data['title'] = 'All Payments';
        $data['payment'] = true;
        $data['allpayment'] = $this->User_m->allPayment();
        $userId = user()['idusers'];
        $data['content'] = 'backend/payment';
        $this->load->view('backend/index', $data);
    }

    public function editStatusBayar()
    {
        $status = $this->input->post('status', true);
        $orderId = $this->input->post('orderid', true);
        $paymentId = $this->input->post('idbayar', true);

        $bayar = [
            "status" => $status,
            "update_at" => get_dateTime(),
            "update_by" => user()['idusers']
        ];

        $this->db->where('idpembayaran', $paymentId);
        $this->db->update('pembayaran', $bayar);

        $order = [
            "status_bayar" => ($status != 'verified') ? 'belum lunas' : 'lunas',
            "status" => ($status != 'verified') ? 'pembayaran pending' : 'pembayaran terima'
        ];

        $this->db->where('idorder', $orderId);
        $this->db->update('pesanan', $order);

        redirect('transaction/payment');
    }

    public function editStatus()
    {
        $data = [
            "status" => $this->input->post('status', true),
            "update_at" => get_dateTime(),
            "update_by" => user()['idusers']
        ];

        $this->db->where('idorder', $this->input->post('idorder', true));
        $this->db->update('pesanan', $data);
        redirect('transaction');
    }

    public function editResi()
    {
        $data = [
            "no_resi" => $this->input->post('no_resi', true),
            "update_at" => get_dateTime(),
            "update_by" => user()['idusers']
        ];

        $this->db->where('idorder', $this->input->post('idorder', true));
        $this->db->update('pesanan', $data);
        redirect('transaction');
    }

    public function view()
    {
        $id = $this->input->post('id', true);
        $data = $this->db->get_where('pesanan', ['idorder' => $id])->row();
        echo json_encode($data);
    }

    public function viewPembayaran()
    {
        $id = $this->input->post('id', true);
        $data = $this->db->get_where('pembayaran', ['idpembayaran' => $id])->row();
        echo json_encode($data);
    }

    public function delete()
    {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            foreach ($id as $item) {
                // Review if Category_m or another model is used for deletion
                $this->Category_m->delete($item);
            }
        } else {
            $id = $this->input->post('idx');
            foreach ($id as $item) {
                // Review if Category_m or another model is used for permanent deletion
                $this->Category_m->delete_permanen($item);
            }
        }
    }

    public function restore()
    {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            foreach ($id as $item) {
                // Review if Posts_m or another model is used for restoration
                $this->Posts_m->restore($item);
            }
        }
    }
}

/* End of file Transaction.php */
